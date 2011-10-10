<script type="text/javascript">
function addCart(){
	if (document.frmProduct.item_id.selectedIndex == 0){
		alert('Oppp! please select size-color you want');
		return;
	}
	document.frmProduct.cmdCart.value = 'addCart';
	document.frmProduct.submit();
}
</script>

<h1><?=$product['product_name'] ?></h1>

<p><?=$product['description'] ?></p>

<form name="frmProduct" action="<?= base_url().'cart' ?>" method="post">
	<input type="hidden" name="product_id" value="<?=$product['product_id'] ?>">
	
	<h2>Photos</h2>
	<?foreach ($photos as $photo){ ?>
	    <div style="float: left; margin: 1px">
	    	<img src="<?= base_url().'images/products/'.$photo['photo_filename'] ?>">
	    </div>
	<?} ?>
	<div style="clear: left"></div>	
	
	<?=form_dropdown('item_id', $items_options);?>
	
	<?foreach ($items as $item){ ?>
	    <p>
	    	<?=$item['size_name'].'   -   '.$item['color_name'] ?>
	    </p>
	<?} ?>
	
	<input type="hidden" name="cmdCart" value="addCart" />
	<input type="button" name="btnAddCart" value="add cart" onclick="addCart();" />
</form>

