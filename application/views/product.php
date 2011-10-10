
<h1><?=$product['product_name'] ?></h1>

<p><?=$product['description'] ?></p>

<form action="<?= base_url().'cart' ?>" method="post">
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
	<input type="submit" name="btnAddCart" value="add cart" />
</form>

