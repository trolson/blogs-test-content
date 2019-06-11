<?php
	session_start();
?>
<script>
	function validateForm() {
    	var fb = document.forms["edit_profile"]["facebook"].value;
    	var tw = document.forms["edit_profile"]["twitter"].value;
    	var lii = document.forms["edit_profile"]["linkedin"].value;
    	var gp = document.forms["edit_profile"]["google"].value;
    	if (fb) {
    		var fbstr = "http://facebook.com/";
    		var fbsstr = "https://facebook.com/";
    		var fbwstr = "http://www.facebook.com/";
    		var fbwsstr = "https://www.facebook.com/";
    		var fbcheck = fb.indexOf(fbstr);
    		var fbscheck = fb.indexOf(fbsstr);
    		var fbcheckw = fb.indexOf(fbwstr);
    		var fbscheckw = fb.indexOf(fbwsstr);
    		if (fbcheck !== 0 && fbscheck !== 0 && fbwsstr !==0 && fbscheckw !==0) {
        		alert("Must be a valid facebook URL");
        		return false;
    		}
		}
		if (tw) {
    		var twstr = "http://twitter.com/";
    		var twsstr = "https://twitter.com/";
    		var twwstr = "http://www.twitter.com/";
    		var twwsstr = "https://www.twitter.com/";
    		var twcheck = tw.indexOf(twstr);
    		var twscheck = tw.indexOf(twsstr);
    		var twcheckw = tw.indexOf(twwstr);
    		var twscheckw = tw.indexOf(twwsstr);
    		if (twcheck !== 0 && twscheck !== 0 && twcheckw !==0 && twscheckw !==0) {
        		alert("Must be a valid twitter URL");
        		return false;
    		}
		}
		if (lii) {
    		var liistr = "http://linkedin.com/";
    		var liisstr = "https://linkedin.com/";
    		var liiwstr = "http://www.linkedin.com/";
    		var liiwsstr = "https://www.linkedin.com/";
    		var liicheck = lii.indexOf(liistr);
    		var liischeck = lii.indexOf(liisstr);
    		var liicheckw = lii.indexOf(liiwstr);
    		var liischeckw = lii.indexOf(liiwsstr);
    		if (liicheck !== 0 && liischeck !== 0 && liicheckw !==0 && liischeckw !==0) {
        		alert("Must be a valid linkedin URL");
        		return false;
    		}
		}
		if (gp) {
    		var gpstr = "http://plus.google.com/";
    		var gpsstr = "https://plus.google.com/";
    		var gpwstr = "http://plus.google.com/";
    		var gpwsstr = "https://plus.google.com/";
    		var gpcheck = gp.indexOf(gpstr);
    		var gpscheck = gp.indexOf(gpsstr);
    		var gpcheckw = gp.indexOf(gpwstr);
    		var gpscheckw = gp.indexOf(gpwsstr);
    		if (gpcheck !== 0 && gpscheck !== 0 && gpcheckw !==0 && gpscheckw !==0) {
        		alert("Must be a valid Google+ URL");
        		return false;
    		}
		}    	
	}
</script>
<div id = "main_content">
	<div id = "blog_content">
		<div id = "main_left">
			<article id = "article_post">
				
				<h1>Edit Profile</h1>
				
				
					<?php
					if (!isset($_COOKIE["rewards"])){
					echo 'Please sign in to your Social Rewards account to edit your profile.';
					
					
					}
					else {
					$userId = $_COOKIE["rewards"];
				
					$_SESSION['user']=$userId;
					global $wpdb;
					$getuser = $wpdb->get_row("SELECT * FROM nitro_userinfo WHERE nitro_id = '$userId'");
					$ID = $getuser->ID;
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
					if (empty($avatar)){
						$img= 'https://alln-extcloud-storage.cisco.com/ciscoblogs/nitro_users/empty.jpg';					
					}
					else {
						$img = 'https://alln-extcloud-storage.cisco.com/ciscoblogs/nitro_users/';
						$img.= $avatar;
					}
					
					?>
					
					<p>Your profile will appear instantly on the live site. Spam, promotional and derogatory content will be removed.</p>
				<form action="/wp-content/plugins/bunchball/edit_submit.php" method="post" id="edit_profile" name="edit_profile" onsubmit="return validateForm()">
				
			<div class="formelement">	
            	<label for="username">Username</label>
            	<span class = "perm"><?php echo $userId; ?></span>
            	<br class ="clear" />
            </div>
            <div class="formelement">
            	<label for="Name">Name</label>
            	<span class = "perm"><?php echo $firstname; echo ' '; echo $lastname; ?></span>
            	<br class ="clear" />
            </div>
            <div class="formelement">
            	<label for="Email">Email</label>
           		<span class = "perm"><?php echo $email;?></span>
           		<br class ="clear" />
           	</div>
           	<div class="formelement">
            <label for="avatar">Avatar</label>
            
            	
            	<div id = "oldphoto">
            	<img src="<?php echo $img; ?>">
            	</div>
            	<br class = "clear" />
            	<span class="upload_btn" onclick="show_popup('popup_upload')">Update photo</span>
            	<br />
            	
            <br class ="clear" />
            </div>
            <input id="imgfield" type="hidden" name="imgfield" value="<?php echo $avatar?>"/>
            <div class="formelement">
            	<label for="title">Title</label></dt>
            	<input id="title" type="text" name="title" value="<?php echo $title?>"/>
            	<br class ="clear" />
            </div>
            <div class="formelement">
            	<label for="bio">Bio</label>          
            	<textarea class="ckeditor" rows="10" cols="30" name = "bio"><?php echo $bio; ?></textarea> 
            	<br class ="clear" />
            </div>
            <div class="formelement">
            	<label for="facebook">Facebook URL</label>
            	<input id="facebook" type="text" name="facebook" value="<?php echo $facebook ?>"/>
            	<br class ="clear" />
            </div>
            <div class="formelement">
            	<label for="twitter">Twitter URL</label>
            	<input id="twitter" type="text" name="twitter" value="<?php echo $twitter ?>"/>
            	<br class ="clear" />
            </div>
            <div class="formelement">
            	<label for="linkedin">LinkedIn URL</label>
            	<input id="linkedin" type="text" name="linkedin" value="<?php echo $linkedin ?>"/>
            	<br class ="clear" />
            </div>
            <div class="formelement">
            	<label for="google">Google+ URL</label>
            	<input id="google" type="text" name="google" value="<?php echo $google ?>"/>
            	<br class ="clear" />
            </div>
        <input type="submit" value = "save" class = "profile_submit"/>
        <?php $url = site_url();
								$url.= "/rewards-profile/";
								$url.= $ID;
								$_SESSION['URL']=$url; ?>
								
        <a href = "<?php echo $url ?>" class = "cancel">Cancel</a>
        <div class = "clear"></div>

				</form>
				
				
			<!-- The popup for upload new photo -->
    <div id="popup_upload">
        <div class="form_upload">
            <span class="close" onclick="close_popup('popup_upload')">x</span>
            <h2>Upload photo</h2>
            <form action="/wp-content/plugins/bunchball/formfiles/upload_photo.php" method="post" enctype="multipart/form-data" target="upload_frame" onsubmit="submit_photo()">
                <input type="file" name="photo" id="photo" class="file_input">
                <div id="loading_progress"></div>
                <input type="submit" value="Upload photo" id="upload_btn">
            </form>
            <iframe name="upload_frame" class="upload_frame"></iframe>
        </div>
    </div>

    <!-- The popup for crop the uploaded photo -->
    <div id="popup_crop">
        <div class="form_crop">
            <span class="close" onclick="close_popup('popup_crop')">x</span>
            <h2>Crop photo</h2>
            <!-- This is the image we're attaching the crop to -->
            <img id="cropbox" />
            
            <!-- This is the form that our event handler fills -->
            <form>
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <input type="hidden" id="photo_url" name="photo_url" />
                <input type="button" value="Crop Image" id="crop_btn" onclick="crop_photo()" />
            </form>
        </div>
    </div>	
<?php	}	?>		



			</article>
		</div>
		<div id = "main_right">
		<?php include("sidebar.php"); ?>
	</div>
	<div class = "clear"></div>
	</div>
</div>