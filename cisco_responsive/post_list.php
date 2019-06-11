<?php
$category = get_the_category();
$cat=get_cat_name( $_GET['cat']);
$catslug=$category[0]->category_nicename;
$catid = $category[0]->cat_ID;
?>
<div id = "main_content">
  <div id = "blog_content">
    <div id = "main_left">
      <article id = "category_content">
        <p class = "breadcrumb">
          <a href = "<?php bloginfo('url');?>">Cisco Blog</a>
        </p>
        <?php
        echo '<h1 class = "cat_heading">' . $cat . '</h1>';
        ?>
        <?php
        $args = array(
          'posts_per_page' => -6,
          'ignore_sticky_posts' =>1,
          'cat' => $_GET['cat'],
          'monthnum' => $_GET['month'],
          'year' => $_GET['year'],
        );
        $wp_query = new WP_Query($args);
        echo '<ul class = "listings">';
        if ($wp_query->have_posts()) {
          while ($wp_query->have_posts()) {
            $wp_query->the_post();

      $c++;
    if ( $c == 1 || $c == 2 ) {$class = '';}
    else {
      $class ='class = "lazy"';
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
        if ( $c == 1 || $c == 2 ) {
          echo '<img src = "http://166.78.168.251/bunchball/wp-content/uploads/placeholder.png">';
        }
        else {

          echo '<img ' . $class . ' data-original = "http://166.78.168.251/bunchball/wp-content/uploads/placeholder.png">';
        }
      }
      echo '</div>';
      echo '<span class = "list_cat">' . $category[0]->cat_name . '</span>';
      echo '<h2><a href = "' . get_the_permalink() . '"">' . get_the_title() . '</a></h2>';
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
      <?php
        $content = strip_shortcodes($post->post_content);
          echo apply_filters( 'the_content', wp_trim_words( strip_tags( $content ), 20, '' ) );
        ?>
          <a class = "read_more" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read More ><img class"right-arrow" src="<?php bloginfo('stylesheet_directory'); ?>/img/right-chevron.svg" alt="right-arrow"></a>
        <br />
        <?php $posttags = get_the_tags();
          if ($posttags) {
            echo 'Tags:<br />';
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







              rob_pagination();






        ?>
      </article>
    </div>
    <div id = "main_right">
      <?php include("sidebar.php"); ?>
    </div>
    <div class = "clear"></div>
  </div>
</div>
