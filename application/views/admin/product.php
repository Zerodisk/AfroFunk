<script type="text/javascript">
<!--
var $isNew = <?=$isNew?>;
var $product_id = <?=$product_id?>;

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
		fnLoadItemList($product_id);
		//fnLoadPhotoList($product_id);
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
	<br />
	  <p>
		show product details here
	  </p>
	<br />
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