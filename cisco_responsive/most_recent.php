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
			'posts_per_page' => -5,
			'ignore_sticky_posts' =>1,
			'cat' => -5555,
			'orderby' =>'comment_count',
		);
		include('tab_loop.php');
	?>
