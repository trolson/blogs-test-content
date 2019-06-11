	<footer class = "sb-slide">
		<section id = "footer_content">
			<?php
			global $wpdb;
			if(is_home()||is_author()||is_search()||is_page()||is_tag()) {
				$social =$wpdb->get_row("SELECT * from wp_cisco_social WHERE wp_cisco_social.id = '0'");
			}
			else{
				$category = get_the_category();
				$catid= $category[0]->cat_ID;
				$social =$wpdb->get_row("SELECT * from wp_cisco_social WHERE wp_cisco_social.id = $catid");
			}
			?>
			<ul id = "footer_social">
				<li class = "footer_social_title">Connect</li>

				<li><a target='_blank' href='<?php echo $social->fb ?>'><img src = "<?php echo get_template_directory_uri(); ?>/img/footer_fb.png" height = "25" width = "25"></a></li>
				<li><a target='_blank' href='<?php echo $social->tw ?>'><img src = "<?php echo get_template_directory_uri(); ?>/img/footer_tw.png"></a></li>
				<li><a target='_blank' href='<?php echo $social->li ?>'><img src = "<?php echo get_template_directory_uri(); ?>/img/footer_li.png"></a></li>
				<div class = "clear"></div>
			</ul>
			<section id="footer_new">
				<?php wp_nav_menu( array( 'theme_location' => 'bottom-menu', 'container_class' => 'footer_new' ) ); ?>
			</section>
			<br class="clear" />
			<section id ="disclaimer">
				<b>Legal Disclaimer</b>
				<p>Some of the individuals posting to this site, including the moderators, work for Cisco Systems. Opinions expressed here and in any corresponding comments are the personal opinions of the original authors, not of Cisco. The content is provided for informational purposes only and is not meant to be an endorsement or representation by Cisco or any other party. This site is available to the public. No information you consider confidential should be posted to this site. By posting you agree to be solely responsible for the content of all information you contribute, link to, or otherwise upload to the Website and release Cisco from any liability related to your use of the Website. You also grant to Cisco a worldwide, perpetual, irrevocable, royalty-free and fully-paid, transferable (including rights to sublicense) right to exercise all copyright, publicity, and moral rights with respect to any original content you provide. The comments are moderated. Comments will appear as soon as they are approved by the moderator.</p>
			</section>
		</section>
		<?php wp_footer(); ?>
	</footer>
	<script>//nitro.refreshNML();</script>
</body>
</html>
