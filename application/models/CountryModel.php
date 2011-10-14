<?php
class CountryModel extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getCountryList($active_only = TRUE, $order_by = 'weight'){
    	$sql_extra = '';
    	if ($active_only){
    		$sql_extra = ' where is_active = 1 ';
    	}
    	$sql = "select country_id, country_name, iso_2, iso_3, country_code, weight
    	        from country $sql_extra order by $order_by";
    	
    	$query = $this->db->query($sql);
    	$data = $query->result_array();
    	
    	$query->free_result();
    	return $data;
    }
    
    function getCountry($country_id){
    	//still don't know why we need this :(  so do nothing for now
    }
    
    /*
    * return active country drop down options
    *  input are the first list in drop down box
    *   - $initialValue is value in dropdown list
    *   - $initialText  is the text display in dropdown list
    *  
    *  output is the array option for codigniter form_dropdown function
    */
    function getShippingCountryDropdown($initialValue, $initialText){
    	$options = array();
    	$countries = $this->getCountryList();
    	$options[$initialValue] = $initialText;
    	foreach ($countries as $country){
    		$options[$country['country_id']] = $country['country_name'];
    	}
    	return $options;
    }
}