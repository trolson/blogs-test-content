<?php
define('WP_USE_THEMES', false);
	require_once('../../../wp-load.php');
?>
<script> nitro.callAPI("method=user.getChallengeProgress&userId=AboutUsUser&showCanAchieveChallenge=true", "availableBadges"); </script>
						<ul id = "list">
						</ul>