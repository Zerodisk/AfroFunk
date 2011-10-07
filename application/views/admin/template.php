<html>
    <head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin_layout.css" />
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.6.1.min.js"></script>
    </head>
    <body>
        <div id="container">
        <? $this->load->view('admin/header', $header) ?>
        
        
        <? $this->load->view($page, $main) ?>
        

        <? $this->load->view('admin/footer', $footer) ?>
        </div>
    </body>
</html>
