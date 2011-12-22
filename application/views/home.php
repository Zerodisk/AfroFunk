<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="UTF-8" />

    	<title>afrofunk clothing</title>
        
        <!-- CSS FILES -->
        <link rel="stylesheet" href="<?=base_url()?>css/home/style.css" media="screen" />
        <link rel="stylesheet" href="<?=base_url()?>css/home/style_light.css" media="screen" title="change" />        
		
		<!-- JS FILES -->
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.6.1.min.js"></script>            
    </head>
    <!-- HEAD ENDS -->
    
    <body class="home blog">
    	<div class="wrapper">
    	
        	<!-- /#header/ -->
        	<div id="header">
            	<!-- /#logo/ -->
            	<div id="logo">
                	<h1 style="margin: 0; float: left;"><a href="<?=base_url()?>"><img src="http://dl.dropbox.com/u/3431098/timeless_light.png" alt="afrofunk" /></a></h1>                
                </div>                
                
                <!-- /#menu/ -->
                <div id="menu">
                	 <ul id="menu-main-menu" class="">
                	 	<li id="menu-item-5" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-5"><a href="<?=base_url()?>">Home</a></li>
						<li id="menu-item-14" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-14"><a href="<?=base_url()?>about-us/">About Us</a></li>

						<?foreach ($categories as $category){ ?>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-102"><a href="<?=base_url().'Category/'.$category['category_name'] ?>"><?=$category['category_name'] ?></a></li>
						<?} ?>
	
						<li id="menu-item-132" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-132"><a href="<?=base_url()?>contact/">Contact</a></li>
					</ul>                
                
                </div>
                
                <!-- /#header-right/ --> 
                <div id="header-right">
                	<h6 class="light">search:</h6>
                
                	<form id="s-top" method="get" action="#">
                    
                    	<input name="s" value="" type="text" id="searchInput" />
                        <input type="submit" value="" id="searchButton" />
                    
                    </form>
                    
                    <div class="clear"></div>
                    <!-- /clears float/ -->
                    
                    <ul id="socialTop">
						<li><a href="#"><img src="<?=base_url()?>images/top_rss.png" alt="rss" /></a></li>
						<li><a href="http://facebook.com/"><img src="<?=base_url()?>images/top_face.png" alt="rss" /></a></li>
					 	<li><a href="http://twitter.com/"><img src="<?=base_url()?>images/top_twitter.png" alt="rss" /></a></li>
					</ul>
                </div>
             
            </div>
            <!-- /#header/ -->
    
		    <!-- /#content/ -->     
			<div id="content">
				<!-- /#slider -->
				<a href="http://google.com/"><img src="http://timeless.salumguilher.me/wp-content/uploads/2011/06/slide1.jpg" alt="Slide 002" /></a> 
			    <!-- /#slider -->   
		    	<div class="divider-top"></div>
		
		    	<div class="block">		            
		            <h1 style="color: #454545; text-align: center; font-size: 230%; margin-bottom: .7em; margin-top: 8px;">afrofunk clothing is here</h1>
					<p style="font-family: Georgia, 'Times New Roman', serif; font-size: 15px; font-style: italic; line-height: 24px; color: #aaa; text-align: center;">afrofunk clothing, functionality with 100+ shortcodes and 6 custom Widgets. You can&#8217;t seriously ask for any more. &#8211; </p>       
		        </div>   
		        <div class="divider-top"><a href="#">top</a></div>    
		        
		    	<div class="block">        		        	            
		            <div class="one-fourth">
		            	<a href="#"><img src="http://timeless.salumguilher.me/wp-content/themes/timeless/includes/timthumb.php?q=100&amp;zc=1&amp;src=http://timeless.salumguilher.me/wp-content/uploads/2011/06/post4.png&amp;w=211&amp;h=160" alt="Rimino Concept Phone" /></a><span class="padding-20"></span>
		            	<h5><a href="#">Rimino Concept Phone</a></h5><span class="heading-divider-20"></span>
		            	<p>Amid Moradganjeh wanted to rethink the experience with this concept mobile phone called Rimino .  [...]</p>
		            	<p><a href="#" class="read-more">Read more...</a></p>
		            </div>
		            <div class="one-fourth">
		            	<a href="#"><img src="http://timeless.salumguilher.me/wp-content/themes/timeless/includes/timthumb.php?q=100&amp;zc=1&amp;src=http://timeless.salumguilher.me/wp-content/uploads/2011/06/post7.jpg&amp;w=211&amp;h=160" alt="What is Good Design?" /></a><span class="padding-20"></span>
		            	<h5><a href="#">What is Good Design?</a></h5><span class="heading-divider-20"></span>
		            	<p>Cnjpus Text is the last work of the artist Ryo Shimizu . Tokyo capita, the  [...]</p>
		            	<p><a href="#" class="read-more">Read more...</a></p>
		            </div>
		            <div class="one-fourth">
		            	<a href="#"><img src="http://timeless.salumguilher.me/wp-content/themes/timeless/includes/timthumb.php?q=100&amp;zc=1&amp;src=http://timeless.salumguilher.me/wp-content/uploads/2011/06/post6.png&amp;w=211&amp;h=160" alt="Suspended Structure" /></a><span class="padding-20"></span>
			            <h5><a href="#">Suspended Structure</a></h5><span class="heading-divider-20"></span>
			            <p>Seeking to develop sculptures in the city, Janet Echelman imagine beautiful shapes with multiple colors.  [...]</p>
			            <p><a href="#" class="read-more">Read more...</a></p>
		           	</div>
		           	<div class="one-fourth last">
		           		<a href="#"><img src="http://timeless.salumguilher.me/wp-content/themes/timeless/includes/timthumb.php?q=100&amp;zc=1&amp;src=http://timeless.salumguilher.me/wp-content/uploads/2011/06/post5.jpeg&amp;w=211&amp;h=160" alt="Exploded Structures" /></a><span class="padding-20"></span>
		           		<h5><a href="#">Exploded Structures</a></h5><span class="heading-divider-20"></span>
		           		<p>The artist Ben Grasso based in Brooklyn (New York), reveals all his artistic talent with  [...]</p>
		           		<p><a href="#" class="read-more">Read more...</a></p>
		           	</div>
		           	<div class="clear"></div>		        
		        </div> 
		        <div class="divider-top"><a href="#">top</a></div>        
		    </div>
		    <!-- /#content/ -->
        	
        	<!-- /#footer/ -->
			<div id="footer" class="block">
				<div class="one-sixth">
					<div class="footer-sidebar-block">			
						<div class="textwidget">
							<h1><img alt="afrofunk" src="http://timeless.salumguilher.me/wp-content/uploads/2011/06/logo-footer.gif" /></h1>                    
                    		<p>afrofunk clothing is sydney base company.</p>                    
                    		<p>the galleries<br>shop rg26c, 500 geroge st. sydney<br>nsw, australia</p>
                    	</div>
					</div>
				</div>
				<div class="one-sixth">
					<div class="footer-sidebar-block">
						<h5>Pages</h5>
						<div class="menu-footer-menu-container">
							<ul id="menu-footer-menu" class="menu">
								<li id="menu-item-92" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-92"><a href="<?=base_url()?>">Home</a></li>
								<li id="menu-item-93" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-93"><a href="#">About Us</a></li>
								<li id="menu-item-96" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-96"><a href="#">Shipping and Return</a></li>
								<li id="menu-item-97" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-97"><a href="#">Terms &#038; Conditions</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="one-sixth">
					<div class="footer-sidebar-block">
						<ul class="flickr-grid">
							<li><a href="#"><img src="http://farm8.staticflickr.com/7001/6400028385_0b0bd4cfa5_s.jpg" alt="" width="50" height="50" /></a></li>
							<li><a href="#"><img src="http://farm8.staticflickr.com/7012/6449494919_6392e5fcc5_s.jpg" alt="Art Basel" width="50" height="50" /></a></li>
							<li><a href="#"><img src="http://farm8.staticflickr.com/7164/6442245457_3119d7d775_s.jpg" alt="Lunch" width="50" height="50" /></a></li>
							<li><a href="#"><img src="http://farm8.staticflickr.com/7007/6451015791_0c62332e47_s.jpg" alt=" " width="50" height="50" /></a></li>
							<li><a href="#"><img src="http://farm8.staticflickr.com/7160/6400023631_b7e9a4049b_s.jpg" alt="" width="50" height="50" /></a></li>
							<li><a href="#"><img src="http://farm8.staticflickr.com/7146/6477256881_d4245bd9ae_s.jpg" alt="Maxed out activity level on the Fitbit." width="50" height="50" /></a></li>
						</ul>
					</div>
				</div>
				<div class="one-third">
					<div class="footer-sidebar-block">
						<ul class="twitter-feed" id="ItxXz">
							<li>&nbsp;</li>
						</ul>
					</div>
				</div>
				<div class="one-sixth last">
					<div class="footer-sidebar-block">			
						<div class="textwidget">
							<h6>The Essence of afrofunk</h6>
							<p>So, as we look ahead to 2011, a new year and a new decade, we can also look to the past to see what’s stood the test of time. What does “afrofunk” mean to you?</p>
						</div>
					</div>
				</div>
			</div>
			<!-- /#footer/ -->
            
            <div id="copyright">
            	<div class="left"> 
                	<strong>afrofunk</strong> - Copyright &#169; 2005-2011. All right is reserved.                
                </div>              
                <div class="right">
	                
                </div>      
            </div>
        
        </div>
                    
    </body>

</html>