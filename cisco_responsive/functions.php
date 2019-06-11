<?php
@ini_set( 'upload_max_size' , '30M' );
@ini_set( 'post_max_size', '15M');
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('display_errors', 1);
// Basic theme stuff
//set max upload size to 30Megs
function wpse_70754_change_upload_size()
{
    return 31000 * 1024;
}
add_filter('upload_size_limit', 'wpse_70754_change_upload_size');
//Removes/filters out base64 inline images from post
add_filter('wp_insert_post_data', 'filter_base64_data_in_posts', 10, 2);
function filter_base64_data_in_posts($filtered_data, $raw_data){
    $filtered_data['post_content'] = preg_replace('#"data:image/[^;]+;base64, .*"(?s:.)#', '#BASE 64 NOT ALLOWED."', $filtered_data['post_content']);
    $filtered_data['post_content'] = preg_replace('#\'data:image/[^;]+;base64, .*\'(?s:.)#', '#BASE 64 NOT ALLOWED.\'', $filtered_data['post_content']);
    $filtered_data['post_content'] = preg_replace('#"image/[^;]+;base64, .*"(?s:.)#', '#BASE 64 NOT ALLOWED."', $filtered_data['post_content']);
    $filtered_data['post_content'] = preg_replace('#\'image/[^;]+;base64, .*\'(?s:.)#', '#BASE 64 NOT ALLOWED.\'', $filtered_data['post_content']);
    return $filtered_data;
}
add_theme_support( 'html5', array( 'search-form' ) );
function remove_wp_update_notice() {
    if ( !current_user_can('manage_options') ) {
        remove_action( 'admin_notices', 'update_nag', 3);
    }
}
wp_oembed_add_provider( '/https?:\/\/(.+)?(wistia.com|wi.st)\/(medias|embed)\/.*/', 'http://fast.wistia.com/oembed', true);
add_action('admin_init', 'remove_wp_update_notice');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
// Adding superscript buttons to tinyMCE
function my_mce_buttons_2($buttons) {
    /**
     * Add in a core button that's disabled by default
     */
    $buttons[] = 'superscript';
    $buttons[] = 'subscript';
    $buttons[] = 'code';
    return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');
add_filter('mce_buttons_2', 'my_mce_buttons_2');
/**
 * Remove login hints error messages at /wp-admin/.
 *
 */
function no_wordpress_errors(){
    return 'Please check your username and/or password. If you continue to have trouble logging in, please contact your administrator. <a href="/wp-login.php?action=lostpassword">Forgot Password or Username?</a>';
}
add_filter( 'login_errors', 'no_wordpress_errors' );
/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {
    register_sidebar( array(
        'name' => 'Right Sidebar',
        'id' => 'sidebar_right_1',
        'before_widget' => '<li class="widget">',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );
add_action( 'after_setup_theme', 'default_attachment_display_settings' );
/**
 * Set the Attachment Display Settings "Link To" default to "none"
 *
 * This function is attached to the 'after_setup_theme' action hook.
 */
function default_attachment_display_settings() {
    update_option( 'image_default_align', 'center' );
    update_option( 'image_default_link_type', 'none' );
    update_option( 'image_default_size', 'large' );
}
// Adding all the JS or CSS files, dependent on page
function cisco_blogs_scripts() {
    if( !is_admin() ){
        wp_enqueue_style( 'normalize', get_template_directory_uri() . '/normalize.css' );
        wp_enqueue_style( 'slidebarsstyle', get_template_directory_uri() . '/slidebars.css' );
        wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.js');
        wp_enqueue_script('slidebars', get_template_directory_uri() . '/js/slidebars.js', array( 'jquery'));
        wp_enqueue_script('lazyload', get_template_directory_uri() . '/js/jquery.lazyload.js', array( 'jquery'));
        wp_enqueue_script('theme_script', get_template_directory_uri() . '/js/theme_script.js', array( 'jquery'));
        wp_enqueue_script('cisco1', 'https://www.cisco.com/assets/swa/j/blogs.js', array( 'jquery'));
        wp_enqueue_script('tags', 'https://www.cisco.com/c/dam/cdc/t/ctm.js', array( 'jquery'));
        wp_enqueue_script('jquerytools', get_template_directory_uri() . '/js/jquery.tools.min.js', array( 'jquery'));
        wp_enqueue_script('tiptip', get_template_directory_uri() . '/js/jquery.tipTip.minified.js', array( 'jquery'));
        if (is_home()) {
            wp_enqueue_style( 'homepage', get_template_directory_uri() . '/styles/homepage.css' );
            wp_enqueue_script('home', get_template_directory_uri() . '/js/home.js', array( 'jquery-ui-tabs'));
            wp_enqueue_script('infinite', get_template_directory_uri() . '/js/jquery.jscroll.min.js', array( 'jquery'));
        }
        if (is_single()) {
            if ( in_category(16197) ) {
                wp_enqueue_style( 'single', get_template_directory_uri() . '/styles/talos_single.css' );
            }
            else {
                wp_enqueue_style( 'single', get_template_directory_uri() . '/styles/single.css' );
            }
            global $post;
            wp_localize_script('single', 'single_script_vars', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'post_id'=>$post->ID ) );
            wp_enqueue_script('twitter', 'https://platform.twitter.com/widgets.js');
            wp_enqueue_script('comment-reply', array( 'jquery'));
        }
        if (is_category() || is_page('archive')) {
            if (is_category('16197')) {
                wp_enqueue_style( 'category', get_template_directory_uri() . '/styles/talos_category.css' );
            }
            else {
                wp_enqueue_style( 'category', get_template_directory_uri() . '/styles/category.css' );
            }
            wp_enqueue_script('twitterfeed', get_template_directory_uri() . '/js/twitter_feed.js', array( 'jquery'));
            wp_enqueue_script('catscript', get_template_directory_uri() . '/js/category.js', array( 'jquery-ui-tabs'));
        }
        if (is_search() || is_tag()) {
            wp_enqueue_style( 'search', get_template_directory_uri() . '/styles/search.css' );
        }
        if (is_author()|| (is_page('Rewards Profile'))) {
            wp_enqueue_style( 'author', get_template_directory_uri() . '/styles/author.css' );
        }
        if (is_page('About Rewards')){
            wp_enqueue_style( 'aboutcss', get_template_directory_uri() . '/styles/about.css' );
            wp_enqueue_script('catscript', get_template_directory_uri() . '/js/category.js', array( 'jquery-ui-tabs'));
            wp_enqueue_script('leaderboard', bloginfo('url') . '/wp-content/plugins/bunchball/leaderboard.js', array( 'jquery'), '1.0.0', true);
        }
        if (is_page('edit rewards profile')) {
            wp_enqueue_style( 'form', get_template_directory_uri() . '/styles/edit_profile.css' );
            wp_enqueue_style( 'formstyle', bloginfo('url') . '/wp-content/plugins/bunchball/formfiles/css/style.css' );
            wp_enqueue_style( 'jscrop', bloginfo('url') . '/wp-content/plugins/bunchball/formfiles/css/jquery.Jcrop.min.css' );
            wp_enqueue_script('jcropscript', bloginfo('url') . '/wp-content/plugins/bunchball/formfiles/js/jquery.Jcrop.min.js', array( 'jquery'), '1.0.0', true);
            wp_enqueue_script('formscript', bloginfo('url') . '/wp-content/plugins/bunchball/formfiles/js/script.js', array( 'jquery'), '1.0.0', true);
            wp_enqueue_script('ckedit', bloginfo('url') . '/wp-content/plugins/bunchball/ckeditor/ckeditor.js', array( 'jquery'), '1.0.0', true);
        }
        if (is_404()) {
            wp_enqueue_style('404', get_template_directory_uri() . '/styles/404.css');
            wp_enqueue_style( 'homepage', get_template_directory_uri() . '/styles/homepage.css' );
            wp_enqueue_script('home', get_template_directory_uri() . '/js/home.js', array( 'jquery-ui-tabs'));
        }
    }
}
add_action( 'wp_enqueue_scripts', 'cisco_blogs_scripts' );
// Removing youtube from oembed because people complained
wp_oembed_remove_provider( 'http://youtube.com/*' );
wp_oembed_remove_provider( 'http://www.youtube.com/*' );
wp_oembed_remove_provider( 'https://youtube.com/*' );
wp_oembed_remove_provider( 'https://www.youtube.com/*' );
function hide_admin_bar(){ return false; }
add_filter( 'show_admin_bar', 'hide_admin_bar' );
// Featured image stuff
add_theme_support( 'post-thumbnails' );
add_action( 'after_setup_theme', 'baw_theme_setup' );
function baw_theme_setup() {
    add_image_size( 'listing_image', 460, 230, true ); // 300 pixels wide (and unlimited height)
    add_image_size( 'carousel_image', 1500, 560, true ); // (cropped) 456px before
    add_image_size( 'twitter_image', 600, 314, true ); // (cropped)
//remove_image_size('thumbnail');
}
add_action('do_meta_boxes', 'replace_featured_image_box');
function replace_featured_image_box(){
    add_meta_box('postimagediv', __('Article Image'), 'post_thumbnail_meta_box', 'post', 'side', 'default');
}
// Multiple Authors fix
add_action('do_meta_boxes', 'multiauthor_box');
function multiauthor_box() {
    add_meta_box('multiauthorimagediv', __('Other Authors'), 'post_multiauthors_meta_box', 'post', 'side', 'default');
}
function post_multiauthors_meta_box() {
    $postid = get_the_ID();
    //$custom_meta = get_post_meta( $postid, '_custom-author-box', true);
    $categories = get_the_category();
    $cat_id = $categories[0]->cat_ID;
    $catvalue = '"' . $cat_id . '"';
//echo $catvalue;
    global $wpdb;
    $myrows = $wpdb->get_results( "SELECT * FROM wp_usermeta WHERE meta_key = 'user_cats' AND meta_value LIKE '%$catvalue%'" );
    $authors = array();
    $editors = array();
    $accreditations = get_post_meta($postid, '_multiple_authors', false );
//echo $cat_id;
    foreach ($myrows as $myrow) {
        $user_id = $myrow->user_id;
        $lastname = 'last_name';
        $firstname = 'first_name';
        $userlevel1 = 'wp_user_level';
        $single = true;
        $user_first = get_user_meta( $user_id, $firstname, $single );
        $user_last = get_user_meta( $user_id, $lastname, $single );
        $user_roler = get_user_meta( $user_id, $userlevel1, $single );
        $username = $user_first . " " . $user_last; ?>
        <input type="checkbox" name="multiple_authors[]" value="<?php echo $user_id ?>" <?php checked(in_array( $user_id, $accreditations[0] ),true, true ); ?> /> <?php
        echo $username;
        echo '<br />';
    }
    ?>
    <?php
}
//function save_multiauthors_meta_box( $post_id, $post ) {
//Only expects one argument, death to post_ID.
function save_multiauthors_meta_box($post)
{
    global $post;
    // Get our form field
    if (isset($_POST['multiple_authors'])) {
        $custom = $_POST['multiple_authors'];
        update_post_meta($post->ID, '_multiple_authors', $custom);
    } else {
        //Can't delete something that doesn't exist {
        if (!empty($post)) {
            delete_post_meta($post->ID, '_multiple_authors');
        } else {
        }
    }
}
add_action('save_post', 'save_multiauthors_meta_box');
if (is_admin()) {
    function my_remove_meta_boxes()
    {
        //remove_meta_box('postexcerpt', 'post', 'normal');
        remove_meta_box('trackbacksdiv', 'post', 'normal');
        remove_meta_box('postcustom', 'post', 'normal');
        //remove_meta_box('slugdiv', 'post', 'normal');
    }
    add_action('admin_menu', 'my_remove_meta_boxes');
}
//Dealing with excerpt stuff
function excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}
function content($limit) {
    global $more; // Declare global $more (before the loop).
    $more = 1;
    $link = get_permalink();
    $content = explode(' ', get_the_content(), $limit);
    if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content);
    } else {
        $content = implode(" ",$content);
    }
    $content = preg_replace('/\[.+\]/','', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function cleaner($excerpt) {
    $U = explode(' ',$excerpt);
    $W =array();
    foreach ($U as $k => $u) {
        if (stristr($u,'httpv') || (count(explode('.',$u)) > 1)) {
            unset($U[$k]);
            return cleaner( implode(' ',$U));
        }
    }
    return implode(' ',$U);
}
function nm_carousel_excerpt_truncate($string,$length=205,$append="&hellip;") {
    $string = strip_tags($string);
    $string = trim($string);
    if(strlen($string) > $length) {
        $string = wordwrap($string, $length);
        $string = explode("\n", $string, 2);
        $string = $string[0] . $append;
    }
    return $string;
}
// Custom author link to platform
function custom_author_link() {
    $biolink = get_the_author_meta('platform_bio');
    if ($biolink) {
        echo '<a href = "';
        echo $biolink;
        echo '"target ="_blank" rel ="author" >';
        echo the_author_meta('first_name');
        echo ' ';
        echo the_author_meta('last_name');
        echo '</a>';
    }
    else {
        the_author_posts_link();
    }
}


function get_social_id($catid){
    global $wpdb;
    $social =$wpdb->get_row("SELECT * from wp_cisco_social WHERE wp_cisco_social.id =  '$catid'");
    return $social;
}

// The subscribe widget
function subscribe($catid){
    global $wpdb;
    if(is_home()||is_author()||is_search()||is_page()||is_tag()) {
        $text = 'Subscribe to Cisco Blogs';
    }
    else {
        $text = 'Subscribe to ' . get_cat_name($catid);
    }
    if($catid !== 3110) {
        $subscribe =$wpdb->get_row("SELECT * from wp_cisco_subscribe WHERE wp_cisco_subscribe.id = $catid");
        if ($subscribe->email_URI !== '') {
            ?>
            <li id="subscribe" class="widget">
                <h3><?php echo $text ?></h3>
                <div id="subscribe_box">
                    <form id ="subscribe_form" action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=<?php echo $subscribe->email_URI;?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
                        <input type="text" class="subscribe" name="email" value="Enter email address" onFocus="if(this.value == 'Enter email address') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Enter email address';}"></input>
                        <input type="hidden" value=<?php echo'"'; echo $subscribe->email_URI; echo '"';?> name="uri" ></input>
                        <input type="hidden" name="loc" value="en_US"></input>
                        <input type="submit" class="subscribe_button" value="Subscribe" ></input>
                        <div class="clear"></div>
                    </form>
                </div>
                <div class="clear"></div>
            </li>
        <?php } }
}
//decomissioned bunchball widget
function bye_bunchball($catid){
    ?>
    <li id = "nitroLoggedOut" class="widget">
        <div class = "consoleTitle">
            Cisco Social Rewards
        </div>
        <div class = "consoleTextNoLog">
            <p> The current version of the Social Rewards program was discontinued in August 2018. </p><p>
                Cisco Blogs is looking for better ways to engage our entire Cisco community across all Cisco properties. </p>
        </div>
        <?php echo '<a href = "' . site_url() . '/rewards-about" class="joinNow">Read More</a>'; ?>
        <div class = "consoleTextNoLog">
        </div>
    </li>
    <?php
}
/**
 * Cisco DECOMISSION Bunchball Widget Creation and Registration
 **/
function cisco_load_bye_bunchball_widget()
{
    register_widget('cisco_bye_bunchball_widget');
}
add_action('widgets_init', 'cisco_load_bye_bunchball_widget');
// Creating the widget
class cisco_bye_bunchball_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
// Base ID of your widget
            'cisco_bye_bunchball_widget',
// Widget name will appear in UI
            __('Cisco Decomission Bunchball', 'cisco_widget_domain'),
// Widget description
            array(
                'description' => __('Cisco is removing bunchball as part of our social strategy', 'cisco_widget_domain')
            ));
    }
// Creating widget front-end
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if(is_home() || is_author() || is_search() || is_page()) {
            $catid = 0;
        }
        elseif(is_category('security')){
            $catid = 50;
        }
        else {
            $category = get_the_category();
            $catid= $category[0]->cat_ID;
        }
        if ( $catid == 16197) {
            $catid = 50;
        }
        bye_bunchball($catid);
        echo $args['after_widget'];
    }
} // Class cisco_bye_bunchball_widget ends here
// The archives widget
function archivebox($catid){
    $params = array(
        'format' => 'option',
        'type' => 'monthly',
        'cat' => $catid,
        'show_post_count' => false,
        'echo' => 1
    );
    ?>
    <li id="archives" class="widget">
        <div id = "select_content">
            <div id = "archive_title">
                Archives
            </div>
            <div id = "styled_select">
                <select id="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
                    <option value="">Select</option>
                    <?php wp_get_archives($params); ?>
                </select>
            </div>
            <div class = "clear"></div>
        </div>
    </li>
    <?php
}
// The Follow us Widget
function follow($catid) {
    global $wpdb;
    if(is_home()||is_author()||is_search()||is_page()||is_tag()) {
        $social =$wpdb->get_row("SELECT * from wp_cisco_social WHERE wp_cisco_social.id = '0'");
    }
    else{
        $social =$wpdb->get_row("SELECT * from wp_cisco_social WHERE wp_cisco_social.id = $catid");
    }
    if(is_home()||is_author()||is_search()||is_page()||is_tag()) {
        $text = 'Connect with Cisco Blogs';
    }
    else {
        $text = 'Connect with ' . get_cat_name($catid);
    }
    $subscribe =$wpdb->get_row("SELECT * from wp_cisco_subscribe WHERE wp_cisco_subscribe.id = $catid");
    ?>
    <li id="social_widget" class="widget">
        <h3><?php echo $text ?></h3>
        <ul>
            <?php if ($catid == 16197) { ?>
                <li><a target='_blank' href="<?php echo $social->fb ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/follow_fb.svg" alt="Facebook"></a></li>
                <li><a target='_blank' href="<?php echo $social->tw ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/follow_tw.svg" alt="Twitter"></a></li>
                <li><a target='_blank' href="<?php echo $social->yt ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/follow_yt.svg" alt="YouTube"></a></li>
                <li><a href="http://feeds.feedburner.com/<?php echo $subscribe->rss_URI;?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/rss.svg" alt = "Rss"></a></li>
            <?php }
            else { ?>
                <li><a target='_blank' href="<?php echo $social->fb ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/follow_fb.svg" alt="Facebook"></a></li>
                <li><a target='_blank' href="<?php echo $social->tw ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/follow_tw.svg" alt="Twitter"></a></li>
                <li><a target='_blank' href="<?php echo $social->li ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/follow_li.svg" alt="Linkedin"></a></li>
                <li><a target='_blank' href="<?php echo $social->yt ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/follow_yt.svg" alt="YouTube"></a></li>
                <li><a target='_blank' href="<?php echo $social->ig ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/follow_ig.svg" alt="Instagram"></a></li>
                <li><a href="http://feeds.feedburner.com/<?php echo $subscribe->rss_URI;?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/rss.svg" alt = "Rss"></a></li>
            <?php } ?>
        </ul>
    </li>
    <?php
    if ($catid == 17762) {
        ?>
        <div class="widget_wearecisco" style="background-color:#005073;">
            <img class="widget_wearecisco_img" src="<?php bloginfo('stylesheet_directory'); ?>/img/1439865_Life-at-Cisco_Cisco-Careers_02.jpg" alt="Cisco Careers" />
            <h3 class="widget_wearecisco_h3_one">Cisco Careers</h3>
            <p class="widget_wearecisco_p_one">Be you. With Us. #WeAreCisco</p>
            <a class="button-one" name="Apply Now" title="Apply Now" href="https://www.cisco.com/c/en/us/about/careers.html?CAMPAIGN=talent&COUNTRY_SITE=us&POSITION=social+media+organic&REFERRING_SITE=blog&CREATIVE=careershomeAD&tags=blg%7Cad" target="_blank">Apply Now</a>
        </div>
        <div class="widget_wearecisco" style="background-color:#00bcea; margin-top:25px;">
            <img class="widget_wearecisco_img" src="<?php bloginfo('stylesheet_directory'); ?>/img/1439865_Life-at-Cisco_Why-Cisco_03.jpg" alt="Why Cisco" />
            <h3 class="widget_wearecisco_h3_two">Why Cisco?</h3>
            <p class="widget_wearecisco_p_two">What makes us unique?</p>
            <a class="button-two" name="Discover Cisco" title="Discover Cisco" href="https://www.cisco.com/c/en/us/about/careers/working-at-cisco.html?CAMPAIGN=talent&COUNTRY_SITE=us&POSITION=social+media+organic&REFERRING_SITE=blog&CREATIVE=workingatcisco&tags=blg%7Cad" target="_blank">Discover</a>
        </div>
        <?php
    }
}
// The Related links widget
function related_links($catid){
    global $wpdb;
    if ($catid==9){
        $wwrs1 =$wpdb->get_results("SELECT * from wp_cisco_wwreading WHERE wp_cisco_wwreading.id = 9101");
        $wwrs2 =$wpdb->get_results("SELECT * from wp_cisco_wwreading WHERE wp_cisco_wwreading.id = 9102");
        $wwrs3 =$wpdb->get_results("SELECT * from wp_cisco_wwreading WHERE wp_cisco_wwreading.id = 9103");
        $wwrs4 =$wpdb->get_results("SELECT * from wp_cisco_wwreading WHERE wp_cisco_wwreading.id = 9104");
        $rls =$wpdb->get_results("SELECT * from wp_cisco_relinks WHERE wp_cisco_relinks.id = 9 ORDER BY wp_cisco_relinks.link_text");
        ?>
        <li id="blogroll">
            <ul id="blogroll_links">
                <!--update the line below to change title for services page.-->
                <li class="roll_heading">What We're Reading</li>
                <li><b>General</b></li>
                <?php
                foreach ($wwrs1 as $wwr1) {
                    ?>
                    <li><a href="<?php echo $wwr1->link;?>" target="_blank"><?php echo $wwr1->link_text;?></a></li>
                    <?php
                }
                ?>
                <li><b>Video</b></li>
                <?php
                foreach ($wwrs2 as $wwr2) {
                    ?>
                    <li><a href="<?php echo $wwr2->link;?>" target="_blank"><?php echo $wwr2->link_text;?></a></li>
                    <?php
                }
                ?>
                <li><b>Mobility</b></li>
                <?php
                foreach ($wwrs3 as $wwr3) {
                    ?>
                    <li><a href="<?php echo $wwr3->link;?>" target="_blank"><?php echo $wwr3->link_text;?></a></li>
                    <?php
                }
                ?>
                <li><b>Data Center</b></li>
                <?php
                foreach ($wwrs4 as $wwr4) {
                    ?>
                    <li><a href="<?php echo $wwr4->link;?>" target="_blank"><?php echo $wwr4->link_text;?></a></li>
                    <?php
                }
                ?>
            </ul>
            <ul id="related_links">
                <li class="roll_heading">Related Links</li>
                <?php
                foreach ($rls as $rl) {
                    ?>
                    <li><a href="<?php echo $rl->link;?>" target="_blank"><?php echo $rl->link_text;?></a></li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <?php
    }
    elseif ($catid==14800){
        $wwrs1 =$wpdb->get_results("SELECT * from wp_cisco_wwreading WHERE wp_cisco_wwreading.id = 148001");
        $wwrs2 =$wpdb->get_results("SELECT * from wp_cisco_wwreading WHERE wp_cisco_wwreading.id = 148002");
        $rls =$wpdb->get_results("SELECT * from wp_cisco_relinks WHERE wp_cisco_relinks.id = 14800 ORDER BY wp_cisco_relinks.link_text");
        ?>
        <li id="blogroll">
            <ul id="blogroll_links">
                <li class="roll_heading">What We're Reading</li>
                <li><b>Oil and Gas</b></li>
                <?php
                foreach ($wwrs1 as $wwr1) {
                    ?>
                    <li><a href="<?php echo $wwr1->link;?>" target="_blank"><?php echo $wwr1->link_text;?></a></li>
                    <?php
                }
                ?>
                <li><b>Utilities</b></li>
                <?php
                foreach ($wwrs2 as $wwr2) {
                    ?>
                    <li><a href="<?php echo $wwr2->link;?>" target="_blank"><?php echo $wwr2->link_text;?></a></li>
                    <?php
                }
                ?>
            </ul>
            <ul id="related_links">
                <li class="roll_heading">Related Links</li>
                <?php
                foreach ($rls as $rl) {
                    ?>
                    <li><a href="<?php echo $rl->link;?>" target="_blank"><?php echo $rl->link_text;?></a></li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <?php
    }
    else{
        $wwrs =$wpdb->get_results("SELECT * from wp_cisco_wwreading WHERE wp_cisco_wwreading.id = $catid ORDER BY wp_cisco_wwreading.link_text");
        $rls =$wpdb->get_results("SELECT * from wp_cisco_relinks WHERE wp_cisco_relinks.id = $catid ORDER BY wp_cisco_relinks.link_text");
        if ($wwrs || $rls){
            ?>
            <li id="blogroll">
                <?php
                if ($wwrs){
                    ?>
                    <ul id="blogroll_links">
                        <?php
                        if ($catid==21743) { ?>
                            <li class="roll_heading">DevNet Dev Centers</li>
                        <?php }
                        else { ?>
                            <li class="roll_heading">What We're Reading</li>
                        <?php }
                        foreach ($wwrs as $wwr) {
                            ?>
                            <li><a href="<?php echo $wwr->link;?>" target="_blank"><?php echo $wwr->link_text;?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                if ($rls){
                    ?>
                    <ul id="related_links">
                        <li class="roll_heading">Related Links</li>
                        <?php
                        foreach ($rls as $rl) {
                            ?>
                            <li><a href="<?php echo $rl->link;?>" target="_blank"><?php echo $rl->link_text;?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </li>
            <?php
        }
    }
}
//user stuff
function remove_version() {
    return '';
}
add_filter('the_generator', 'remove_version');
/** Remove AIM, Jabber andY IM fields */
add_filter('user_contactmethods','hide_profile_fields',10,1);
function hide_profile_fields( $contactmethods ) {
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    return $contactmethods;
}
// Guest Blogger stuff
add_action('show_user_profile', 'guest_blogger_show');
add_action('edit_user_profile', 'guest_blogger_show');
function guest_blogger_show($user) {
    if ( current_user_can('edit_users') ) {
        ?>
        <h3>Other</h3>
        <label for="guest_blogger">
            Guest Blogger
            <?php
            echo '<input name="guest_blogger" type="checkbox" id="guest_blogger" value="yes"';
            if ($user->guest_blogger =='yes') {
                echo 'checked="checked"';
            }
            echo ' />';
            ?>
        </label>
        <br />
        <label for="featured_blogger">
            Featured Blogger
            <?php
            echo '<input name="featured_blogger" type="checkbox" id="featured_blogger" value="yes"';
            if ($user->featured_blogger =='yes') {
                echo 'checked="checked"';
            }
            echo ' />';
            ?>
        </label>
        <?php
    }
}
add_action('personal_options_update', 'guest_blogger_update');
add_action('edit_user_profile_update', 'guest_blogger_update');
function guest_blogger_update($user_id) {
    if (isset($_POST['guest_blogger'])){
        update_user_meta($user_id, 'guest_blogger', 'yes');
    }
    else {
        delete_user_meta($user_id, 'guest_blogger');
    }
    if (isset($_POST['featured_blogger'])){
        update_user_meta($user_id, 'featured_blogger', 'yes');
    }
    else {
        delete_user_meta($user_id, 'featured_blogger');
    }
}
/** Add Twitter and Facebook fields */
function my_new_contactmethods( $contactmethods ) {
//add Facebook
    $contactmethods['facebook'] = 'Facebook (Please Enter URL)';
// Add Title
    $contactmethods['title'] = 'Title';
// Add Cisco Group
    $contactmethods['cisco_group'] = 'Cisco Group';
// Add Category
    $contactmethods['category'] = 'Category';
// Add Twitter
    $contactmethods['twitter'] = 'Twitter (Please Enter URL)';
// Add LinkedIn
    $contactmethods['linkedin'] = 'LinkedIN (Please Enter URL)';
// Add Rewards ID
    $contactmethods['rewards_id'] = 'Rewards ID #';
// Add Link to external bio
    $contactmethods['platform_bio'] = 'Platform Bio Link';
    return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);
function custom_colors() {
    echo '<style type="text/css">
#rewards_id{display:none}
</style>';
    echo '<style type="text/css">
#platform_bio{display:none}
</style>';
    if ( current_user_can('edit_users') ) {
        echo '<style type="text/css">
#rewards_id{display:block}
</style>';
        echo '<style type="text/css">
#platform_bio{display:block}
</style>';
    }
}
add_action('admin_head', 'custom_colors');
// Featured Blogger stuff
function wp_user_query_random_enable($query) {
    if($query->query_vars["orderby"] == 'rand') {
        $query->query_orderby = 'ORDER by RAND()';
    }
}
add_filter('pre_user_query', 'wp_user_query_random_enable');
function featured_blogger() {
    $wp_user_query = new WP_User_Query( array( 'meta_key' => 'featured_blogger', 'meta_value' => 'yes', 'orderby' => 'rand', 'number' => 1 ) );
    $authors = $wp_user_query->get_results();
    foreach ($authors as $author){
        $img = $author->userphoto_image_file;
        if ($author->nitro_name) {
            $nitroName = $author->nitro_name;
        }
        echo '<div id = "featured_blogger">';
        echo '<div id = "featured_blogger_img">';
        echo '<img class = "img-circle" src = "https://alln-extcloud-storage.cisco.com/ciscoblogs/userphoto/' . $img . '">';
        echo '</div>';
        echo '<div id = "featured_blogger_content">';
        echo '<h3>Featured Blogger: ' . $author->display_name . '</h3>';
//removed nitro author name 8-8-18
        $text = $author->description;
        preg_match('/^([^.!?]*[\.!?]+){0,2}/', strip_tags($text), $abstract);
        echo '<p>' . $abstract[0] . '</p>';
        $userurl = get_author_posts_url($author->ID); ?>
        <a class="view_profile" href = "<?php echo $userurl;?>">View Profile<img class"right-arrow" src="<?php bloginfo('stylesheet_directory'); ?>/img/right-chevron.svg" alt="right-arrow" style="height:12px"></a>
        <?php
        echo '</div>';
        echo '<div class = "clear"></div>';
        echo '</div>';
    }
}
//featured author for the api endpoint /wp-json/ng-featured-route/v2/featured_author
function featured_blogger_api() {
    $wp_user_query = new WP_User_Query( array( 'meta_key' => 'featured_blogger', 'meta_value' => 'yes', 'orderby' => 'rand', 'number' => 1 ) );
    $authors = $wp_user_query->get_results();
    foreach ($authors as $author){
        $img = $author->userphoto_image_file;
//removed nitro author name 8-8-18
    }
    $author_img = "https://alln-extcloud-storage.cisco.com/ciscoblogs/userphoto/" . $img;
    $author_name = $author->display_name;
//$featured_layout = featured_author_layout($nitroName);
    $author_description = $author->description;
    preg_match('/^([^.!?]*[\.!?]+){0,2}/', strip_tags($author_description), $abstract);
    $author_summary = $abstract[0];
    $profile_url = get_author_posts_url($author->ID);
    $array_data = array("author_img"=>$author_img,"author_name"=>$author_name,"author_featured_layout"=>featured_author_layout($nitroName),"author_description"=>$author_description,"author_summary"=>$author_summary,"author_profile_url"=>$profile_url,"author_nitro_name"=>$nitroName);
    return $array_data;
}
// Search page 10 posts
function change_wp_search_size($query) {
    if(!is_admin()) {
        if ( $query->is_search )
            $query->query_vars['posts_per_page'] = 10;
        return $query;
    }}
add_filter('pre_get_posts', 'change_wp_search_size');
// Pagination on category pages
function rob_pagination($pages = '', $range = 9) {
    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) {
            $pages = 1;
        }
    }
    if(1 != $pages) {
        echo "<div class='pagination'>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a class='page_last' href='".get_pagenum_link(1)."'>&laquo;</a>";
        if($paged > 1 && $showitems < $pages) echo "<a class='page_last' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<a class='page_last' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
        echo "</div>\n";
    }
}
// The sponsored post stuff on front page
add_action( 'init', 'create_sponsored' );
function create_sponsored() {
    $labels = array(
        'name' => __( 'Sponsored Posts' ),
        'singular_name' => __( 'Sponsored Post' )
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'supports' => array('title','thumbnail','excerpt','page-attributes')
    );
    register_post_type( 'sponsored', $args);
    register_taxonomy_for_object_type( 'category', 'sponsored');
}
function link_get_meta( $value ) {
    global $post;
    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}
function link_add_meta_box() {
    add_meta_box(
        'link-link',
        __( 'Link', 'link' ),
        'link_link_html',
        'sponsored',
        'normal',
        'core'
    );
}
add_action( 'add_meta_boxes', 'link_add_meta_box' );
function link_link_html( $post) {
    wp_nonce_field( '_link_link_nonce', 'link_link_nonce' ); ?>
    <p>
        <label for="link_link_link_text"><?php _e( 'Link Text', 'link' ); ?></label><br>
        <input type="text" name="link_link_link_text" id="link_link_link_text" value="<?php echo link_get_meta( 'link_link_link_text' ); ?>">
    </p> <p>
    <label for="link_link_link_and_tracking_code"><?php _e( 'Link and tracking code', 'link' ); ?></label><br>
    <textarea name="link_link_link_and_tracking_code" id="link_link_link_and_tracking_code" ><?php echo link_get_meta( 'link_link_link_and_tracking_code' ); ?></textarea>
    </p><?php
}
function link_link_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['link_link_nonce'] ) || ! wp_verify_nonce( $_POST['link_link_nonce'], '_link_link_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post' ) ) return;
    if ( isset( $_POST['link_link_link_text'] ) )
        update_post_meta( $post_id, 'link_link_link_text', esc_attr( $_POST['link_link_link_text'] ) );
    if ( isset( $_POST['link_link_link_and_tracking_code'] ) )
        update_post_meta( $post_id, 'link_link_link_and_tracking_code', esc_attr( $_POST['link_link_link_and_tracking_code'] ) );
}
add_action( 'save_post', 'link_link_save' );
// Backend featured bloggers
add_action('admin_menu', 'featured_bloggers_setup_menu');
function featured_bloggers_setup_menu(){
    add_menu_page( 'Featured Bloggers Edit', 'Featured Bloggers', 'manage_options', 'featured_bloggers-plugin', 'featured_bloggers_init' );
}
function featured_bloggers_init(){
    echo '<h3>Featured Bloggers</h3>';
    $wp_user_query = new WP_User_Query( array( 'meta_key' => 'featured_blogger', 'meta_value' => 'yes') );
    $authors = $wp_user_query->get_results();
    echo '<ul>';
    foreach ($authors as $author){
        echo '<li>';
        echo '<a href = "' . get_site_url() . '/wp-admin/user-edit.php?user_id=' . $author->ID . '">' . $author->display_name . '</a>';
        echo'</li>';
    }
}
// Custom Comments List.
function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <?php
    $commentID = get_comment_ID();
    if (function_exists('bunchball')) {
        comment_layout($commentID, $args, $depth);
    }
    else {
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>">
                <div class="comment_image">
                    <?php echo get_avatar($comment,$size='54',$default='<path_to_url>' ); ?>
                </div>
                <div class="comment_act">
                    <div class="comment_user_info">
                        <span class="fn"><?php comment_author_link() ?></span>
                        <span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),' ','') ?></span>
                        <div class="reply">
                            <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div>
                    </div>
                    <div class="comment_text">
                        <?php if ($comment->comment_approved == '0') { ?>
                            <em class="approved"><?php _e('Your comment is awaiting moderation.') ?></em>
                            <br />
                        <?php } ?>
                        <?php comment_text() ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </li>
        <?php
    }
}

// Post excerpt by post ID
function get_excerpt_by_id($post_id){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 35; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);
    if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    endif;
    $excerpt2 = preg_replace('".*/"', '', $the_excerpt );
    return $excerpt2;
}
//facebook excerpt
function addfb() {
    if (is_single() ){
        $post_id = get_the_ID();
        $desc = get_excerpt_by_id($post_id);
        echo '<meta property="og:description" content="' . $desc . '"/>';
    }
}

//gets the url of a post
function get_share_link(){
    $postid = get_the_ID();
    $sharelink = get_permalink($postid);
    return $sharelink;
}

// gets title of a post
function get_share_title(){
    $postid = get_the_ID();
    $sharetitle = get_the_title($postid);
    return $sharetitle;
}

//composes tweet based off of post excerpt or custom tweet text
function get_twitter_link(){
  $category = get_the_category();
  $catid= $category[0]->cat_ID;
  global $wpdb;
  $via =$wpdb->get_row("SELECT * from wp_cisco_social WHERE wp_cisco_social.id = $catid");
  $twit = $via->tw_handle;
  $postid = get_the_ID();
  $bitlylink = get_post_meta ($postid, '_bitly_shortlink', true);
  if ( $bitlylink !=='') {
    $postBit = $bitlylink;
  }
  else {
    $postBit = get_permalink($postid);
  }

  $excerpt1 = get_excerpt_by_id($postid);
  $excerpt1 = str_replace(array("\n", "\r"), '', $excerpt1);


  $customuser = get_post_meta ($postid, 'twitter_username', true );
  $customuser = str_replace(chr(64), '', $customuser);
  $customtweet2 = get_post_meta ($postid, 'custom_tweet', true );
  $customtweet = urlencode($customtweet2);

    if ($customuser and $customtweet !=='') {
        $tweetuser = $customuser;
        $tweettext = $customtweet;
    }
    elseif ($customuser !=='' and $customtweet =='') {
      $tweetuser = $customuser;
      $tweettext = get_the_title($postid);

    }
    elseif ($customuser =='' and $customtweet !=='') {
      $tweetuser = $twit;
      $tweettext = $customtweet;
    }
    else{
      $tweetuser = $twit;
      $tweettext = get_the_title($postid);
    }

    $tweettext = str_replace("amp%3B","",$tweettext);
    $tweettext = str_replace("&#38;","",$tweettext);
    $tweettext = str_replace("&","%26",$tweettext);
    $tweettext = str_replace("#038;","",$tweettext);


    $twitterlink = 'https://twitter.com/intent/tweet?url=' . $postBit . '&text=' . $tweettext . '&via=' . $tweetuser;

    return $twitterlink;

}


// The floating share bar or desktop
function share() {
  $sharelink = get_share_link();
  $sharetitle = get_share_title();
  $twitterlink = get_twitter_link();
  ?>
  <div id="share_bar1">

    <span class = "share_title">Share</span>
    <div class="twitter">
      <div class = "box">
        <a class = "share" href="<?php echo $twitterlink ?>" data-config-metrics-group='social_shares' data-config-metrics-title='twitter_shares' data-config-metrics-item='twitter_share'>  <img class="share_image" src="<?php bloginfo('stylesheet_directory'); ?>/img/share_tw_white.svg" alt="share on twitter"></img></a>

      </div>
    </div>

    <div class="facebook">
      <div class = "box">
        <a class = "share" href = "http://www.facebook.com/sharer/sharer.php?u=<?php echo $sharelink; ?>&title=<?php echo $sharetitle; ?>" data-config-metrics-group='social_shares' data-config-metrics-title='facebook_shares' data-config-metrics-item='facebook_share' onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img class="share_image" src="<?php bloginfo('stylesheet_directory'); ?>/img/share_fb_white.svg" alt="share on facebook"></a>
      </div>
    </div>


    <div class="linkedin">
      <div class = "box">
        <a class = "share" href = "https://www.linkedin.com/cws/share?url=<?php echo $sharelink ?>" data-title=" " data-config-metrics-group='social_shares' data-config-metrics-title='linkedin_shares' data-config-metrics-item='linkedin_share' onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img class="share_image" src="<?php bloginfo('stylesheet_directory'); ?>/img/share_li_white.svg" alt="share on linkedin"></a>
      </div>
    </div>

    <?php
    $categorymail = get_the_category();
    $catmail= $categorymail[0]->cat_name;
    ?>
    <div class = "mail">
      <div class = "box">
      <a class="share" href="mailto:?subject=Cisco Blog: <?php the_title();?>&body=I saw this post on Cisco <?php echo $catmail; ?> blog and thought you might like to read it.%0A%0A<?php the_title();?>%0A%0A<?php (the_permalink()); ?>%0A%0A****Disclaimer****%0A%0ACisco is not responsible for the content of this email, and its contents do not necessarily reflect Cisco’s views or opinions. Cisco has not verified the email address or name of the sender." data-config-metrics-group='social_shares' data-config-metrics-title='email_shares' data-config-metrics-item='email_share'> <img class="share_image" src="<?php bloginfo('stylesheet_directory'); ?>/img/share_email_white.svg"> </a>
    </div>

    </div>
    <div class = "clear"></div>
  </div>
  <?php
}


//share bar for tablet and mobile pages
function share_small(){
  $sharelink = get_share_link();
  $sharetitle = get_share_title();
  $twitterlink = get_twitter_link();
?>
 <br>
  <div class = "share_text">Share:</div>
  <div id="share_bar2">

    <div class="twitter">
      <div class = "box">
        <a class = "share" href="<?php echo $twitterlink ?>" data-config-metrics-group='social_shares' data-config-metrics-title='twitter_shares' data-config-metrics-item='twitter_share'>  <img class="share_image" src="<?php bloginfo('stylesheet_directory'); ?>/img/share_tw_navy.svg" alt="share on twitter"></img></a>

      </div>
    </div>

    <div class="facebook">
      <div class = "box">
        <a class = "share" href = "http://www.facebook.com/sharer/sharer.php?u=<?php echo $sharelink; ?>&title=<?php echo $sharetitle; ?>" data-config-metrics-group='social_shares' data-config-metrics-title='facebook_shares' data-config-metrics-item='facebook_share' onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img class="share_image" src="<?php bloginfo('stylesheet_directory'); ?>/img/share_fb_navy.svg" alt="share on facebook"></a>
      </div>
    </div>


    <div class="linkedin">
      <div class = "box">
        <a class = "share" href = "https://www.linkedin.com/cws/share?url=<?php echo $sharelink ?>" data-title=" " data-config-metrics-group='social_shares' data-config-metrics-title='linkedin_shares' data-config-metrics-item='linkedin_share' onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img class="share_image" src="<?php bloginfo('stylesheet_directory'); ?>/img/share_li_navy.svg" alt="share on linkedin"></a>
      </div>
    </div>

    <?php
    $categorymail = get_the_category();
    $catmail= $categorymail[0]->cat_name;
    ?>
    <div class = "mail">
      <div class = "box">
      <a class="share" href="mailto:?subject=Cisco Blog: <?php the_title();?>&body=I saw this post on Cisco <?php echo $catmail; ?> blog and thought you might like to read it.%0A%0A<?php the_title();?>%0A%0A<?php (the_permalink()); ?>%0A%0A****Disclaimer****%0A%0ACisco is not responsible for the content of this email, and its contents do not necessarily reflect Cisco’s views or opinions. Cisco has not verified the email address or name of the sender." data-config-metrics-group='social_shares' data-config-metrics-title='email_shares' data-config-metrics-item='email_share'> <img class="share_image" src="<?php bloginfo('stylesheet_directory'); ?>/img/share_email_navy.svg"> </a>
    </div>

    </div>
    <div class = "clear"></div>
  </div>

  <br>
<?php
}

//Custom tweet stuff
add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add() {
    add_meta_box( 'custom_twitter', 'Custom Tweet', 'cd_meta_box_cb', 'post', 'side', 'core' );
}
function cd_meta_box_cb( $post ){
    $values = get_post_custom( $post->ID );
    $name = isset( $values['twitter_username'] ) ? esc_attr( $values['twitter_username'][0] ) : '';
    $custom_tweet = isset( $values['custom_tweet'] ) ? esc_attr( $values['custom_tweet'][0] ) : '';
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="twitter_username">Twitter Username</label>
        <input type="text" name="twitter_username" id="twitter_username" value="<?php echo $name; ?>" />
    </p>
    <p>
        <label for="custom_tweet">Custom Tweet</label>
        <textarea rows="4" cols="30" name="custom_tweet" id="custom_tweet" maxlength="246"><?php echo $custom_tweet; ?></textarea>
    </p>
    <?php
}
add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id ){
// Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
// if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
// if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
// now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );
// Probably a good idea to make sure your data is set
    if( isset( $_POST['twitter_username'] ) )
        update_post_meta( $post_id, 'twitter_username', wp_kses( $_POST['twitter_username'], $allowed ) );
    if( isset( $_POST['custom_tweet'] ) )
        update_post_meta( $post_id, 'custom_tweet', wp_kses( $_POST['custom_tweet'], $allowed ) );
}
function example_image_enqueue() {
    global $typenow;
    if( $typenow == 'post' ) {
        wp_enqueue_media();
// Registers and enqueues the required javascript.
        wp_register_script( 'meta-image', get_stylesheet_directory_uri() . '/js/meta-image.js', array( 'jquery' ) );
        wp_localize_script( 'meta-image', 'meta_image',
            array(
                'title' => 'Choose or Upload an Image',
                'button' => 'Use this image',
            )
        );
        wp_enqueue_script( 'meta-image' );
    } // End if
} // End example_image_enqueue()
add_action( 'admin_enqueue_scripts', 'example_image_enqueue' );
function twitter_card(){
    if (is_single()) {
        global $post;
        $post_id = $post->ID;
        $category = get_the_category();
        $cat_id = $category[0]->term_id;
        $my_excerpt = get_excerpt_by_id($post_id);
        $title = get_the_title($post_id);
        global $wpdb;
        $via =$wpdb->get_row("SELECT * from wp_cisco_social WHERE wp_cisco_social.id = $cat_id");
        $meta_value1 = get_post_meta( get_the_ID(), 'meta-text', true );
// Checks and displays the retrieved value
        if( $meta_value1 !=='' ) {
            $twitboxuser = $meta_value1;
        }
        else {
            $twitboxuser = '@' . $via->tw_handle . '';
        }
        $meta_value2 = get_post_meta( get_the_ID(), 'meta-image', true );
        echo '<meta name="twitter:card" content="summary">';
        echo '<meta name="twitter:site" content="@CiscoBlogs">';
        echo '<meta name="twitter:creator" content="' . $twitboxuser . '">';
        echo '<meta name="twitter:title" content="' . $title . '">';
        echo '<meta name="twitter:description" content="' . $my_excerpt . '">';
        if( $meta_value2 !=='' ) {
            $twitboximage = $meta_value2;
            echo '<meta name="twitter:image" content="' . $twitboximage . '">';
        }
    }
    else if (is_category()) {
        global $wpdb;
        $category = get_the_category();
        $cat_id = $category[0]->term_id;
        $cat_name =$category[0]->cat_name;
        $via =$wpdb->get_row("SELECT * from wp_cisco_social WHERE wp_cisco_social.id = $cat_id");
        $twitboxuser = '@' . $via->tw_handle . '';
        echo '<meta name="twitter:card" content="summary">';
        echo '<meta name="twitter:site" content="@CiscoBlogs">';
        echo '<meta name="twitter:creator" content="' . $twitboxuser . '">';
        echo '<meta name="twitter:title" content="' . $cat_name . '">';
        echo '<meta name="twitter:description" content="Cisco Blogs ' . $cat_name . '">';
    }
    else {
        echo '<meta name="twitter:card" content="summary">';
        echo '<meta name="twitter:site" content="@CiscoBlogs">';
        echo '<meta name="twitter:creator" content="@CiscoBlogs">';
        echo '<meta name="twitter:title" content="Cisco Blogs">';
        echo '<meta name="twitter:description" content="Welcome to Cisco Blogs">';
    }
}
//Storify  -- storify was deprecated in May 2018//
function storify_embed_the_content($content) {
    $ex = "/\<p\>(https?\:\/\/(?:www\.)?storify\.com\/(?:[^\/]+)\/(?:[^\/]+))\/?\<\/p\>/i";
    $replacement = '<script type="text/javascript" src="${1}.js"></script>';
    return preg_replace($ex, $replacement, $content);
}
add_filter('the_content', 'storify_embed_the_content');
function storify_shortcode($atts) {
    return '<script type="text/javascript" src="' . $atts['url'] . '.js"></script>';
}
add_shortcode('storify', 'storify_shortcode');
function cc_media_default() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){ wp.media.controller.Library.prototype.defaults.contentUserSetting=false; });
    </script>
    <?php
}
add_action( 'admin_footer-post-new.php', 'cc_media_default' );
add_action( 'admin_footer-post.php', 'cc_media_default' );
function bitly(){
    global $post;
    $post_id = $post->ID;
    //regular post URL
    $url2 = get_permalink($post_id);
    $access_token = '7f6e43c582729cc5cbb3f7dc6f2d1b9324b8edea';
    $domain ='bit.ly';
    //API Url for creating bitly URL with our post's URL
    $url = 'https://api-ssl.bitly.com/v3/shorten?access_token='.$access_token.'&longUrl='.urlencode($url2).'&domain='.$domain;
    try {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $output = json_decode(curl_exec($ch));
    } catch (Exception $e) {
    }
    //If bitly produces a response then the bitly url is that response
    if(isset($output)){$bitly = $output->data->url;}
    //else the 'bitly' url is just the regular post URL
    else { $bitly = $url2;}
  //_bitly_shortlink is added to the posts meta data in the wp_postmeta table of the database
    add_post_meta( $post_id, '_bitly_shortlink', $bitly, true );
}
//This function is called upon new post creation
add_action('publish_post', 'bitly');
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
    if ( ! is_admin() ) {
        global $id;
        $comment_list = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($comment_list);
        return count($comments_by_type['comment']);
    }
    else {
        return $count;
    }
}
// Allow editors to get comment notifications from their categories
function editoremail($comment_id) {
    global $wpdb;
    $comment = get_comment($comment_id);
    $post = get_post($comment->comment_post_ID);
    $admin_email = get_option('admin_email');
    $siteurl = get_option('siteurl');
    $post_id = $post->ID;
    $post_categories = wp_get_post_categories( $post_id );
    $cats = array();
    $editors = array();
    foreach($post_categories as $cat){
        $cat_id = $cat->cat_ID;
        $catvalue = '"' . $cat_id . '"';
        $cats[] = array( 'ID' => $catvalue);
        global $wpdb;
        $myrows = $wpdb->get_results( "SELECT * FROM wp_usermeta WHERE meta_key = 'user_cats' AND meta_value LIKE '%$catvalue%'" );
        foreach ($myrows as $myrow) {
            $user_id = $myrow->user_id;
            $userlevel1 = 'wp_user_level';
            $user_roler = get_user_meta( $user_id, $userlevel1, $single );
            $single = true;
            $editor_query = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE ID = $user_id;");
            $editor_email = $editor_query->user_email;
            if ($user_roler >6){
                $editors[] = $editor_email;
            }
        }
    }
    $result = array_unique($editors);
    $editorsmail = implode(", ",$result);
    $comment_author_domain = @gethostbyaddr($comment->comment_author_IP);
    $notify_message = sprintf( __('A new comment on the post #%1$s "%2$s"'), $cat_id, $post->post_title ) . "\r\n";
    $notify_message .= get_permalink($comment->comment_post_ID) . "\r\n\r\n";
    $notify_message .= sprintf( __('Author : %1$s (IP: %2$s , %3$s)'), $comment->comment_author, $comment->comment_author_IP, $comment_author_domain ) . "\r\n";
    $notify_message .= sprintf( __('E-mail : %s'), $comment->comment_author_email ) . "\r\n";
    $notify_message .= sprintf( __('URL : %s'), $comment->comment_author_url ) . "\r\n";
    $notify_message .= sprintf( __('Whois : http://ws.arin.net/cgi-bin/whois.pl?queryinput=%s'), $comment->comment_author_IP ) . "\r\n";
    $notify_message .= __('Comment: ') . "\r\n" . $comment->comment_content . "\r\n\r\n";
    $notify_message .= sprintf( __('Delete it: %s'), "$siteurl/wp-admin/comment.php?action=cdc&c=$comment_id" ) . "\r\n";
    $notify_message .= sprintf( __('Spam it: %s'), "$siteurl/wp-admin/comment.php?action=cdc&dt=spam&c=$comment_id" ) . "\r\n";
    $subject = sprintf( __('[%1$s] A new comment has been posted: "%2$s"'), get_option('blogname'), $post->post_title );
    $notify_message = apply_filters('comment_moderation_text', $notify_message, $comment_id);
    $subject = apply_filters('comment_moderation_subject', $subject, $comment_id);
    $testmail = 'robertkristie@comcast.net, rob.kristie@quikpixel.com';
    @wp_mail($editorsmail, $subject, $notify_message);
}
add_action('comment_post', 'editoremail');
// Removing quickpress because people break stuff
function remove_quickpress() {
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
add_action('wp_dashboard_setup', 'remove_quickpress' );
//Hiding private posts because people break stuff
function hide_private_post() {
    if( is_admin() ) {
        global $pagenow;
        if( 'edit.php' == $pagenow || 'post-new.php' == $pagenow || 'post.php' == $pagenow) {
            echo '<style type="text/css">';
            echo 'a.edit-visibility {display:none;}';
            echo '</style>';
        }
    }
}
add_action( "admin_head", "hide_private_post" );

// Adding function to see if it is Talos
function is_subcategory (){
    $cat = get_query_var('cat');
    $category = get_category($cat);
    $category->parent;
    return ( $category->parent == '0' ) ? false : true;
}
// Video checkbox
add_action('do_meta_boxes', 'video_box');
function video_box()
{
    add_meta_box('videodiv', __('Video'), 'post_video_meta_box', 'post', 'side', 'core');
}
function post_video_meta_box() {
    $postid = get_the_ID();
    $custom_meta = get_post_meta( $postid, 'video', true);
    ?>
    <input type="checkbox" name="video" value="yes" <?php if ( $custom_meta == "yes" ) echo 'checked="checked"'; ?> />Video
    <?php
}
function save_video_meta_box($post)
{
    global $post;
    // Get our form field
    if (isset($_POST['video'])) {
        update_post_meta($post->ID, 'video', 'yes');
    } else {
        //Can't delete something that doesn't exist {
        if (!empty($post)) {
            delete_post_meta($post->ID, 'video');
        } else {
        }
    }
}
add_action('save_post', 'save_video_meta_box');
// Custom RSS feeds for tintup and google news
add_action('init', 'customRSS');
add_action('init', 'customRSS2');
function customRSS(){
    add_feed('tintup', 'customRSSFunc');
}
function customRSS2(){
    add_feed('googlenews', 'customRSSFunc2');
}
function customRSSFunc(){
// get_template_part('feed', 'tintup');
}
function customRSSFunc2(){
    get_template_part('feed', 'googlenews');
}
// OVP embed
function ovp_shortcode( $attr, $content = null ) {
    return '<iframe src="//players.brightcove.net/1384193102001/41XYD7gTx_default/index.html?videoId=' . $content . '" allowfullscreen webkitallowfullscreen mozallowfullscreen width="640" height="360"></iframe>';
}
add_shortcode('ovp', 'ovp_shortcode');
function ovp360_shortcode( $attr, $content = null ) {
    return '<iframe src="//players.brightcove.net/1384193102001/rJAQO0Z8_default/index.html?videoId=' . $content . '" width="640" height="360" allowfullscreen="allowfullscreen"></iframe>';
}
add_shortcode('ovp360', 'ovp360_shortcode');
// Allow Contributors to Add Media
function allow_contributor_uploads() {
    $contributor = get_role('contributor');
    $contributor->add_cap('upload_files');
}
if ( current_user_can('contributor') && !current_user_can('upload_files') ) {
    add_action('admin_init', 'allow_contributor_uploads');
}
// Changing name of image uploads to avoid conflicts
function wp_modify_uploaded_file_names($file) {
    $info = pathinfo($file['name']);
    $ext = empty($info['extension']) ? '' : '.' . $info['extension'];
    $name = basename($file['name'], $ext);
    $file['name'] = uniqid() . $ext; // uniqid method
// $file['name'] = md5($name) . $ext; // md5 method
// $file['name'] = base64_encode($name) . $ext; // base64 method
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'wp_modify_uploaded_file_names', 1, 1);
/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function recent_add_dashboard_widget() {
    add_meta_box('recent_dashboard_widget', 'What\'s New with Cisco Blogs', 'recent_dashboard_widget_function', 'dashboard', 'side', 'high');
}
add_action( 'wp_dashboard_setup', 'recent_add_dashboard_widget' );
/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function recent_dashboard_widget_function() {
// Display recent developments page
    $post = get_page_by_title('Recent updates from the development team');
    if( $post ) {
        $content = $post->post_content;
        $content = apply_filters('the_content', $content);
        $output = "<h3>{$post->post_title}</h3><p>{$content}</p>";
    }
//display form for user feedback
    echo "<div class='feature_post_class_wrap'>
<label style='background:#ccc;'>$output</label>
</div>
<p> <b>Have any feedback or ideas for new features on Cisco Blogs? <br> Let us know and we'll get back to you via email! </b></p>
<form action='index.php' method='post' name='feedbackForm'>
<textarea name='feedback' type='text' id='feedback' value=' ' class='regular-text'></textarea><br>
<input type='submit' name='submit' id='submit' class='button button-primary' value='Submit'></p></form>";
//gather form info and send feedback to blog devs
    $current_user = wp_get_current_user();
    $fname = $current_user->user_firstname;
    $lname = $current_user->user_lastname;
    $uemail = $current_user->user_email;
    if ($_POST['feedback']){
        $feedback = ' From: ' . $fname . ' '. $lname .' <'.$uemail.'>' . "\r\n" . "\r\n" . $_POST['feedback'];
        wp_mail( 'blogs-support@cisco.com', 'Blog Feedback', $feedback);
    }
}
//add_action( 'wp_dashboard_setup', 'prefix_add_dashboard_widget' );   //this was causing error: Warning: call_user_func_array() expects parameter 1 to be a valid callback, function 'prefix_add_dashboard_widget' not found or invalid function name in /var/www/html/wp-includes/class-wp-hook.php on line 286
// This will occur when the comment is posted
function plc_comment_post( $incoming_comment ) {
// convert everything in a comment to display literally
    $incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);
// the one exception is single quotes, which cannot be #039; because WordPress marks it as spam
    $incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );
    return( $incoming_comment );
}
// This will occur before a comment is displayed
function plc_comment_display( $comment_to_display ) {
// Put the single quotes back in
    $comment_to_display = str_replace( '&apos;', "&#039;", $comment_to_display );
    return $comment_to_display;
}
add_filter( 'preprocess_comment', 'plc_comment_post', '', 1);
add_filter( 'comment_text', 'plc_comment_display', '', 1);
add_filter( 'comment_text_rss', 'plc_comment_display', '', 1);
add_filter( 'comment_excerpt', 'plc_comment_display', '', 1);
//update the login page to include the cisco logo
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/Cisco_logo.svg);
            height:85px;
            width:130px;
            background-size: 130px 68.9px;
            background-repeat: no-repeat;
            padding-bottom: 20px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
// updates the logo to direct to the blog home page when clicked
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

//gets the slug category ID

function get_term_id(){
	global $wp;
	//get the url of the page
		$current_url = home_url(add_query_arg(array(),$wp->request));
	//break the url into an array by the delimiter '/'
	    $array_parts = explode('/',$current_url);
	//get location of the category within the array (2nd from the end). This ensures that the code will work on localhost (where there is an extra folder in url)
		$array_parts_size = sizeof($array_parts)-2;
	//get the category slug out of the array
		$category_slug_in_url = $array_parts[$array_parts_size];
	//now check if the category slug actually exists in the database
		$term_id_from_url = term_exists($category_slug_in_url);
		if (empty($term_id_from_url)){
			$term_id_from_url = '';
		}
	return $term_id_from_url;
}

//dispalys a specified number of posts when called
function fill_posts($posts_per_page, $cat_id) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args =array(
        'category__not_in' =>5555,
        'category__in' => $cat_id,
        'post__not_in' => get_option( 'sticky_posts' ),
        'pagination' => true,
        'paged' => $paged,
        'ignore_sticky_posts' =>1,
        'posts_per_page' => $posts_per_page
    );
    return $args;
}
// Define the custom excerpt length
$custom_excerpt_length = 30;
add_filter( 'wp_insert_post_data', 'auto_populate_excerpt', 99, 2 );
/**
 * Checks if the the post has excerpt or not
 */
function auto_populate_excerpt( $data, $postarr )
{
    global $custom_excerpt_length;
// check if it's a valid call
    if ( !in_array( $data['post_status'], array( 'pending', 'auto-draft' ) ) && 'post' == $data['post_type'] )
    {
// if the except is empty, call the excerpt creation function
        if ( strlen($data['post_excerpt']) == 0 ) {
            $data['post_excerpt'] = auto_create_excerpt( $data['post_content'], $custom_excerpt_length );
        } else {
            $data['post_excerpt'] = strip_shortcodes( $data['post_excerpt'] );
        }
    }
    return $data;
}
/**
 * Returns the original content string if its word count is lesser than $length,
 * or a trimed version with the desired length.
 */
function auto_create_excerpt( $content, $length = 35 )
{
    $content = strip_shortcodes( $content );
    $the_string = preg_replace( '#\s+#', ' ', $content );
    $words = explode( ' ', $the_string );
    /**
     * splits the $content into an array of words
     **/
//preg_match_all( '/\b[\w\d-]+\b/', $content, $words );
    if( count($words) <= $length )
        $result = $content . '...';
    else
        $result = implode( ' ', array_slice( $words, 0, $length ) ) . '...';
    return $result;
}
/**
 * API Added field 'userPhotoThumb' for 'Posts' endpoint :
 * wp-json/wp/v2/posts?per_page=10&_embed
 */
add_action( 'rest_api_init', function () {
    register_rest_field( 'post', 'userPhotoThumb', array(
        'get_callback' => function( $comment_arr ) {
            $comment_obj = get_comment( $comment_arr['id'] );
            return "https://alln-extcloud-storage.cisco.com/ciscoblogs/userphoto/" . get_the_author_meta(userphoto_thumb_file);
        },
        'update_callback' => function( $userPhotoThumb, $comment_obj ) {
            $ret = wp_update_comment( array(
                'comment_ID' => $comment_obj->comment_ID,
                'userPhotoThumb' => $userPhotoThumb
            ) );
            if ( false === $ret ) {
                return new WP_Error(
                    'rest_comment_userPhotoThumb_failed',
                    __( 'Failed to update comment author photo thumbnail.' ),
                    array( 'status' => 500 )
                );
            }
            return true;
        },
        'schema' => array(
            'description' => __( 'Author photo thumbnail.' ),
            'type' => 'string'
        ),
    ) );
} );
/**
 * Generates the estimated reading time for a post
 **/
function get_reading_time() {
    global $post;
    $words = str_word_count(strip_tags($post->post_content));
    $minutes = floor($words/120);
    if($minutes > 1){
        echo $minutes . ' min read';
    }
    else{
        echo '1 min read';
    }
}
/**
 * Cisco Subscribe Widget Creation and Registration
 **/
function cisco_load_subscribe_widget()
{
    register_widget('cisco_subscribe_widget');
}
add_action('widgets_init', 'cisco_load_subscribe_widget');
// Creating the widget
class cisco_subscribe_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
// Base ID of your widget
            'cisco_subscribe_widget',
// Widget name will appear in UI
            __('Cisco Subscribe', 'cisco_widget_domain'),
// Widget description
            array(
                'description' => __('Cisco Subscribe widget', 'cisco_widget_domain')
            ));
    }
// Creating widget front-end
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if(is_home() || is_author() || is_search() || is_page() || is_tag()) {
            $catid = 0;
        }
        elseif(is_category('security')){
            $catid = 50;
        }
        else {
            $category = get_the_category();
            $catid= $category[0]->cat_ID;
        }
        if (is_category( array( 2, 3, 5, 7, 8, 9, 50, 51, 1853, 1854, 2051, 3107, 3108, 3109, 4362, 4364 ) )) {
            require("contactus.php");
        }
        if ( $catid == 16197) {
            $catid = 50;
        }
        subscribe($catid);
        echo $args['after_widget'];
    }
} // Class cisco_subscribe_widget ends here
/**
 * Cisco Social Connect Widget Creation and Registration
 **/
function cisco_load_connect_widget()
{
    register_widget('cisco_connect_widget');
}
add_action('widgets_init', 'cisco_load_connect_widget');
// Creating the widget
class cisco_connect_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
// Base ID of your widget
            'cisco_connect_widget',
// Widget name will appear in UI
            __('Cisco Connect', 'cisco_widget_domain'),
// Widget description
            array(
                'description' => __('Cisco Social Connect widget', 'cisco_widget_domain')
            ));
    }
// Creating widget front-end
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if(is_home() || is_author() || is_search() || is_page() || is_tag()) {
            $catid = 0;
        }
        elseif(is_category('security')){
            $catid = 50;
        }
        else {
            $category = get_the_category();
            $catid= $category[0]->cat_ID;
        }
        if ( $catid == 16197) {
            $catid = 50;
        }
        follow($catid);
        echo $args['after_widget'];
    }
} // Class cisco_connect_widget ends here
/**
 * Cisco Bunchball Widget Creation and Registration
 **/
function cisco_load_bunchball_widget()
{
    register_widget('cisco_bunchball_widget');
}
add_action('widgets_init', 'cisco_load_bunchball_widget');
// Creating the widget
class cisco_bunchball_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
// Base ID of your widget
            'cisco_bunchball_widget',
// Widget name will appear in UI
            __('Cisco Bunchball', 'cisco_widget_domain'),
// Widget description
            array(
                'description' => __('Cisco Bunchball Console and Newsfeed widget', 'cisco_widget_domain')
            ));
    }
// Creating widget front-end
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if(is_home() || is_author() || is_search() || is_page() || is_tag()) {
            $catid = 0;
        }
        elseif(is_category('security')){
            $catid = 50;
        }
        else {
            $category = get_the_category();
            $catid= $category[0]->cat_ID;
        }
        if ( $catid == 16197) {
            $catid = 50;
        }
        if ($catid !== 16197) {
            if (function_exists('bunchball')) {
                nitro_console();
            }
            if (function_exists('bunchball')) {
                newsfeed();
            }
        }
        echo $args['after_widget'];
    }
} // Class cisco_twitter_widget ends here


/**
 * Cisco Twitter Widget Creation and Registration
 **/
function cisco_load_twitter_widget()
{
    register_widget('cisco_twitter_widget');
}
add_action('widgets_init', 'cisco_load_twitter_widget');
// Creating the widget
class cisco_twitter_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
        // Base ID of your widget
            'cisco_twitter_widget',
        // Widget name will appear in UI
            __('Cisco Twitter', 'cisco_widget_domain'),
        // Widget description
            array(
            'description' => __('Cisco Twitter feed widget', 'cisco_widget_domain')
        ));
    }
    // Creating widget front-end
    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        if(is_home() || is_author() || is_search() || is_page()) {
          $catid = 0;
        }
        elseif(is_category('security')){
          $catid = 50;
        }
        else {
          $category = get_the_category();
          $catid= $category[0]->cat_ID;
        }
        if ( $catid == 16197) {
          $catid = 50;
        }
        if (is_category() || is_single()) {
            if (is_category( array( 2, 5, 7, 8, 9, 1764, 4363, 4364, 3, 49, 12100, 9276, 22760 ) )||in_category( array( 2, 5, 7, 8, 9, 1764, 4363, 4364, 3, 49, 12100, 9276, 22760 ) )) {
              $social = get_social_id($catid);
                ?>
                  <a class="twitter-timeline" data-width="240" data-height="560" data-dnt="true" href="<?php echo $social->tw ?>"></a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                <?php
            }
        }
        echo $args['after_widget'];
    }
} // Class cisco_twitter_widget ends here


/**
 * Cisco Related Links Creation and Registration
 **/
function cisco_load_related_links_widget()
{
    register_widget('cisco_related_links_widget');
}
add_action('widgets_init', 'cisco_load_related_links_widget');
// Creating the widget
class cisco_related_links_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
// Base ID of your widget
            'cisco_related_links_widget',
// Widget name will appear in UI
            __('Cisco Related Links', 'cisco_widget_domain'),
// Widget description
            array(
                'description' => __('Cisco Related Links widget', 'cisco_widget_domain')
            ));
    }
// Creating widget front-end
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if(is_home() || is_author() || is_search() || is_page() || is_tag()) {
            $catid = 0;
        }
        elseif(is_category('security')){
            $catid = 50;
        }
        else {
            $category = get_the_category();
            $catid= $category[0]->cat_ID;
        }
        if ( $catid == 16197) {
            $catid = 50;
        }
        if (is_category() || is_single()) {
            related_links($catid);
        }
        echo $args['after_widget'];
    }
} // Class cisco_related_links_widget ends here
/**
 * Cisco Top, Bottom, and our favorite content Menu Creation
 **/
function register_my_menus() {
    register_nav_menus(
        array(
            'top-menu' => __( 'Top Header Menu' ),
            'bottom-menu' => __( 'Bottom Menu' ),
            'our-favorite-content' => ( 'Our Favorite Content')
        )
    );
}
add_action( 'init', 'register_my_menus' );

function count_menu_items($menu){
    return count(wp_get_nav_menu_items($menu));
}
function fav_content_dynamic_menu_width() {
    wp_enqueue_style(
        'homepage',
        get_template_directory_uri() . '/styles/homepage.css'
    );
    $nav_items = count_menu_items('our-favorite-content') + 1;
    $custom_css = "
ul#featured_categories li{
width: calc(100%/ $nav_items );
}";
    wp_add_inline_style( 'homepage', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'fav_content_dynamic_menu_width' );

add_action('rest_api_init', 'register_rest_images' );
function register_rest_images(){
    register_rest_field( array('post'),
        'fimg_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}
/**
 * Adds Retired Posts submenu item to the "Posts" menu in the admin.
 */
add_action( 'admin_menu', 'linked_url' );
function linked_url() {
    add_posts_page( 'linked_url', 'Retired Posts', 'read', 'edit.php?post_status=draft&tag=retired', '', 'dashicons-text', 1 );
}

function get_user_id_by_search( $search_term ) {
    $user = get_users(array('search' =>  $search_term));

    if (!empty($user))
        return $user[0]->ID;
}

function nick_search_check($keyword) {
//in the logic below we never show both author and tag
$id = get_user_id_by_search($keyword);
$curauth = get_user_by('id', $id);
if ($curauth) {
//author exists
nick_search_check_author($curauth);
} else {
//check to see if the keyword matches a tag
//nick_search_check_tag($keyword);
}

}


function nick_search_check_author($curauth) {
$img  = $curauth->userphoto_image_file;
$display_name = $curauth->display_name;
$user_nicename = $curauth->user_nicename;
$description = $curauth->description;


preg_match('/^([^.!?]*[\.!?]+){0,2}/', strip_tags($description), $abstract);
$description = '<p>' . $abstract[0] . '</p>';

echo"<style type=\"text/css\">#featured_blogger{border-bottom: 0px solid #71757f;padding: 1rem 0;}</style>";
echo "<div id=\"featured_blogger\"><div id=\"featured_blogger_img\"><img class=\"img-circle\" src=\"https://alln-extcloud-storage.cisco.com/ciscoblogs/userphoto/".$img."\"></div><div id=\"featured_blogger_content\"><h3>Blogger: ".$display_name."</h3><p>".$description."</p><a class=\"view_profile\" href=\"https://blogs.cisco.com/author/".$user_nicename."\">View Profile<img class\"right-arrow\"=\"\" src=\"https://blogs.cisco.com/wp-content/themes/cisco_responsive/img/right-chevron.svg\" alt=\"right-arrow\" style=\"height:12px\"></a></div><div class=\"clear\"></div></div>";

}

function nick_search_check_tag($keyword) {

echo $keyword;

}

/**
* Gets the meta_concept for a given post's category, if it exists.
* Meta_concept is set for each category with the Advanced Custom Fields plugin
**/
function get_meta_concept(){
	$category = get_the_category();
	$category_id = 'category_' . $category[0]->cat_ID;

	$concept = get_field('meta_concept', $category_id);
	if($concept){
		echo '<meta name="concept" content="' . $concept . '">';
	}

}
?>
