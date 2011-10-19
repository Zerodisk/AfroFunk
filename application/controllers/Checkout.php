<?php
class Checkout extends MY_Controller{
	
	private $order_id;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->library('session');
        $this->order_id = $this->session->userdata('db_order_id');	//get db_order_id from codeigniter session
        
        //redirect back to cart page if cart is empty
        if (afro_getNumberOfItem($this->order_id) <= 0){
        	header('Location: '.base_url().'cart');			//cart empty
        }       
        
        //load models and library
        $this->load->model('NameAddressModel');
        $this->load->model('CountryModel');   
        $this->load->model('OrderModel');  
        $this->load->library('form_validation');
        $this->load->helper('form');
		
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
    	switch ($this->input->post('cmdCheckout')){
    		case 'confirmOrder':
    			//get postback for selected country
    			$shipping_country_id = $this->input->post('shp_country_id');
    			$billing_country_id  = $this->input->post('bil_country_id');
    			
    			//set form validation rule
        		$this->_setValidationRule();    				    			    				
    			//validate all name address
    			if ($this->form_validation->run() == FALSE){
					//error validation
				}
				else{
					//success validate						
	    			$this->_saveOrder();		//save all name address or update if it's existed
	    			header('Location: '.base_url().'payment/?oid='.$this->order_id);
				}   

				$form_data = $this->_returnFormValue(TRUE);
    				
    			break;
    		default:
				//hit checkout page directly
		   		$form_data = $this->_returnFormValue(FALSE);
		   		if ($form_data->shp_country_id != NULL){$shipping_country_id = $form_data->shp_country_id;}
		   		if ($form_data->bil_country_id != NULL){$billing_country_id  = $form_data->bil_country_id;}

    			break;
   		}
   		
    	//load all neccesary main data
        $data['main'] = array(
        					'order_id'			  => $this->order_id,
							'countries_options'   => $this->CountryModel->getShippingCountryDropdown(),
        					'shipping_country_id' => $shipping_country_id,
        					'billing_country_id'  => $billing_country_id,
        					'main_error_message'  => '<span class="error" style="color:red">There is an error, please see below in red text</span>',
        					'form_data'			  => $form_data,
        				);

        //load page name
        $data['page'] = 'checkout';

        //load page template
        $this->load->view('template', $data);
    }
    
    
    
    /*********************** private function ************************/
    
    /*
     * function return form data to be filled on the page
     *  take 1 parameter - $isSubmitted
     *       					true:  page is submitted 
     *       					       load all variable back from http post
     *       					false: page is not submitted, page might be load directly
     *       						   load all variable from db (order and name_address table)
     *  return object/class checkout_form_data()
     */
    private function _returnFormValue($isSubmitted){
    	$return = new checkout_form_data();
    	
    	if ($isSubmitted){
    		//submitted - read from http post
    		foreach(array_keys($this->input->post()) as $key){
    			$return->setValue($key, $this->input->post($key));
    		}
    	}
    	else{
    		//not sumitted - read from db
			$order = $this->OrderModel->getOrder($this->order_id);
			$return->ord_email   = $order['email'];
			$return->ord_mobile  = $order['mobile'];
			$return->ord_phone   = $order['phone'];
			
			if ($order['bill_name_address_id'] != NULL){
				$bil_name_address = $this->NameAddressModel->getNameAddress($order['bill_name_address_id']);

				foreach(array_keys($bil_name_address) as $key){
	    			$return->setValue('bil_'.$key, $bil_name_address[$key]);
	    		}
			}
    		if ($order['ship_name_address_id'] != NULL){
				$shp_name_address = $this->NameAddressModel->getNameAddress($order['ship_name_address_id']);
				
    			foreach(array_keys($shp_name_address) as $key){
	    			$return->setValue('shp_'.$key, $shp_name_address[$key]);
	    		}
			}
    	}
    	
    	return $return;
    }

    /*
     * save/update data to order table
     *   - save both name_address
     *   - return order_id
     */    
    private function _saveOrder(){
    	//double make sure by update total order price again
    	$this->OrderModel->updateOrderPrice($this->order_id);
 
    	//save name address
    	$name_address = $this->_saveNameAddress();
    	
    	$param = array(
    	  				'first_name' => $this->input->post('bil_first_name'),
    					'last_name'  => $this->input->post('bil_last_name'),
    					'email'	     => $this->input->post('ord_email'),
    					'phone'      => $this->input->post('ord_phone'),
    					'mobile'	 => $this->input->post('ord_mobile'),
    				    'bill_name_address_id' => $name_address['bill_name_address_id'],
    					'ship_name_address_id' => $name_address['ship_name_address_id'],
    				  );
    	$this->OrderModel->updateOrder($this->order_id, $param);
    }
    
    /*  for save billing+shipping name address into name_address table
     *  return array of name_address_id
     *         array(
     *         	     'bill_name_address_id'		=>   billing name_address_id,
     *               'ship_name_address_id'		=>   shipping name_address_id,
     *              ) 
     */
    
    private function _saveNameAddress(){
    	$order = $this->OrderModel->getOrder($this->order_id);
    	
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
    		
    		if (($order['bill_name_address_id'] == NULL) && ($order['ship_name_address_id'] == NULL)){
    			$return[$each['field_name']] = $this->NameAddressModel->addNameAddress($each['address_type'], $param);
    		}
    		else{
    			$return[$each['field_name']] = $this->NameAddressModel->updateNameAddress($order[$each['field_name']], $param);
    		}
    	}
    	return $return;
    }
    
    /*
     * set codeigniter validation rule
     */
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
	private $data = array();
	
	public function __get($var_name){
		if (isset($this->data[$var_name])){
			return $this->data[$var_name];
		}
		else{
			return NULL;
		}
	}
	
	public function __set($var_name, $value) {
		$this->data[$var_name] = $value;
	}
	
	public function setValue($var_name, $value){
		$this->data[$var_name] = $value;
	}
}