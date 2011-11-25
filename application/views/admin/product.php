<script type="text/javascript">
<!--

var record_index = 0;
var limit = 50;

$(document).ready(function(){
	$('#btnSearchSubmit').click(function(){
		$('#ajax_waiting').show();
		var keyword = $('#txtSearchKeyword').val();
		$.getJSON('<?=base_url()?>admin/product/ajax_search', { 'keyword' : keyword, 'record_index' : record_index, 'limit': limit}, 
			function(json){
	                if (json.status){
		                if (json.data.length > 0){
							$('#no_result').hide();
							clearSearchResult();
			                for (var i = 0;i <= json.data.length - 1;i++){
								$('#items').append(returnSearchResultItem(json.data[i]));
			                }	
			                $('#ajax_waiting').hide();
		                }
		                else{
		                	showNoResultFound();
		                }		                	        
	                }   
	                else{
	                	showNoResultFound();
	                }
			}
		);	
	});
});

function returnSearchResultItem(product){

	return '<div style="color:blue"><span>' + product.product_id + '</span><span>' + product.product_name + '</span></div>';
	
}

function clearSearchResult(){
	$('#items').empty();
}

function showNoResultFound(){
	clearSearchResult();
	$('#no_result').show();
	$('#ajax_waiting').hide();
}

//-->
</script>

<div class="tab_header">
	<h1>Product</h1>
	<br />
	<ul>
		<li id="selected"><a href="#">Search</a></li>
		<!--  
		<li><a href="#">This</a></li>
		<li><a href="#">The Other</a></li>
		<li><a href="#">Banana</a></li>
		-->
	</ul>
</div>
<div class="tab_content">
	<form name="frmProductSearch" method="post" action="">
		<br />
		  <p>
			<label_search>keyword:</label_search>
			<input type="text" name="txtSearchKeyword" id="txtSearchKeyword" value="" />
			<input type="button" name="btnSearchSubmit" id="btnSearchSubmit" value="  search  " />
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
</div>