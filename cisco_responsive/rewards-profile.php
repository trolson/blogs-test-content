<?php
	$params = explode('/', $_SERVER['REQUEST_URI']);
        foreach($params as $param) {
            if(is_numeric($param)) {
                $user_id = $param;
            }
        }
        
        global $wpdb;
        $getuser = $wpdb->get_row("SELECT * FROM nitro_userinfo WHERE ID = '$user_id'");
        $nitroId = $getuser->nitro_id;
        $firstname = $getuser->firstname;
		$lastname = $getuser->lastname;
		$email = $getuser->email;
		$thumb = $getuser->img;
		$facebook = $getuser->facebook;
		$twitter = $getuser->twitter;
		$linkedin = $getuser->linkedin;
		$google = $getuser->google;
		$title = $getuser->title;
		$bio = $getuser->bio;
		$avatar = $getuser->img;
		$approved = $getuser->approved;
		if (empty($avatar)||$approved == 0){
			$img= 'https://alln-extcloud-storage.cisco.com/ciscoblogs/nitro_users/empty.jpg';					
		}
		else {
			$img= 'https://alln-extcloud-storage.cisco.com/ciscoblogs/nitro_users/' . $avatar;
		}
?>
<div id = "main_content">
	<div id = "blog_content">
		<div id = "main_left">
			<article id = "article_post">
				<?php	
				if ($username === $nitroId) {  
					if ($approved != 1) {
						//echo '<div class = "bio_unapproved">Pending review. Please contact <a href = "mailto:socialrewards@cisco.com Subject=My profile is pending review">socialrewards@cisco.com</a> to authenticate your bio/title.</div>';
					}
				} ?>
				<aside class="author_big_photo">
					<img src = "<?php echo $img; ?>">
						<?php $username = $_COOKIE["rewards"];
						if (1===0) { 
						//if ($username != $nitroId) { 
    						view_memberProfile();
    					}
						?>
				</aside>
				<div id = "author_content">
					<h1><?php echo $firstname . " " . $lastname ?></h1> 
					<?php
					if (1===0) { 
					//if ($username === $nitroId) { 
    					$url = site_url();
						$url.= "/edit-rewards-profile/"; ?>
    					<a href = "<?php echo $url; ?>">Edit your profile</a><?php
    				} ?>
					<div class="user_title">
						<p>
							<?php	
							if (1===0) { 
							//if ($username === $nitroId) {
								//if (empty($title)) {
									if (1===0) { 
    								$url = site_url();
									$url.= "/edit-rewards-profile/"; ?>
    								<a href = "<?php echo $url; ?>">Add your title here</a> <?php
    							}
    							else {
									?>
									<span class = "author_title"><?php //echo $title;?></span>
								<?php }					
							}
							else {
								?>
								<span class = "author_title"><?php //echo $title;?></span>
								<?php 
							} ?>
						</p>
					</div>	
					<!--
					<div id="author_links">
						<?php if (!empty($twitter)) {  ?>
						<a href="<?php //echo $twitter; ?>" target='_blank' class='author_twitter'><img src="<?php //bloginfo('stylesheet_directory'); ?>/img/share_twitter.png" width="30" height="" alt="Twitter"></a>
						<?php } ?>
						<?php if (!empty($facebook)) { ?>
						<a href="<?php //echo $facebook; ?>" target='_blank' class='author_facebook'><img src="<?php //bloginfo('stylesheet_directory'); ?>/img/share_fb.png" width="30" height="" alt="Facebook"></a>
						<?php } ?>
						<?php if (!empty($linkedin)) { ?>
						<a href="<?php //echo $linkedin; ?>" target='_blank' class='author_linkedin'><img src="<?php //bloginfo('stylesheet_directory'); ?>/img/share_linked.png" width="30" height="" alt="LinkedIn"></a>
						<?php } ?>
						<a href="<?php bloginfo('url'); ?>/author/<?php //echo $curauth->user_nicename ?>/feed/" class="author_rss">Rss</a> 
						
						<div class="clear"></div>
					-->
				
					<div id = "author_rewards">
						 <?php //$nitroName = $nitroId;
						 //user_layout($nitroName)?>
					</div>
					<div id = "author_description">
						<?php 
						if (1===0) { 
						//if ($username === $nitroId) {
							if (empty($bio)) {
								$url = site_url();
								$url.= "/edit-rewards-profile/"; ?>
    							<a href = "<?php echo $url; ?>">Add your bio here</a> <?php				
							}
							else {
								echo $bio;				
							}			
							}
						else {
							//echo $bio;				
						} ?>
					</div>
				</div>
				<!--<div class = "clear"></div>-->
			</article>
		</div>
		<div id = "main_right">
		<?php include("sidebar.php"); ?>
	</div>
	<div class = "clear"></div>
	</div>
</div>