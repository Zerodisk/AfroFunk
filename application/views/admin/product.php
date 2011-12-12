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
var $isNew = <?if ($isNew){ echo('true'); } else{ echo('false'); }?>;
var $product_id = <?=$product_id?>;
var $item_id = 0;
var $is_active = <?if (isset($product['is_active'])) { echo($product['is_active']); } else{ echo('false'); }?>;


var fnAddNewProduct = function(){
	$('#section_item').hide();
	$('#section_item_content').hide();

	$('#section_photo').hide();
	$('#section_photo_content').hide();
};

var returnItemList = function(item){
	var li_start = '<li class="product_item_list">';
	var statusText = '';
	if (item.is_active == 1)
		statusText = 'actived';
	else
		statusText = 'disabled';
	
	var id     = li_start + item.item_id    + '</li>';
	var color  = li_start + item.color_name + '</li>';
	var size   = li_start + item.size_name  + '</li>';
	var qty    = li_start + item.qty        + '</li>';
	var status = li_start + statusText      + '</li>';
	var option = li_start + '<a href="javascript:btnEditItem_Click(' + item.item_id + ', ' + item.size_id + ', ' + item.color_id + ', ' + item.is_active + ')">edit</a></li>';
	
	return '<ul class="product_item_top">'
			 + id + color + size + qty + status + option;
			 + '</ul>';
};

var returnPhotoList = function(photo){
	var img = '<img src="<?=base_url().'images/products/'?>' + photo.photo_filename + '" width="150" style="float:left" />';
	var del = '<a href="javascript:void();" class="grey-button pcb" id="linkSave" onclick="btnDeletePhoto_Click(' + photo.photo_id + ');"><span>Delete</span></a>';
	var is_active = '';
	var is_main = '';

	if (photo.is_main == 1){
		is_main = 'this is default photo';
	}
	else{
		is_main = '<a href="javascript:void();" class="grey-button pcb" onclick="btnPhotoMakeDefault_Click(' + photo.photo_id + ')"><span>Set as default</span></a>';

		if (photo.is_active == 1){
			is_active = '<a href="javascript:void();" class="grey-button pcb" onclick="btnPhotoChangeStatus_Click(' + photo.photo_id + ', 0)"><span>Set to disabled</span></a> - status: Enabled';
		}
		else{
			is_active = '<a href="javascript:void();" class="grey-button pcb" onclick="btnPhotoChangeStatus_Click(' + photo.photo_id + ', 1)"><span>Set to enabled</span></a> - status: Disabled';
		}	
	}

	
	return '<div class="unit size1of2">'
			 + img + is_main + '<br/><br/>' + is_active + '<br/><br/>' + del
			 + '</div>';
};

//function for add new photo (actually just close window dialog)
var fnAddPhoto = function(){
	$(this).dialog('close');
    $('#dialogAlert').remove();

    $('#ajax_waiting_photo').show();
    fnLoadPhotoList($product_id);	
};

//function for editing an existing item
var fnEditItem = function(){
	var item_id    = $item_id;
	var size_id    = $('#size_id_edit').val();
	var color_id   = $('#color_id_edit').val();
	var is_active  = 0;
	
	if ($('#chkIsActive_edit').is(':checked'))
		is_active = 1;

	$('#ajax_waiting_item').show();

	$.getJSON('<?=base_url()?>admin/product/ajax_updateItem', { 'item_id' : item_id, 'size_id': size_id, 'color_id': color_id, 'is_active': is_active }, 
			function(json){
	            if (json.status){
					//edit success
					fnLoadItemList($product_id);					
					dialogBoxClose();;		                
	            }	   
	            else{
					//edit failed !!!
					alert('Edit item failed, please try again');
	            }             	  	          
			}
		);	
};

//function for adding a new item
var fnAddNewItem = function(){
	var product_id = $product_id;
	var qty        = $('#qty_new').val();
	var size_id    = $('#size_id_new').val();
	var color_id   = $('#color_id_new').val();
	$('#ajax_waiting_item').show();
	
	$.getJSON('<?=base_url()?>admin/product/ajax_addNewItem', { 'product_id' : product_id, 'qty': qty, 'size_id': size_id, 'color_id': color_id }, 
			function(json){
	            if (json.status){
					//add success
					fnLoadItemList($product_id);					
					dialogBoxClose();		                
	            }	   
	            else{
					//add failed !!!
					alert('Add new item failed, please try again');
	            }             	  	          
			}
		);	
};

//function to load items
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

//function to load photo list
var fnLoadPhotoList = function(product_id){
	targetTag = '#photo_list';
	$.getJSON('<?=base_url()?>admin/product/ajax_getPhotoList', { 'product_id' : product_id }, 
		function(json){
			$('#photo_list').height(200);
		
            if (json.data.length > 0){
                $(targetTag).empty();
	            for (var i = 0;i <= json.data.length - 1;i++){
					$(targetTag).append(returnPhotoList(json.data[i]));
					if ((i % 2) == 1){						
						$(targetTag).append('<p>&nbsp;</p>');
						$('#photo_list').height($('#photo_list').height() + 100);
					}
	            }	
            }
            else{
				$(targetTag).append('no photo found');
            }    
            
            $('#ajax_waiting_photo').hide();	                	  
		}
	);
};

//function to change photo status(is_active)
var fnPhotoChangeStatus = function(photo_id, is_active){
	$('#ajax_waiting_photo').show();
	$.getJSON('<?=base_url()?>admin/product/ajax_photoChangeStatus', { 'photo_id' : photo_id, 'is_active': is_active }, 
		function(json){		
            if (json.status){
            	fnLoadPhotoList($product_id);
            }
            else{
				alert('set photo as a default is failed, please try again.');
				$('#ajax_waiting_photo').hide();
            }               
		}
	);	
};

//function make select photo as a main/default photo
var fnPhotoMakeDefault = function(photo_id){
	$('#ajax_waiting_photo').show();
	$.getJSON('<?=base_url()?>admin/product/ajax_photoSetMain', { 'photo_id' : photo_id }, 
		function(json){		
            if (json.status){
            	fnLoadPhotoList($product_id);
            }
            else{
				alert('set photo as a default is failed, please try again.');
				$('#ajax_waiting_photo').hide();
            }               
		}
	);	
};

//function to delete photo 
var fnDeletePhoto = function(photo_id){
	$('#ajax_waiting_photo').show();
	$.getJSON('<?=base_url()?>admin/product/ajax_deletePhoto', { 'photo_id' : photo_id }, 
		function(json){		
            if (json.status){
            	fnLoadPhotoList($product_id);
            }
            else{
				alert('delete photo is failed, please try again.');
				$('#ajax_waiting_photo').hide();
            }               
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
			$('#txtPriceSale').addClass('red');
		} 

	}
});



function dialogAlert($title, $msg, $fnAction){
	$('#dialogAlert').remove();

    $('body').append('<div id="dialogAlert" style="display:none" title="' + $title + '">' + $msg + '</div>');
    $('#dialogAlert').dialog({
        modal: true,
        width: 600,
        draggable: false,
        resizable: false,
        buttons: {
            OK: function() {
                $fnAction();
            },
            CANCEL: function(){
            	dialogBoxClose();
            }
        }
    });
}

function dialogBoxClose(){
	$(this).dialog('close');
    $('#dialogAlert').remove();	
}

function fnSubmitSave(){
	document.frmAdminProduct.submit();
}

function btnAddItem_Click(){
	var html = $('#dialog_item_new').html();
	html = html.replace('#qty_new#', 'qty_new');
	html = html.replace('#color_id_new#', 'color_id_new');
	html = html.replace('#size_id_new#', 'size_id_new');
	
	dialogAlert('add new item', html, fnAddNewItem);
}

function btnEditItem_Click(item_id, size_id, color_id, is_active){
	var html = $('#dialog_item_edit').html();
	$item_id = item_id;
	html = html.replace('#color_id_edit#', 'color_id_edit');
	html = html.replace('#size_id_edit#', 'size_id_edit');
	html = html.replace('#chkIsActive_edit#', 'chkIsActive_edit');

	dialogAlert('edit item', html, fnEditItem);

	//select the existing value (color, size);
	$('#size_id_edit').val(size_id);	
	$('#color_id_edit').val(color_id);
	if (is_active == 1)
		$('#chkIsActive_edit').attr('checked', true);
}

function btnAddPhoto_Click(){
	var html = $('#dialog_photo_new').html();

	dialogAlert('add new photo', html, fnAddPhoto);	
}

function btnDeletePhoto_Click(photo_id){
	if (confirm('are you sure to delete this photo?')){
		fnDeletePhoto(photo_id);		
	}
}

function btnPhotoMakeDefault_Click(photo_id){
	if (confirm('are you sure to make this photo as default photo for this product?')){
		fnPhotoMakeDefault(photo_id);		
	}
}

function btnPhotoChangeStatus_Click(photo_id, is_active){
	fnPhotoChangeStatus(photo_id, is_active);
}
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
	<div class="product_new_link"><a href="<?=base_url().'admin/product/add'?>" title="add new product">
		    <img src="<?=base_url().'images/plus.png'?>" border="0" width="20" />
		 </a></div>
		 
	<br /><br /><br />
	<form name="frmAdminProduct" method="post" action="<?=base_url()?>admin/product/save">
	  <input type="hidden" name="isNew" value="<?if ($isNew){ echo('true'); } else{ echo('false'); }?>">
	  <input type="hidden" name="cmdAdminProduct" value="submit">
	  <input type="hidden" name="product_id" value="<?=$product_id?>">
	  
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
				<?=form_dropdown('category_id', $categories_options, $category_id_selected)?>
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
				<textarea name="txtProductDescription" id="txtProductDescription" rows="10" cols="100"><?=setValue($product['description'])?></textarea>
			</div>		
	     </div>	 	
	     <br /><br />
	  	 <div style="height:150px">
			<div class="unit size1of4">
				size description:
			</div>
			<div class="unit size3of4">
				<textarea name="txtSizeDescription" id="txtSizeDescription" rows="10" cols="100"><?=setValue($product['size_description'])?></textarea>
			</div>		
	     </div>		          	      		
	  </div>	
	</form>
	  
	<br /><br /><br />
	<div class="product_general_container" style="text-align: right">
	  	 <a href="javascript:void();" class="grey-button pcb" id="linkSave" onclick="fnSubmitSave();"><span>Save Product</span></a>&nbsp;&nbsp;
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
	<div><a href="javascript:btnAddItem_Click()" class="product_new_link" title="add new item"><img src="<?=base_url().'images/plus.png'?>" border="0" width="20" /></a></div>

	<br />
	  <ul class="product_item_top">
	  	 <li class="product_item_list"><b>Id</b></li>
	  	 <li class="product_item_list"><b>Color</b></li>
	  	 <li class="product_item_list"><b>Size</b></li>
	  	 <li class="product_item_list"><b>Stock</b></li>
	  	 <li class="product_item_list"><b>Status</b></li>
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
	<div><a href="javascript:btnAddPhoto_Click();" class="product_new_link" title="add new photo"><img src="<?=base_url().'images/plus.png'?>" border="0" width="20" /></a></div>
	<br />
	  <p id="photo_list" style="height: 100px">
		<div id="ajax_waiting_photo" class="product_search_wait"><img src="<?=base_url().'images/ajax-loader.gif'?>" border="0" /></div>
	  </p>
	<br />
</div>

<div id="dialog_item_new" style="display:none">
	<div class="unit size1of6">&nbsp;&nbsp;color:</div>
	<div class="unit size1of6"><?=form_dropdown('', $colors_options, '', 'id="#color_id_new#"')?></div>
	
	<div class="unit size1of6">&nbsp;&nbsp;size:</div>
	<div class="unit size1of6"><?=form_dropdown('', $sizes_options, '', 'id="#size_id_new#"')?></div>
	
	<div class="unit size1of6">&nbsp;&nbsp;qty:</div>
	<div class="unit size1of6"><input type="text" id="#qty_new#"  value="" size="3" maxlength="3" /></div>
</div>
<div id="dialog_item_edit" style="display:none">
	<div class="unit size1of6">&nbsp;&nbsp;color:</div>
	<div class="unit size1of6"><?=form_dropdown('', $colors_options, '', 'id="#color_id_edit#"')?></div>
	
	<div class="unit size1of6">&nbsp;&nbsp;size:</div>
	<div class="unit size1of6"><?=form_dropdown('', $sizes_options, '', 'id="#size_id_edit#"')?></div>
	 
	<div class="unit size1of6">selling on web</div>
	<div class="unit size1of6"><input type="checkbox" id="#chkIsActive_edit#" value="true" /></div>
</div>
<div id="dialog_photo_new" style="display:none">
	<iframe src="../photo_add/<?=$product_id?>" frameBorder="0"></iframe>
</div>
<div id="dialog_stock_adjust" style="display:none">
	<div class="unit size1of4">adjustment type</div>
	<div class="unit size1of4">
		<select id="#ddTransacType#">
			<option value=""></option>
		</select>
	</div>
	<div class="unit size1of4">by</div>
	<div class="unit size1of4"></div>
</div>


<br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br />
<?if (isset($product)) {var_dump($product);} ?>
<br /><br />
<?if (isset($colors_options)) {var_dump($colors_options);} ?>
<br /><br />
<?if (isset($sizes_options)) {var_dump($sizes_options);} ?>
<br /><br />
<?if (isset($categories_options)) {var_dump($categories_options);} ?>
