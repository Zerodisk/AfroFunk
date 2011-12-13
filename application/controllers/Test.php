<?php
class Test extends MY_Controller{
    
    public function Test(){
        parent::__construct();

        //load all model for testing
        $this->load->model('CategoryModel');
        $this->load->model('ProductModel');
        $this->load->model('ColorModel');
        $this->load->model('SizeModel');
        $this->load->model('PhotoModel');
        $this->load->model('CategoryPhotoModel');
        $this->load->model('ItemModel');
        $this->load->model('ProductSizeModel');
        $this->load->model('TransactionModel');
        $this->load->model('ShippingModel');
        $this->load->model('OrderModel');
        $this->load->model('OrderItemModel');
        $this->load->model('CountryModel');
        
        //load variable for header/footer/title
        $data['header'] = $this::_getHeader();
        $data['footer'] = $this::_getFooter();
        $data['title']  = $this::_getTitle();
        $this->load->vars($data);     
    }
    
    public function index(){
        echo 'test page';
    }
    
    public function color_list(){
        $result = $this->ColorModel->getColorList();
        foreach($result as $one){
            echo $one['color_id'].' - '.$one['color_name'].'<br>';
        }
    }
    
    public function color($color_id){
    	$result = $this->ColorModel->getColorById($color_id);
    	if (count($result) > 0){
    		echo $result['color_id'].' - '.$result['color_name'];
    	}
    }
    
    public function color_add($color){
    	$this->ColorModel->addColor(array('color_name' => $color, 'weight' => 1));
    	echo 'add new color: '.$color;
    }

    public function size_list(){
        $result = $this->SizeModel->getSizeList();
        foreach($result as $one){
            echo $one['size_id'].' - '.$one['size_name'].'<br>';
        }
    }
    
	public function size($size_id){
    	$result = $this->SizeModel->getSizeById($size_id);
    	if (count($result) > 0){
    		echo $result['size_id'].' - '.$result['size_name'];
    	}
    }
    
    public function product_list(){
    	$category_id = 1;
    	echo 'Category: '.$this->CategoryModel->getCategoryNameById($category_id).'<br><br>';
        $result = $this->ProductModel->getProductListByCategoryId($category_id);
        foreach($result as $one){
            echo $one['product_id'].' - '.$one['product_name'];
            echo '<br>';
        }
    }
    
    public function product_add(){
    	$param = array('description' => 'test', 'price_discount' => 10, 'is_active' => 1);
    	$product_id = $this->ProductModel->addProduct($param, 'Add auto 5', 19.99, 1);
    	echo 'new product id: '.$product_id;
    }

    public function category_list(){
        $result = $this->CategoryModel->getCategoryList(null);
        foreach($result as $category){
            echo $category['category_id'].' - '.$category['category_name'].'<br>';
        }
    }
    
    public function category($category_id){
    	$result = $this->CategoryModel->getCategoryById($category_id);
    	if (count($result) > 0){
    		echo $result['category_id'].' - '.$result['category_name'];
    	}
    }
    
    public function photo_list($product_id){
    	$result = $this->PhotoModel->getPhotoListByProductId($product_id);
    	foreach($result as $photo){
    		var_dump($photo);
    		echo '<br><br>';
    	}
    }
    
    public function photo($photo_id){
    	$photo = $this->PhotoModel->getPhotoById($photo_id);
    	if (count($photo) > 0){
    		var_dump($photo);
    	}
    }
    
    public function photo_add($product_id){
    	$new_photo = $this->PhotoModel->addPhoto(null, $product_id);
    	var_dump(($new_photo));
    	echo '<br><br>';
    	echo 'new photo added for product_id: '.$product_id.'<br>';
    	echo 'new photo_id: '.$new_photo['photo_id'];
    }
    
    public function item_add($product_id){
    	$param = array(
    				'qty' => 7,
    				'weight' => 4.5
    			 );
    	$this->ItemModel->addItem($param, $product_id, 1);
    	echo 'new item added';	
    }
    
    public function photo_delete($photo_id){
    	$this->PhotoModel->deletePhoto($photo_id);
    	echo 'photo id: '.$photo_id.' has been deleted';
    }
    
    public function test1(){
    	$data = array(
    				'a' => 1,
    				'b' => 2,
    			    'c' => 3
    			);
    	
    	$data['d'] = 4;
    	$data['e'] = 5;
    	echo '<pre>';
    	var_dump($data);
    	echo '</pre>';
    	
    	echo '<br><br>'.date('Y-m-d H:i:s');
    }
    
    public function category_photo_duplicate(){
    	if ($this->CategoryPhotoModel->isFileNameDuplicate('tesT.jpg')){
    		echo('duplicate');	
    	}
    	else{
    		echo('good name');
    	}
    }
    
    public function category_photo($id){
    	var_dump($this->CategoryPhotoModel->getPhotoById($id));
    }
    
	public function category_add_photo(){
    	var_dump($this->CategoryPhotoModel->addPhoto(null, 2, 'test_12.jpg'));
    }
    
    public function getCategoryPhotoFolder(){
    	echo $this->CategoryPhotoModel->getLocalFolder();
    } 
    
    public function category_delete_photo($id){
    	if ($this->CategoryPhotoModel->deletePhoto($id)){
    		echo 'deleted';
    	}
    	else{
    		echo 'id is not found';
    	}
    }
    
    public function getPhotoFolder(){
    	echo $this->PhotoModel->getLocalFolder();
    	echo "<br>";
    	echo $this->PhotoModel->getUrlPath();
    }
    
    public function transac_new(){
    	$this->TransactionModel->transacNew(123, 4);
    }
    
    public function transac_sale(){
    	$this->TransactionModel->transacSale(321, 2, 999);
    }
    
    public function shipping($country_id){
    	$shipping = $this->ShippingModel->getShippingCostByCountry($country_id);
    	var_dump($shipping);
    }
    
    public function testconfig(){
    	echo($this->config->item('test'));
    }
    
    public function shoppingcart(){
    	//$this->load->library('shoppingcart', array('db'));
    	$this->load->library('shoppingcart');
    	echo('load shopping cart work!!<br>');
    	echo($this->shoppingcart->getOrderId());
    }
    
    public function shoppingcart_add($item_id){
    	$this->load->library('shoppingcart');
    	$this->shoppingcart->addCart($item_id);
    }
    
    public function shoppingcart_remove($item_id){
    	$this->load->library('shoppingcart');
    	$this->shoppingcart->removeCart($item_id);
    }
    
    public function shoppingcart_getcart(){
    	$this->load->library('shoppingcart');
    	$cart = $this->shoppingcart->getCart();
    	var_dump($cart);
    	
    	echo("\n".'number of total item in cart: '.$this->shoppingcart->getNumberOfItem($cart));
    }
    
    public function shoppingcartclear(){
    	$this->load->library('session');
    	$this->session->unset_userdata('order_id');
    	$this->session->unset_userdata('db_order_id');
    	$this->session->unset_userdata('shipping_country_id');
    	$this->session->sess_destroy();
    }
    
    public function shoppingcart_update(){
    	$this->load->library('shoppingcart');
    	$this->shoppingcart->updateCart(6, 3);
    }
    
    public function shoppingcart_empty(){
    	$this->load->library('shoppingcart');
    	$this->shoppingcart->emptyCart();
    }
    
    public function updateOrderPrice($order_id){
    	$this->OrderModel->updateOrderPrice($order_id);
    }
    
    public function country_list(){
    	$countries = $this->CountryModel->getCountryList(TRUE, 'country_name');
    	var_dump($countries);
    }
    
    public function ajax_test(){
    	$result = array('result' => 'success',
    					'data' => $this->input->get_post('item'),
    	);
    	echo(json_encode($result));
/*
 * //this will send request using post
$(document).ready(function(){
	$('#btnPayNow').click(function(){
		$.post('<?=base_url()?>test/ajax_test', { 'item' : 'Tan Tang'}, 
		function(data){
			alert(data.result + ': ' + data.data);
			if (data.result == 'success')
				$('#item').append('<div style="color:blue">true-yes</div>');
			else
				$('#item').append('<div style="color:red">false-no</div>');
		}, 'json');
	});
});
 */
    	
/*
 * //this will send request using get
$(document).ready(function(){
	$('#btnPayNow').click(function(){
		$.getJSON('<?=base_url()?>test/ajax_test', { 'item' : 'Tan Tang', 'item2':'value2'}, 
			function(json){
			alert(json.result + ': ' + json.data);
			}
		);	
	});
});
 */
    }
    
    public function ajax_test2(){
    	$keyword = $this->input->get_post('keyword');    	
    	$products = $this->ProductModel->getProductListForAdminSearch($keyword);
    	
    	$helper = new MY_Controller();
    	$helper->echoJson(TRUE, $products);
    }
    
    
    
    
    /*
     * main controller for product main landing page
     */
    public function template(){
        //load main variable
        $data['main'] = array(
                                'test'  => 'from: public function index()',
                                'alert' => 'hello world'
                             );
        
        //load page name
        $data['page'] = 'product_main';

        //load page template
        $this->load->view('template', $data);
    }
    
    /*
     * controller for selected product id (route from product/$id to this method view($id))
     */
    public function view($id){
        //load main variable
        $data['main'] = array('product_id' => $id);
        
        //load page name
        $data['page'] = 'product_selected';
        
        //load page template
        $this->load->view('template', $data);
    }
    
    public function viewall(){
        $this->load->model('ProductModel');
        
        // ******** prefer array as I think we can use some useful array functionallity **********
        echo 'using result as array<br>';
        foreach($this->ProductModel->getCategoryListArray() as $category){
            echo $category['id'].' - '.$category['name'].'<br>';
        }
        
        
        echo 'using result as object<br>';
        foreach($this->ProductModel->getCategoryListObject() as $category){
            echo $category->id.' - '.$category->name.'<br>';
        }
        
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
        return ;
    }    
}

