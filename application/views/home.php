<?foreach ($categories as $category){ ?>
	<p><a href="<?=base_url().'Category/'.$category['category_name'] ?>"><?=$category['category_name'] ?></a></p>
<?} ?>