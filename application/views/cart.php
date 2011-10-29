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
<br />
<h1>your shopping cart</h1>
<br />
<!-- order_id = <?=$order_id ?> -->

<?if ($cart_num_item == 0){?>
	<p>your shopping cart is empty</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<?
  }
  else{
?>

<form name="frmCart" action="<?= base_url().'cart' ?>" method="post">
	<input type="hidden" name="order_id" value="<?=$order_id ?>" />
	<input type="hidden" name="cmdCart" value="" />
	<input type="hidden" name="item_id" value="" />

	<div>
	<?foreach($cart as $item){?>
		<div class="unit size4of5">
			<div class="unit size1of2">
				<div class="unit size1of3">
					<img src="<?=base_url().'product/photo/'.$item['product_id'] ?>" width="100" />
				</div>
				<div class="unit size2of3">
					<a href="<?=base_url().'product/'.$item['product_id'] ?>"><?=$item['product_name'] ?></a>
					<br>
					<?=$item['product_name_extra'] ?>
				</div>
			</div>
			<div class="unit size1of6 paddown5">$<?=$item['price_sell'] ?></div>
			<div class="unit size1of6">
				<?=form_dropdown('item_id-'.$item['item_id'], $item['qty_options'], $item['qty']); ?>
				<!--
				<a href="javascript:removeItem(<?=$item['item_id']?>);">remove</a>
				-->
			</div>
			<div class="unit size1of6 paddown5">
				<div class="size1of2 amount">$<?=$item['qty'] * $item['price_sell'] ?></div>
				<div class="size1of2"></div>
			</div>
		</div>
		<div class="unit size1of5">&nbsp;</div>
	<?}?>
	</div>
	
	<div>
		<div class="unit size4of5">
			<div class="unit size1of2">
				<div class="unit size1of3"><p>shipping country:</p></div>
				<div class="unit size2of3 paddown5"><?=form_dropdown('shipping_country_id', $countries_options, $shipping_country_id)?></div>
			</div>
			<div class="unit size1of6">&nbsp;</div>
			<div class="unit size1of6">&nbsp;</div>
			<div class="unit size1of6">
				<div class="size1of2 amount">$<?=$shipping_price ?></div>
				<div class="size1of2"></div>
			</div>
		</div>
		<div class="unit size1of5">&nbsp;</div>
	</div>	
	<p>&nbsp;</p>
	<div>
		<div class="unit size4of5">
			<div class="unit size1of2">
				<div class="unit size1of3"><p>total price:</p></div>
				<div class="unit size2of3"></div>
			</div>
			<div class="unit size1of6">&nbsp;</div>
			<div class="unit size1of6">&nbsp;</div>
			<div class="unit size1of6">
				<div class="size1of2 amount">$<?=($cart_total_price + $shipping_price) ?></div>
				<div class="size1of2"></div>			
			</div>
		</div>
		<div class="unit size1of5">&nbsp;</div>
	</div>	
	<p>&nbsp;</p>
	<div>
		<div class="unit size1of2">
			<p><input type="button" name="btnUpdateCart" value="update cart" onclick="updateCart()" /></p>
		</div>
		<div class="unit size1of2">
			<?if ($cart_num_item > 0) {?>
			<p><input type="button" name="btnCheckOut" value="check out" onclick="checkOut()" /></p>
			<?}?>
		</div>
	</div>
</form>
<?}?>
<p>&nbsp;</p>
<p>&nbsp;</p>
