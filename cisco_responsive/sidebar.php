<?php if ( is_active_sidebar( 'sidebar_right_1' ) ) : ?>
	<!-- #primary-sidebar start -->
	<ul id = "sidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar_right_1' ); ?>
	</ul>
	<!-- #primary-sidebar end -->
<?php endif; ?>