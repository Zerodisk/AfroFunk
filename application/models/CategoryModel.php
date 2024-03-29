<?php
class CategoryModel extends CI_Model{

    function CategoryModel(){
        // Call the Model constructor
        parent::__construct();
    }
    
    //function return list of category by given parent_id (parent_id = null mean first level of category)
    function getCategoryList($parent_id = NULL, $active_only = TRUE){      
    	$sql_extra = '';
    	if ($active_only){
    		$sql_extra = ' and is_active = 1 ';
    	}      
        if ($parent_id == NULL)
            $sql = 'select * from category where parent_id is ?'.$sql_extra;
        else
            $sql = 'select * from category where parent_id = ?'.$sql_extra;  
            
        $query = $this->db->query($sql, array($parent_id));
        $data = $query->result_array();
        
        $query->free_result();  
        return $data; 
    }
    
    //function return category_id by a given category_name (return -1 if not found)
    function getCategoryIdByName($category_name){
        $sql = 'select category_id from category where category_name = ?';
        $query = $this->db->query($sql, array($category_name));
        $category_id = -1;
        
        if ($query->num_rows() > 0){
           $row = $query->row(); 
           $category_id = $row->category_id;
        }
        
        $query->free_result(); 
        return $category_id;
    }
    
    //function return category by a given category_id (return null if not found)
    function getCategoryById($category_id){
        $sql = 'select * from category where category_id = ?';
        $query = $this->db->query($sql, array($category_id));
        $data = $query->row_array();
        
        $query->free_result(); 
        return $data;
    }
    
    //function return category_name by a given category_id (return null if not found)
    function getCategoryNameById($category_id){
        $sql = 'select category_name from category where category_id = ?';
        $query = $this->db->query($sql, array($category_id));
        $category_name = null;
        
        if ($query->num_rows() > 0){
           $row = $query->row(); 
           $category_name = $row->category_name;
        }
        
        $query->free_result(); 
        return $category_name;
    }
    
    
    /*
    * return active category drop down options
    *  input are the first list in drop down box
    *   - $initialValue is value in dropdown list
    *   - $initialText  is the text display in dropdown list
    *
    *  output is the array option for codigniter form_dropdown function
    */
    function getCategoryDropdown($initialValue = NULL, $initialText = NULL){
    	$options = array();
    	$categories = $this->getCategoryList();
    	 
    	if (($initialValue != NULL) && ($initialText != NULL))
    	$options[$initialValue] = $initialText;
    	 
    	foreach ($categories as $category){
    		$options[$category['category_id']] = $category['category_name'];
    	}
    	return $options;
    }    
    
}
   