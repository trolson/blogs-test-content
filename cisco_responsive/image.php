<?php
global $post;

wp_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
?>
