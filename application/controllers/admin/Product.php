<?php
class Product extends MY_Controller{
	
    public function Product(){
        parent::__construct('admin');
            
        //load header+footer+title
        $data['header'] = $this::getHeader();
        $data['footer'] = $this::getFooter();
        $this->load->vars($data);
    }	
    
    public function index(){
    	//show admin luncher page with all accessible menu
		$data['main'] = null;
    	
    	//load page name
        $data['page'] = 'admin/product';

        //load page template
        $this->load->view('admin/template', $data);
    	
    }

}