<?php
class PhotoModel extends CI_Model{
    
    function PhotoModel()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getLocalFolder(){
    	$this->load->helper('path');
    	return set_realpath('images/products');
    }
    
    function getUrlPath(){
    	return base_url().'images/products';
    }

    //function return list of photo by a given product_id
    function getPhotoListByProductId($product_id, $active_only = TRUE){
    	$sql_extra = '';
    	if ($active_only){
    		$sql_extra = ' and is_active = 1 ';
    	}
    	$sql = 'select *, filename as photo_filename from photo 
    			where product_id = ? '.$sql_extra.' order by is_main DESC, weight ASC';

        $query = $this->db->query($sql, array($product_id));
        $data = $query->result_array();
        
        $query->free_result();  
        return $data;      
    }
    
    //function return photo by a given product_id
    function getPhotoById($photo_id){
    	$sql = 'select *, filename as photo_filename from photo where photo_id = ?';
    	$query = $this->db->query($sql, $photo_id);
        $data = $query->row_array();
        
        $query->free_result();  
        return $data;
    }
    
    //return image file name of default/main photo for a given product_id
    function getDefaultPhoto($product_id){
    	$sql = 'select filename from photo where product_id = ? and is_active = 1 and is_main = 1 limit 1';
    	$query = $this->db->query($sql, $product_id);
        $data = $query->row_array();
        $query->free_result();  
        
        $photo = 'noimage.jpg';
        if (isset($data['filename'])){
        	$photo = $data['filename'];   
        }
        return $photo;	
    }
    
    function getNewPhotoFileName($product_id){
    	$photo_count = $this::countPhotoByProductId($product_id);

        if ($photo_count == 0){
    		//first photo for this product_id 			- filename = [product_id].[file_extension]
    		$filename = $product_id;
    	}
    	else{
    		//second photo onward for this product_id 	- filename = [product_id]_[4 digits random number].[file_extension]
    		$this->load->helper('string');
    		$filename = $product_id.'_'.random_string('alnum', 4);
    	}    	
    	
    	return $filename;
    }
    
    //function to add photo - function return new photo object
    function addPhoto($product_id, $filename, $param = null){
    	$photo_count = $this::countPhotoByProductId($product_id);

    	if (!is_array($param)){
    		$param = array();
    	}
    	
    	$param['product_id']   = $product_id;
    	$param['date_created'] = date('Y-m-d H:i:s');
		$param['filename']     = $filename;
		    	
    	if ($photo_count == 0){
    		//first photo - set as main automatically
    		$param['is_main']  = 1;
    	}
    	
    	$this->db->insert('photo', $param); 
    	
    	$new_photo_id = $this->db->insert_id();
    	return $new_photo_id;
    }
    
    //function update photo ($param is array of name and value where name is field's name and value is new udpate value)
    function updatePhoto($photo_id, $param){
        $this->db->where('photo_id', $photo_id);
        $this->db->update('photo', $param);
        
        if (isset($param['is_main'])){
        	if ($param['is_main'] == 1){
        		$photo = $this->getPhotoById($photo_id);
        		$sql = 'update photo set is_main = 0 where product_id = '.$photo['product_id'].' and photo_id != '.$photo_id;
        		$this->db->query($sql);
        	}
        }
    }
    
    //function return number of photo for a given product_id
    function countPhotoByProductId($product_id){
    	$sql = 'select count(*) as count_photo from photo where product_id = ?';
    	$query = $this->db->query($sql, $product_id);
        $data = $query->row_array();
        
        $query->free_result();  
        return $data['count_photo'];
    }
    
    //function delete photo by a given photo_id
    function deletePhoto($id){
    	$photo = $this::getPhotoById($id);
    	if (count($photo) > 0){
 	    	$filename = $photo['filename'];
	    	
	    	//delete from db
	    	$this->db->delete('photo', array('photo_id' => $id));
	    	
	    	//delete file
	    	try{
	    		unlink($this::getLocalFolder().$filename);
	    	}
	    	catch(Exception $e){
	    		//delete failed (could be file is not found or no permission)
	    	}

	    	return TRUE;
    	}
    	else{
    		return FALSE;
    	}
    }
    
}