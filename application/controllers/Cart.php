<?php
class Cart extends MY_Controller{
    
    public function Cart(){
        parent::__construct();
        
        //load models and library
        $this->load->library('session');
        if ($this->session->userdata('db_order_id') != FALSE){
        	/*
        	 * found new confirm db_order_id, then 
        	 *    1. load shoppingcart with db parameter
        	 * 	  2. manual overwrite codeigniter session order_id with db_order_id	
        	 */
        	$this->load->library('shoppingcart', array('db'));
        	$this->session->set_userdata('order_id',$this->session->userdata('db_order_id'));
        }
        else{
        	$this->load->library('shoppingcart');
        }
        
        $this->load->model('CountryModel');
        $this->load->model('OrderModel');
        $this->load->helper('form');
        
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }
    
    public function index(){
    	$shipping_country_id = -1;
    	
    	//check if there is any commande request
   		switch ($this->input->post('cmdCart')){
    		case 'addCart':
    			$item_id = $this->input->post('item_id');
    			if ($item_id > 0){
   					$this->shoppingcart->addCart($item_id);
   				}
    			break;
    				
    		case 'removeCartItem':
    			$item_id = $this->input->post('item_id');
    			if ($item_id > 0){
   					$this->shoppingcart->removeCart($item_id);
    			}
    			break;
    				
    		case 'updateCart' || 'checkOut':
    			//update shopping cart
    			$items = $this->extractItem($this->input->post());
    			foreach($items as $item){
    				$this->shoppingcart->updateCart($item['item_id'], $item['qty']);
   				}
    				
    			//save shipping country_id if there is value there
    			if ($this->input->post('shipping_country_id') != FALSE){
    				$this->session->set_userdata('shipping_country_id', $this->input->post('shipping_country_id'));
    			}
    				
    			/*
    			 * db cart:      1. - do save cart into db
    			 *               2. - assign db_order_id
    			 *               
    			 * session cart: 1. - just assign db_order_id
    			 * 
    			 *      then redirection to checkout page
    			 */
    			if ($this->input->post('cmdCart') == 'checkOut'){
    					
    			    if ($this->shoppingcart->getConfigCartType() == 'session'){
				   		//save session cart into db order/order_item
			  			$cart = $this->shoppingcart->getCart();
				   		$this->session->set_userdata('db_order_id', $this->OrderModel->addCartToOrder($cart, TRUE));
    			    }
    			    else{
    			    	$this->session->set_userdata('db_order_id', $this->shoppingcart->getOrderId());
    			    }			    	
    					
    				redirect('checkout');
    			}
    			break;
    	}
	
    	
    	//get cart
    	$cart = $this->shoppingcart->getCart();
    	$num_item = $this->shoppingcart->getNumberOfItem($cart);
    	
    	//get shipping country id - save it in codeigniter sessions
    	if ($this->session->userdata('shipping_country_id') != FALSE){
    		$shipping_country_id = $this->session->userdata('shipping_country_id');
    	}
    	
    	//get shipping cost by country_id
    	$shipping = $this->_getShippingCost($shipping_country_id);
    	$shipping_price = 0;
    	$shipping_item_id = 0;
    	if ($shipping != NULL){
    		$shipping_price = $shipping['price'];
    		$shipping_item_id = $shipping['item_id'];
    	}
    	
    	//load all neccesary main data
        $data['main'] = array(
        					'order_id'	  	   => $this->shoppingcart->getOrderId(),			//order_id for this cart
        					'cart' 		       => $this->customizeCart($cart),					//cart and all items
        					'cart_num_item'    => $num_item,									//number of item in cart
        					'cart_total_price' => $this->shoppingcart->getTotalPrice($cart),	//total price for this cart
        					'countries_options'   => $this->CountryModel->getShippingCountryDropdown(-1, 'select your shipping country'),		//for country drop down options
        					'shipping_country_id' => $shipping_country_id,						//user selected shipping country_id
        					'shipping_price'	  => $shipping_price,							//shipping cost
        					'shipping_item_id'    => $shipping_item_id,							//shipping item_id
        				);

        //load page name
        $data['page'] = 'cart';

        //load page template
        $this->load->view('template', $data);
    }
    
    
    
    
    
    
    
    /****************************** private function for ********************************/
    
    /*
     * extract all http post variable to the new format
     * input: form post interested will name started with item_id-[db item id] (i.e. item_id-5 it mean item_id = 5)
     * output:
     * format is array(
     * 					'item_id'
     * 					'qty'
     * 				  )
     */
    private function extractItem($post){
    	$return = array();
    	foreach(array_keys($post) as $key){
    		if (substr($key, 0, 8) == 'item_id-'){
    			$new = array(
    			              'item_id' => substr($key, 8, (strlen($key) - 8)),
    			              'qty'     => $post[$key],
    						);	
    			array_push($return, $new);
    		}
    	}
    	return $return;
    }
    
    /*
     * function return cart information for the mvc-view cart page
     */
    private function customizeCart($cart){
    	$return = array();
    	foreach($cart as $item){
    		$cus_item = array(
    							'product_id' 		 => $item['product_id'],
    							'product_name'		 => $item['product_name'],
    							'product_name_extra' => $this->_getProductExtra($item['color_name'], $item['size_name']),
    							'item_id'			 => $item['item_id'],
    							'qty'				 => $item['qty'],
    							'qty_options'		 => $this->_getQtyDropdown($item['qty_available']),
    							'price'				 => $item['price'],
    							'price_discount_amt' => $item['price_discount_amt'],
    							'price_sell'		 => ($item['price'] - $item['price_discount_amt']),
    						 );
    		array_push($return, $cus_item);
    	}
    	return $return;
    }
    
    //return extra production for size and color
    private function _getProductExtra($color, $size){
    	$return = '';
    	if (isset($color) && isset($size)){
    		$return = '(color: '.$color.' - size: '.$size.')';
    	}
    	else if(!isset($color) && isset($size)){
    		$return = '(size: - '.$size.')';
    	}
    	else if(isset($color) && !isset($size)){
    		$return = '(color - '.$color.')';
    	}
    	return $return;
    }
    
    //return the drop down menu for max qty
    private function _getQtyDropdown($qty_available){
    	$options = array();
    	for ($i = 0; $i <= $qty_available; $i++) {
    		$options[$i] = $i;	
    	}
    	return $options;
    }
    
    private function _getShippingCost($country_id){
    	if ($country_id <= 0){return NULL;}
    	$this->load->model('ShippingModel');
    	$shipping = $this->ShippingModel->getShippingCostByCountry($country_id);
    	return $shipping;
    }
    
    private function _getHeader(){
        return array(
                    'first'  => '1. first',
                    'second' => '2. second'
                    );
    }
    
    private function _getFooter(){
        return array(
                    'third'  => '3. third',
                    'fourth' => '4. fourth'
                    );        
    }
    
    private function _getTitle(){
        return array(
        			'title' => 'AfroFunk - Cart',
        			);
    }  
}