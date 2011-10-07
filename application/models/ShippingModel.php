<?php
class ShippingModel extends CI_Model{
	
	private $default_item_id;
	private $default_price;
    
    function ShippingModel()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('ItemModel');
        
        $this->default_price = 30;
        $this->default_item_id = -1;
    }

    /*
     * return shipping cost by a given country_id
     *    result returned in array with 3 value
     *    - product_id   shipping product_id
     *    - item_id		 accociate item_id for above product_id
     *    - price        shipping price
     */
    function getShippingCostByCountry($country_id){
    	$product_id = $this::getProductIdForShippingCost($country_id);
    	
    	$product = $this->ProductModel->getProductById($product_id);
    	if (count($product) > 0){				//in case product disabled or not found
	    	$price = $product['price'];
	    	
	    	$items = $this->ItemModel->getItemList($product_id);
	    	if (count($items) > 0)				//in case item disabled or not found
	    		$item_id = $items[0]['item_id'];
	    	else
	    		$item_id = $this->default_item_id;
    	}
    	else{
    		$price 		= $this->default_price;
    		$item_id 	= $this->default_item_id;
    	}
    	
    	return array(
    				'product_id' => intval($product_id),
    				'item_id' 	 => intval($item_id),
    				'price'   	 => floatval($price),
    			);
    }
    
    
    
    /*------------------- start private function here ---------------*/
    
    //function return product_id for shipping cost for a given country_id
    private function getProductIdForShippingCost($country_id){
    	$sql = 'select * from shipping_cost where country_id = ?
				union
				select * from shipping_cost where country_id is null
				order by country_id desc limit 1';
    	$query = $this->db->query($sql, $country_id);
        $data = $query->row_array();
        
        $query->free_result();  
        return $data['product_id'];    
    }
}