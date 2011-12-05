<?php
class Product extends MY_Controller{
	
    public function __construct(){
        parent::__construct('admin');
        
        //load models
        $this->load->model('ProductModel');
        $this->load->model('ItemModel');
        $this->load->model('PhotoModel');
        $this->load->model('SizeModel');
        $this->load->model('ColorModel');
            
        //load header+footer+title
        $data['header'] = $this::getHeader();
        $data['footer'] = $this::getFooter();
        $this->load->vars($data);
    }	
    
    public function index(){
    	//populate main data
		$data['main'] = null;
    	
    	//load page name
        $data['page'] = 'admin/product_search';

        //load page template
        $this->load->view('admin/template', $data);
    	
    }
    
    public function view($product_id){
    	//populate main data
		$data['main'] = array(
							'product_id'	=> $product_id,
							'product'		=> $this->ProductModel->getProductById($product_id, FALSE),							
							'items'			=> $this->ItemModel->getItemList($product_id, FALSE),
							'photos'		=> $this->PhotoModel->getPhotoListByProductId($product_id, FALSE),
							'sizes'			=> $this->SizeModel->getSizeList(),
							'colors'		=> $this->ColorModel->getColorList(),							
						);
    	
    	//load page name
        $data['page'] = 'admin/product';

        //load page template
        $this->load->view('admin/template', $data);
    }
    
    public function ajax_search(){
    	//read ajax input
    	$keyword 	  = $this->input->get_post('keyword');
    	$record_index = $this->input->get_post('record_index');
    	$limit 		  = $this->input->get_post('limit');

    	//query and return as json
    	$products = $this->ProductModel->getProductListForAdminSearch($keyword, $record_index, $limit);
		$this->echoJson(TRUE, $products);
    }
    
    public function ajax_getItemList(){
    	$product_id = $this->input->get_post('product_id');

    	$items = $this->ItemModel->getItemList($product_id, FALSE);
    	$this->echoJson(TRUE, $items);
    }

}