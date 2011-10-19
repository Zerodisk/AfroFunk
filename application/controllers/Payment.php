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
        					   'cc_options_year'   => $this->CreditCardModel->getOptionsExpiryYear(-1, 'year'),
        					   'cc_options_month'  => $this->CreditCardModel->getOptionsExpiryMonty(-1, 'month'),
        					   'cc_cart_type'	   => $this->CreditCardModel->getOptionsCardType(),
        				     );

        //load page name
        $data['page'] = 'payment';

        //load page template
        $this->load->view('template', $data);
    }
    
    
    
    
    /*********************** private function ************************/
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