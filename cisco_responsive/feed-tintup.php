<?php
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

/**
 * Fires between the xml and rss tags in a feed.
 *
 * @since 4.0.0
 *
 * @param string $context Type of feed. Possible values include 'rss2', 'rss2-comments',
 *                        'rdf', 'atom', and 'atom-comments'.
 */
do_action( 'rss_tag_pre', 'rss2' );
?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	xmlns:tint="http://www.tintup.com/rss-ext/"
	<?php
	/**
	 * Fires at the end of the RSS root to add namespaces.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_ns' );
	?>
>

<channel>
	<title><?php wp_title_rss(); ?></title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<language><?php bloginfo_rss( 'language' ); ?></language>
	<sy:updatePeriod><?php
		$duration = 'hourly';

		/**
		 * Filter how often to update the RSS feed.
		 *
		 * @since 2.1.0
		 *
		 * @param string $duration The update period. Accepts 'hourly', 'daily', 'weekly', 'monthly',
		 *                         'yearly'. Default 'hourly'.
		 */
		echo apply_filters( 'rss_update_period', $duration );
	?></sy:updatePeriod>
	<sy:updateFrequency><?php
		$frequency = '1';

		/**
		 * Filter the RSS update frequency.
		 *
		 * @since 2.1.0
		 *
		 * @param string $frequency An integer passed as a string representing the frequency
		 *                          of RSS updates within the update period. Default '1'.
		 */
		echo apply_filters( 'rss_update_frequency', $frequency );
	?></sy:updateFrequency>
	<?php
	/**
	 * Fires at the end of the RSS2 Feed Header.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_head');

	while( have_posts()) { the_post();
	?>
	<item>
		<?php $group = get_the_author_meta(cisco_group); $title = get_the_author_meta(title); ?>
		<?php $content = get_the_content(); ?>
		<title><?php the_title_rss() ?></title>
		<?php if ( strlen( $content ) > 0 ){ ?>
		<description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
		<?php } else { ?>
		<description><![CDATA[<?php the_excerpt_rss(); ?>]]></description:encoded>
		<?php } ?>
		<link><?php the_permalink_rss() ?></link>
		<tint:post-image><?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing_image' ); echo $image[0]; ?></tint:post-image>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<author><?php the_author() ?></author>
		<tint:author-image><?php $thumb = get_the_author_meta(userphoto_thumb_file); echo site_url() . '/wp-content/uploads/userphoto/' . $thumb; ?></tint:author-image>		
		<tint:author-title><?php echo htmlspecialchars($title); ?></tint:author-title>

		<tint:author-group><?php echo htmlspecialchars($group); ?></tint:author-group>
		<guid><?php the_guid(); ?></guid>


	<?php rss_enclosure();
	do_action( 'rss2_item' );
	?>
	</item>
	<?php } ?>
</channel>
</rss>
