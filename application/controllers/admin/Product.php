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
        
        $this->load->library('form_validation');
        $this->load->helper('form');
            
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
    
    //add new product page
    public function add(){    	        
        $this->_beforeFormRender(TRUE, 0, NULL);
    }
    
    //update existing product or add new product
    public function save(){
    	/*
    	 * 1. check for signal to add submittion
    	 * 2. add new product
    	 * 3. get new product id
    	 * 4. then  
    	 *          $this->view($product_id);
    	 *		    return;
    	 * 
    	 */

    	if ($this->input->post('cmdAdminProduct') == 'submit'){
    		//set form validation rule
	        $this->_setValidationRule();    
	        				    			    				
	    	//validate data
	    	if ($this->form_validation->run() == TRUE){
				//success validate	
				if ($this->input->post('isNew') == 'true'){
    				//save new product
		
		    			
		    	}
		    	else{
		    		//update existing product
		
		    			
		    	}
		    		
		    	$this->view($product_id);
		    	return;
			}
			else{
				//error validation				
				echo('data error, please click back on browser and try again<br />'.validation_errors());
			}   
    	}
    }
    
    //view individual page
    public function view($product_id){
    	$product = $this->ProductModel->getProductById($product_id, FALSE);
        if (count($product) <= 0){
        	echo 'selected product is not found !!';
        	return;
        }
        
        $this->_beforeFormRender(FALSE, $product_id, $product);
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
    
    
    
	// ************************** private function ************************ //
    /*
     * set codeigniter validation rule
     */
    private function _setValidationRule(){
    	$this->form_validation->set_rules('txtProductName', 'product name' 	  , 'trim|required');
    	$this->form_validation->set_rules('txtPrice' 	  , 'price (original)', 'trim|required|decimal');
    	$this->form_validation->set_rules('txtPriceSale'  , 'price (sale)'    , 'trim|required|decimal|greater_than[0]');
    	
    	$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">', '</span>');
    }
    
    private function _beforeFormRender($isNew, $product_id, $product){
    	//populate main data
		$data['main'] = array(
							'isNew' 		=> $isNew,
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
    
    
    
}