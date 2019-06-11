<?php
$category = get_the_category();
$cat=$category[0]->cat_name;
$catslug=$category[0]->category_nicename;
?>

<div id = "main_content">

	<div id = "blog_content">
	<div id = "main_left">

		<article id = "article_post">
			<p class = "breadcrumb">
			<?php
				echo "<a href='";?> <?php bloginfo('url'); ?><?php echo "'>Cisco Blog</a> > <a href='";?> <?php bloginfo('url'); ?><?php echo "/category/" . $catslug . "/'>" . $cat ."</a>" ;
			echo '</p>';
 			if (have_posts()) {
				while (have_posts()) { the_post();  ?>
  					<div id = "post_info">
  						<span class = "post_category">
  							<?php echo $cat; ?>
  						</span>
						<h1 id="post-<?php the_ID(); ?>" class="kindle_title title"><?php the_title(); ?></h1>
						<?php
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
					 share_small();
					 $posttags = get_the_tags();
					if ($posttags) {
						echo 'Tags:<br />';
						echo '<ul class = "tagged">';
							foreach($posttags as $tag) {
								echo '<li><a class = "post_tags" href="';echo bloginfo(url);
								echo '/?tag=' . $tag->slug . '">' . $tag->name . '</a></li>';
							}
						echo '</ul>';
					}
				}
			}
			?>
			<div id = "comments">
				<?php comments_template();
				?>

			</div>
		</article>

	</div>
	<div id = "main_right">
		<?php include("sidebar_talos.php"); ?>
	</div>
	<div class = "clear"></div>
</div>
</div>
