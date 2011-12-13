<?php

class ColorModel extends CI_Model{
    
    function ColorModel()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //function return all color list
    function getColorList(){
        $sql = 'select * from color order by color_name';
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
    
    /*
    * return active color drop down options
    *  input are the first list in drop down box
    *   - $initialValue is value in dropdown list
    *   - $initialText  is the text display in dropdown list
    *
    *  output is the array option for codigniter form_dropdown function
    */
    function getColorDropdown($initialValue = NULL, $initialText = NULL){
    	$options = array();
    	$colors = $this->getColorList();
    
    	if (($initialValue != NULL) && ($initialText != NULL))
    	$options[$initialValue] = $initialText;
    
    	foreach ($colors as $color){
    		$options[$color['color_id']] = $color['color_name'];
    	}
    	return $options;
    }    
    
}

