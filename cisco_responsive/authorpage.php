<?php
	if(get_query_var('author_name')) {
		$curauth = get_user_by('slug', get_query_var('author_name'));
	}
	else {
		$curauth = get_userdata(get_query_var('author'));
	}
//removed check for bunchball function
?>




<div id = "main_content">
	<div id = "blog_content">
		<div id = "main_left">
			<article id = "article_post">
				<div class = "breadcrumb"><a href='<?php bloginfo('url'); ?>'>Cisco Blog</a>&nbsp;&nbsp;>&nbsp;&nbsp;Author Biographies</div>
				<aside class="author_big_photo">
					<?php $img = $curauth->userphoto_image_file;
      				echo '<img class = "img-circle" src = "https://alln-extcloud-storage.cisco.com/ciscoblogs/userphoto/' . $img . '">';
					?>
				</aside>
				<div id = "author_content">
					<h1><?php echo $curauth->display_name; ?></h1>
					<div class="user_title">
						<p>
							<span class = "author_title"><?php echo $curauth->title; ?></span><br />
							<?php echo $curauth->cisco_group; ?><br />
							<?php if ($curauth->guest_blogger) { ?>
								Guest Blogger
							<?php } ?>
						</p>
					</div>
					<div id="author_links">
					<?php if ($curauth->twitter) { ?>
						<a href="<?php echo $curauth->twitter; ?>" target='_blank' class='author_twitter'><img src="<?php bloginfo('stylesheet_directory'); ?>/img/share_twitter.png" width="30" height="" alt="Twitter"></a>
					<?php } ?>
					<?php if ($curauth->facebook) { ?>
						<a href="<?php echo $curauth->facebook; ?>" target='_blank' class='author_facebook'><img src="<?php bloginfo('stylesheet_directory'); ?>/img/share_fb.png" width="30" height="" alt="Facebook"></a>
					<?php } ?>
					<?php if ($curauth->linkedin) { ?>
						<a href="<?php echo $curauth->linkedin; ?>" target='_blank' class='author_linkedin'><img src="<?php bloginfo('stylesheet_directory'); ?>/img/share_linked.png" width="30" height="" alt="LinkedIn"></a>
					<?php } ?>
					<!--<a href="<?php bloginfo('url'); ?>/author/<?php echo $curauth->user_nicename ?>/feed/" class="author_rss">Rss</a> -->
					<div class="clear"></div>
</div>
					<!-- removed author rewards from bunchball-->

					<div id = "author_description">
						<?php echo $curauth->description; ?>
					</div>
				</div>
				<div class = "clear"></div>
				<h2 class="feature"><?php echo $curauth->display_name; ?>'s Articles</h2>
				<ul id = "search_results">
				<?php
while (have_posts()) {
  the_post();
  $category = get_the_category();
    $categorynewid = $category[0]->cat_name;
    $category_idnew = get_cat_ID( $categorynewid );
    $category_link = get_category_link( $category_idnew );?>
	<li class = "search_result">
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );
    echo '<div class = "post_image">';
      if (!empty($image)) {
        echo '<img src = "' . $image[0] . '">';
      }
      else {
				// 10/23/2017 updating image path due to missing files on prod
        echo '<img src = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
      } ?>
  	</div>
  	<div class = "post_info">

  	 <span class = "post_category"><?php echo '<a class = "list_cat" href = "' . $category_link . '">' . $category[0]->cat_name . '</a>'; ?></span>
		  <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			<?php
			echo '<span class = "list_author">';
        the_time('F j, Y');
				echo ' - ';
				comments_number( '0 Comments', '1 Comment', '% Comments' );
				//echo ' - ';
				//get_reading_time();
				?>
      </span>
      <div class = "clear"></div>
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
       </div>
       <div class = "clear"></div>

		</li>
					<?php } ?>
				</ul>
				<?php rob_pagination() ?>
			</article>
		</div>
		<div id = "main_right">
		<?php include("sidebar.php"); ?>
	</div>
	<div class = "clear"></div>
	</div>
</div>
