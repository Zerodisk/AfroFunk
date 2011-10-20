<?php
class Tool extends MY_Controller{
	
    public function __construct(){
        parent::__construct('admin');
    }	
    
    public function index(){
		echo 'this is admin-tool page';
    }


}