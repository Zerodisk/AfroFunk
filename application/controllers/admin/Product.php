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
        $this->load->model('TransactionModel');
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
            
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
        $this->_addProductDataToViewBeforeRender(TRUE, 0, NULL);
    }
    
    //update existing product or add new product
    public function save(){

    	if ($this->input->post('cmdAdminProduct') == 'submit'){
    		//set form validation rule
	        $this->_setValidationRule();    
	        				    			    				
	    	//validate data
	    	if ($this->form_validation->run() == TRUE){
				//success validate	
	    		if ($this->input->post('chkIsActive') == 'true'){$is_active = TRUE;}else{$is_active = FALSE;}
	    		
	    		$param = array(
    							'description' 			=> $this->input->post('txtProductDescription'),
    							'size_description' 		=> $this->input->post('txtSizeDescription'),
    							'price_discount_amt' 	=> $this->input->post('txtPrice') - $this->input->post('txtPriceSale'),
    							'is_active'				=> $is_active,
	    		);
	    		
				if ($this->input->post('isNew') == 'true'){
    				//save new product
					$product_id = $this->ProductModel->addProduct($param, 
													$this->input->post('txtProductName'),
													$this->input->post('txtPrice'),
													$this->input->post('category_id')
								  );
					
		    	}
		    	else{
		    		//update existing product
		    		$product_id = $this->input->post('product_id');
		    		
		    		$param['product_name'] = $this->input->post('txtProductName');
		    		$param['price'] = $this->input->post('txtPrice');
		    		$param['category_id'] = $this->input->post('category_id');
		    		
					$this->ProductModel->updateProduct($this->input->post('product_id'), $param);		
		    	}
		    		
		    	header('Location: '.base_url().'admin/product/view/'.$product_id);
		    	return;
			}
			else{
				//error validation				
				echo('data error, click back on browser and try again<br />'.validation_errors());
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
        
        $this->_addProductDataToViewBeforeRender(FALSE, $product_id, $product);
    }
    
    public function photo_add($product_id){
		$data['product_id'] = $product_id;

        //load page template
        $this->load->view('admin/photo_upload', $data);
    }
    
    public function photo_save(){
    	$this->load->library('upload');

    	$product_id = $this->input->get_post('product_id');
    	$filename = $this->PhotoModel->getNewPhotoFileName($product_id).'.jpg';
    	
    	$config['upload_path']   = $this->PhotoModel->getLocalFolder();
    	$config['file_name']     = $filename;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	     = '1024';

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload()){
			//error
			$error = array('error' => $this->upload->display_errors());
			echo("upload file fail\n\n".$error);
		}
		else{
			//success
			
			$photo_id = $this->PhotoModel->addPhoto($product_id, $filename);
			echo('photo upload success, click ok button to close this windoe');
		}
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
    
    public function ajax_addNewItem(){
    	$product_id = $this->input->get_post('product_id');
    	$qty        = $this->input->get_post('qty');
    	$size_id    = $this->input->get_post('size_id');
    	$color_id   = $this->input->get_post('color_id');
    	
    	if (!is_numeric($qty))
    		$this->echoJson(FALSE, NULL);    //qty is NOT numeric number
    	
    	$param = array();
    	if ($size_id > 0)
    		$param['size_id']  = $size_id;
    	if ($color_id > 0)
    		$param['color_id'] = $color_id;
    	
    	$item_id = $this->ItemModel->addNewItem($product_id, $qty, $param);
    	if ($item_id > 0)
    		$this->echoJson(TRUE, $item_id);
    	else
    		$this->echoJson(FALSE, NULL);
    }
    
    public function ajax_updateItem(){
    	$item_id    = $this->input->get_post('item_id');
    	$is_active  = $this->input->get_post('is_active');
    	$size_id    = $this->input->get_post('size_id');
    	$color_id   = $this->input->get_post('color_id');
    	
    	$param = array(
    					'is_active' => $is_active,
    					'size_id'	=> $size_id,
    					'color_id'	=> $color_id,
    	);
    	
    	$this->ItemModel->updateitem($item_id, $param);
    	$this->echoJson(TRUE, NULL);
    }
    
    public function ajax_deletePhoto(){
    	$photo_id = $this->input->get_post('photo_id');
    	
    	$this->PhotoModel->deletePhoto($photo_id);
    	$this->echoJson(TRUE, NULL);
    }
    
    public function ajax_photoSetMain(){
    	$photo_id = $this->input->get_post('photo_id');
    	
    	$param = array('is_main' => 1);
    	$this->PhotoModel->updatePhoto($photo_id, $param);
    	$this->echoJson(TRUE, NULL);
    }
    
    public function ajax_photoChangeStatus(){
    	$photo_id = $this->input->get_post('photo_id');
    	$is_active = $this->input->get_post('is_active');
    	 
    	$param = array('is_active' => $is_active);
    	$this->PhotoModel->updatePhoto($photo_id, $param);
    	$this->echoJson(TRUE, NULL);
    }
    
    public function ajax_stockUpdate(){
    	$item_id       = $this->input->get_post('item_id');
    	$transac_type  = $this->input->get_post('transac_type');
    	$transac_qty   = $this->input->get_post('transac_qty');
    	
    	if (!is_numeric($transac_qty))
    		$this->echoJson(FALSE, NULL);    //qty is NOT numeric number
    	
    	if ($this->ItemModel->updateStock($item_id, $transac_type, $transac_qty))
    		$this->echoJson(TRUE, NULL);
    	else
    		$this->echoJson(FALSE, NULL);
    }
    
    
    
	// ************************** private function ************************ //
    /*
     * set codeigniter validation rule
     */
    private function _setValidationRule(){
    	$this->form_validation->set_rules('txtProductName', 'product name' 	  , 'trim|required');
    	$this->form_validation->set_rules('txtPrice' 	  , 'price (original)', 'trim|required|decimal|greater_than[0]');
    	$this->form_validation->set_rules('txtPriceSale'  , 'price (sale)'    , 'trim|required|decimal|greater_than[0]');
    	
    	$this->form_validation->set_error_delimiters('<span class="error" style="color:red;">', '</span>');
    }
    
    private function _addProductDataToViewBeforeRender($isNew, $product_id, $product){
    	$category_id_selected = 0;
    	
    	if (!$isNew){
    		$category_id_selected = $product['category_id'];
    	}
    	
    	//populate main data
		$data['main'] = array(
							'isNew' 				=> $isNew,
							'product_id'			=> $product_id,
							'product'				=> $product,							
							'sizes_options'			=> $this->SizeModel->getSizeDropdown(-1, 'select size'),				//for size drop down option
							'colors_options'		=> $this->ColorModel->getColorDropdown(-1, 'select color'),				//for color drop down option
							'categories_options'   	=> $this->CategoryModel->getCategoryDropdown(-1, 'select category'),	//for category drop down options
							'category_id_selected'  => $category_id_selected,	
							'transac_options'		=> $this->TransactionModel->getTransactionTypeDropdownSimple('', 'select transaction type'),
							'transac_selected'		=> 'PIN',
							'product_photos_folder'	=> $this->PhotoModel->getUrlPath(),		
		);
    	
    	//load page name
        $data['page'] = 'admin/product';

        //load page template
        $this->load->view('admin/template', $data);
    }
    
    
    
}