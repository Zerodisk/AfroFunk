<?php

class SizeModel extends CI_Model{
    
    function SizeModel()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //function retuen all size list
    function getSizeList(){
        $sql = 'select * from size order by weight';
        $query = $this->db->query($sql);
        $data = $query->result_array();
        
        $query->free_result();  
        return $data;         
    }
    
    //function return size name by a give size_id
    function getSizeById($size_id){
        $sql = 'select * from size where size_id = ?';
        $query = $this->db->query($sql, array($size_id));
        $data = $query->row_array();
        
        $query->free_result();  
        return $data;    
    }
    
    //function add size ($data is array of name and value)
    function addSize($param){
    	$this->db->insert('size', $param); 
    }
    
    //function update size ($param is array of name and value where name is field's name and value is new udpate value)
    function updateSize($param, $pid){
        $this->db->where('size_id', $pid);
        $this->db->update('size', $param);
    }
    
    //function delete size by a given size_id
    function deleteSize($pid){
        $this->db->delete('size', array('size_id' => $pid));
    }
    
}

