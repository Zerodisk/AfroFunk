<?php
class Category extends CI_Controller{
    
    public function Category(){
        parent::__construct();
        
        //load models
        $this->load->model('CategoryModel');
        $this->load->model('CategoryPhotoModel');
        $this->load->model('ProductModel');
        
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }
    
    public function index(){
		echo 'Category page';
    }
    
    //list all product by a given categoryid
    public function view($category_id){
    	//load category name
        $category_name = $this->CategoryModel->getCategoryNameById($category_id);
		
        //load category photo slice
        $category_photos = $this->CategoryPhotoModel->getPhotosByCategoryId($category_id);
        
        //load photos for a given category
        $products = $this->ProductModel->getProductListByCategoryId($category_id, TRUE, 'date_created', 'ASC', 30);
        
        //load all neccesary main data
        $data['main'] = array(
        					'products'        => $products,
        					'category_id'     => $category_id,
        					'category_name'   => $category_name,
        					'category_photos' => $category_photos
        				);
        
        //load page name
        $data['page'] = 'category';

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
                    'third'  => 'footer on category page',
                    );        
    }
    
    private function _getTitle(){
        return null;
    }  
    
}