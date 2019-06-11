<?php
	$category = get_the_category();
	$catid= $category[0]->cat_ID;
	if ($catid == 3) {
		$phone = 'EXT 124';
		$email = '000236901';
		$chat = '000236891';
	}
	elseif ($catid == 5) {
		$phone = 'EXT 122';
		$email = '000236877';
		$chat = '000236896';
	}
	elseif ($catid == 7) {
		$phone = 'EXT 111';
		$email = '000236899';
		$chat = '000236873';
	}
	elseif ($catid == 8) {
		$phone = 'EXT 125';
		$email = '000236882';
		$chat = '000236904';
	}
	elseif ($catid == 9) {
		$phone = 'EXT 115';
		$email = '000236903';
		$chat = '000236876';
	}
	elseif ($catid == 50) {
		$phone = 'EXT 112';
		$email = '000236888';
		$chat = '000236864';
	}
	elseif ($catid == 1853) {
		$phone = 'EXT 113';
		$email = '000236893';
		$chat = '000236870';
	}
	elseif ($catid == 1854) {
		$phone = 'EXT 118';
		$email = '000236867';
		$chat = '000236880';
	}
	elseif ($catid == 2051) {
		$phone = 'EXT 118';
		$email = '000236892';
		$chat = '000236865';
	}
	elseif ($catid == 3107) {
		$phone = 'EXT 118';
		$email = '000236868';
		$chat = '000236886';
	}
	elseif ($catid == 3108) {
		$phone = 'EXT 118';
		$email = '000236889';
		$chat = '000236883';
	}
	elseif ($catid == 3109) {
		$phone = 'EXT 118';
		$email = '000236872';
		$chat = '000236890';
	}

	elseif ($catid == 4362) {
		$phone = 'EXT 118';
		$email = '000236875';
		$chat = '000236898';
	}
	elseif ($catid == 4364) {
		$phone = 'EXT 116';
		$email = '000236863';
		$chat = '000236878';
	}
?>
<li class="widget contactus">

<!-- begin s01v8 -->
<migrate>
    <link rel="stylesheet" type="text/css" href="https://cisco.com/web/fw/w/cl/pilot/ml-base-pilot.css" />
    <link rel="stylesheet" type="text/css" href="https://cisco.com/assets/pilot/s01/s01-pilot.css" />
</migrate>
<div id="fw-mb-w1">
<div class="mlb-pilot s01-pilot s01v8-pilot">
    <h3 class="s01v8-title">Let Us Help</h3>
    <ul style="margin: -25px 0 0 -10px;">
				<br/>
				<li class="no-border"> <strong><a href="https://engage2demand.cisco.com/LP=567?ecid=136">Contact us</a></strong><br /><strong>Call us: 1-800-553-6387 <br /><?php echo $phone; ?></strong><br/>
        <span class="s01v8-smaller_text" >US/Can | 5am-5pm Pacific<br/>
        <a name="&amp;amp;lpos=sm_luh" href="https://www.cisco.com/web/siteassets/contacts/international.html?reloaded=true&campaign=ctctest&position=testa&creative=other+countries&country_site=us&referring_site=smb+series+models" target="_blank">Other Countries</a></span> <span class="s01v8-icon s01v8-phone"></span> </li>
    </ul>
</div> <!-- end s01v8 -->

</div>





<div class="clear"></div>
</li>
