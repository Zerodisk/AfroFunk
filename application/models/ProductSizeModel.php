<?php
class ProductSizeModel extends CI_Model{
    
    function ProductSizeModel()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getProductSizeListByProductId($product_id){ 
    	$sql = 'select p.product_size_id, p.product_id, s.size_id, s.size_name, 
				p.chest, p.waist, p.burst, p.shoulder, p.length, p.width, p.height, p.description
				from product_size p left join size s on p.size_id = s.size_id
				where p.product_id = ?';
    	$query = $this->db->query($sql, $product_id);
        $data = $query->result_array();
        
        $query->free_result();  
        return $data; 
    }
    
    function getProductSizeById($product_size_id){
    	$sql = 'select p.product_size_id, p.product_id, s.size_id, s.size_name, 
				p.chest, p.waist, p.burst, p.shoulder, p.length, p.length, p.width, p.height, p.description
				from product_size p left join size s on p.size_id = s.size_id
				where p.product_size_id = ?';
    	$query = $this->db->query($sql, $product_size_id);
        $data = $query->row_array();
        
        $query->free_result();  
        return $data;
    }
    
    function addProductSize($param = NULL, $size_id, $product_id){
    	if (!is_array($param)){
    		$param = array();
    	}
    	
    	$param['size_id'] 	  = $size_id;
    	$param['product_id']  = $product_id;
    	$this->db->insert('product', $param);

    	return $this->db->insert_id();
    }
    
    function updateProductSize($param = NULL, $product_size_id){
        if (!is_array($param)){
    		$param = array();
    	}
    	
        $this->db->where('product_size_id', $product_size_id);
        $this->db->update('product_size', $param);
    }
    
    function deleteProductSize($product_size_id){
        $this->db->delete('product_size', array('product_size_id' => $product_size_id));
    }
    
    
    
}