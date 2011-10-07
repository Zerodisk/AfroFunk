<?php
class ProductModel extends CI_Model{
    
    function ProductModel()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //function return list of product by a given category_id
    function getProductListByCategoryId($category_id, 
    									$active_only 	 = TRUE, 
    									$order_by 		 = 'date_created', 
    									$order_direction = 'DESC', 
    									$limit 			 = null){
    										
        $sql = 'select p.product_id, p.product_name, p.description, p.size_description, p.price, p.price_discount_amt, 
        	       p.price - p.price_discount_amt as price_sell, p.is_active, p.date_created, p.date_modified, 
        	       ifnull(o.filename, CONCAT(p.product_id, ".jpg")) as photo_filename 
        	    from product p left join photo o on (p.product_id = o.product_id and o.is_main = 1) 
        	    where p.category_id = ?
        		and p.is_active = ?';
        
        $sql = $sql.' order by p.'.$this->db->escape_str($order_by).' '.$this->db->escape_str($order_direction);
        
        if($limit != null)
        	$sql = $sql.' limit '.$limit;
        
        $query = $this->db->query($sql, array($category_id, ($active_only) ? 1 : 0));
        $data = $query->result_array();
        
        $query->free_result();  
        return $data; 
    }
    
    //function return product by a given product_id
    function getProductById($product_id, $active_only = TRUE){
        $sql = 'select product_id, product_name, description, size_description, 
                price, price_discount_amt, price - price_discount_amt as price_sell, 
        		is_active, date_created, date_modified from product where product_id = ? and is_active = ?';
            
        $query = $this->db->query($sql, array($product_id, ($active_only) ? 1 : 0));
        //$data = $query->result_array();
        $data = $query->row_array();
        $query->free_result();  
        return $data; 
    }
    
    //function update product ($param is array of name and value where name is field's name and value is new udpate value)
    function updateProduct($product_id, $param){
    	$param['date_modified'] = date('Y-m-d H:i:s');
        $this->db->where('product_id', $product_id);
        $this->db->update('product', $param);
    }
    
    //function add new product and return new product_id
    function addProduct($param = null, $product_name, $price, $category_id){
    	if (!is_array($param)){
    		$param = array();
    	}
    	
    	$param['product_name'] 	= $product_name;
    	$param['price'] 		= $price;
    	$param['category_id'] 	= $category_id;
    	$param['date_created'] 	= date('Y-m-d H:i:s');
    	$param['date_modified'] = date('Y-m-d H:i:s');
    	$this->db->insert('product', $param);

    	return $this->db->insert_id();
    }
    
    //function return max product_id
    function getMaxProductId(){
    	$sql = 'select max(product_id) as max_product_id from product';
    	$query = $this->db->query($sql);
        $data = $query->row_array();
        
        $query->free_result();  
        return $data['max_product_id'];    
    }

    
    
}



