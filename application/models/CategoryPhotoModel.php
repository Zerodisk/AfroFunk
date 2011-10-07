<?php
class CategoryPhotoModel extends CI_Model{
	
    function CategoryPhotoModel(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function getLocalFolder(){
    	$this->load->helper('path');
    	return set_realpath('images/categories');
    }
    
    //function return all photo category slice by a given category_id
    function getPhotosByCategoryId($category_id, $active_only = TRUE){
        $sql = 'select * from category_photo_slice where category_id = ? and is_active = ? order by weight ASC';  
            
        $query = $this->db->query($sql, array($category_id, ($active_only) ? 1 : 0));
        $data = $query->result_array();
        
        $query->free_result();  
        return $data; 
    }
    
    //function check if photo full filename is duplicated? return true if duplicate
    //   filename comparing is NOT case sensitived
    function isFileNameDuplicate($fullfilename){
    	$sql = 'select count(*) as count from category_photo_slice where filename = ?';
    	$query = $this->db->query($sql, array($fullfilename));
        $result = FALSE;
        
        if ($query->num_rows() > 0){
           $row = $query->row(); 
           if ($row->count > 0){
           		$result = TRUE;
           }
        }
        
        $query->free_result(); 
        return $result;
    }
    
    //return photo by a given id
    function getPhotoById($id){
    	$sql = 'select * from category_photo_slice where id = ?';
    	$query = $this->db->query($sql, array($id));
        $data = $query->row_array();
        
        $query->free_result(); 
        return $data;
    }
    
    //function add new photo
    //  - return null if filename is duplicated
    //  - return new photo object/array if insert done successfully
    function addPhoto($param = null, $category_id, $fullfilename){
    	//return null immidiately if filename is duplicated
    	if ($this::isFileNameDuplicate($fullfilename)){
    		return null;
    	}
    	
    	if (!is_array($param)){
    		$param = array();
    	}
    	
    	$param['category_id'] = $category_id;
    	$param['filename'] 	  = $fullfilename;
    	
    	$this->db->insert('category_photo_slice', $param); 
    	
    	$new_photo_id = $this->db->insert_id();
    	return $this::getPhotoById($new_photo_id);
    }
    
	//function update category photo slice ($param is array of name and value where name is field's name and value is new udpate value)
    function updatePhoto($param, $id){
        $this->db->where('id', $id);
        $this->db->update('category_photo_slice', $param);
    }
    
    //function to delete category photo by a given photo_id
    function deletePhoto($id){
    	$photo = $this::getPhotoById($id);
    	if (count($photo) > 0){
 	    	$filename = $photo['filename'];
	    	
	    	//delete from db
	    	$this->db->delete('category_photo_slice', array('id' => $id));
	    	
	    	//delete file
	    	unlink($this::getLocalFolder().$filename);

	    	return TRUE;
    	}
    	else{
    		return FALSE;
    	}
    }
	
}