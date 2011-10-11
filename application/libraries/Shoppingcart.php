<?php

/*
 * shopping cart constructer.
 * without input parameter, it will use config setting for db or sessions shopping cart
 * but it's also possible to overwrite.
 * cart config can be 2 values below
 *   - db      => store all shopping cart in db
 *   - session => store all shopping cart in codeigniter sessions variable
 * how to load this library with input cart_config
 *   - for db use       $this->load->library('shoppingcart', array('db'));              
 *   - for session use  $this->load->library('shoppingcart', array('session')); 
 *   
 * ++++ note: the order_id once created will be store on codeigniter sessions variable for both db and session ++++
 */

class Shoppingcart{
	var $ci;
	var $cart;

	function __construct($cart_config = NULL){
		$this->ci =& get_instance();
		
		//check if there is input value
		if ($cart_config == NULL){
			$cart_config = $this->ci->config->item('afro_cart_config');
		}
		else{
			$cart_config = $cart_config[0];
		}
		
		//use sessions shopping cart
		if ($cart_config == 'session'){
			$this->cart = new sessionCart();
		}
		
		//use db shopping cart
		if ($cart_config == 'db'){
			$this->cart = new dbCart();
		}
	}
	
	//return current order_id
	function getOrderId(){
		return $this->cart->getOrderId();
	}
	
	/*
	 * return cart items format of array, 
	 *    each element is the unique item_id with its own qty
	 */
	function getCart(){
		return $this->cart->getCart();
	}
	
	//empty shopping cart
	function emptyCart(){
		$this->cart->emptyCart();
	}
	
	//remove item from cart for a given item_id
	function removeCart($item_id){
		$this->cart->removeCard($item_id);
	}
	
	//update qty on the given item_id
	function updateCart($item_id, $qty){
		$item = array(
						'item_id' => $item_id, 
						'qty' => $qty,
					 );
		$this->cart->updateCart($item);
	}
	
	/*
	 * add item to shopping cart
	 *  - for exisint item, will extend qty with new one
	 *  - for new item, will simply add item to cart
	 */
	function addCart($item_id, $qty = 1){	
		$this->ci->load->model('ItemModel');
		//get item details
		$item = $this->ci->ItemModel->getItem($item_id);
		//pre-populate all neccessary value for item
		$param = array(
			 			'item_id'      			=> $item_id,
						'qty'          			=> $qty,
						'qty_available'			=> $item['qty'],
						'price'        			=> $item['price'],
						'price_discount_amt' 	=> $item['price_discount_amt'],
						'color_name'   			=> $item['color_name'],
						'size_name'   		 	=> $item['size_name'],
						'product_id'			=> $item['product_id'],
						'product_name' 			=> $item['product_name'],
					  );
			
		//add item to cart
		$this->cart->addCart($param);
	}
	
	/*
	 * return total number of item/quantity in shopping cart
	 * input: current shopping cart (optional)
	 *        if nothing passed, will retreive shopping cart from db/sessions
	 */
	function getNumberOfItem($cart = NULL){
		if ($cart == NULL){$cart = $this->getCart();}
		
		$num_item = 0;
		foreach($cart as $item){
			$num_item = $num_item + $item['qty'];
		}	
		return $num_item;
	}
	
	// return total price for the shopping cart
	function getTotalPrice($cart = NULL){
		if ($cart == NULL){$cart = $this->getCart();}
		$total = 0;
		foreach($cart as $item){
			$total = $total + (($item['price'] - $item['price_discount_amt']) * $item['qty']);
		}
		return $total;
	}

}


interface IShoppingCart{
	function addCart($item);
	function getCart();
	function updateCart($item);
	function removeCard($item_id);
	function emptyCart();
	function getOrderId();
}


class dbCart implements IShoppingCart{
	var $ci;
	var $order_id;

	function dbCart(){
		$this->ci =& get_instance();
		$this->ci->load->library('session');
		$this->ci->load->model('OrderModel');
		$this->ci->load->model('OrderItemModel');

		$this->order_id = $this->ci->session->userdata('order_id');

		if ($this->order_id == FALSE){
			$this->order_id = $this->ci->OrderModel->addOrder_Initial();
			$this->ci->session->set_userdata('order_id', $this->order_id);
		}
	}

	function getOrderId(){
		return $this->order_id;
	}

	function addCart($item){
		if ($this->isExistingItem($item)){
			//add the existing item - so just append the existing qty with new qty
			$exItem = $this->ci->OrderItemModel->getOrderItem(NULL, $this->order_id, $item['item_id']);
			$new_qty = $exItem['qty'] + $item['qty'];
			
			if ($new_qty > $exItem['qty_available']){
				return;		//new qty is greater than what we have in stock, so do nothing and return
			}
			
			$param = array('qty' => ($new_qty));
			$this->ci->OrderItemModel->updateOrderItem($param, $exItem['order_item_id']);
		}
		else{
			$param = array(
						   'qty'   => $item['qty'],
					       'price' => $item['price'],
						   'price_discount_amt' => $item['price_discount_amt'],
						  );
			$this->ci->OrderItemModel->addOrderItem($item['item_id'], $this->order_id, $param);
		}
		
		$this->ci->OrderModel->updateOrderPrice($this->order_id);
	}

	function getCart(){
		return $this->ci->OrderItemModel->getOrderItemList($this->order_id);
	}

	function updateCart($item){
		if ($this->isExistingItem($item)){
			if ($item['qty'] == 0){		//remober item if qty set to 0
				$this->removeCard($item['item_id']);
			}
			else {
				$param = array(
							   'qty' => $item['qty'],
							  );
				
				$this->ci->OrderItemModel->updateOrderItem($param, NULL, $this->order_id, $item['item_id']);
				
				$this->ci->OrderModel->updateOrderPrice($this->order_id);				
			}

			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function removeCard($item_id){
		$this->ci->OrderItemModel->removeOrderItem(NULL, $this->order_id, $item_id);
		$this->ci->OrderModel->updateOrderPrice($this->order_id);
	}

	function emptyCart(){
		$this->ci->OrderItemModel->emptyOrderItem($this->order_id);
		$this->ci->OrderModel->updateOrderPrice($this->order_id);
	}
	
	
	/* -------------------- private function ------------------- */
	private function isExistingItem($item){
		$item_id = $item['item_id'];
		$items = $this->ci->OrderItemModel->getOrderItemList($this->order_id);
		foreach($items as $oneItem){
			if ($oneItem['item_id'] == $item_id){
				return TRUE;
			}
		}
		return FALSE;
	}
}


class sessionCart implements IShoppingCart{
	var $ci;
	var $order_id;

	function sessionCart(){
		$this->ci =& get_instance();
		$this->ci->load->library('session');
		
		$this->order_id = $this->ci->session->userdata('order_id');
		
		if ($this->order_id == FALSE){
			$this->ci->load->helper('string');
			$this->order_id = random_string('numeric', 10);
			$this->ci->session->set_userdata('order_id', $this->order_id);
		}
	}

	function getOrderId(){
		return $this->order_id;
	}

	function addCart($item){
		$cart = $this->getCart();
		if ($this->isExistingItem($item)){
			//update existing
			$index = $this->returnItemIndex($cart, $item['item_id']);
			$new_qty = $cart[$index]['qty'] + $item['qty'];
			if ($new_qty > $cart[$index]['qty_available']){
				return;		//new qty is greater than what we have in stock, so do nothing and return
			}
			$cart[$index]['qty'] = $new_qty;
		}
		else{
			//add new
			array_push($cart, $item);
		}
		$this->ci->session->set_userdata($this->order_id, $cart);
	}

	function getCart(){
		$cart = $this->ci->session->userdata($this->order_id);
		if ($cart == FALSE){
			return array();
		}
		else{
			return $cart;
		}
	}

	function updateCart($item){
		if ($this->isExistingItem($item)){	
			if ($item['qty'] == 0){		//remove item if qty set to 0
				$this->removeCard($item['item_id']);
			}
			else{
				$cart = $this->getCart();
				$index = $this->returnItemIndex($cart, $item['item_id']);
				if ($index < 0)
					return FALSE;  		//not match item_id
	
				$cart[$index]['qty'] = $item['qty'];
				$this->ci->session->set_userdata($this->order_id, $cart);				
			}

			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	function removeCard($item_id){
		$cart = $this->getCart();
		$index = $this->returnItemIndex($cart, $item_id);
		if ($index >= 0){
			unset($cart[$index]);
			$cart = array_values($cart);
		}
		$this->ci->session->set_userdata($this->order_id, $cart);
	}

	function emptyCart(){
		$this->ci->session->unset_userdata($this->order_id);
	}
	

	
	
	/* -------------------- private function ------------------- */
	private function isExistingItem($item){
		$item_id = $item['item_id'];
		$items = $this->getCart();
		foreach($items as $oneItem){
			if ($oneItem['item_id'] == $item_id){
				return TRUE;
			}
		}
		return FALSE;
	}
	
	private function returnItemIndex($cart, $item_id){
		$index = 0;
		foreach($cart as $oneItem){
			if ($oneItem['item_id'] == $item_id){
				return $index;
			}
			$index = $index + 1;
		}
		return -1;   //not match
	}
}



