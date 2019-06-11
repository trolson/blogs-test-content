<?php
// Template Name: robtest
get_header();


    	global $wpdb;
    	$results = $wpdb->get_results ("select p.id, sum(c.twitter_tweets) as twitter_tweets, sum(c.facebook_likes) as facebook_likes, sum(c.google_plusones) as google_plusones  from wp_posts p, wp_smpro_cache c where DATEDIFF(CURDATE(), p.post_date) < 21 and p.post_status = 'publish' and p.id = c.post_id group by c.post_id order by twitter_tweets desc, facebook_likes desc, google_plusones desc limit 6");
    	
    	foreach ($results as $result) {
    		$id = $result->id;
    		$queryId = 'p=' . $id;
    		echo $queryId;
    		$query = new WP_Query( $queryId );

    		if ( $query->have_posts() ){
    			while ( $query->have_posts()) {
    				$query->the_post();
    				echo '<h2><a href = "' . get_the_permalink() . '"">' . get_the_title() . '</a></h2>';
    				echo ''
    			}
    		}
    		wp_reset_postdata();
    	}
    		$wpdb->flush();



?>

