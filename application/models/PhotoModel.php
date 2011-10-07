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

    //function return list of photo by a given product_id
    function getPhotoListByProductId($product_id, $active_only = TRUE){
    	$sql = 'select *, filename as photo_filename from photo 
    			where product_id = ? and is_active = ? 
    			order by is_main DESC, weight ASC';

        $query = $this->db->query($sql, array($product_id, ($active_only) ? 1 : 0));
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
    
    //function to add photo - function return new photo object
    function addPhoto($param = null, $product_id, $file_extension = '.jpg'){
    	$photo_count = $this::countPhotoByProductId($product_id);

    	if (!is_array($param)){
    		$param = array();
    	}
    	
    	$param['product_id']   = $product_id;
    	$param['date_created'] = date('Y-m-d H:i:s');
    	
    	if ($photo_count == 0){
    		//first photo for this product_id 			- filename = [product_id].[file_extension]
    		$param['filename'] = $product_id.$file_extension;
    		$param['is_main']  = 1;
    	}
    	else{
    		//second photo onward for this product_id 	- filename = [product_id]_[4 digits random number].[file_extension]
    		$this->load->helper('string');
    		$param['filename'] = $product_id.'_'.random_string('alnum', 4).$file_extension;
    	}
    	
    	$this->db->insert('photo', $param); 
    	
    	$new_photo_id = $this->db->insert_id();
    	return $this::getPhotoById($new_photo_id);
    }
    
    //function update photo ($param is array of name and value where name is field's name and value is new udpate value)
    function updatePhoto($param, $photo_id){
        $this->db->where('photo_id', $photo_id);
        $this->db->update('photo', $param);
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
	    	unlink($this::getLocalFolder().$filename);

	    	return TRUE;
    	}
    	else{
    		return FALSE;
    	}
    }
    
}