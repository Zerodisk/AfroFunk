<?php
class Report extends MY_Controller{
	
    public function Report(){
        parent::__construct('admin');
    }	
    
    public function index(){
		echo 'this is admin-report page';
    }


}