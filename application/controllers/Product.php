<?php
class Product extends MY_Controller{
    
    public function Product(){
        parent::__construct();
        
        //load models
        $this->load->model('ProductModel');
        $this->load->model('ItemModel');
        $this->load->model('PhotoModel');
        
        $this->load->helper('form');
        
        //load header+footer+title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);
    }
    
	public function index(){
		echo 'Product page';
	}
	
	public function view($product_id){
        //load product for a given product id
        $product = $this->ProductModel->getProductById($product_id);
        
        if (count($product) <= 0){
        	echo 'selected product is not found !!';
        	return;
        }
        
        //load photos
        $photos = $this->PhotoModel->getPhotoListByProductId($product_id);

        //load item/size/color
        $items = $this->ItemModel->getItemList($product_id);
        
        //prepare for dropdown box
        $options = array();
        $options[-1] = 'select size and color';
        foreach($items as $item){
        	$options[$item['item_id']] = $item['size_name'].'  -  '.$item['color_name'];
        }
        
        //load all neccesary main data
        $data['main'] = array(
        					'product' => $product,			//product
        					'photos'  => $photos,			//list of photos
        					'items'   => $items,			//list of items
        					'items_options' => $options,	//dropdown menu for size and color
        				);
        
        //load page name
        $data['page'] = 'product';

        //load page template
        $this->load->view('template', $data);
	}

	//redirect to default given product_id photo
	public function Photo($product_id){
		$filename = $this->PhotoModel->getDefaultPhoto($product_id);
		redirect(base_url().'images/products/'.$filename);
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
                    'third'  => '3. third',
                    'fourth' => '4. fourth'
                    );        
    }
    
    private function _getTitle(){
        return null;
    }  
}

