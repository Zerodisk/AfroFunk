<?php
class Payment extends MY_Controller{
	
	private $order_id;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->library('session');
        $this->order_id = $this->session->userdata('db_order_id');	//get db_order_id from codeigniter session

        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }
    
    public function index(){
    	//read query string oid and compare with codeigniter session db_order_id
    	$db_order_id = $this->input->get('oid');
    	if (strval($this->order_id) != strval($db_order_id)){
    		header('Location: '.base_url().'cart');
    	}
    	
    	
    	
    	//load all neccesary main data
        $data['main'] = array(

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