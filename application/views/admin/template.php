<html>
   <head>
		<title>Afro Funk - Admin</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/oocss/libraries.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/oocss/content.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/oocss/grids.css" />
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin_layout.css" />
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.6.1.min.js"></script>
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
