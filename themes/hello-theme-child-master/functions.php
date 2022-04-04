<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

add_action('after_setup_theme', 'remove_core_updates');

//Ocultar todos los avisos de actualizaciones
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');

function hide_notices_dashboard() {
    global $wp_filter;

    if ( is_network_admin() and isset($wp_filter['network_admin_notices']) ) {
        unset( $wp_filter['network_admin_notices'] );
    } elseif( is_user_admin() && isset($wp_filter['user_admin_notices']) ) {
        unset( $wp_filter['user_admin_notices'] );
    } else {
        if ( isset($wp_filter['admin_notices']) ) {
            unset( $wp_filter['admin_notices'] );
        }
    }

    if ( isset($wp_filter['all_admin_notices']) ) {
        unset( $wp_filter['all_admin_notices'] );
    }
}
add_action( 'admin_init', 'hide_notices_dashboard' );