<?php
class Home extends MY_Controller{
	
    public function Home(){
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
        $data['page'] = 'admin/dashboard';

        //load page template
        $this->load->view('admin/template', $data);
    	
    }


}