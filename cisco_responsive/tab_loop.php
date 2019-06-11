<?php

$wp_query = new WP_Query($args);


if ( $wp_query->have_posts() ) {
  echo '<ul class = "listings">';
  while ( $wp_query->have_posts() ) {

    $wp_query->the_post();
    $excerpt = strip_tags(content('20'));
    $category = get_the_category();
    $categorynewid = $category[0]->cat_name;
    $category_idnew = get_cat_ID( $categorynewid );

    // Get the URL of this category
    $category_link = get_category_link( $category_idnew );
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );
    $c++;
    if ( $c == 3 || $c == 4 || $c== 5 ) {$class = 'class = "lazy"';}
    else {
      $class ='';
    }
    echo '<li class = "tab_posts">';
      echo '<div class = "listing_image">';
      if (!empty($image)) {
        if ( $c == 3 || $c == 4 || $c == 5 ) {
        echo '<img ' . $class . ' data-original= "' . $image[0] . '">';

      }
      else {
        echo '<img src= "' . $image[0] . '">';
      }
      }
      else {
        if ( $c == 3 || $c == 4 || $c== 5 ) {
          echo '<img ' . $class . ' data-original = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
        }
        else {
          echo '<img src = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
        }
      }
      echo '</div>';
      echo '<a class = "list_cat" href = "' . $category_link . '">' . $category[0]->cat_name . '</a>';
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

        <a class="read_more" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read More<img class"right-arrow" src="<?php bloginfo('stylesheet_directory'); ?>/img/right-chevron.svg" alt="right-arrow"></a>
    </li>
  <?php
  }


} else {
  // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

echo '<li class = "tab_posts">';
  echo '<div class = "listing_image">';

$args2 = array(
  'post_type' => 'sponsored',
  'posts_per_page' => 1,
  'orderby' => array('menu_order' => 'ASC' )
  );
$the_query2 = new WP_Query($args2);
if ( $the_query2->have_posts() ) {
  while ( $the_query2->have_posts() ) {
    $the_query2->the_post();
     $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );
     echo '<div class = "listing_image">';
     echo '<img src = "' . $image[0] . '">';
     echo '</div>';
    echo '<span class = "list_cat">Offer from Cisco</span>';
    echo '<h2>' . get_the_title() . '</h2>';
    the_excerpt();
    $linktext = get_post_meta($post->ID, 'link_link_link_text', true);
    $linkcontent = get_post_meta($post->ID, 'link_link_link_and_tracking_code', true);
    ?>
    <a class="read_more" href="<?php echo $linkcontent ?>" rel="bookmark"><?php echo $linktext ?><img class"right-arrow" src="<?php bloginfo('stylesheet_directory'); ?>/img/right-chevron.svg" alt="right-arrow" style="height:12px;width:12px"></a>
    <?php
  }



}

  echo '</div>';
  echo '</li>';
  echo '<div class = "clear"></div>';
  echo '</ul>';


?>
