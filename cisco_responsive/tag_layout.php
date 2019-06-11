<section id = "main_content">
	<section id = "blog_content">
	<div id = "main_left">
		<div id = "search_content">
			<div class = "breadcrumb"><a href='<?php bloginfo('url'); ?>'>Cisco Blog </a> ></div>
			<ul id = "search_results">
				<?php $current_tag = single_tag_title("", false);
				echo '<h1>' . $current_tag . '</h1>';
				 if (have_posts()) {
					while (have_posts()) {
						the_post();
						$c++;
    					if ( $c == 1 || $c == 2 ) {$class = '';}
    						else {
      						$class ='class = "lazy"';
    					}
						$category = get_the_category();
						$cat = $category[0]->cat_name;
						?>
						<li class = "search_result">
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );
      						echo '<div class = "post_image">';
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
          echo '<img src = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
        }
        else {

          echo '<img ' . $class . ' data-original = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
        }
      }  ?>
  							</div>
  							<div class = "post_info">

								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<div class = "post_category">
  									<?php echo $cat; ?>
  								</div>
								<?php
								echo '<div class="author_image">';
								userphoto_the_author_thumbnail();
								echo '<span class = "list_author">';
									custom_author_link();
											echo '<br />';
											the_time('F j, Y');
											echo ' - ';?>
											<a href="<?php comments_link(); ?>"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a>
											<?php
								  //echo ' - ';
								  //get_reading_time();

								echo  '</span>';
								echo '</div>'; ?>
      							<div class = "clear"></div>
      							<p>
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
      							</p>
        						<a class="read_more" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read More<img class"right-arrow" src="<?php bloginfo('stylesheet_directory'); ?>/img/right-chevron.svg" alt="right-arrow"></a>
        					</div>
        					<div class = "clear"></div>

						</li>
					<?php }
				} ?>
			</ul>
			<?php rob_pagination() ?>
		</div>
	</div>
	<div id = "main_right">
		<?php include("sidebar.php"); ?>
	</div>
	<div class = "clear"></div>
</section>
</section>
