<?php
/*
 * this class is the wrapper for ProductModel and ItemModel
 *   this can be used for product page where it shows a selected product
 *   all items and relate product-size for a selected product will also been returned.
 */
class ProductItemModel extends CI_Model{
    
    function ProductItemModel()
    {
        // Call the Model constructor
        parent::__construct();
        
        // pre-load al neccessary model
        $this->load->model('ProductModel');
        $this->load->model('PhotoModel');
        $this->load->model('ItemModel');
    }

    /*
     * return selected product and all items, photos related.
     */
    function getProductAndItemListByProductId($product_id, $active_only = TRUE){
    	$product = $this->ProductModel->getProductById($product_id, $active_only);
    	$photos = $this->PhotoModel->getPhotoListByProductId($product_id, $active_only);
    	$items = $this->ItemModel->getItemList($product_id, $active_only);
    	
    	return array(
    				 'Product' => $product,
    				 'Photo'   => $photos,
    				 'Item'	   => $items,	
    	);
    }
    
    
    
    
}