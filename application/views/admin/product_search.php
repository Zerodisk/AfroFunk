<script type="text/javascript">
<!--

var record_index = 0;
var limit = 5;
var keyword;
var noMoreResult = false;

$(document).ready(function(){
	$('#txtSearchKeyword').focus();
	
	$('#btnSearchSubmit').click(function(){
		noMoreResult = false;
		clearSearchResult();
		record_index = 0;
		keyword = $('#txtSearchKeyword').val();
		loadSearch();
		return false;
	});
	
});

function showItemList(product_id){
	var targetTag = '#item_' + product_id;
	$('#ajax_waiting_item_' + product_id).show();
	$.getJSON('<?=base_url()?>admin/product/ajax_getItemList', { 'product_id' : product_id }, 
		function(json){
            if (json.data.length > 0){
                $(targetTag).empty();
				$(targetTag).append('<div>');
				$(targetTag).append(returnItemHeader());
	            for (var i = 0;i <= json.data.length - 1;i++){
					$(targetTag).append(returnItemList(json.data[i]));
	            }	
	            $(targetTag).append('</div>');
            }
            else{
            	dialogAlert('no items found');
              	$('#linkShowItem_' + product_id).hide();
            }	
            $('#ajax_waiting_item_' + product_id).show();	                	  
		}
	);	
}

function returnSearchResultItem(product){
	var li_start = '<li class="product_search_list">';
	var wait = '<div id="ajax_waiting_item_' + product.product_id + '" class="product_item_search_wait" style="display:none;"><img src="<?=base_url().'images/ajax-loader.gif'?>" border="0" /></div>'
	
	var photo    = li_start + '<img height="100" src="<?=base_url().'images/products/'?>' + product.photo_filename + '" /></li>';
	var id       = li_start + product.product_id + '</li>';
	var name     = li_start + '<a href="product/view/' + product.product_id + '">' + product.product_name + '</a></li>';
	var price    = li_start + '$' + product.price + '</li>';
	var qty      = li_start + product.qty + '</li>';
	var options  = li_start + '<a href="javascript:showItemList(' + product.product_id + ')" id="linkShowItem_' + product.product_id + '">show items</a></li>';

	var space    = li_start + '&nbsp;</li>';
	var items    = li_start + '<div id="item_' + product.product_id + '">' + wait + '</div></li>';
	
	return '<ul class="product_search_top">'
			 + photo + id + name + price + qty + options + space + items
			 + '</ul>';
	
}

function returnItemList(item){
	var li_start = '<li class="product_item_list">';

	var color = li_start + item.color_name + '</li>';
	var size =  li_start + item.size_name  + '</li>';
	var qty =   li_start + item.qty        + '</li>';
	
	return '<ul class="product_item_top">'
			 + color + size + qty 
			 + '</ul>';
}

function returnItemHeader(){
	var li_start = '<li class="product_item_header">';

	var color = li_start + 'Color</li>';
	var size =  li_start + 'Size</li>';
	var qty =   li_start + 'Stock</li>';
	
	return '<ul class="product_item_top">'
			 + color + size + qty 
			 + '</ul>';
}

function clearSearchResult(){
	$('#items').empty();
}

function showNoResultFound(){
	$('#no_result').show();
	$('#ajax_waiting').hide();
	$('#linkLoadMoreResult').hide();
}

function loadSearch(){
	$('#ajax_waiting').show();
	$.getJSON('<?=base_url()?>admin/product/ajax_search', { 'keyword' : keyword, 'record_index' : record_index, 'limit': limit}, 
		function(json){
            if (json.status){
	             if (json.data.length > 0){
					$('#no_result').hide();					
					$('#items').append('<div>');
		            for (var i = 0;i <= json.data.length - 1;i++){
						$('#items').append(returnSearchResultItem(json.data[i]));
		            }	
		            $('#items').append('</div>');
		            $('#linkLoadMoreResult').show();
	             }
	             else{
	            	noMoreResult = true;
	               	if (record_index == 0) {showNoResultFound();}
	             }		                	        
            }   
            else{
            	noMoreResult = true;
            	if (record_index == 0) {showNoResultFound();}
            }
            $('#ajax_waiting').hide();	
		}
	);	
}

function loadMoreResult(){
	record_index = record_index + limit;
	loadSearch();
	if (noMoreResult){$('#linkLoadMoreResult').hide();}
}

function dialogAlert($msg)
{
	$alertMsg = 'AfroFunk';
	
    $('body').append('<div id="dialogAlert" style="display:none" title="' + $alertMsg + '">' + $msg + '</div>');
    $('#dialogAlert').dialog({
        modal: true,
        width: 400,
        draggable: false,
        resizable: false,
        buttons: {
            OK: function() {
                $(this).dialog('close');
                $('#dialogAlert').remove();
            }
        }
    });
}


//-->
</script>

<div class="tab_header">
	<h1>Product</h1>
	<br />
	<ul id="tab_search">
		<li id="selected"><a href="javascript:tabSwitch(1)">Search</a></li>
		<!-- 
		<li><a href="javascript:tabSwitch(2)">tab 1</a></li>
		<li><a href="javascript:tabSwitch(3)">tab 2</a></li>
		-->		
	</ul>
</div>
<div class="tab_content">
	<form name="frmProductSearch" method="post" action="">
		<br />
		<div><a href="product/add" class="product_new_link" title="add new product">new product<img src="<?=base_url().'images/plus.png'?>" border="0" width="20" /></a>&nbsp;&nbsp;&nbsp;</div>
		<br />
		  <p>
			<span>keyword:&nbsp;&nbsp;&nbsp;&nbsp;</span>
			<input type="text" name="txtSearchKeyword" id="txtSearchKeyword" value="" size="50" />&nbsp;&nbsp;
			<input type="submit" name="btnSearchSubmit" id="btnSearchSubmit" value="  search  " />
		  </p>
		<br />
	</form>
</div>


<br />
<div class="tab_header">
	<h1>Result</h1>
	<br />
	<ul>
		<li id="selected"><a href="#">Search Result</a></li>
	</ul>
</div>
<div class="tab_content">
	<br />
	<ul class="product_search_title">
		<li class="product_search_list">&nbsp;</li>	
		<li class="product_search_list">Product Id</li>	
		<li class="product_search_list">Product name</li>	
		<li class="product_search_list">Price</li>	
		<li class="product_search_list">Stock</li>
		<li class="product_search_list"></li>		
	</ul>
	<div id="no_result" style="text-align:center">&nbsp;&nbsp;&nbsp;no result found</div>
	<div id="items"></div>
	<div id="ajax_waiting" class="product_search_wait" style="display:none;"><img src="<?=base_url().'images/ajax-loader.gif'?>" border="0" /></div>
	<br /><br />
	<div id="linkLoadMoreResult" style="display:none;text-align:right"><a href="javascript:loadMoreResult()">load more...</a></div>
</div>

