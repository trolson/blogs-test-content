<div id="tsm-tab-wrap">

	<!-- Tab links -->
	<?php if(!is_404()){ ?>
	<ul class="tsm-tabs">
		<li><a href="#recent">Most Recent</a></li>
		<li><a href="<?php echo get_stylesheet_directory_uri(); ?>/most_commented.php" class="tab">Most Commented</a></li>
	<!--	<li><a href="<?php echo get_stylesheet_directory_uri(); ?>/recommended.php" class="tab">Recommended</a></li> -->
	</ul>
<?php } ?>

	<div class="tsm-tab-content">
		<!-- Tab content - id must match the href from the tab link -->
		<div id="recent">
			<?php

			if(is_404()){
				$term_id_from_url = get_term_id();
			 $args = fill_posts('3',$term_id_from_url);
		 }
		 else{
			 $args = fill_posts('5',$term_id_from_url);
		 }

			 include('tab_loop.php');
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
