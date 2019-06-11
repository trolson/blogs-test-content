<?php
	get_header();

?>

<cdc-template-micro lang="en" search-set-context="blogs">
        <?php
        if (is_single()){
            share();
            //$excerpt = my_excerpt($post->post_content, get_the_excerpt());
        }
    echo '<div id="sb-site">';
            if (is_home()) {
                require("homepage.php");
            }
            if (is_author()) {
                require("authorpage.php");
            }
            if (is_single()) {
                if ( in_category(16197) ) {
                    require("talos_singlepost.php");
                }
                else {
                    require("singlepost.php");
                }
            }
            if (is_search()) {
                require("search_results.php");
            }

            if (is_category()) {
                if ( is_subcategory() ) {
                    require ('talos_cat_layout.php');
                }

                else {
                    require ("cat_layout.php");
                }
            }
            if (is_page('archive')) {
                require("post_list.php");
            }
            if (is_page('rewards-about')) {
                require('rewards_about.php');
            }
            if (is_page('Rewards Profile')) {
                require('rewards-profile.php');
            }
            if (is_page('edit rewards profile')) {
                require('rewards-edit.php');
            }

            if (is_tag()) {
                require("tag_layout.php");
            }

            ?>
</div>


<div class="sb-slidebar sb-left sb-width-custom sb-momentum-scrolling " data-sb-width="50%">
    <?php include 'mainmenu.php'; ?>
</div>
</cdc-template-micro>
