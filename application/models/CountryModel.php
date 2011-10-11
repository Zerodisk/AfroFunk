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
    	
    }
}