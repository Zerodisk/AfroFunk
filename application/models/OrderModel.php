<?php
class OrderModel extends CI_Model{

    function OrderModel(){
        // Call the Model constructor
        parent::__construct();
        
        $this->load->model('OrderItemModel');
    }
    
    //return the given order
    function getOrder($order_id){
    	
    }
    
    //return list of order base on the given parameter
    function getOrderList($param){
    	
    }
    
    function getOrderListByDate($date_from, $date_to, $which_date, $param = NULL){
    	
    }
    
    function addOrder_Initial(){
    	$param = array('date_created' => date('Y-m-d H:i:s'));
    	$this->db->insert('order', $param);
    	$order_id = $this->db->insert_id();
    	
    	return $order_id;
    }
    
    //for update order
    function updateOrder($order_id, $param){
    	$this->db->where('order_id', $order_id);
    	$this->db->update('order', $param);
    }
    
    //for update order price base on all order_item
    function updateOrderPrice($order_id){
    	$items = $this->OrderItemModel->getOrderItemList($order_id);
    	$price = 0;
    	foreach ($items as $item){
    		$pre_discount_price = floatval($item['price'] - $item['price_discount_amt']);
    		$pre_discount_price = $pre_discount_price - ($pre_discount_price * floatval($item['price_discount_percent']) / 100);
    		$price = $price + ($pre_discount_price * $item['qty']); 
    	}
    	$param = array('price_total' => $price);
    	$this->updateOrder($order_id, $param);
    }
    
    /*
     * this function will add all items from shopping cart to order_item table
     * 2 parameters
     *  - order_id
     *  - shopping cart
     */
    function addCartToOrder($order_id, $cart){
    	//empty existing order item before add new
    	
    	
    	//start adding
    	
    }
    
    //remove all order item for a given order_id
    function emptyOrder($order_id){
    	$this->OrderItemModel->emptyOrderItem($order_id);
    }
    
    /*
     * add shipping item to the given order by a country_id
     * step are 1. get shipping cose from shipping model
     * 		    2. add into order_item
     * 			3. update total order price
     */
    function addShipping($order_id, $country_id){
    	//get shipping cost
    	$this->load->model('ShippingModel');
    	$shipping = $this->ShippingModel->getShippingCostByCountry($country_id);
    	//add to order item
    	$param = array(
    	               'price' => $shipping['price'],
    	              );
    	$this->OrderItemModel->addOrderItem($shipping['item_id'], $order_id, $param);
    	//update total order price again
    	$this->updateOrderPrice($order_id);
    }
    
    
}
    