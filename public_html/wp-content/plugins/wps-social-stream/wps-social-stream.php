<?php

/**
 * Plugin Name: Social Stream for WordPress With Carousel
 * Description: Social Stream for WordPress With Carousel
 * Version: 1.1
 * Author: Hitesh Khunt
 * Author URI: http://www.saragna.com/Hitesh-Khunt
 * Plugin URI: http://plugin.saragna.com/vc-addon
 * Text Domain: swp-social
 * License: GPLv2 or later
 * 
 */

$anisliderVersion = "1.1";

$currentFile = __FILE__;

$currentFolder = dirname($currentFile);

$animate_slider_tables = 'swp_social_stream';

require_once $currentFolder . '/inc/comman_class.php';
require_once $currentFolder . '/inc/admin_class.php';
require_once $currentFolder . '/inc/slider-tinymce.php';
require_once $currentFolder . '/inc/all_function.php';
require_once $currentFolder . '/inc/social-feed-shortcode.php';

if (!class_exists('swp_social')) {

class swp_social extends swp_social_class_grid {

	const doc_link = 'http://plugin.saragna.com/vc-addon';

	var $exclude_img = array();

	function __construct() {
		parent::__construct();
		add_action('admin_menu', array( $this, 'add_animate_setting_page'));
		add_shortcode('swp_social_data','swp_social_grid_shortcode');
		add_shortcode('swp_social','swp_social_layout_shortcode');
	}

	public function add_animate_setting_page() {
			add_menu_page( 'Social Stream', 'Social Stream', 'manage_options', 'swp-social', array( $this, 'my_spost_grid_page'), self::animate_plugin_url( '../assets/image/icon.png' ), 83);

	}
	public function my_spost_grid_page(){
	global $wpdb,$anisliderVersion;
		include('admin/setting.php');
	}
}
$swp_social = new swp_social();
}



add_action('init', 'do_output_buffer');

if(!function_exists('do_output_buffer')){

	function do_output_buffer() {

		ob_start();

	}

}
