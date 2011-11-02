<!--  top level menu start here -->
	  <div class="menu-top">
	     <ul>
	  	  <?foreach ($menus as $menu){ ?>
		    <li class="menu<?=$menu[2] ?>"><a href="<?=$menu[1] ?>"><?=$menu[0] ?></a></li>
	  	  <?} ?>
	    </ul>
	  </div>
<!--  top level menu end here -->