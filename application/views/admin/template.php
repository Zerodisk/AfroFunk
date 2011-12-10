<html>
   <head>
		<title>Afro Funk - Admin</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/oocss/libraries.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/oocss/content.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/oocss/grids.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin_layout.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/pure-css-buttons-v1.0/buttons.css" />
		
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery-ui.css" />
		<!--  
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
		-->
		
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.6.1.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/tabSwitch.js"></script>		
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>
		
   </head>
   <body>
      <div id="container">
        <div id="header">
          <? $this->load->view('admin/header', $header) ?>
        </div>
        
        <div id="content">
          <? $this->load->view($page, $main) ?>
          <p>&nbsp;</p>
        </div>

		<div id="footer">
          <? $this->load->view('admin/footer', $footer) ?>
        </div>
      </div>
   </body>
</html>
