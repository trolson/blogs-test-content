<?php
	define('WP_USE_THEMES', false);
	require_once('../../../wp-load.php');
		$args = array(
			'date_query' => array(
				array(
					'column' => 'post_date_gmt',
					'after'  => '1 month ago',
				),
		
			),
			'posts_per_page' => -6,
			'ignore_sticky_posts' =>1,
			'cat' => $_GET["category"],
			'orderby' =>'comment_count',
		);
		include('talos_cat_tab_loop.php');
	?>