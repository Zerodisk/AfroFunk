<script type="text/javascript">
<!--
function removeItem(item_id){
	document.frmCart.cmdCart.value = 'removeCartItem';
	document.frmCart.item_id.value = item_id;
	document.frmCart.submit();
}

function updateCart(){
	document.frmCart.cmdCart.value = 'updateCart';
	document.frmCart.submit();
}

function checkOut(){
	if (document.frmCart.shipping_country_id.selectedIndex == 0){
		//no shipping country selected
		alert('select your shipping country');
		document.frmCart.shipping_country_id.focus();
		return;
	}
	document.frmCart.cmdCart.value = 'checkOut';
	document.frmCart.submit();
}
//-->
</script>

<h1>your shopping cart</h1>
<!-- order_id = <?=$order_id ?> -->

<form name="frmCart" action="<?= base_url().'cart' ?>" method="post">
	<table>
		<tr>
			<td colspan="2">product</td>
			
			<td>price each</td>
			<td>qty</td>
			<td>#</td>
			<td>total price</td>
		</tr>
		<?foreach($cart as $item){?>
		  <tr>
			<td><img src="<?=base_url().'product/photo/'.$item['product_id'] ?>" width="50" /></td>
			<td>
				<a href="<?=base_url().'product/'.$item['product_id'] ?>"><?=$item['product_name'] ?></a>
				<br>
				<?=$item['product_name_extra'] ?>
			</td>
			
			<td><?=$item['price_sell'] ?></td>
			<td><?=form_dropdown('item_id-'.$item['item_id'], $item['qty_options'], $item['qty']); ?></td>
			<td><a href="javascript:removeItem(<?=$item['item_id']?>);">remove</a></td>
			<td><?=$item['qty'] * $item['price_sell'] ?></td>
		  </tr>	 
		<?}?>
		  <tr>
		    <td colspan="4">&nbsp;</td>
		    <td>total:</td>
		    <td><?=$cart_total_price?></td>
		  </tr>
	</table>
	
	<br />
	<div>shipping destination: <?=form_dropdown('shipping_country_id', $countries_options, $shipping_country_id)?></div>
	
	<br />
	<div>shipping cost $<?=$shipping_price ?></div>
	
	<br />
	<div>total price: $<?=($cart_total_price + $shipping_price) ?></div>
	
	<br />
	<input type="hidden" name="order_id" value="<?=$order_id ?>" />
	<input type="hidden" name="cmdCart" value="" />
	<input type="hidden" name="item_id" value="" />
	<input type="button" name="btnUpdateCart" value="update cart" onclick="updateCart()" />
	&nbsp;
	<?if ($cart_num_item > 0) {?>
	<input type="button" name="btnCheckOut" value="check out" onclick="checkOut()" />
	<?}?>
</form>

<p>&nbsp;</p>
