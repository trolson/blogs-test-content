
<?php
define('WP_USE_THEMES', false);
	require_once('../../../wp-load.php');
?>
<script>
jQuery(function($) {
		var faqs = $(".faqs");
		faqs.children("dd").hide();
		faqs.children("dt")
			.css("cursor", "pointer")
			.click(function() {
				$(this).next("dd").slideToggle();
		});
	});
</script>
<p>Frequently Asked Questions (FAQs) about the Cisco Social Rewards program are listed below. Please note that we encourage honest participation and will be monitoring the community to ensure fair play. Only quality content will be rewarded here!</p>
						<dl class="faqs">
							<dt>Why should I participate in the Cisco Social Rewards program?</dt>
								<dd>To be recognized and rewarded for your participation and engagement on the Cisco blog site.  You are already participating why not get awarded for your hard work? </dd>
							<dt>Who can participate in the Cisco Social Rewards program?</dt>
								<dd>We encourage everyone, over the age of 18, to participate in the program including visitors to the site, Cisco bloggers and guest bloggers.</dd>
							<dt>What is a badge and how do I earn one?</dt>
								<dd> A badge is a virtual icon representation of a completed behavior. Users earn badges by participating on the Cisco blog site. This includes: viewing, commenting, sharing and more. Some badges contain multiple levels and some are single level badges. New badges and levels will be added over time and adjustments to the criteria may change. Please see the Available Badges tab for details on the specific badges the Cisco Social Rewards program offers.</dd>
							<dt>What is an Engagement Score and how do I earn one?</dt>
								<dd>An engagement score is earned by a user participating on the Cisco blog site and is represented by a virtual icon that changes as the user earns more points. Points are earned by participating on the Cisco blog site. This includes: earning badges, visiting, reading, sharing, publishing blog articles and more. The engagement score and associated points can be found on the engagement score tab.</dd>
							<dt>Can I change my username?</dt>
								<dd>Unfortunately, at this time your username cannot be changed. </dd>
							<dt>How do I remove myself from the Cisco Social Rewards program?</dt>
								<dd>Please contact <a href="mailto:socialrewards@cisco.com">socialrewards@cisco.com</a> to have your profile removed.</dd>
							<dt>Is the participation monitored?</dt>
								<dd>Yes, the site is monitored to encourage quality content and a positive environment. Cisco reserves the right to remove inappropriate content.</dd>
							<dt>How do I change my photo?</dt>
								<dd>You can update your photo at any time by uploading it to your profile page. All photos, titles and bios are reviewed before being displayed on the site.</dd>
						</dl>