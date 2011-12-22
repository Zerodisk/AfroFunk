<?php
class Home extends MY_Controller{
    
    public function Home(){
        parent::__construct();
        
        //load models
        $this->load->model('CategoryModel');
    }

    //main landing page
    public function index(){
        $categories = $this->CategoryModel->getCategoryList();
        
        //load all neccesary main data
        $data = array(
        			   'categories' => $categories,
        			 );

        //load page template
        $this->load->view('home', $data);
    } 
     
}