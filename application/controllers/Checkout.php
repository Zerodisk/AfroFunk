<?php
class Checkout extends MY_Controller{
	
	private $order_id;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->library('shoppingcart');
        //redirect back to cart page if cart is empty
        if ($this->shoppingcart->getNumberOfItem() <= 0){
        	redirect('cart');			//cart empty
        }       
        
        //load models and library
        $this->load->model('NameAddressModel');
        $this->load->model('CountryModel');        
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
		
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
        
        //get order_id from sessions
        $this->order_id = $this->shoppingcart->getOrderId();
    }
    
    public function index(){
    	$shipping_country_id = $this->session->userdata('shipping_country_id');	//set default shipping country from cart page
    	$billing_country_id  = $this->session->userdata('shipping_country_id'); //set default billing country from cart page
    	
    	//check if there is any commande request
    	if ($this->input->post('cmdCheckout')){
    		switch ($this->input->post('cmdCheckout')){
    			case 'confirmOrder':
    				//set form validation rule
        			$this->_setValidationRule();
    				
    				//get postback for selected country
    				$shipping_country_id = $this->input->post('shp_country_id');
    				$billing_country_id  = $this->input->post('bil_country_id');
    				
    				//validate all name address
    				if ($this->form_validation->run() == FALSE){
						//error validation
					}
					else{
						//success validate						
	    				$this->_saveOrder();		//save all name address or update if it's existed
	    					    				
	    				redirect('confirm'); 		//redirect to confirm page
					}    	
    				
    				break;
    			default:
    				//do nothing and it shouldn't be anything landed here
    			
    				break;
    		}
    		
//    		$form_data = $this->_returnFormValue(TRUE);
    	}
    	else{    		
    		//hit this page directly, check if there is any existing name and address, if yes then pull them from db

/*
    		$form_data = $this->_returnFormValue(FALSE);
    		$shipping_country_id = $form_data->shp_country_id;
    		$billing_country_id  = $form_data->bil_country_id;
*/
    	}
    	
    	
    	//load all neccesary main data
        $data['main'] = array(
        					'order_id'			  => $this->order_id,
							'countries_options'   => $this->CountryModel->getShippingCountryDropdown(),
        					'shipping_country_id' => $shipping_country_id,
        					'billing_country_id'  => $billing_country_id,
        					'main_error_message'  => '<span class="error" style="color:red">There is an error, please see below in red text</span>',
//        					'form_data'			  => $form_data,
        				);

        //load page name
        $data['page'] = 'checkout';

        //load page template
        $this->load->view('template', $data);
    }
    
    
    
    /*********************** private function ************************/
/*    
    private function _returnFormValue($isSubmitted){
    	$return = new checkout_form_data();
    	if ($isSubmitted){
    		$return->bil_first_name = $this->input->post('bil_first_name');
    		$return->bil_last_name  = $this->input->post('bil_last_name');
    	}
    	else{
			$order = $this->OrderModel->getOrder($this->order_id);
			$bil_name_address = 
			$shp_name_address = 
			
			
			
			
			
    	}
    	return $return;
    }
*/
        
    private function _saveOrder(){
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
    	$name_address = $this->_saveNameAddress($order_id);
    	
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
    
    private function _saveNameAddress($order_id){
    	$order = $this->OrderModel->getOrder($order_id);
    	if (($order['bill_name_address_id'] == NULL) && ($order['ship_name_address_id'] == NULL)){
    		$isNew = TRUE;
    	}
    	else{
    		$isNew = FALSE;
    	}
    	
    	$return = array();
    	$loop = array(
    					array('address_type' => 'BIL','prefix' => 'bil_', 'field_name' => 'bill_name_address_id'),
    					array('address_type' => 'SHP','prefix' => 'shp_', 'field_name' => 'ship_name_address_id'),
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
    		
    		if ($isNew){
    			$return[$each['field_name']] = $this->NameAddressModel->addNameAddress($each['address_type'], $param);
    		}
    		else{
    			$return[$each['field_name']] = $this->NameAddressModel->updateNameAddress($order[$each['field_name']], $param);
    		}
    	}
    	return $return;
    }
    
    private function _setValidationRule(){
    	$this->form_validation->set_rules('bil_first_name', 'first name' 	, 'trim|required');
    	$this->form_validation->set_rules('bil_last_name' , 'last name'  	, 'trim|required');
    	$this->form_validation->set_rules('ord_email'     , 'email address' , 'trim|required|valid_email');
    	$this->form_validation->set_rules('bil_address_1' , 'address'  		, 'trim|required');
    	$this->form_validation->set_rules('bil_city'      , 'city'       	, 'trim|required');
    	$this->form_validation->set_rules('bil_state'     , 'state'      	, 'trim|required');
    	$this->form_validation->set_rules('bil_postcode'  , 'postcode'   	, 'trim|required');
    	
    	$this->form_validation->set_rules('shp_first_name', 'first name', 'trim|required');
    	$this->form_validation->set_rules('shp_last_name' , 'last name' , 'trim|required');
    	$this->form_validation->set_rules('shp_address_1' , 'address 1' , 'trim|required');
    	$this->form_validation->set_rules('shp_city'      , 'city'      , 'trim|required');
    	$this->form_validation->set_rules('shp_state'     , 'state'     , 'trim|required');
    	$this->form_validation->set_rules('shp_postcode'  , 'postcode'  , 'trim|required');
    	
    	$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">', '</span>');
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

class checkout_form_data{
	public $bil_first_name;
	public $bil_last_name;
	public $ord_email;
	public $bil_address_1;
	public $bil_address_2; 
	public $bil_city; 
	public $bil_state;
	public $bil_postcode;
	public $bil_country_id;
	public $ord_phone;
	public $ord_mobile;
	
	public $shp_first_name;
	public $shp_last_name;
	public $shp_address_1;
	public $shp_address_2;
	public $shp_city;
	public $shp_state;
	public $shp_postcode;
	public $shp_country_id;
}