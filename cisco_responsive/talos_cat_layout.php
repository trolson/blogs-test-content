<?php $category = get_the_category();
$cat=$category[0]->cat_name;
$catslug=$category[0]->category_nicename;
$catid = $category[0]->cat_ID;

?>
<?php
        if (!is_paged()) { ?>
<div id = "talos_main_image">
  <div id = "talos_heading">
    <h1>Cisco Threat Research Blog</h1>
    <p>Threat intelligence for Cisco Products</p>
    <p>We detect, analyze, and protect customers from both known and unknown emerging threats</p>
  </div>
</div>
<?php } ?>

  <div id = "main_content">
  <?php if (!is_paged()) { ?>
	   <div id = "blog_content" class = "paged">
  <?php } else { ?>
  <div id = "blog_content" >
    <?php } ?>

		<div id = "main_left">
			<article id = "category_content">
				<p class = "breadcrumb">
					<a href = "<?php bloginfo('url');?>">Cisco Blog</a>

				</p>
				<?php
				echo '<h1 class = "cat_heading">' . $cat . '</h1>';
				?>
				<?php
				if (!is_paged()) {
					include("talos_cat_tabs.php");
					rob_pagination();
				}
				else {
					echo '<ul class = "listings" style = "list-style:none">';
					if (have_posts()) {
						while (have_posts()) {
							the_post();
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
						}





				?>
			</article>
		</div>
		<div id = "main_right">
			<?php include("sidebar_talos.php"); ?>
		</div>
		<div class = "clear"></div>
	</div>
</div>
