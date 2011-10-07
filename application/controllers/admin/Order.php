<?php
class Order extends MY_Controller{
	
    public function Order(){
            parent::__construct();
        
        //load header+footer+title
        $data['header'] = $this::getHeader();
        $data['footer'] = $this::getFooter();
        $this->load->vars($data);
    }	
    
    public function index(){
    	//show admin luncher page with all accessible menu
		$data['main'] = null;
    	
    	//load page name
        $data['page'] = 'admin/order';

        //load page template
        $this->load->view('admin/template', $data);
    	
    }


}