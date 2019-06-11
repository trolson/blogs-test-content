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
                        <news:publication_date><?php echo the_time('Y-m-d'); ?></news:publication_date>
                        <news:title><?php the_title_rss() ?></news:title>
                        <?php
                        $tagstrings = wp_get_post_tags ($id);
    $result = '';
    foreach ($tagstrings as $tagstring) {
        $result .= $tagstring->name;
        $result .=', ';
    }
    ?>
                        <news:keywords><?php echo $result; ?></news:keywords>
                        <news:stock_tickers>NASDAQ:CSCO</news:stock_tickers>
                </news:news>        
        <?php rss_enclosure();
        do_action( 'rss2_item' );
        ?>
        </url>
        <?php } ?>
        </urlset>

