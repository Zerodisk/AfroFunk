<html>
   <head>		
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.6.1.min.js"></script>	
   </head>
   <body>
      <div id="container">

        <div id="content">

			<?php echo form_open_multipart(base_url().'admin/product/photo_save');?>
				<input type="hidden" name="product_id" id="product_id" value="<?=$product_id?>" />
				<input type="file" name="userfile" size="20" />
				<br /><br />

				<input type="submit" value="upload" />
			</form>
        </div>

      </div>
   </body>
</html>
