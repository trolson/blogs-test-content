<?php

$wp_query = new WP_Query($args);


if ( $wp_query->have_posts() ) {
  echo '<ul class = "listings">';
  while ( $wp_query->have_posts() ) {
    $wp_query->the_post();
    $category = get_the_category();
    echo '<li class = "talos_posts">';
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

        echo  '</span>';
        echo '</div>'; ?>
      <div class = "clear"></div>
      <?php
      $multi_author = get_post_meta($post->ID, '_multiple_authors');
      $output = array();
      foreach($multi_author as $row => $authors){
        foreach($authors as $author => $author_id){
          $nicename = get_the_author_meta( 'display_name', $author_id );
          $user_display = '<a href ="' . get_author_posts_url($author_id) . '">' . $nicename . '</a>';
          array_push($output, "$user_display");
        }
      }
      if (!empty($output)) {
        echo 'Contributors: ' . implode(', ', $output);
      }

        the_content();

        ?>
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
