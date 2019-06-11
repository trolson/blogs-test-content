<?php
// Template Name: Rajini
	define('WP_USE_THEMES', false);
	$query = new WP_Query( 'p=175671' );
	 while ($query->have_posts()) {
			$query->the_post(); 
			$content = get_the_content();
			echo strip_tags($content); 
		}

?>
