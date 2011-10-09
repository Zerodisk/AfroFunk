<h1>your shopping cart</h1>
<script>
function removeItem(item_id){
	
}
</script>
<form name="frmCart" action="<?= base_url().'cart' ?>" method="post">
	<table width="800">
		<tr>
			<td>product id</td>
			<td>product name</td>
			
			<td>price</td>
			<td>qty</td>
			<td>total</td>
		</tr>
		<?foreach($cart as $item){?>
		  <tr>
			<td><img src="<?=base_url().'product/photo/'.$item['product_id'] ?>" width="50" /></td>
			<td>
				<?=$item['product_name'] ?>
				<br>
				<?=$item['product_name_extra'] ?>
			</td>
			
			<td><?=$item['price_sell'] ?></td>
			<td><?=form_dropdown('item_id-'.$item['item_id'], $item['qty_options'], $item['qty']); ?></td>
			<td><?=$item['qty'] * $item['price_sell'] ?></td>
		  </tr>	 
		<?}?>
	</table>
	
	
	<input type="submit" name="btnUpdateCart" value="update cart" />
</form>
