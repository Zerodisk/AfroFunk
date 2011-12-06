<?php
/*
 * this is the main controller where all afro-controller need to inherit
 *   the __construct can accept one input which is the $section
 *     - NULL   mean the public afro shopping (assume $section = public)
 *     - admin  mean the admin area where we can manage inventory/stock/sale/report
 */
class MY_Controller extends CI_Controller{
	
	var $section;
    
	public function __construct($section = NULL){
        parent::__construct();
        
        switch ($section){
        	case 'admin':
        		$this->load->library('session');
        			 
        		if (!$this->session->userdata('isAdminLogined')){
        			header('Location: '.base_url().'admin/login');
        		}
        		break;
        	 default:
        	 	$section = 'public';  //assume as public internet access
        		break;
        }
        
        $this->section = $section;
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
    
    /*
     *  function return json
     *   - set content type, json encoding and return json data
     *  
     *  2 input parameters
     *   - $status = true meaning success request/response, then check data
     *             = false meaning fail request or response, no need to check for data 
     *               (but you can check for error_code or error_description)
     *   - $data   = the actual data, it can be array or object
     */ 
    public function echoJson($status, $object = NULL){
    	$this->output->set_header("Content-Type: application/json");
    	
    	$result = new jsonData();
    	
    	$result->status = $status;
    	if ($result->status)
    		$result->data = $object;
    	
    	sleep(1);
    	echo(json_encode($result));
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

/*
 * data structure for json response
 * - status				= boolean indicate the status of request/response
 * - data				= the actual, only return in status = TRUE
 * - error_code			= code of error
 * - error_description  = error text description
 */
class jsonData{
	public $status;
	public $data;
	public $error_code;
	public $error_description;
}