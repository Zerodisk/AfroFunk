<script type="text/javascript">
<!--

var record_index = 0;
var limit = 50;
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
	$.getJSON('<?=base_url()?>admin/product/ajax_getItemList', { 'product_id' : product_id }, 
		function(json){
            if (json.data.length > 0){
				$(targetTag).append('<div>');
	            for (var i = 0;i <= json.data.length - 1;i++){
					$(targetTag).append(returnItemList(json.data[i]));
	            }	
	            $(targetTag).append('</div>');
            }
            else{
              	alert('no items found');
            }		                	  
            //$('#linkShowItem_' + product_id).hide();      
		}
	);	
}

function returnSearchResultItem(product){
	var li_start = '<li class="product_search_list">';
	var photo    = li_start + '<img height="100" src="<?=base_url().'images/products/'?>' + product.photo_filename + '" /></li>';
	var id       = li_start + product.product_id + '</li>';
	var name     = li_start + '<a href="product/view/' + product.product_id + '">' + product.product_name + '</a></li>';
	var price    = li_start + '$' + product.price + '</li>';
	var qty      = li_start + product.qty + '</li>';
	var options  = li_start + '<a href="javascript:showItemList(' + product.product_id + ')" id="linkShowItem_' + product.product_id + '">show items</a></li>';
	
	return '<ul class="product_search_top">'
			 + photo + id + name + price + qty + options 
			 + '</ul><div id="item_' + product.product_id + '"></div>';
	
}

function returnItemList(item){

	
	return item.color_name;


}

function clearSearchResult(){
	$('#items').empty();
}

function showNoResultFound(){
	$('#no_result').show();
	$('#ajax_waiting').hide();
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
		}
	);	
	$('#ajax_waiting').hide();	
}

function loadMoreResult(){
	record_index = record_index + limit;
	loadSearch();
	if (noMoreResult){$('#linkLoadMoreResult').hide();}
}



//-->
</script>

<div class="tab_header">
	<h1>Product</h1>
	<br />
	<ul>
		<li id="selected"><a href="#">Search</a></li>
		<!--  
		<li><a href="#">tab 1</a></li>
		<li><a href="#">tab 2</a></li>
		-->
	</ul>
</div>
<div class="tab_content">
	<form name="frmProductSearch" method="post" action="">
		<br />
		  <p>
			<label_search>keyword:</label_search>
			<input type="text" name="txtSearchKeyword" id="txtSearchKeyword" value="" />
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
	<div id="no_result">&nbsp;&nbsp;&nbsp;no result found</div>
	<div id="items"></div>
	<div id="ajax_waiting" class="product_search_wait" style="display:none;"><img src="<?=base_url().'images/ajax-loader.gif'?>" border="0" /></div>
	<br /><br />
	<div id="linkLoadMoreResult" style="display:none;text-align:right"><a href="javascript:loadMoreResult()">load more...</a></div>
</div>

