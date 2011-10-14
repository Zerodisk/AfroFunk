<script type="text/javascript">
<!--

//do copy billing address to shipping address
function copyAddress(chkBox){
	if (chkBox.checked){
		//start copy
		document.frmCheckout.shp_first_name.value = document.frmCheckout.bil_first_name.value;
		document.frmCheckout.shp_last_name.value = document.frmCheckout.bil_last_name.value;
		document.frmCheckout.shp_address_1.value = document.frmCheckout.bil_address_1.value;
		document.frmCheckout.shp_address_2.value = document.frmCheckout.bil_address_2.value;
		document.frmCheckout.shp_city.value = document.frmCheckout.bil_city.value;
		document.frmCheckout.shp_state.value = document.frmCheckout.bil_state.value;
		document.frmCheckout.shp_postcode.value = document.frmCheckout.bil_postcode.value;
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
	alert('');
	
}
//-->
</script>

<h1>check out page</h1>
<br />
<form name="frmCheckout" action="<?= base_url().'checkout' ?>" method="post">

	<h2>billing address</h2>
		first name: <input type="text" name="bil_first_name" value="" />
		<br />
		last name: <input type="text" name="bil_last_name" value="" />
		<br />
		address 1: <input type="text" name="bil_address_1" value="" />
		<br />
		address 2: <input type="text" name="bil_address_2" value="" />
		<br />
		city: <input type="text" name="bil_city" value="" />
		<br />
		state: <input type="text" name="bil_state" value="" />
		<br />
		postcode: <input type="text" name="bil_postcode" value="" />
		<br />
		country:
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
		country:
		<br />
	
	
	<input type="hidden" name="cmdCheckout" value="" />
	<input type="button" name="btnConfigm" value="submit" onclick="orderConfirm()" />
	<br /><br />
</form>
