<!DOCTYPE html>
<html lang="eng-US">
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="theme-color" content="#0d98be"/>
	<meta name="google-site-verification" content="7xOQ7euTYUaq8BiBRm4BZQp0syI9FwRWnYHszFDRp-s" />
	<title><?php if ( is_single() ) {  wp_title(''); } else if (is_category() ) { single_cat_title('Cisco '); echo ' Blog';} else {?>Cisco Blog<?php }?></title>
	<?php
	if(is_single()) {
		$post = get_post();
		$id = get_the_ID();
		$tags = get_the_tags($id);
		$category = get_the_category($id);
		$title = get_the_title();
		//$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );
		$text = wp_filter_nohtml_kses( get_the_excerpt($post->ID) );
		$image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' );
    	$image = $image_array[0];
		echo '<meta property="og:image" content="' . $image . '"/>';
		echo '<meta property="og:description" content="' . $text . '"/>';
		echo '<meta property="og:title" content="' . $title . '"/>';
		echo '<meta name="description" content="' . $text . '"/>';
		echo '<meta name="twitter:card" content="summary_large_image">';
		echo '<meta property="twitter:image" content="' . $image . '"/>';
    echo get_meta_concept();

		if ($post->post_date){
			echo '<meta name="blogsPostDate" content="' . $post->post_date . '"/>';
		}
		if ($post->post_author){
			echo '<meta name="blogsPostAuthor" content="' . get_the_author_meta('display_name', $post->post_author) . '"/>';
		}
		if (count($tags) > 0) {
			$tag_string = '';
			foreach($tags as $single_tag ) {
				$tag_string .= $single_tag->slug .',';
			}
			echo '<meta name="blogsPostTags" content="' . $tag_string . '"/>';
		}
		if ($category) {
			echo '<meta name="blogsPostCat" content="' . $category[0]->name . '"/>';
		}



	}
	else{
		echo '<meta property="og:image" content="https://blogs.cisco.com/wp-content/themes/cisco_brand/images/Cisco_Logo_RGB-2color_92x52.gif"/>';
		echo '<meta property="og:description" content=""/>';
		echo '<meta name="description" content=""/>';
	}
	?>
	<meta property="og:site_name" content="blogs@Cisco - Cisco Blogs"/>
	<meta name="google-site-verification" content="9MlQU9MMQ1jHLMUkONKe6QzZ-ZIGRv0BCD1_rY1Zdmc" />
	<?php if ($post->ID == 5882) {
		echo '<meta name="robots" content="noindex">';
	}?>
	<meta name="bitly-verification" content="25789e2a57d8"/>
	<meta name="accessLevel" content="GUEST, CUSTOMER, PARTNER"/>
	<meta name="language" content="en"/>
	<meta name="country" content="US"/>
	<meta name="contentType" content="ciscoBlogs"/>
	<?php if (is_author()) { ?>
		<meta name="docType" content="blogAuthorBio" />
	<?php } else { ?>
		<meta name="docType" content="blogPost" />
	<?php } ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="shortcut icon" href="//www.cisco.com/favicon.ico" />
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <script type='text/javascript' src="//www.cisco.com/etc/designs/cdc/clientlibs/responsive/js/web-component-foundation.min.js"></script>
  <script>
  /**
  * Invokes appropriate private methods based on input parameters based on needs of web component architecture
  * @param {Array} wcAssets array of strings that correlate to the names of web components or array of objects containing asset name and corresponding locale/path
  * @param {String} localePath specifies where web component should be retrieved from (expected format: en/us or en_au for all other locales); false if wcAssets, is array of objects
  * @param {Boolean} isWem [Optional] specifies if assets are being loaded on a WEM environment
  * @param {Boolean} needTargetter [Optional] specifies need for targetter bundle to be loaded (generally needed on external sites)
  * @param {Boolean} isRelative [Optional] specifies if asset path(s) should be relative
  * @param {String} env [Optional] specifies enviornment to append to relative path (should not be used with isRelative)
  * @param {Boolean} hasEnvOverride [Optional] specifies if environment needs to be overridden (should be used with env)
  */
  cdc.wcAncillaryAssetAllocator.init(['cdc-template-blogs','cdc-template'], 'en/us', false, true, false, 'prod');
  </script>

	<?php wp_head(); ?>


</head>
<body>
	<div id = "rewards_fix"></div>
	<?php if (function_exists('bunchball')) { nitro_js(); nitro_connect(); }
