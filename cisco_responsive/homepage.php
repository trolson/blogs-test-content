<?php
require("carousel.php");
?>
<style type="text/css">
#main_content{
	max-width:1200px;
}
</style>
<div id = "home_featured">
<ul id = "featured_categories">
		<li class = "ul_fav">Our Favorite Content</li>
	<?php
	wp_nav_menu( array( 'theme_location' => 'our-favorite-content', 'container_class' => 'nav_link' ) );
	?>
	<div class = "clear" />
	</ul>
</div>
<div id = "main_content">
	<div id = "main_left">
		<?php include("tabs.php");
		featured_blogger();
		?>
		<div class = "jscroll">
			<h3>More Recent Posts:</h3>
			<a href = "<?php bloginfo('url')?>/post-page-2/" class = "jscroll-next">Next</a>
		</div>
	</div>
	<div id = "main_right">
		<?php include("sidebar.php"); ?>
	</div>
	<div class = "clear"></div>
</div>
