<h1>this is payment page</h1>

<div id="your_order" style="float:left">
    <h2>your order</h2>
    <table>
    	<tr>
    		<td>product</td>
    		<td>$each</td>
    		<td>qty</td>
    		<td>total</td>
    	</tr>
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
    </table>


	<h2>payment details</h2>
	<form name="frmPayment" action="<?= base_url().'payment' ?>" method="post">
	   <input type="hidden" name="oid" value="<?=$order_id?>" />
	   <input type="hidden" name="cmdPayment" value="" />
	   <table>
	      <tr>
	   	  	<td>card type</td>
	   	  	<td>
	   	  	    <?=form_dropdown('card_type', $cc_cart_type)?>
	   	  	</td>
	   	  </tr>
	   	  <tr>
	   	  	<td>card number</td>
	   	  	<td><input type="text" name="card_number" value="" /></td>
	   	  </tr>
	   	  <tr>
	   	  	<td>security code</td>
	   	  	<td><input type="text" name="card_cvv" value="" /></td>
	   	  </tr>
	   	  <tr>
	   	  	<td>expiry date</td>
	   	  	<td>
	   	  		<?=form_dropdown('card_month', $cc_options_month)?>
	   	  		<?=form_dropdown('card_year', $cc_options_year)?>
	   	  	</td>
	   	  </tr>
	   	  
	   	  <tr>
	   	  	<td>card holder name</td>
	   	  	<td><input type="text" name="card_holder_name" value="" /></td>
	   	  </tr>
	   </table>
	   <input type="button" name="btnPayNow" value="pay now" />
	</form>
</div>

<div style="float:right">
	<div id="your_billing">
	    <h2>billing address</h2>
		    <?=$bill_name_address['first_name'].' '.$bill_name_address['last_name']?><br />
		    <?=$bill_name_address['address_1'].'  '.$bill_name_address['address_2']?><br />
		    <?=$bill_name_address['city'].', '.$bill_name_address['state'].' '.$bill_name_address['postcode']?><br />
		    <?=$bill_name_address['country_name']?>
	</div>
	
	<div id="your_shipping">
	    <h2>shipping address</h2>
		    <?=$ship_name_address['first_name'].' '.$ship_name_address['last_name']?><br />
		    <?=$ship_name_address['address_1'].'  '.$ship_name_address['address_2']?><br />
		    <?=$ship_name_address['city'].', '.$ship_name_address['state'].' '.$ship_name_address['postcode']?><br />
		    <?=$ship_name_address['country_name']?>
		     
	</div>
	<p>&nbsp;</p>
</div>



