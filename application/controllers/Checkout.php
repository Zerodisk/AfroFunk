<?php
class Checkout extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        
        //load models and library
        $this->load->model('CountryModel');
        $this->load->library('shoppingcart');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }
    
    public function index(){
    	//check if there is any commande request
    	if ($this->input->post('cmdCheckout')){
    		switch ($this->input->post('cmdCheckout')){
    			case 'confirmOrder':
    				//validate all name address
    				
    				
    				//save all name address or update if it's there
    				
    				
    				//redirect to confirm page 
    				
    				
    				break;
    		}
    	}
    	
    	
    	
    	//load all neccesary main data
        $data['main'] = array(

        				);

        //load page name
        $data['page'] = 'checkout';

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
            			'title' => 'AfroFunk - Check out',
    	);
    }
}