<script type="text/javascript">
<!--

//do copy billing address to shipping address
function copyAddress(chkBox){
	if (chkBox.checked){
		//start copy
		document.frmCheckout.shp_first_name.value = document.frmCheckout.bil_first_name.value;
		document.frmCheckout.shp_last_name.value  = document.frmCheckout.bil_last_name.value;
		document.frmCheckout.shp_address_1.value  = document.frmCheckout.bil_address_1.value;
		document.frmCheckout.shp_address_2.value  = document.frmCheckout.bil_address_2.value;
		document.frmCheckout.shp_city.value       = document.frmCheckout.bil_city.value;
		document.frmCheckout.shp_state.value      = document.frmCheckout.bil_state.value;
		document.frmCheckout.shp_postcode.value   = document.frmCheckout.bil_postcode.value;
		document.frmCheckout.shp_country_id.selectedIndex = document.frmCheckout.bil_country_id.selectedIndex;
	}
}

function orderConfirm(){
	//do simple validation
	if (isFormValid()){
		//submit to confirm page
		document.frmCheckout.cmdCheckout.value = 'confirmOrder';
		document.frmCheckout.submit();
	}
}

function isFormValid(){
	//do some simple form validation
	return true;
}
//-->
</script>

<h1>check out page</h1>
<div><?= validation_errors(); ?></div>
<form name="frmCheckout" action="<?= base_url().'checkout' ?>" method="post">

	<h2>billing address</h2>
		first name: <input type="text" name="bil_first_name" value="<?=set_value('bil_first_name') ?>" />
		<?=form_error('bil_first_name')?>
		<br />
		last name: <input type="text" name="bil_last_name" value="<?=set_value('bil_last_name') ?>" />
		<br />
		email: <input type="text" name="ord_email" value="<?=set_value('ord_email') ?>" />
		<br />
		address 1: <input type="text" name="bil_address_1" value="<?=set_value('bil_address_1') ?>" />
		<br />
		address 2: <input type="text" name="bil_address_2" value="<?=set_value('bil_address_2') ?>" />
		<br />
		city: <input type="text" name="bil_city" value="<?=set_value('bil_city') ?>" />
		<br />
		state: <input type="text" name="bil_state" value="<?=set_value('bil_state') ?>" />
		<br />
		postcode: <input type="text" name="bil_postcode" value="<?=set_value('bil_postcode') ?>" />
		<br />
		country: <?=form_dropdown('bil_country_id', $countries_options, $billing_country_id)?>
		<br />
		phone: <input type="text" name="ord_phone" value="<?=set_value('ord_phone') ?>" />
		<br />
		mobile: <input type="text" name="ord_mobile" value="<?=set_value('ord_mobile') ?>" />
		<br />
		
	<h2>shipping address</h2>
	<input type="checkbox" name="chkCopyAddress" value="" onclick="copyAddress(this)" /> copy from billing address
	<br />
		first name: <input type="text" name="shp_first_name" value="" />
		<br />
		last name: <input type="text" name="shp_last_name" value="" />
		<br />
		address 1: <input type="text" name="shp_address_1" value="" />
		<br />
		address 2: <input type="text" name="shp_address_2" value="" />
		<br />
		city: <input type="text" name="shp_city" value="" />
		<br />
		state: <input type="text" name="shp_state" value="" />
		<br />
		postcode: <input type="text" name="shp_postcode" value="" />
		<br />
		country: <?=form_dropdown('shp_country_id', $countries_options, $shipping_country_id)?>
		<br />
	
	<input type="hidden" name="order_id" value="<?=$order_id ?>" />
	<input type="hidden" name="cmdCheckout" value="" />
	<input type="button" name="btnConfigm" value="submit" onclick="orderConfirm()" />
	<br /><br />
</form>
