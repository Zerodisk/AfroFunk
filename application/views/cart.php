<script type="text/javascript">
function removeItem(item_id){
	document.frmCart.cmdCart.value = 'removeCartItem';
	document.frmCart.item_id.value = item_id;
	document.frmCart.submit();
}

function updateCart(){
	document.frmCart.cmdCart.value = 'updateCart';
	document.frmCart.submit();
}
</script>

<h1>your shopping cart</h1>
<form name="frmCart" action="<?= base_url().'cart' ?>" method="post">
	<table>
		<tr>
			<td>&nbsp;</td>
			<td>product</td>
			
			<td>price each</td>
			<td>qty</td>
			<td>#</td>
			<td>total price</td>
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
			<td><a href="javascript:removeItem(<?=$item['item_id']?>);">remove</a></td>
			<td><?=$item['qty'] * $item['price_sell'] ?></td>
		  </tr>	 
		<?}?>
	</table>
	
	<input type="hidden" name="cmdCart" value="" />
	<input type="hidden" name="item_id" value="" />
	<input type="button" name="btnUpdateCart" value="update cart" onclick="updateCart()" />
</form>
