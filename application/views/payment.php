<h1>this is payment page</h1>
<script type="text/javascript">
<!--


function submitPayNow(){
	//do simple validation
	if (isFormValid()){
		//submit to confirm page
		document.frmPayment.cmdPayment.value = 'payCreditCard';
		document.frmPayment.submit();
	}
}

function isFormValid(){
	//do some simple form validation
	if (document.frmPayment.card_type.selectedIndex == 0){
		alert('select credit card type');
		return false;
	}
	if (document.frmPayment.card_number.value == ''){
		alert('enter credit card number');
		return false;
	}
	if (document.frmPayment.card_cvv.value == ''){
		alert('enter credit card security number');
		return false;
	}
	if (document.frmPayment.card_month.selectedIndex == 0){
		alert('select credit card expiry month');
		return false;
	}
	if (document.frmPayment.card_year.selectedIndex == 0){
		alert('select credit card expiry year');
		return false;
	}
	if (document.frmPayment.card_holder_name.value == ''){
		alert('enter credit card holder name');
		return false;
	}
	return true;
}


//-->
</script>
<div class="page">
<div class="line">
<div class="unit size3of4">
    <h2>your order</h2>
    <table>
    	<thead>
    	<tr>
    		<td>product</td>
    		<td>$each</td>
    		<td>qty</td>
    		<td>total</td>
    	</tr>
    	</thead>
    	<tbody>
    	<?
    	  $price_total = 0;
    	  foreach ($items as $item){
    	    $price_each = afro_getFinalSalePrice($item['price'], $item['price_discount_amt'], $item['price_discount_percent']);
    	    $price_total = $price_total + ($price_each * $item['qty']);
    	?>
    	<tr>
    		<td><?=$item['product_name'].'  '.afro_getProductNameExtraInfo($item['color_name'], $item['size_name'])?></td>
    		<td><?=$price_each?></td>
    		<td><?=$item['qty']?></td>
    		<td><?=$price_each * $item['qty']?></td>
    	</tr>
    	<?}?>
    	</tbody>
    </table>

	<h2>payment details</h2>
	<div>
	<?if (strlen(validation_errors()) > 0){ 
		echo('<p>'.$main_error_message.'</p>');
	}?>
	</div>
	
	<form name="frmPayment" action="<?= base_url().'payment' ?>" method="post">
	   <input type="hidden" name="oid" value="<?=$order_id?>" />
	   <input type="hidden" name="cmdPayment" value="" />
	   
	   <p>
		   	<label for="card_type">card type</label>
		   	<?=form_dropdown('card_type', $cc_card_type, set_value('card_type'),'id="card_type"')?>
		   	<?=form_error('card_type')?>
	   </p>
	   <p>
	   		<label for="card_number">card number</label>	
	   		<input type="text" name="card_number" id="card_number" value="<?=set_value('card_number') ?>" />
	   	  	<?=form_error('card_number')?>	
	   </p>
	   <p>
	   		<label for="card_cvv">security code</label>
	   		<input type="password" name="card_cvv" id="card_cvv" value="<?=set_value('card_cvv') ?>" maxlength="4" />
	   	  	<?=form_error('card_cvv')?>
	   </p>	  
	   <p>
	   		<label>expiry date</label>
   	  		<?=form_dropdown('card_month', $cc_options_month, set_value('card_month'), 'id="card_month"')?>
   	  			<?=form_error('card_month')?>
   	  		<?=form_dropdown('card_year', $cc_options_year, set_value('card_year'), 'id="card_year"')?>
   	  		    <?=form_error('card_year')?>	   		
	   </p>
	   <p>
	   		<label for="card_holder_name">card holder name</label>
	   		<input type="text" name="card_holder_name" id="card_holder_name" value="<?=set_value('card_holder_name') ?>" />
	   	  	<?=form_error('card_holder_name')?>
	   </p> 
	   <p>
	   		<input type="button" name="btnPayNow" id="btnPayNow" value="pay now" onclick="submitPayNow()" />
	   </p>
	</form>
	
</div>

<div class="unit size1of4 lastUnit">
	<div class="mod simple">
		<b class="top">
			<b class="tl"></b>
			<b class="tr"></b>
		</b>
		<div class="inner">
			<div class="hd">
			    <div class="unit size3of4"><h3>billing address</h3></div>
				<div class="unit size1of4 payment_edit"><h6><a href="<?=base_url().'checkout'?>">edit</a></h6></div>
			</div>
			<div class="db">
			    <p>
			    <?=$bill_name_address['first_name'].' '.$bill_name_address['last_name']?><br />
			    <?=$bill_name_address['address_1'].'  '.$bill_name_address['address_2']?><br />
			    <?=$bill_name_address['city'].', '.$bill_name_address['state'].' '.$bill_name_address['postcode']?><br />
			    <?=$bill_name_address['country_name']?>
			    <br /><br />
			    email: <?=$order['email'] ?><br />
			    phone: <?=$order['phone'] ?><br />
			    mobile: <?=$order['mobile'] ?>
			    </p>			
			</div>
		</div>	
		<b class="bottom">
			<b class="bl"></b>
			<b class="br"></b>
		</b>
	</div>
	
	<div class="mod simple">
		<b class="top">
			<b class="tl"></b>
			<b class="tr"></b>
		</b>
		<div class="inner">
			<div class="hd">
			    <div class="unit size3of4"><h3>shipping address</h3></div>
				<div class="unit size1of4 payment_edit"><h6><a href="<?=base_url().'checkout'?>">edit</a></h6></div>
			</div>
			<div class="db">
			    <p>
				<?=$ship_name_address['first_name'].' '.$ship_name_address['last_name']?><br />
			    <?=$ship_name_address['address_1'].'  '.$ship_name_address['address_2']?><br />
			    <?=$ship_name_address['city'].', '.$ship_name_address['state'].' '.$ship_name_address['postcode']?><br />
			    <?=$ship_name_address['country_name']?>
			    </p>			
			</div>
		</div>	
		<b class="bottom">
			<b class="bl"></b>
			<b class="br"></b>
		</b>   
	</div>
	<p>&nbsp;</p>
</div>

</div>
</div>
<p>&nbsp;</p>
