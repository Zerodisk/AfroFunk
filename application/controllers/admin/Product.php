<?php
class Product extends MY_Controller{
	
    public function __construct(){
        parent::__construct('admin');
        
        //load models
        $this->load->model('CategoryModel');
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
    
    //product search page
    public function index(){
    	//populate main data
		$data['main'] = NULL;
    	
    	//load page name
        $data['page'] = 'admin/product_search';

        //load page template
        $this->load->view('admin/template', $data);
    	
    }
    
    //add new product
    public function add(){
    	/*
    	 * 1. check for signal to add submittion
    	 * 2. add new product
    	 * 3. get new product id
    	 * 4. then  
    	 *          $this->view($product_id);
    	 *		    return;
    	 * 
    	 */
    	
    	
    	//show new product entry page
    	$data['main'] = array(
    						'isNew' 		=> 'true',
    						'product_id'	=> '0',
    						'product'		=> NULL,
    						'sizes'			=> $this->SizeModel->getSizeList(),
    						'colors'		=> $this->ColorModel->getColorList(),
    						'categories'	=> $this->CategoryModel->getCategoryList(NULL, FALSE),
    					);
    	
    	//load page name
        $data['page'] = 'admin/product';

        //load page template
        $this->load->view('admin/template', $data);
    }
    
    //view individual page
    public function view($product_id){
    	$product = $this->ProductModel->getProductById($product_id, FALSE);
        if (count($product) <= 0){
        	echo 'selected product is not found !!';
        	return;
        }
    	
    	//populate main data
		$data['main'] = array(
							'isNew' 		=> 'false',
							'product_id'	=> $product_id,
							'product'		=> $product,							
							'sizes'			=> $this->SizeModel->getSizeList(),
							'colors'		=> $this->ColorModel->getColorList(),	
							'categories'	=> $this->CategoryModel->getCategoryList(NULL, FALSE),
						);
    	
    	//load page name
        $data['page'] = 'admin/product';

        //load page template
        $this->load->view('admin/template', $data);
    }
    
    
    
    // ************************** ajax controller ************************ //
    
    //ajax for product search result
    public function ajax_search(){
    	//read ajax input
    	$keyword 	  = $this->input->get_post('keyword');
    	$record_index = $this->input->get_post('record_index');
    	$limit 		  = $this->input->get_post('limit');

    	//query and return as json
    	$products = $this->ProductModel->getProductListForAdminSearch($keyword, $record_index, $limit);
		$this->echoJson(TRUE, $products);
    }
    
    //ajax for item list for a given product_id
    public function ajax_getItemList(){
    	$product_id = $this->input->get_post('product_id');

    	$items = $this->ItemModel->getItemList($product_id, FALSE);
    	$this->echoJson(TRUE, $items);
    }
    
    //ajax for product infomation for a given product_id
    public function ajax_getProduct(){
    	$product_id = $this->input->get_post('product_id');
    	
    	$product = $this->ProductModel->getProductById($product_id, FALSE);
    	$this->echoJson(TRUE, $product);
    }
    
    //ajax for photo list for a given product_id
    public function ajax_getPhotoList(){
    	$product_id = $this->input->get_post('product_id');

    	$photos = $this->PhotoModel->getPhotoListByProductId($product_id, FALSE);
 		$this->echoJson(TRUE, $photos);   	
    }

}