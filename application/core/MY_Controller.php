<?php
class MY_Controller extends CI_Controller{
    
	public function __construct(){
        parent::__construct();
        $this->load->library('session');
        
        if (!$this->session->userdata('isAdminLogined')){
        	header('Location: '.base_url().'admin/login');
        }
    }	
    
    /*
     * function return menu path in array format
     *   array of 'menu text display', 'full path url', 'css class name'
     */
    public function getMainMenu(){
    	$selected = $this::_getAdminSectionName();
    	$menus = array(
    				array('Home'	 , base_url().'admin'	       , $this::_returnSelected($selected, '')),
    				array('Products' , base_url().'admin/product'  , $this::_returnSelected($selected, 'product')),
    				array('Orders'   , base_url().'admin/order'    , $this::_returnSelected($selected, 'order')),
    				array('Customer' , base_url().'admin/customer' , $this::_returnSelected($selected, 'customer')),
    				array('Report'   , base_url().'admin/report'   , $this::_returnSelected($selected, 'report')),
    				array('PayPal'   , base_url().'admin/paypal'   , $this::_returnSelected($selected, 'paypal')),
    				array('Tools'    , base_url().'admin/tool'     , $this::_returnSelected($selected, 'tool')),
    			 );		
    	return $menus;
    }
    
    /*
     *  function return all admin header variable(array)
     *    this can be override by sub-class
     */
    public function getHeader(){
        return array(
                    'menus'  => $this::getMainMenu(),
                    );
    }
    
    /*
     *  function return all admin footer variable(array)
     *    this can be override by sub-class
     */
    public function getFooter(){
    	return array(
    	    		'copyright' => 'copyright 2011 afrofunk clothing, all right is reserved',
    	            );
    }
    
    
    
    
    /************************* Private function here *****************************/
	
	/*
     * return the path section right after admin section 
     *   i.e 'http://www.afrofunk.com.au/shop/admin/product/view/12' will return 'product'
     */
    private function _getAdminSectionName(){
    	return $this->uri->segment(2, '');
    }
    
    private function _returnSelected($compare, $with){
    	if ($compare == $with)
    		return '-selected';
    	else
    		return '';
    }

    
}