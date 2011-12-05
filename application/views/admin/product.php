<script type="text/javascript">
<!--


//-->
</script>

<div class="tab_header">
	<h1>Product: <?=$product['product_name']?></h1>
	<br />
	<ul id="tab_search">
		<li id="selected"><a href="javascript:tabSwitch(1)">General</a></li>	
	</ul>
</div>
<div class="tab_content">
	<br />
	  <p>
		show product details here
	  </p>
	<br />
</div>



<div class="tab_header">
	<br />
	<ul id="tab_search">
		<li id="selected"><a href="javascript:tabSwitch(1)">Item list</a></li>	
	</ul>
</div>
<div class="tab_content">
	<br />
	  <p>
		show all item list here
	  </p>
	<br />
</div>



<div class="tab_header">
	<br />
	<ul id="tab_search">
		<li id="selected"><a href="javascript:tabSwitch(1)">Photos</a></li>	
	</ul>
</div>
<div class="tab_content">
	<br />
	  <p>
		show all photos lists here
	  </p>
	<br />
</div>



<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<?var_dump($product); ?>
<br />
<?var_dump($items); ?>
<br />
<?var_dump($photos); ?>
<br />
<?var_dump($colors); ?>
<br />
<?var_dump($sizes); ?>