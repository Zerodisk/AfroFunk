<?php
class Report extends MY_Controller{
	
    public function __construct(){
        parent::__construct('admin');
    }	
    
    public function index(){
		echo 'this is admin-report page';
    }


}