<?php
class Cart extends CI_Controller{
    
    public function Cart(){
        parent::__construct();
        
        //load models and library
        $this->load->library('shoppingcart');
        $this->load->helper('form');
        
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }
    
    public function index(){
    	//check if there is any commande request
    	if ($this->input->post('cmdCart')){
    		switch ($this->input->post('cmdCart')){
    			case 'addCart':
    				$item_id = $this->input->post('item_id');
    				if ($item_id > 0){
    					$this->shoppingcart->addCart($item_id);
    				}
    				break;
    			case 'updateCart':
    				$items = $this->extractItem($this->input->post());
    				foreach($items as $item){
    					$this->shoppingcart->updateCart($item['item_id'], $item['qty']);
    				}
    				break;
    			case 'removeCartItem':
    				$item_id = $this->input->post('item_id');
    				if ($item_id > 0){
    					$this->shoppingcart->removeCart($item_id);
    				}
    				break;
    		}
    	}
    	
    	//get cart
    	$cart = $this->shoppingcart->getCart();
    	$num_item = $this->shoppingcart->getNumberOfItem($cart);
    	
    	//load all neccesary main data
        $data['main'] = array(
        					'cart' 		=> $this->customizeCart($cart),			//cart and all items
        					'num_item'  => $num_item,		//number of item in cart
        				);
        
        //load page name
        $data['page'] = 'cart';

        //load page template
        $this->load->view('template', $data);
    }
    
    
    
    
    
    
    
    /***********************************
     *
     * private function for
     * - header
     * - footer
     * - title
     * - customizeCart
     * 
     ***********************************/
    
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
     * function return cart information for the mvc-view
     */
    private function customizeCart($cart){
    	$return = array();
    	foreach($cart as $item){
    		$cus_item = array(
    							'product_id' 		 => $item['product_id'],
    							'product_name'		 => $item['product_name'],
    							'product_name_extra' => $this->getProductExtra($item['color_name'], $item['size_name']),
    							'item_id'			 => $item['item_id'],
    							'qty'				 => $item['qty'],
    							'qty_options'		 => $this->getQtyDropdown($item['qty_available']),
    							'price'				 => $item['price'],
    							'price_discount_amt' => $item['price_discount_amt'],
    							'price_sell'		 => $this->getPriceSell($item['price'], $item['price_discount_amt']),
    						 );
    		array_push($return, $cus_item);
    	}
    	return $return;
    }
    
    //return extra production for size and color
    private function getProductExtra($color, $size){
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
    private function getQtyDropdown($qty_available){
    	$options = array();
    	for ($i = 0; $i <= $qty_available; $i++) {
    		$options[$i] = $i;	
    	}
    	return $options;
    }
    
    //return price for sell after discount
    private function getPriceSell($price, $price_discount_amt){
    	return $price - $price_discount_amt; 
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
        return null;
    }  
}