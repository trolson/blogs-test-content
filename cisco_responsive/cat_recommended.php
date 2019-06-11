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
			'meta_key' => 'share_count',
  			'orderby' => 'meta_value_num',
  			'order' => 'DESC'
		);
		include('cat_tab_loop.php');
	?>
