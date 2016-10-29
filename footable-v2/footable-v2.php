<?php
/*
Plugin Name: Footable v2
Description: Footable v2.0.3
Author: X-Raym
Author URI: http://extremraym.com/
*/

/**
 * Check whether we are on this page or a sub page
 *
 * @param int $pid Page ID to check against.
 * @return bool True if we are on this page or a sub page of this page.
 */
function is_tree( $pid ) {      // $pid = The ID of the page we're looking for pages underneath
    $post = get_post();               // load details about this page
 
    $is_tree = false;
    if ( is_page( $pid ) ) {
        $is_tree = true;            // we're at the page or at a sub page
    }
 
    $anc = get_post_ancestors( $post->ID );
    foreach ( $anc as $ancestor ) {
        if ( is_page() && $ancestor == $pid ) {
            $is_tree = true;
        }
    }
    return $is_tree;  // we arn't at the page, and the page is not an ancestor
}

function register_footables_script() {
    
    if ( is_tree( 869 ) || is_author() || is_singular( 'badges' ) ) {
    
        wp_register_script( 'footable-core', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/2.0.3/js/footable.min.js' );
    	wp_register_script( 'footable-sort', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/2.0.3/js/footable.sort.js' );
    	wp_register_script( 'footable-filter', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/2.0.3/js/footable.filter.js' );
    	wp_register_script( 'footable-init', plugin_dir_url( __FILE__ ) . 'js/footable-init.js' );
    
        wp_register_style( 'footable-core', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/2.0.3/css/footable.core.min.css' );
        wp_register_style( 'footable-metro', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/2.0.3/css/footable.metro.min.css' );
    
        wp_enqueue_script('footable-core' );
        wp_enqueue_script('footable-filter' );
        wp_enqueue_script('footable-sort' );
        wp_enqueue_script('footable-init' );
        
        wp_enqueue_style('footable-core');
        wp_enqueue_style('footable-metro');
    
    } else {
        return false;
    }

}
add_action( 'wp_enqueue_scripts', 'register_footables_script' );