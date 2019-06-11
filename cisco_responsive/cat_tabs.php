
	<div id="tsm-tab-wrap">
		<?php 
		$category = get_the_category(); 
		$catid= $category[0]->cat_ID;
		if(is_category('security')){ 
		$catid = 50;
	}

		?>
 
		<!-- Tab links -->
		<ul class="tsm-tabs">
			<li><a href="#recent">Most Recent</a></li>
			<li><a href="<?php echo get_stylesheet_directory_uri(); ?>/cat_commented.php?category=<?php echo $catid ?>" class="tab">Most Commented</a></li>
			<!-- <li><a href="<?php echo get_stylesheet_directory_uri(); ?>/cat_recommended.php?category=<?php echo $catid ?>" class="tab">Recommended</a></li> -->
		</ul>
 
		<div class="tsm-tab-content">
			<!-- Tab content - id must match the href from the tab link -->
			<div id="recent">
				<?php
				$args =( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => 10,'cat'=> $catid));
					include('cat_tab_loop.php');
				?>
				<div class = "sponsored">
				</div>
			</div>
 
			<div id="tab_2">
			</div>
 
			<div id="tab_3">
			</div>
		</div>
 
	</div>
