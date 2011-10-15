<?php
class Checkout extends CI_Controller{
	
	private $order_id;
    
    public function __construct(){
        parent::__construct();
        
        //load models and library
        $this->load->model('CountryModel');
        $this->load->library('shoppingcart');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //redirect back to cart page if cart is empty
        if ($this->shoppingcart->getNumberOfItem() <= 0){
        	//cart empty
        	redirect('cart');	
        }
        
        //get order_id from sessions
        $this->order_id = $this->shoppingcart->getOrderId();
        
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }
    
    public function index(){
    	$shipping_country_id = $this->session->userdata('shipping_country_id');	//set default shipping country from cart page
    	$billing_country_id  = $this->session->userdata('shipping_country_id'); //set default billing country from cart page
    	
    	//check if there is any commande request
    	if ($this->input->post('cmdCheckout')){
    		switch ($this->input->post('cmdCheckout')){
    			case 'confirmOrder':
    				//set form validation rule
        			$this->setValidationRule();
    				
    				//get postback for selected country
    				$shipping_country_id = $this->input->post('shp_country_id');
    				$billing_country_id = $this->input->post('bil_country_id');
    				
    				//validate all name address
    				if ($this->form_validation->run() == FALSE){
						//error validation
					}
					else{
						//success validate
						//save all name address or update if it's existed
	    				$this->saveOrder();
	    				
	    				//redirect to confirm page
	    				redirect('confirm'); 
					}    				    				
    				
    				break;
    		}
    	}
    	
    	
    	
    	//load all neccesary main data
        $data['main'] = array(
        					'order_id'			  => $this->order_id,
							'countries_options'   => $this->CountryModel->getShippingCountryDropdown(),
        					'shipping_country_id' => $shipping_country_id,
        					'billing_country_id'  => $billing_country_id,
        				);

        //load page name
        $data['page'] = 'checkout';

        //load page template
        $this->load->view('template', $data);
    }
    
    
    
    /*********************** private function ************************/
    
    private function saveOrder(){
    	if ($this->shoppingcart->getConfigCartType() == 'session'){
    		//save session cart into db order/order_item
    		$cart = $this->shoppingcart->getCart();
    		$order_id = $this->OrderModel->addCartToOrder($cart, FALSE);
    	}
    	else{
    		//order already store in db, return db order_id
    		$order_id = $this->order_id;
    	}
    	
    	//make sure update total order price again
    	$this->OrderModel->updateOrderPrice($order_id);
 
    	//save name address
    	$name_address = $this->saveNameAddress();
    	
    	$param = array(
    	  				'first_name' => $this->input->post('bil_first_name'),
    					'last_name'  => $this->input->post('bil_last_name'),
    					'email'	     => $this->input->post('ord_email'),
    					'phone'      => $this->input->post('ord_phone'),
    					'mobile'	 => $this->input->post('ord_mobile'),
    				    'bill_name_address_id' => $name_address['bill_name_address_id'],
    					'ship_name_address_id' => $name_address['ship_name_address_id'],
    				  );
    	$this->OrderModel->updateOrder($order_id, $param);
    	return $order_id;
    }
    
    /*  for save billing+shipping name address into name_address table
     *  return array of name_address_id
     *         array(
     *         	     'bill_name_address_id'		=>   billing name_address_id,
     *               'ship_name_address_id'		=>   shipping name_address_id,
     *              ) 
     */
    
    private function saveNameAddress(){
    	$return = array();
    	$this->load->model('NameAddressModel');
    	$loop = array(
    					array('address_type' => 'BIL','prefix' => 'bil_', 'return' => 'bill_name_address_id'),
    					array('address_type' => 'SHP','prefix' => 'shp_', 'return' => 'ship_name_address_id'),
    				 );
    	foreach($loop as $each){
    		$param = array(
    						'first_name' => $this->input->post($each['prefix'].'first_name'),
    						'last_name'  => $this->input->post($each['prefix'].'last_name'),
    						'address_1'  => $this->input->post($each['prefix'].'address_1'),
    						'address_2'  => $this->input->post($each['prefix'].'address_2'),
    						'city'       => $this->input->post($each['prefix'].'city'),
    						'state'      => $this->input->post($each['prefix'].'state'),
    						'postcode'   => $this->input->post($each['prefix'].'postcode'),
    						'country_id' => $this->input->post($each['prefix'].'country_id'),
    					  );
    					  
    		$return[$each['return']] = $this->NameAddressModel->addNameAddress($each['address_type'], $param);;
    	}
    	return $return;
    }
    
    private function setValidationRule(){
    	$this->form_validation->set_rules('bil_first_name', 'billing first name' , 'trim|required');
    	$this->form_validation->set_rules('bil_last_name' , 'billing last name'  , 'trim|required');
    	$this->form_validation->set_rules('ord_email'     , 'email address'      , 'trim|required|valid_email');
    	$this->form_validation->set_rules('bil_address_1' , 'billing address 1'  , 'trim|required');
    	$this->form_validation->set_rules('bil_city'      , 'billing city'       , 'trim|required');
    	$this->form_validation->set_rules('bil_state'     , 'billing state'      , 'trim|required');
    	$this->form_validation->set_rules('bil_postcode'  , 'billing postcode'   , 'trim|required');
    	
    	$this->form_validation->set_rules('shp_first_name', 'shipping first name', 'trim|required');
    	$this->form_validation->set_rules('shp_last_name' , 'shipping last name' , 'trim|required');
    	$this->form_validation->set_rules('shp_address_1' , 'shipping address 1' , 'trim|required');
    	$this->form_validation->set_rules('shp_city'      , 'shipping city'      , 'trim|required');
    	$this->form_validation->set_rules('shp_state'     , 'shipping state'     , 'trim|required');
    	$this->form_validation->set_rules('shp_postcode'  , 'shipping postcode'  , 'trim|required');
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
            			'title' => 'AfroFunk - Check out',
    	);
    }
}