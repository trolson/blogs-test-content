<?php
$display_count = 5;
$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$offset = ( $page - 1 ) * $display_count;
$args2 =array(
  'category__not_in' =>5555,
  'post__not_in' => get_option( 'sticky_posts' ),
  'post_type'  =>  'post',
    'orderby'    =>  'date',
    'order'      =>  'desc',
    'number'     =>  $display_count,
    'page'       =>  $page,
    'offset'     =>  $offset
         );
$the_query2 = new WP_Query($args2);
$excerpt = strip_tags(content('20'));

if ( $the_query2->have_posts() ) {
  echo '<ul class = "listings">';
    while ( $the_query2->have_posts() ) {
    $the_query2->the_post();
    $category = get_the_category();
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );
    echo '<li class = "tab_posts">';
      echo '<div class = "listing_image">';
        echo '<img src = "' . $image[0] . '">';
      echo '</div>';
      echo '<span class = "list_cat">' . $category[0]->cat_name . '</span>';
      echo '<h2>' . get_the_title() . '</h2>';
      echo '<div class="author_image">';
              userphoto_the_author_thumbnail();
      echo '</div>';
      echo '<span class = "list_author">';
      custom_author_link();
      echo ' - ';
      the_time('F j, Y');
      echo ' - ';?>
      <a href="<?php comments_link(); ?>"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a>
      <?php
      //echo ' - ';
      //get_reading_time();
      ?>
      </span>
      <div class = "clear"></div>
      <p>
      <?php
     echo $excerpt;
     ?>
       <a class="read_more" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read more<img src="<?php bloginfo('stylesheet_directory'); ?>/img/right-arrow.svg" alt="right-arrow"></a>
     <?php

    echo'</li>';
  }
  echo '<li>';
  echo '<div class = "listing_image holder">';
  echo 'Sponsored post';
  echo '</div>';
  echo '</li>';
  echo '<div class = "clear"></div>';
  echo '</ul>';
  echo '<div id="nav-below">';
  echo get_next_posts_link();
  echo '</div>';

} else {
  // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
?>
