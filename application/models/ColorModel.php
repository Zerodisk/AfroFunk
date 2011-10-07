<?php

class ColorModel extends CI_Model{
    
    function ColorModel()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //function return all color list
    function getColorList(){
        $sql = 'select * from color order by weight';
        $query = $this->db->query($sql);
        $data = $query->result_array();
        
        $query->free_result();  
        return $data;         
    }
    
    //function return color name by a given color_id
    function getColorById($color_id){
        $sql = 'select * from color where color_id = ?';
        $query = $this->db->query($sql, array($color_id));
        $data = $query->row_array();
        
        $query->free_result();  
        return $data;    
    }
    
    //function add color ($data is array of name and value)
    function addColor($param){
    	$this->db->insert('color', $param); 
    }
    
    //function update color ($param is array of name and value where name is field's name and value is new udpate value)
    function updateColor($param, $pid){
        $this->db->where('color_id', $pid);
        $this->db->update('color', $param);
    }
    
    //function delete color by a given color_id
    function deleteColor($pid){
        $this->db->delete('color', array('color_id' => $pid));
    }
    
}

