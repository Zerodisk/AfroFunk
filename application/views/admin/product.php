<?php 
function setValue($value){
	if (isset($value)){
		return $value;
	}
	else{
		return '';
	}
}
?>

<script type="text/javascript">
<!--
var $isNew = <?=$isNew?>;
var $product_id = <?=$product_id?>;
var $is_active = <?if (isset($product['is_active'])) { echo($product['is_active']); } else{ echo('false'); }?>;

var fnAddNewProduct = function(){
	$('#section_item').hide();
	$('#section_item_content').hide();

	$('#section_photo').hide();
	$('#section_photo_content').hide();
};

var returnItemList = function(item){
	var li_start = '<li class="product_item_list">';

	var id    = li_start + item.item_id + '</li>';
	var color = li_start + item.color_name + '</li>';
	var size =  li_start + item.size_name  + '</li>';
	var qty =   li_start + item.qty        + '</li>';
	
	return '<ul class="product_item_top">'
			 + id + color + size + qty 
			 + '</ul>';
};

var returnPhotoList = function(photo){
	var li_start = '<li class="product_item_list">';

	var img = li_start + '<img src="<?=base_url().'images/products/'?>' + photo.photo_filename + '" /></li>';
	
	return '<ul class="product_item_top">'
			 + img
			 + '</ul>';
};


var fnLoadItemList = function(product_id){
	targetTag = '#item_list';
	$.getJSON('<?=base_url()?>admin/product/ajax_getItemList', { 'product_id' : product_id }, 
		function(json){
            if (json.data.length > 0){
                $(targetTag).empty();
	            for (var i = 0;i <= json.data.length - 1;i++){
					$(targetTag).append(returnItemList(json.data[i]));
	            }	
            }	   
            else{
				$(targetTag).append('no items found');
            }             	  
            $('#ajax_waiting_item').hide();

            //load photo list
            fnLoadPhotoList(product_id);
		}
	);
};

var fnLoadPhotoList = function(product_id){
	targetTag = '#photo_list';
	$.getJSON('<?=base_url()?>admin/product/ajax_getPhotoList', { 'product_id' : product_id }, 
		function(json){
            if (json.data.length > 0){
                $(targetTag).empty();
	            for (var i = 0;i <= json.data.length - 1;i++){
					$(targetTag).append(returnPhotoList(json.data[i]));
	            }	
            }
            else{
				$(targetTag).append('no photo found');
            }    
            $('#ajax_waiting_photo').hide();	                	  
		}
	);
};

$(document).ready(function(){	
	if ($isNew) {
		fnAddNewProduct();
	}
	else{
		//load item list, then load photo list inside fnLoadItemList(product_id) function
		fnLoadItemList($product_id);

		//handle the checkbox (is_active)
		if ($is_active){
			$('#chkIsActive').prop("checked", true);
		}

		//check price color - show in red if product is on discount
		if ($('#txtPrice').val() != $('#txtPriceSale').val()){
			//$('#txtPriceSale').attr("style", "red");
			$('#txtPriceSale').addClass('red');
		} 

	}
});



//-->
</script>

<div class="tab_header" id="section_product">
	<h1><?if (isset($product)) { echo('Product: '.$product['product_name']); } else { echo('New product'); }?></h1>
	<br />
	<ul id="tab_search">
		<li id="selected"><a href="javascript:tabSwitch(1)">General</a></li>	
	</ul>
</div>
<div class="tab_content" id="section_product_content">
	<div><a href="<?=base_url().'admin/product/add'?>" class="product_new_link">new product</a></div>
	<br /><br />
	  <div class="product_general_container">
	  	 <div>
			<div class="unit size1of4">
				product id:
			</div>
			<div class="unit size1of4">
				<input type="text" name="txtProductId" id="txtProductId" value="<?=setValue($product['product_id'])?>" disabled/>
			</div>		
			<div class="unit size1of4">
				product name:
			</div>
			<div class="unit size1of4">
				<input type="text" name="txtProductName" id="txtProductName" value="<?=setValue($product['product_name'])?>" />
			</div>
	     </div>		
	     <br /><br />
	  	 <div>
			<div class="unit size1of4">
				$price (original):
			</div>
			<div class="unit size1of4">
				<input type="text" name="txtPrice" id="txtPrice" value="<?=setValue($product['price'])?>" />
			</div>		
			<div class="unit size1of4">
				$price (sale):
			</div>
			<div class="unit size1of4">
				<input type="text" name="txtPriceSale" id="txtPriceSale" value="<?=setValue($product['price']) - setValue($product['price_discount_amt'])?>" />
			</div>
	     </div>		
	     <br /><br />
	  	 <div>
			<div class="unit size1of4">
				selling on web:
			</div>
			<div class="unit size1of4">
				<input type="checkbox" name="chkIsActive" id="chkIsActive" value="true" />
			</div>		
			<div class="unit size1of4">
				category:
			</div>
			<div class="unit size1of4">
				
			</div>
	     </div>	    
	     <br /><br />
	  	 <div>
			<div class="unit size1of4">
				date created:
			</div>
			<div class="unit size1of4">
				<input type="text" name="txtDateCreated" id="txtDateCreated" value="<?=setValue($product['date_created'])?>" disabled/>
			</div>		
			<div class="unit size1of4">
				date last change:
			</div>
			<div class="unit size1of4">
				<input type="text" name="txtDateModified" id="txtDateModified" value="<?=setValue($product['date_modified'])?>" disabled/>
			</div>
	     </div>	 
	     <br /><br />
	  	 <div style="height:150px">
			<div class="unit size1of4">
				product description:
			</div>
			<div class="unit size3of4">
				<textarea name="" id="" rows="10" cols="100"><?=setValue($product['description'])?></textarea>
			</div>		
	     </div>	 	
	     <br /><br />
	  	 <div style="height:150px">
			<div class="unit size1of4">
				size description:
			</div>
			<div class="unit size3of4">
				<textarea name="" id="" rows="10" cols="100"><?=setValue($product['size_description'])?></textarea>
			</div>		
	     </div>		          	      		
	  </div>	
	  
	  <br /><br /><br />
	  <div class="product_general_container" style="text-align: right">
	  		<a href="#" class="grey-button pcb" id="linkSave"><span>Save Product</span></a>&nbsp;&nbsp;
	  </div>

		
		
	<br /><br />
</div>



<div class="tab_header" id="section_item">
	<br />
	<ul id="tab_search">
		<li id="selected"><a href="javascript:tabSwitch(1)">Item list</a></li>	
	</ul>
</div>
<div class="tab_content" id="section_item_content">
	<div><a href="#" class="product_new_link">add item</a></div>
	<br />
	  <ul class="product_item_top">
	  	 <li class="product_item_list"><b>Id</b></li>
	  	 <li class="product_item_list"><b>Color</b></li>
	  	 <li class="product_item_list"><b>Size</b></li>
	  	 <li class="product_item_list"><b>Stock</b></li>
	  	 <li class="product_item_list"><b>Option</b></li>
	  </ul>
	  <p id="item_list">
		<div id="ajax_waiting_item" class="product_search_wait"><img src="<?=base_url().'images/ajax-loader.gif'?>" border="0" /></div>
	  </p>
	<br />
</div>



<div class="tab_header" id="section_photo">
	<br />
	<ul id="tab_search">
		<li id="selected"><a href="javascript:tabSwitch(1)">Photos</a></li>	
	</ul>
</div>
<div class="tab_content" id="section_photo_content">
	<div><a href="#" class="product_new_link">add photo</a></div>
	<br />
	  <p id="photo_list">
		<div id="ajax_waiting_photo" class="product_search_wait"><img src="<?=base_url().'images/ajax-loader.gif'?>" border="0" /></div>
	  </p>
	<br />
</div>



<br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br />
<?if (isset($product)) {var_dump($product);} ?>
<br /><br />
<?if (isset($colors)) {var_dump($colors);} ?>
<br /><br />
<?if (isset($sizes)) {var_dump($sizes);} ?>
<br /><br />
<?if (isset($categories)) {var_dump($categories);} ?>
