<?php
	get_header();
?>
<header>
        <div id = "hero">
            <div class = "top_third">
                <div id = "cisco_logo">
                    <div class="dropdown">
                        <div class = "logo_hover"></div>
                        <div class="dropdown-content">
                            <ul>
                                <li><a href = "https://cisco.com">All of Cisco</a></li>
                                <li><a href = "<?php echo get_home_url(); ?>">Blogs Home</a></li>
                            </ul>
                         </div>
                    </div>
                </div>
            </div>
            <div class = "hero_header_text">Cisco Blogs</div>
                <div id = "mobile_search_top">
                    <i class="fa fa-search"></i>
                </div>
                <div id = "normal_search">
                    <div id = "normal_search_box"><?php get_search_form(); ?></div>
                        <i class="fa fa-search"></i>
                    <div class = "clear"></div>
                </div>
            <div class = "clear"></div>
            <div id = "normal_menu">
                <?php include 'mainmenu.php'; ?>
            </div>
            <div id = "mobile_search">
                <div id = "mobile_search_box">
                    <?php get_search_form(); ?>
                </div>
        </div>
        </div>
    </header>

    <div class="clear"></div>

    <div id = "main_content">
      <div class="spacer">
       &nbsp;
      </div>
			<div id = "main_left">
				 <h1 class ="error"> 404 </h1>
				 <h2>Oops! Page not found. Try a search or read one of our latest articles. </h2>

				 <?php

				 include("tabs.php");

				 ?>
          </div>
          <div id = "main_right">
        		<?php include("sidebar.php"); ?>
          </div>

        </div>

    <div class="clear"></div>

<?php get_footer();?>
