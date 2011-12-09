<?php
class ProductModel extends CI_Model{
    
    function ProductModel()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /*
     * function return list of product by a given category_id
     *   only show product that have
     *    - active product status
     *    - got stock available for sale
     *   use on public-category page
     */
    function getProductListByCategoryId($category_id, 
    									$record_index    = 0,
    									$limit			 = 999999){
    									
        $sql = 'select p.product_id, p.product_name, p.description, p.size_description, p.price, p.price_discount_amt, 
        	       p.price - p.price_discount_amt as price_sell, p.is_active, p.date_created, p.date_modified, 
        	       ifnull(o.filename, CONCAT(p.product_id, ".jpg")) as photo_filename,
                   sum(i.qty) as qty, p.category_id
        	    from product p inner join item i on p.product_id = i.product_id 
                    left join photo o on (p.product_id = o.product_id and o.is_main = 1)          
        	    where p.category_id = ? 
        	    and p.is_active = 1
        	    and p.product_id > 0
                    group by p.product_id
        			having sum(i.qty) > 0';
        
        //do limit record
        $sql = $sql.' limit '.$record_index.', '.$limit;
        
        $query = $this->db->query($sql, array($category_id));
        $data = $query->result_array();
        
        $query->free_result();  
        return $data; 
    }
    
    /*
     * function return list of product by keyword search
     *   use on admin product search page
     */
    function getProductListForAdminSearch($keyword,
        								  $record_index    = 0,
    									  $limit		   = 999999,
    									  $orderby		   = 'p.product_name',
    									  $direction	   = 'ASC'){
    	$sql = 'select p.product_id, p.product_name, p.description, p.size_description, p.price, p.price_discount_amt, 
        	       p.price - p.price_discount_amt as price_sell, p.is_active, p.date_created, p.date_modified, 
        	       ifnull(o.filename, CONCAT(p.product_id, ".jpg")) as photo_filename,
                   ifnull(sum(i.qty), 0) as qty, count(i.item_id) as num_items, p.category_id
        	    from product p left join item i on p.product_id = i.product_id 
                    left join photo o on (p.product_id = o.product_id and o.is_main = 1)          
        	    where p.product_name like ?
        	        and p.product_id > 0
                    group by p.product_id';
    	
    	//do order by
    	$sql = $sql.' order by '.$orderby.' '.$direction;
    	//do limit record
    	$sql = $sql.' limit '.$record_index.', '.$limit;
    	
    	if ($keyword == '*'){
    		$keyword = '%';
    	}
    	
    	if ($keyword != '%'){
    		$keyword = '%'.$keyword.'%';
    	}    	
    	
    	$query = $this->db->query($sql, array($keyword));
    	$data = $query->result_array();
    	
    	$query->free_result();  	
    	return $data;
    }
    
    
    //function return product by a given product_id
    function getProductById($product_id, $active_only = TRUE){
    	$sql_extra = '';
    	if ($active_only){
    		$sql_extra = ' and is_active = 1 ';
    	}
        $sql = 'select product_id, product_name, description, size_description, 
                price, price_discount_amt, price - price_discount_amt as price_sell, 
        		is_active, date_created, date_modified, category_id from product where product_id = ?'.$sql_extra;
        
        $query = $this->db->query($sql, array($product_id));
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



