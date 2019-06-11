<div id = "respond">
<?php if ( comments_open() ){ ?>
<span class = "comment_heading">Leave a comment</span><br />
<p class="cisco_respond">We'd love to hear from you! Your comment(s) will appear instantly on the live site. Spam, promotional and derogatory comments will be removed and HTML formatting will not appear.</p>

<?php
}
	//$cats = get_the_category();
	//foreach($cats as $cat) {
		//$catID =$cat->cat_ID;
		//if ($catID == 50) {
			// <p class="cisco_respond"><b>All comments in this blog are held for moderation.  Your comment will not display until it has been approved</b></p>
	//}
	//}
	if ( ! comments_open() ){ ?>
				<p class = "cisco_respond">In an effort to keep conversations fresh, Cisco Blogs closes comments after 60 days. Please visit the <a href ="<?php bloginfo('url'); ?>">Cisco Blogs hub page</a> for the latest content.</p>
		<?php
	}
	else{

		?>
<form action="wp-comments-post.php" method="post" id="commentform">
	<?php
	if ( is_user_logged_in() ) {
		$user_ID = get_current_user_id();
		$user_info = get_userdata($user_ID);
		echo '<div id = "commentLoggedIn">';
			echo '<div id = "commentLoggedInImage">';
				echo get_avatar23($user_ID);
			echo '</div>';
			echo '<div id = "commentLoggedInName">';
				echo $user_info->display_name;
			echo '</div>';
			echo '<div class = "clear"></div>';
		echo '</div>';
		echo '<p><textarea name="comment" id="comment" cols="60%" rows="10" tabindex="4"></textarea></p> ';
	}
	else {
		$userId = $_COOKIE["rewards"];
		if (isset($userId)) {
			global $wpdb;
			$getuser = $wpdb->get_row("SELECT * FROM nitro_userinfo WHERE nitro_id = '$userId'");
			if($getuser === null){
				global $wpdb;
				$getuser = $wpdb->get_row("SELECT * FROM $wpdb->usermeta WHERE meta_key = 'nitro_name' AND meta_value = '$userId'");
				$userinfo = $getuser->user_id;
				$user_info = get_userdata($userinfo);
				$displayName = $user_info->display_name;
				echo '<div id = "commentLoggedIn">';
					echo '<div id = "commentLoggedInImage">';
						echo get_avatar23($userinfo);
					echo '</div>';
					echo '<div id = "commentLoggedInName">';
						echo $displayName;
					echo '</div>';
					echo '<div class = "clear"></div>';
				echo '</div>';
				echo '<p id ="comments_name"><input type="hidden" name="author" id="author" value="' . $displayName . '" size="22" tabindex="1" />';
				echo '<p><textarea name="comment" id="comment" cols="60%" rows="10" tabindex="4"></textarea></p>';
			}
			else {
				$firstname = $getuser->firstname;
				$lastname = $getuser->lastname;
				$avatar = $getuser->img;
				$approved = $getuser->approved;
				$displayName = $firstname . ' ' . $lastname;
				if (is_null($avatar)){
					$img = get_site_url();
					$img.= '/wp-content/uploads/nitro_image/empty.jpg';
				}
				else {
					if ($approved === '0') {
						$img = get_site_url();
						$img.= '/wp-content/uploads/nitro_image/empty.jpg';
					}
					else {
						$img = get_site_url();
						$img.= '/wp-content/plugins/bunchball/formfiles/images/';
						$img.= $avatar;
					}

				}
				echo '<div id = "commentLoggedIn">';
				echo '<div id = "commentLoggedInImage">';
					echo '<img src = "' . $img . '">';
				echo '</div>';
				echo '<div id = "commentLoggedInName">';
					echo $displayName;
				echo '</div>';
				echo '<div class = "clear"></div>';
			echo '</div>';
			echo '<p id ="comments_name"><input type="hidden" name="author" id="author" value="' . $displayName . '" size="22" tabindex="1" />';
			echo '<p><textarea name="comment" id="comment" cols="60%" rows="10" tabindex="4"></textarea></p>';
			}

		}
		else { ?>
			<p id ="comments_name"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
			<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

			<p><textarea name="comment" id="comment" cols="60%" rows="10" tabindex="4"></textarea></p> <?php
		}

	} ?>
	<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
	<?php comment_id_fields(); ?>
	</p>
	<?php do_action('comment_form', $post->ID); ?>
</form>
<?php
}

	if (have_comments()) { ?>
	<p><span class = "comment_heading"><?php comments_number('0', '1', '%' );?> Comments</span></p>
		<ol class="commentlist" id="thecomments">
				<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
			</ol>
	<?php
	}


 ?>
</div>
