<?php
class Payment extends MY_Controller{
	
	private $order_id;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->library('session');
        $this->order_id = $this->session->userdata('db_order_id');	//get db_order_id from codeigniter session
        
        //for security - read query string oid and compare with codeigniter session db_order_id and check number of item for this order
        $db_order_id = $this->input->get_post('oid');
    	if ((strval($this->order_id) != strval($db_order_id) || (afro_getNumberOfItem($this->order_id) <= 0))){
    		header('Location: '.base_url().'cart');
    	}

        $this->load->model('OrderModel');
        $this->load->model('OrderItemModel');
        $this->load->model('NameAddressModel');
        $this->load->model('CreditCardModel');
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }
    
    public function index(){   	
    	//get order, order_item, shipping cost, billing/shipping address
    	$order = $this->OrderModel->getOrder($this->order_id);
    	$items = $this->OrderItemModel->getOrderItemList($this->order_id);
    	$bill_name_address = $this->NameAddressModel->getNameAddress($order['bill_name_address_id']);
    	$ship_name_address = $this->NameAddressModel->getNameAddress($order['ship_name_address_id']);
    	$shipping_cost = afro_getShippingCost($ship_name_address['country_id']);
    	
    	//check command payment
    	switch ($this->input->post('cmdPayment')){
    		case 'payCreditCard':
    			//set form validation rule
        		$this->_setValidationRule();   
    			//validate all name address
    			if ($this->form_validation->run() == FALSE){
					//error validation
				}
				else{
					//success validate						

				}   
    			
    			break;
    		default:
    		
    			break;
    	}
    	
    	//load all neccesary main data
        $data['main'] = array(
							   'order_id'          => $this->order_id,
        					   'order'             => $order,
                               'items'	           => $items,
        					   'shipping_cost'     => $shipping_cost,
        					   'bill_name_address' => $bill_name_address,	
        					   'ship_name_address' => $ship_name_address,
        					   'cc_options_year'   => $this->CreditCardModel->getOptionsExpiryYear('-1', 'year'),
        					   'cc_options_month'  => $this->CreditCardModel->getOptionsExpiryMonty('-1', 'month'),
        					   'cc_card_type'	   => $this->CreditCardModel->getOptionsCardType(),
        					   'main_error_message'  => '<span class="error" style="color:red">There is an error, please see below in red text</span>',	
        				     );

        //load page name
        $data['page'] = 'payment';

        //load page template
        $this->load->view('template', $data);
    }
    
    
    
    
    /*********************** private function ************************/
    
    /*
     * set codeigniter validation rule
     */
    private function _setValidationRule(){
    	$this->form_validation->set_rules('card_type'        ,'credit card type'            ,'required|exact_length[3]');
		$this->form_validation->set_rules('card_number'      ,'credit card number'          ,'required|numeric|min_length[15]|max_length[20]');
    	$this->form_validation->set_rules('card_cvv'         ,'credit card security number' ,'required|numeric|min_length[3]|max_length[4]');
    	$this->form_validation->set_rules('card_holder_name' ,'credit card holder name'     ,'required');
    	
    	$this->form_validation->set_rules('card_month' ,'' , 'greater_than[0]');
    	$this->form_validation->set_rules('card_year'  ,'' , 'greater_than[0]');
    	$this->form_validation->set_message('greater_than', 'card expiry date is required');
    
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
            			'title' => 'AfroFunk - Payment',
    	);
    } 
}