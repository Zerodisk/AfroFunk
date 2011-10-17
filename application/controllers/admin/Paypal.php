<?php
class Paypal extends MY_Controller{
	
    public function Paypal(){
        parent::__construct('admin');
    }	
    
    public function index(){
		echo 'this is admin-paypal page';
    }


}