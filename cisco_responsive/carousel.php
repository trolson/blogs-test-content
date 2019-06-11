<link rel='stylesheet' id='msl-main-css'  href='<?php echo get_template_directory_uri(); ?>/styles/carousel.min.css' type='text/css' media='all' />
<script>var ms_grabbing_curosr = '<?php echo get_template_directory_uri(); ?>/styles/common/grabbing.cur', ms_grab_curosr = '<?php echo get_template_directory_uri(); ?>/styles/common/grab.cur';</script>
		<!-- START MasterSlider -->
		<div id="P_MS5adb8aa266fa6" class="master-slider-parent msl ms-parent-id-1" style="max-width:1500px;"  >
			<div id="MS5adb8aa266fa6" class="master-slider ms-skin-metro" >
				 			
<?php
	query_posts( array( 'posts_per_page' => 4, 'cat' => 5555 ) );
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'carousel_image' );			
?>			 
        <div  class="ms-slide" data-delay="4" data-fill-mode="fill"  >
          <div class="slide-overlay">
            <div class="slide-text-excerpt">
              <a href="<?php the_permalink() ?>" class="carousel_read_more">		 	
                <h1 class="slide-title"><?php the_title(); ?></h1>
                <p><?php
                $my_excerpt = nm_carousel_excerpt_truncate(get_the_excerpt());
                echo $my_excerpt;
                ?></p>
              </a>
            </div>
            <a href="<?php the_permalink() ?>" class="read_more">Read More</a>
          </div>
          <img src="<?php echo get_template_directory_uri(); ?>/styles/common/blank.gif" alt="" title="" data-src="<?php echo $image[0]; ?>" />
          <div class="ms-thumb" ><div class="ms-tab-context"><div class=&quot;ms-tab-context&quot;></div></div></div>
        </div>
<?php
		}
	}
?>
			</div>
		</div>
		<!-- END Carousel -->
    <!-- START Carousel jQuery-->
		<script>
		(function ( $ ) {
			"use strict";
			$(function () {
				var masterslider_6fa6 = new MasterSlider();

				// slider controls
				masterslider_6fa6.control('bullets'    ,{ autohide:false, overVideo:true, dir:'h', align:'bottom' , margin:10  });

				// slider setup
				masterslider_6fa6.setup("MS5adb8aa266fa6", {
						width           : 1500,
						height          : 560,
						minHeight       : 250,
						space           : 0,
						start           : 1,
						grabCursor      : true,
						swipe           : true,
						mouse           : true,
						layout          : "boxed",
						wheel           : false,
						autoplay        : true,//off
						instantStartLayers:false,
						loop            : false,
						shuffle         : false,
						preload         : 0,
						heightLimit     : true,
						autoHeight      : false,
						smoothHeight    : true,
						endPause        : false,
						overPause       : true,
						fillMode        : "fill",
						centerControls  : true,
						startOnAppear   : false,
						layersMode      : "center",
						hideLayers      : false,
						fullscreenMargin: 0,
						speed           : 20,
						dir             : "h",
						parallaxMode    : 'swipe',
						view            : "basic"
				});
				window.masterslider_instances = window.masterslider_instances || [];
				window.masterslider_instances.push( masterslider_6fa6 );
			 });

		})(jQuery);
		</script>
		<!-- End Carousel jQuery-->
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.easing.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/masterslider.min.js'></script>