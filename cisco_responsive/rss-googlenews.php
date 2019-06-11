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
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
        <?php
        /**
         * Fires at the end of the RSS2 Feed Header.
         *
         * @since 2.0.0
         */
        do_action( 'rss2_head');

        while( have_posts()) { the_post();
        ?>
        <url>
    <loc><?php the_permalink_rss() ?></loc>
    <news:news>
      <news:publication>
        <news:name>Cisco Blogs</news:name>
        <news:language>en</news:language>
      </news:publication>
      <news:genres>Blog</news:genres>
      <news:publication_date><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></news:publication_date>
      <news:title><?php the_title_rss() ?></news:title>
      <news:keywords></news:keywords>
      <news:stock_tickers>NASDAQ:CSCO</news:stock_tickers>
    </news:news>
 


        <?php rss_enclosure();
        do_action( 'rss2_item' );
        ?>
         </url>
        <?php } ?>
        </urlset>
</channel>
</rss>
