<?php

$wp_query = new WP_Query($args);


if ( $wp_query->have_posts() ) {
  echo '<ul class = "listings">';
  while ( $wp_query->have_posts() ) {

    $wp_query->the_post();
    $c++;
              if ( $c == 3 || $c == 4 || $c== 5 || $c == 6 || $c == 7 || $c== 8 || $c == 9 || $c== 10) {$class = 'class = "lazy"';}
    else {
      $class ='';
    }
    $category = get_the_category();
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );
    echo '<li class = "tab_posts">';
      echo '<div class = "listing_image">';
       if (!empty($image)) {
        if ( $c == 1 || $c == 2 ) {
        echo '<img src= "' . $image[0] . '">';

      }
      else {

        echo '<img ' . $class . ' data-original= "' . $image[0] . '">';
      }
      }
      else {
        if ( $c == 3 || $c == 4 || $c== 5 || $c == 6 || $c == 7 || $c== 8 || $c == 9 || $c== 10) {
          echo '<img ' . $class . ' data-original = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
        }
        else {
          // updated image path due to missing images on prod. Used to point to wp-content/uploads
          echo '<img src = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
        }
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
      echo  '</span>';
      echo '</div>'; ?>

      <div class = "clear"></div>

      <?php
      echo '<div class = "contributors">';
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
      } echo '</div>' ?>
          <?php
        if ( ! has_excerpt() ) {
          $content = strip_shortcodes($post->post_content);
          echo apply_filters( 'the_content', wp_trim_words( strip_tags( $content ), 30, '' ) );
        }
        else {
          $content = get_the_excerpt();

          $content2 = apply_filters( 'the_content', wp_trim_words( strip_tags( $content ), 30, '' ) );
          echo preg_replace( "/\r|\n/", "", $content2 );
        }

        ?>
        <a class = "read_more" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read More<img class"right-arrow" src="<?php bloginfo('stylesheet_directory'); ?>/img/right-chevron.svg" alt="right-arrow"></a>
        <br />
        <?php $posttags = get_the_tags();
          if ($posttags) {
            echo '<div class="tags">Tags:</div>';
            echo '<ul class = "tagged">';
              foreach($posttags as $tag) {
                echo '<li><a class = "post_tags" href="';echo bloginfo(url);
                echo '/?tag=' . $tag->slug . '">' . $tag->name . '</a></li>';
              }
            echo '</ul>';
          } ?>
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
