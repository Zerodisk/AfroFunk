<?php
class Home extends CI_Controller{
    
    public function Home(){
        parent::__construct();
        
        //load models
        $this->load->model('CategoryModel');
        
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }

    //main landing page
    public function index(){
        $categories = $this->CategoryModel->getCategoryList();
        
        //load all neccesary main data
        $data['main'] = array(
        					'categories' => $categories,
        				);
        
        //load page name
        $data['page'] = 'home';

        //load page template
        $this->load->view('template', $data);
    } 
    
    
    
    /***********************************
     *
     * private function for
     * - header
     * - footer
     * - title
     * 
     ***********************************/
    private function _getHeader(){
        return array(
                    'first'  => '1. first',
                    'second' => '2. second'
                    );
    }
    
    private function _getFooter(){
        return array(
                    'third'  => 'footer on home page',
                    );        
    }
    
    private function _getTitle(){
        return null;
    }  
}