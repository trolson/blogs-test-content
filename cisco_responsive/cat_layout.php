<?php $category = get_the_category();
$cat=$category[0]->cat_name;
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
        if ( $cat == "Threat Research") {
          echo '<h1 class = "cat_heading">Security</h1>';
        }
        else {
				echo '<h1 class = "cat_heading">' . $cat . '</h1>';
      }
				?>
				<?php
				if (!is_paged()) {
					include("cat_tabs.php");
					rob_pagination();
				}
				else {
					echo '<ul class = "listings">';
					if (have_posts()) {
            $i = 1;
						while (have_posts()&& $i < 11) {
							the_post();
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
                if ( $c == 3 || $c == 4 || $c== 5 ) {
                  echo '<img ' . $class . ' data-original = "https://alln-extcloud-storage.cisco.com/ciscoblogs/category' . $category[0]->term_id . '.png">';
                }
                else {
									// 10/23/2017 updated image path due to missing files on prod. Used to point to wp-content/uploads
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

              </span>
              <div class = "clear"></div>
                <p>
                  <?php
                  $content = strip_shortcodes($post->post_content);
                  echo apply_filters( 'the_content', wp_trim_words( strip_tags( $content ), 20, '' ) );
                  ?>
                </p>
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
            $i++;
            }


          }
          else {
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
			<?php include("sidebar.php"); ?>
		</div>
		<div class = "clear"></div>
	</div>
</div>
