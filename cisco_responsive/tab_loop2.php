<?php

$wp_query = new WP_Query($args);


if ( $wp_query->have_posts() ) {
  echo '<ul class = "listings">';
  while ( $wp_query->have_posts() ) {

    $wp_query->the_post();

    $excerpt = strip_tags(content('20'));
    $category = get_the_category();
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );

    echo '<li class = "tab_posts">';
      echo '<div class = "listing_image">';
      if (!empty($image)) {

        echo '<img src= "' . $image[0] . '">';

      }
      else {
          echo '<img src = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
        }
      echo '</div>';
      echo '<span class = "list_cat">' . $category[0]->cat_name . '</span>';
      echo '<h2><a href = "' . get_the_permalink() . '"">' . get_the_title() . '</a></h2>';
      echo '<div class="author_image">';
        userphoto_the_author_thumbnail();
      echo '<span class = "list_author">';
		custom_author_link();
		echo '<br/>';
		the_time('F j, Y');
		echo ' - ';?>
		<a href="<?php comments_link(); ?>"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a>
		<?php
		//echo ' - ';
		//get_reading_time();
		?>
      </span>
	  </div>
      <div class = "clear"></div>
      <?php
        $content = strip_shortcodes($post->post_content);
          echo apply_filters( 'the_content', wp_trim_words( strip_tags( $content ), 20, '' ) );
        ?>
        	<a class="read_more" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read More<img class"right-arrow" src="<?php bloginfo('stylesheet_directory'); ?>/img/right-chevron.svg" alt="right-arrow"></a>
    </li>
  <?php
  }


} else {
  // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

  echo '<div class = "clear"></div>';
  echo '</ul>';


?>
