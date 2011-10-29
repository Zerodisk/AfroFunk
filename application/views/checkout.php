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
<br />
<h1>check out page</h1>
<div>
	<?if (strlen(validation_errors()) > 0){ 
		echo('<p>'.$main_error_message.'</p>');
	}?>
</div>
<form name="frmCheckout" action="<?= base_url().'checkout' ?>" method="post">
	<div class="unit size1of2">
		<h2>billing address</h2>
		<p>
			<label for="bil_first_name">first name:</label> 
			<input type="text" name="bil_first_name" value="<?=$form_data->bil_first_name ?>" />
			<?=form_error('bil_first_name')?>
		</p>
		<p>
			<label for="bil_last_name">last name:</label> 
			<input type="text" name="bil_last_name" value="<?=$form_data->bil_last_name ?>" />
			<?=form_error('bil_last_name')?>
		</p>		
		<p>
			<label for="ord_email">email:</label> 
			<input type="text" name="ord_email" value="<?=$form_data->ord_email ?>" />
			<?=form_error('ord_email')?>
		</p>
		<p>
			<label for="bil_address_1">address 1:</label> 
			<input type="text" name="bil_address_1" value="<?=$form_data->bil_address_1 ?>" />
			<?=form_error('bil_address_1')?>
		</p>
		<p>
			<label for="bil_address_2">address 2:</label> 
			<input type="text" name="bil_address_2" value="<?=$form_data->bil_address_2 ?>" />
			<?=form_error('bil_address_2')?>
		</p>
		<p>
			<label for="bil_city">city:</label> 
			<input type="text" name="bil_city" value="<?=$form_data->bil_city ?>" />
			<?=form_error('bil_city')?>
		</p>
		<p>
			<label for="bil_state">state:</label> 
			<input type="text" name="bil_state" value="<?=$form_data->bil_state ?>" />
			<?=form_error('bil_state')?>
		</p>
		<p>
			<label for="bil_postcode">postcode:</label> 
			<input type="text" name="bil_postcode" value="<?=$form_data->bil_postcode ?>" />
			<?=form_error('bil_postcode')?>
		</p>
		<p>
			<label for="bil_country_id">country:</label> 
			<?=form_dropdown('bil_country_id', $countries_options, $billing_country_id)?>
		</p>
		<p>
			<label for="ord_phone">phone:</label> 
			<input type="text" name="ord_phone" value="<?=$form_data->ord_phone ?>" />
			<?=form_error('ord_phone')?>
		</p>
		<p>
			<label for="ord_mobile">mobile:</label> 
			<input type="text" name="ord_mobile" value="<?=$form_data->ord_mobile ?>" />
			<?=form_error('ord_mobile')?>
		</p>
		<p>&nbsp;</p>
	</div>
	<div class="unit size1of2">	
		<h2>shipping address</h2>
		<p>
		<input type="checkbox" name="chkCopyAddress" value="" onclick="copyAddress(this)" /> copy from billing address
		</p>
		<p>
			<label for="shp_first_name">first name:</label> 
			<input type="text" name="shp_first_name" value="<?=$form_data->shp_first_name ?>" />
			<?=form_error('shp_first_name')?>
		</p>
		<p>
			<label for="shp_last_name">last name:</label> 
			<input type="text" name="shp_last_name" value="<?=$form_data->shp_last_name ?>" />
			<?=form_error('shp_last_name')?>
		</p>
		<p>
			<label for="shp_address_1">address 1:</label> 
			<input type="text" name="shp_address_1" value="<?=$form_data->shp_address_1 ?>" />
			<?=form_error('shp_address_1')?>
		</p>
		<p>
			<label for="shp_address_2">address 2:</label> 
			<input type="text" name="shp_address_2" value="<?=$form_data->shp_address_2 ?>" />
			<?=form_error('shp_address_2')?>
		</p>
		<p>
			<label for="shp_city">city:</label> 
			<input type="text" name="shp_city" value="<?=$form_data->shp_city ?>" />
			<?=form_error('shp_city')?>
		</p>
		<p>
			<label for="shp_state">state:</label> 
			<input type="text" name="shp_state" value="<?=$form_data->shp_state ?>" />
			<?=form_error('shp_state')?>
		</p>
		<p>
			<label for="shp_postcode">postcode:</label> 
			<input type="text" name="shp_postcode" value="<?=$form_data->shp_postcode ?>" />
			<?=form_error('shp_postcode')?>
		</p>
		<p>
			<label for="shp_country_id">country:</label> 
			<?=form_dropdown('shp_country_id', $countries_options, $shipping_country_id)?>
		</p>
	</div>
	
	<input type="hidden" name="order_id" value="<?=$order_id ?>" />
	<input type="hidden" name="cmdCheckout" value="" />
	<input type="button" name="btnConfigm" value="submit" onclick="orderConfirm()" />
	<br /><br />
</form>
