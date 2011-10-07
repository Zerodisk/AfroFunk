<?php
class CategoryModel extends CI_Model{

    function CategoryModel(){
        // Call the Model constructor
        parent::__construct();
    }
    
    //function return list of category by given parent_id (parent_id = null mean first level of category)
    function getCategoryList($parent_id = null, $active_only = TRUE){            
        if ($parent_id == null)
            $sql = 'select * from category where parent_id is ? and is_active = 1';
        else
            $sql = 'select * from category where parent_id = ? and is_active = 1';  
            
        $query = $this->db->query($sql, array($parent_id, ($active_only) ? 1 : 0));
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
    
    
}
   