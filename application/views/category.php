<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- 
<script src="<?=base_url()?>js/slideSwitch.js" type="text/javascript"></script>
<link href="<?=base_url()?>css/slideSwitch.css" rel="stylesheet" type="text/css" />
<div id="slideshow">
    <img src="<?=base_url()?>images/categories/1.png" alt="product 1" class="active" onclick="alert('1');" />
    <img src="<?=base_url()?>images/categories/2.png" alt="product 2" onclick="alert('2');" />
    <img src="<?=base_url()?>images/categories/3.png" alt="product 3" onclick="alert('3');" />
</div>
-->
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<? if (count($category_photos) > 0) {?>
<script src="<?=base_url()?>js/jQuery.scrollSomething-1.0.0.js" type="text/javascript"></script>
<link href="<?=base_url()?>css/jQuery.scrollSomething-1.0.0.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
   $(document).ready(function(){
       $("#myScrollebleItems1").scrollSomething({
           scrollerWidth: 900,
           scrollerHeight: 350,
           scrollInterval: 3000,
           scrollPrefix: "example1_",
           itemsVisable: 1,
           itemsScrolling: 1,
           buttonPosition: "bottomRight"
       });
   });
</script>
<div style="clear:both;height:10px"></div>
<div style="width:29px; float:left; border-style: solid; border-width: 1px; border-color: transparent;"></div>    
<div id="myScrollebleItems1" style="float:left;">	
    <? foreach ($category_photos as $category_photo) { ?>
    	<a href="#<?=$category_photo['id']?>"><img src="<?=base_url()?>images/categories/<?=$category_photo['filename'] ?>" alt="" /></a>
    <? } ?>
</div>
<? } ?>







<h1>CategoryID: <?= $category_id ?> is <?= $category_name ?></h1>

<div style="margin: 0 auto; width:870px;">
	<? foreach($products as $product){ ?>
	<div style="border-style: dotted; border-width:1px; float:left; width: 200px; padding: 5px; margin-right: 5px; margin-bottom: 5px;">
	    <a href="<?= $category_name.'/'.$product['product_id'] ?>">
		<img src="<?=base_url()?>images/products/<?=$product['photo_filename'] ?>" width="100" height="120" style="float: top; border-style:solid; border-width: 1px; margin-bottom: 10px;" />
	    </a>
	    
	    <div>Id: <?= $product['product_id']?></div>
	    
	    <div style="margin-bottom:10px;">Name: <?=$product['product_name']; ?></div>
	   
	    <div>$<?= $product['price'] - $product['price_discount'] ?></div>
	    
	    <div>filename: <?=$product['photo_filename'] ?></div>
	</div>
	<? } ?>
</div>  
<div style="height: 10px; clear: left;"></div>

