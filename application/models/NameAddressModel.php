<?php
class NameAddressModel extends CI_Model{
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getNameAddress($name_address_id){
    	$sql = 'select n.name_address_id, n.first_name, n.last_name, n.address_1, n.address_2, n.city, n.state,
    	        n.postcode, c.country_id, c.country_name, n.address_type, n.date_created, n.date_modified
    	        from name_address n inner join country c on n.country_id = c.country_id
    	        where n.name_address_id = ?'; 
    	
        $query = $this->db->query($sql, array($name_address_id));
        $data = $query->row_array();
        $query->free_result();  
        return $data;     	
    }
    
    function addNameAddress($address_type, $param){
    	$param['address_type']  = $address_type;
    	$param['date_created'] 	= date('Y-m-d H:i:s');
    	$param['date_modified'] = date('Y-m-d H:i:s');
    	$this->db->insert('name_address', $param);
    	$name_address_id = $this->db->insert_id();
    	
    	return $name_address_id;
    }
    
    function updateNameAddress($name_address_id, $param){
    	$param['date_modified'] = date('Y-m-d H:i:s');
    	$this->db->where('name_address_id', $name_address_id);
    	$this->db->update('name_address', $param);    	
    }
    
    
    
}