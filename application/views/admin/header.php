<!--  top level menu start here -->
	<div id="header">
	  <div id="menu-top">
	  	<?foreach ($menus as $menu){ ?>
		  <div class="menu<?=$menu[2] ?>"><a href="<?=$menu[1] ?>"><?=$menu[0] ?></a></div>
	  	<?} ?>
		  <div style="clear: left"></div>
	  </div>
	</div>
<!--  top level menu end here -->