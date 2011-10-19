<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('afro_getShippingCost')){
	function afro_getShippingCost($country_id){
		if ($country_id <= 0){
			return NULL;
		}
		
		$ci=& get_instance();
		$ci->load->model('ShippingModel');
		$shipping = $ci->ShippingModel->getShippingCostByCountry($country_id);
		return $shipping;
	}
}

if ( ! function_exists('afro_getNumberOfItem')){
    function afro_getNumberOfItem($order_id){
    	if ($order_id == FALSE){return -1;}
    	$ci=& get_instance();
    	$ci->load->model('OrderItemModel');
    	return $ci->OrderItemModel->getNumberOfItem($order_id);
    }
}

if ( ! function_exists('afro_getProductNameExtraInfo')){
    function afro_getProductNameExtraInfo($color, $size){
    	$return = '';
    	if (isset($color) && isset($size)){
    		$return = '(color: '.$color.' - size: '.$size.')';
    	}
    	else if(!isset($color) && isset($size)){
    		$return = '(size: - '.$size.')';
    	}
    	else if(isset($color) && !isset($size)){
    		$return = '(color - '.$color.')';
    	}
    	return $return;
    }
}

if ( ! function_exists('afro_getFinalSalePrice')){
	function afro_getFinalSalePrice($price, $price_dis_amt, $price_dis_per, $qty = 1){
		if ($price_dis_amt == NULL){$price_dis_amt = 0;}
		if ($price_dis_per == NULL){$price_dis_per = 0;}
		return ($price - $price_dis_amt - (($price - $price_dis_amt) * $price_dis_per / 100)) * $qty;
	}
}

if ( ! function_exists('afro_string_right')){
	function afro_string_right($string, $count){
		return substr($string, ($count*-1));
	}
}

if ( ! function_exists('afro_string_left')){
	function afro_string_left($string, $count){
		return substr($string, 0, $count);
	}
}

