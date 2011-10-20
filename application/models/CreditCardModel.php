<?php
class CreditCardModel extends CI_Model{
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('afrofunk');
    }
   
    function getOptionsCardType(){
    	$card_type = array(
    						''  => 'select credit card type',
    						'VSA' => 'Visa card',
					    	'MSC' => 'Master card',
					    	'AMX' => 'American Express card',
    					  );
    	return $card_type;
    }

    function getOptionsExpiryYear($default_value = NULL, $default_text = NULL, $default_year_length = 4, $default_year_inadvanced = 7){
    	$options = array();
    	if (($default_value != NULL) && ($default_text != NULL)){
    		$options[$default_value] = $default_text;
    	}
    	$this_year = date("Y");
    	for ($i = $this_year; $i <= $this_year + $default_year_inadvanced; $i++) {
    		$options[$i] = afro_string_right(strval($i), $default_year_length);
    	}
    	return $options;
    }
    
    function getOptionsExpiryMonty($default_value = NULL, $default_text = NULL){
    	$options = array();
    	if (($default_value != NULL) && ($default_text != NULL)){
    		$options[$default_value] = $default_text;
    	}
    	for ($i = 1; $i <= 12; $i++) {
    		$options[$i] = afro_string_right('0'.strval($i), 2);
    	}
    	return $options;
    }
    
    
}