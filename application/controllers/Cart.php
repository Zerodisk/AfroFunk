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
    	//add item to cart
    	if ($this->input->post('btnAddCart')){
    		$item_id = $this->input->post('item_id');
    		if ($item_id > 0){
    			$this->shoppingcart->addCart($item_id);
    		}
    	}
    	
    	//click on update cart button
    	if ($this->input->post('btnUpdateCart')){
    	
    	}
    	
    	//click on remove item from cart
    	if ($this->input->post('btnRemoveItem')){
    		
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
    	return '('.$color.' - '.$size.')';
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