<?php

/* ------------------------------------------------------------------------ */
/* Translation
/* ------------------------------------------------------------------------ */
load_theme_textdomain('minti', get_template_directory().'/framework/languages');

/* ------------------------------------------------------------------------ */
/* Inlcudes
/* ------------------------------------------------------------------------ */
require_once (get_template_directory().'/framework/inc/enqueue.php');// Enqueue JavaScripts & CSS
require_once (get_template_directory().'/framework/inc/customcss.php');// Load Custom CSS
require_once (get_template_directory().'/framework/inc/customjs.php');// Load Custom JS
require_once (get_template_directory().'/framework/inc/sidebar-generator.php');// Include Sidebar Generator
require_once (get_template_directory().'/framework/inc/breadcrumbs.php');// Load Breadcrumbs
require_once (get_template_directory().'/framework/inc/shortcodes.php');
require_once (get_template_directory().'/framework/inc/tinymce.php');

if (class_exists('WPBakeryVisualComposerAbstract')) {
	require_once (get_template_directory().'/framework/inc/visualcomposer/vctweaks.php');// Load Visual Composer Tweaks

	// Load own WooCommerce Elements
	// if ( class_exists('Woocommerce') ) {
	// 	require_once(get_template_directory() . '/framework/inc/visualcomposer/vctweaks_woocommerce.php'); // Load Visual Composer WooCommerce Shortcodes
	// }
}

/* ------------------------------------------------------------------------ */
/* Redux */
if (!class_exists('redux') && file_exists(dirname(__FILE__).'/framework/admin/ReduxCore/framework.php')) {
	require_once (dirname(__FILE__).'/framework/admin/ReduxCore/framework.php');
}

// Redux Configuration
require_once (dirname(__FILE__).'/framework/admin/admin-config.php');

/* ------------------------------------------------------------------------ */
/* Meta Box Script */
define('RWMB_URL', trailingslashit(get_template_directory_uri().'/framework/inc/meta-box'));
define('RWMB_DIR', trailingslashit(get_template_directory().'/framework/inc/meta-box'));
require_once RWMB_DIR.'meta-box.php';
require_once RWMB_DIR.'meta-box-tabs/meta-box-tabs.php';// Include Tabs Extension
include get_template_directory().'/framework/inc/meta-boxes.php';

/* ------------------------------------------------------------------------ */
/* Widgets */
require_once (get_template_directory().'/framework/inc/widgets/contact.php');
require_once (get_template_directory().'/framework/inc/widgets/flickr.php');
require_once (get_template_directory().'/framework/inc/widgets/portfolio.php');
require_once (get_template_directory().'/framework/inc/widgets/sponsor.php');

/* ------------------------------------------------------------------------ */
/* One-Click-Installer */
require_once (get_template_directory().'/framework/inc/demoimporter/import.php');

/* ------------------------------------------------------------------------ */
/* Automatic Plugin Activation */
require_once (get_template_directory().'/framework/inc/plugin-activation.php');

add_action('tgmpa_register', 'minti_register_required_plugins');
function minti_register_required_plugins() {
	$plugins = array(
		array(
			'name'               => 'Unicon Portfolio CPT', // The plugin name
			'slug'               => 'unicon_portfolio_cpt', // The plugin slug (typically the folder name)
			'source'             => get_template_directory_uri().'/framework/plugins/unicon_portfolio_cpt.zip', // The plugin source
			'required'           => true, // If false, the plugin is only 'recommended' instead of required
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'Visual Composer', // The plugin name
			'slug'               => 'js_composer', // The plugin slug (typically the folder name)
			'source'             => get_template_directory_uri().'/framework/plugins/js_composer.zip', // The plugin source
			'required'           => true, // If false, the plugin is only 'recommended' instead of required
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'Revolution Slider', // The plugin name
			'slug'               => 'revslider', // The plugin slug (typically the folder name)
			'source'             => get_template_directory_uri().'/framework/plugins/revslider.zip', // The plugin source
			'required'           => false, // If false, the plugin is only 'recommended' instead of required
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'             => 'Contact Form 7',
			'slug'             => 'contact-form-7',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => 'WooCommerce',
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => 'bbPress',
			'slug'             => 'bbpress',
			'required'         => false,
			'force_activation' => false,
		),
	);

	$config = array(
		'domain'                           => 'minti-framework', // Text domain - likely want to be the same as your theme.
		'default_path'                     => '', // Default absolute path to pre-packaged plugins
		'parent_menu_slug'                 => 'themes.php', // Default parent menu slug
		'parent_url_slug'                  => 'themes.php', // Default parent URL slug
		'menu'                             => 'install-required-plugins', // Menu slug
		'has_notices'                      => true, // Show admin notices or not
		'is_automatic'                     => false, // Automatically activate plugins after installation or not
		'message'                          => '', // Message to output right before the plugins table
		'strings'                          => array(
			'page_title'                      => __('Install Required Plugins', 'minti-framework'),
			'menu_title'                      => __('Install Plugins', 'minti-framework'),
			'installing'                      => __('Installing Plugin: %s', 'minti-framework'), // %1$s = plugin name
			'oops'                            => __('Something went wrong with the plugin API.', 'minti-framework'),
			'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
			'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
			'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
			'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
			'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
			'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
			'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
			'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
			'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins'),
			'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins'),
			'return'                          => __('Return to Required Plugins Installer', 'minti-framework'),
			'plugin_activated'                => __('Plugin activated successfully.', 'minti-framework'),
			'complete'                        => __('All plugins installed and activated successfully. %s', 'minti-framework'), // %1$s = dashboard link
			'nag_type'                        => 'updated'// Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa($plugins, $config);

}

/* ------------------------------------------------------------------------ */
/* Comment Styling
/* ------------------------------------------------------------------------ */
function minti_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;?>

		   <li <?php comment_class();?> id="li-comment-<?php comment_ID()?>">
		   <div id="comment-<?php comment_ID();?>" class="comment-body clearfix">

		   		<div class="avatar"><?php echo get_avatar($comment, $size = '100');?></div>

		         <div class="comment-text">

					 <div class="author">
					 	<span><?php if ($comment->comment_author_url == '' || $comment->comment_author_url == 'http://Website') {echo get_comment_author();} else {echo comment_author_link();}?></span>
					 	<div class="date">
	<?php printf(__('%1$s at %2$s', 'minti'), get_comment_date(), get_comment_time())?></a><?php edit_comment_link(__('(Edit)', 'minti'), '  ', '')?>
					   	&middot; <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))?>  </div>
					 </div>

					 <div class="text"><?php comment_text()?></div>

	<?php if ($comment->comment_approved == '0'):?>
			         <em><?php _e('Your comment is awaiting moderation.', 'minti')?></em>
			         <br />
	<?php endif;?>
	</div>

		   </div>
	<?php
}

/* ------------------------------------------------------------------------ */
/* Custom Excerpts
/* ------------------------------------------------------------------------ */
// Set new Default Excerpt Length
function minti_new_excerpt_length($length) {
	return 200;
}
add_filter('excerpt_length', 'minti_new_excerpt_length');

// Custom Excerpt Length
function minti_custom_excerpt($limit = 50) {
	global $minti_data;
	if ($minti_data['switch_readmore'] != 0) {
		return strip_shortcodes(wp_trim_words(get_the_content(), $limit, '... <a class="read-more-link" href="'.get_permalink().'">'.__('read more', 'minti').'  &rarr;</a>'));
	} else {
		return strip_shortcodes(wp_trim_words(get_the_content(), $limit));
	}
}

// Word Limiter
function minti_limit_words($string, $word_limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $word_limit));
}

// Remove Shortcodes from Search Results Excerpt
function minti_remove_shortcode_from_excerpt($excerpt) {
	if (is_search()) {
		$excerpt = strip_shortcodes($excerpt);
	}
	return $excerpt;
}
add_filter('the_excerpt', 'minti_remove_shortcode_from_excerpt');

/* ------------------------------------------------------------------------ */
/* Misc
/* ------------------------------------------------------------------------ */
// Post Thumbnail Sizes
if (function_exists('add_image_size')) {add_theme_support('post-thumbnails');
}

if (function_exists('add_image_size')) {
	add_image_size('blog', 1000, 563, true);// Standard Blog Image
	add_image_size('mini', 80, 80, true);// used for widget thumbnail
	add_image_size('portfolio', 600, 400, true);// also for blog-medium
	add_image_size('regular', 500, 500, true);
	add_image_size('wide', 1000, 500, true);
	add_image_size('tall', 500, 1000, true);
	add_image_size('widetall', 1000, 1000, true);
}

// Content Width
if (!isset($content_width)) {$content_width = 1161;
}

// Add RSS Links to head section
add_theme_support('automatic-feed-links');

// Post Formats
add_theme_support('post-formats', array('gallery', 'link', 'quote', 'audio', 'video'));

// Allow Shortcodes in Text Widget
add_filter('widget_text', 'do_shortcode');

// Add Custom Primary Navigation
function minti_register_custom_menu() {
	register_nav_menu('main_navigation', 'Main Navigation');
	register_nav_menu('footer_navigation', 'Footer Navigation');
	register_nav_menu('topbar_navigation', 'Topbar Navigation');
}
add_action('init', 'minti_register_custom_menu');

// Add Transparent Header Class to Body
function minti_transparent_header_class($classes) {
	global $post;
	global $minti_data;

	if (!is_search() && !is_404() && !is_archive() && !is_author() && !is_home()) {
		if ((rwmb_meta('minti_titlebar') == 'default' && $minti_data['titlebar_layout'] == 'transparentimage') || rwmb_meta('minti_titlebar') == 'transparent' || rwmb_meta('minti_titlebar') == 'transparentimage') {
			if ($minti_data['header_layout'] == 'v1') {
				$classes[] = 'header-is-transparent ';
			}
		}
	}
	if (is_search() || is_404() || is_archive() || is_author() || is_home()) {
		if ($minti_data['titlebar_layout'] == 'transparentimage') {
			if ($minti_data['header_layout'] == 'v1') {
				$classes[] = 'header-is-transparent ';
			}
		}
	}
	if (function_exists('is_woocommerce') && is_woocommerce()) {
		if ($minti_data['titlebar_layout'] == 'transparentimage') {
			if ($minti_data['header_layout'] == 'v1') {
				$classes[] = 'header-is-transparent ';
			}
		}
	}
	if (function_exists('is_bbpress') && is_bbpress()) {
		if ($minti_data['titlebar_layout'] == 'transparentimage') {
			if ($minti_data['header_layout'] == 'v1') {
				$classes[] = 'header-is-transparent ';
			}
		}
	}

	return $classes;
}
add_filter('body_class', 'minti_transparent_header_class');

// One Page Scroll Class
function minti_onepage_class($classes) {
	global $minti_data;
	if (isset($minti_data['switch_pagescroll']) && ($minti_data['switch_pagescroll'] == 1)) {
		$classes[] = 'pagescroll';
	}
	return $classes;
}
add_filter('body_class', 'minti_onepage_class');

// Add Lightbox rel to photo galleries
function minti_add_rel_attribute($link) {
	global $post;
	return str_replace('<a href', '<a rel="prettyPhoto[pp_gal]" href', $link);
}
add_filter('wp_get_attachment_link', 'minti_add_rel_attribute');

// Page Title Filter
function minti_custom_wp_title($title, $sep) {
	if (is_feed()) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo('name', 'display');

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && (is_home() || is_front_page())) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if (($paged >= 2 || $page >= 2) && !is_404()) {
		$title .= " $sep " .sprintf(__('Page %s', 'minti'), max($paged, $page));
	}

	return $title;
}
add_filter('wp_title', 'minti_custom_wp_title', 10, 2);

/* ------------------------------------------------------------------------ */
/* Pagination
/* ------------------------------------------------------------------------ */
function minti_pagination() {
	if (is_singular()) {
		return;
	}

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ($wp_query->max_num_pages <= 1) {
		return;
	}

	$paged = get_query_var('paged')?absint(get_query_var('paged')):1;
	$max   = intval($wp_query->max_num_pages);

	/**	Add current page to the array */
	if ($paged >= 1) {
		$links[] = $paged;
	}

	/**	Add the pages around the current page to the array */
	if ($paged >= 3) {
		$links[] = $paged-1;
		$links[] = $paged-2;
	}

	if (($paged+2) <= $max) {
		$links[] = $paged+2;
		$links[] = $paged+1;
	}

	echo '<div id="pagination" class="clearfix"><ul>'."\n";

	/**	Previous Post Link */
	if (get_previous_posts_link()) {
		printf('<li class="pagination-prev">%s</li>'."\n", get_previous_posts_link('<i class="fa fa-chevron-left"></i>'));
	}

	/**	Link to first page, plus ellipses if necessary */
	if (!in_array(1, $links)) {
		$class = 1 == $paged?' class="current"':'';

		printf('<li%s><a href="%s">%s</a></li>'."\n", $class, esc_url(get_pagenum_link(1)), '1');

		if (!in_array(2, $links)) {
			echo '<li><span>...</span></li>';
		}
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array) $links as $link) {
		$class = $paged == $link?' class="current"':'';
		printf('<li%s><a href="%s">%s</a></li>'."\n", $class, esc_url(get_pagenum_link($link)), $link);
	}

	/**	Link to last page, plus ellipses if necessary */
	if (!in_array($max, $links)) {
		if (!in_array($max-1, $links)) {
			echo '<li><span>...</span></li>'."\n";
		}

		$class = $paged == $max?' class="current"':'';
		printf('<li%s><a href="%s">%s</a></li>'."\n", $class, esc_url(get_pagenum_link($max)), $max);
	}

	/**	Next Post Link */
	if (get_next_posts_link()) {
		printf('<li class="pagination-next">%s</li>'."\n", get_next_posts_link('<i class="fa fa-chevron-right"></i>'));
	}

	echo '</ul></div>'."\n";
}

/* ------------------------------------------------------------------------ */
/* Widget Areas
/* ------------------------------------------------------------------------ */
function minti_widgets_init() {

	global $minti_data;
	$footercolumns = 'four';

	if (isset($minti_data['select_footercolumns']) && ($minti_data['select_footercolumns'] == "4")) {$footercolumns = "four";} elseif (isset($minti_data['select_footercolumns']) && ($minti_data['select_footercolumns'] == "3")) {$footercolumns = "one-third";} elseif (isset($minti_data['select_footercolumns']) && ($minti_data['select_footercolumns'] == "2")) {$footercolumns = "eight";} elseif (isset($minti_data['select_footercolumns']) && ($minti_data['select_footercolumns'] == "1")) {$footercolumns = "sixteen";}

	// Blog Widgets
	register_sidebar(array(
			'name'          => __('Blog Widgets', 'minti-framework'),
			'id'            => 'blog-widgets',
			'description'   => __('These are widgets for the Blog sidebar.', 'minti-framework'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

	// Search Results Widgets
	register_sidebar(array(
			'name'          => __('Search Results Widgets', 'minti-framework'),
			'id'            => 'search-results-widgets',
			'description'   => __('These are widgets for the Search Results sidebar.', 'minti-framework'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

	// Footer Widgets
	register_sidebar(array(
			'name'          => __('Footer Widgets', 'minti-framework'),
			'id'            => 'footer-widgets',
			'description'   => __('These are widgets for the Footer.', 'minti-framework'),
			'before_widget' => '<div id="%1$s" class="widget %2$s '.$footercolumns.' columns">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

	// WooCommerce Widgets
	if (class_exists('Woocommerce')) {
		register_sidebar(array(
				'name'          => __('Shop Widgets', 'minti-framework'),
				'id'            => 'shop-widgets',
				'description'   => __('These are widgets for the Shop sidebar.', 'minti-framework'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			));
	}

	// BBPress Widgets
	if (class_exists('bbPress')) {
		register_sidebar(array(
				'name'          => __('Forum Widgets', 'minti-framework'),
				'id'            => 'forum-widgets',
				'description'   => __('These are widgets for the Forum sidebar.', 'minti-framework'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			));
	}

}

add_action('widgets_init', 'minti_widgets_init');

/* ------------------------------------------------------------------------ */
/* Plugin - WooCommerce
/* ------------------------------------------------------------------------ */
// Add WooCommerce Theme Support
add_theme_support('woocommerce');

if (class_exists('Woocommerce')) {

	global $minti_data;
	//Redux::init( 'minti_data' );

	// Disable WooCommerce CSS
	if (version_compare(WOOCOMMERCE_VERSION, "2.1") >= 0) {
		add_filter('woocommerce_enqueue_styles', '__return_false');
	} else {
		define('WOOCOMMERCE_USE_CSS', false);
	}

	// Increase Number of Related Products to 4
	if (!function_exists('woocommerce_related_output')) {
		function woocommerce_related_output() {
			global $product, $orderby, $related;
			$args = array(
				'posts_per_page' => '4',
				'columns'        => '4',
			);
			return $args;
		}
	}
	add_filter('woocommerce_output_related_products_args', 'woocommerce_related_output');

	// Change products per page
	add_filter('loop_shop_per_page', create_function('$cols', 'return '.$minti_data['text_shopitems'].';'), 20);

	// Toggle Sort by Function
	if ($minti_data["switch_shopsorting"] == 0) {
		remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	}

	// Toggle Result Count
	if ($minti_data["switch_shopresultcount"] == 0) {
		remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	}

	// Toggle Upsell Products
	if ($minti_data["switch_shopupsells"] == 0) {
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	}

	// Toggle Related Products
	if ($minti_data["switch_shoprelatedproducts"] == 0) {
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	}

	// Remove Cart Cross Sells
	remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

	//change tab position to be inside summary
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 1);

	// Remove WooCommerce Prettyphoto Style
	function minti_woo_remove_styles() {
		wp_dequeue_style('woocommerce_prettyPhoto_css');
		wp_dequeue_script('select2');
	}
	add_action('wp_enqueue_scripts', 'minti_woo_remove_styles', 99);

	// Add Custom Pagination
	remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
	function woocommerce_pagination() {
		minti_pagination();
	}
	add_action('woocommerce_pagination', 'woocommerce_pagination', 10);

	// Add Second Image on Hover by http://jameskoster.co.uk
	// License: GNU General Public License v3.0
	if (!class_exists('WC_pif')) {

		class WC_pif {

			public function __construct() {
				//add_action( 'wp_enqueue_scripts', array( $this, 'pif_scripts' ) );														// Enqueue the styles
				add_action('woocommerce_before_shop_loop_item_title', array($this, 'woocommerce_template_loop_second_product_thumbnail'), 11);
				add_filter('post_class', array($this, 'product_has_gallery'));
			}

			// Add pif-has-gallery class to products that have a gallery
			function product_has_gallery($classes) {
				global $product;
				$post_type = get_post_type(get_the_ID());
				if (!is_admin()) {
					if ($post_type == 'product') {
						$attachment_ids = $product->get_gallery_attachment_ids();
						if ($attachment_ids) {
							$classes[] = 'pif-has-gallery';
						}
					}
				}
				return $classes;
			}

			// Display the second thumbnails
			function woocommerce_template_loop_second_product_thumbnail() {
				global $product, $woocommerce;

				$attachment_ids = $product->get_gallery_attachment_ids();

				if ($attachment_ids) {
					$secondary_image_id = $attachment_ids['0'];
					echo wp_get_attachment_image($secondary_image_id, 'shop_catalog', '', $attr = array('class' => 'secondary-image attachment-shop-catalog'));
				}
			}

		}

		$WC_pif = new WC_pif();
	}

}// end if woocommerce class exists

/* ------------------------------------------------------------------------ */
/* Plugin - bbPress
/* ------------------------------------------------------------------------ */
if (class_exists('bbPress')) {

	// Remove BBP Search Widget
	function minti_remove_bbpsearch_widget() {
		unregister_widget('BBP_Search_Widget');
	}
	add_action('widgets_init', 'minti_remove_bbpsearch_widget');

	// Remove Default CSS
	function minti_deregister_bbp_styles() {
		wp_deregister_style('bbp-default');
	}
	add_action('wp_print_styles', 'minti_deregister_bbp_styles', 15);

}// end if bbpress class exists

/* ------------------------------------------------------------------------ */
/* Helper - hex2rgba
/* By: http://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
/* ------------------------------------------------------------------------ */
function minti_hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	if (empty($color)) {
		return $default;
	}

	if ($color[0] == '#') {
		$color = substr($color, 1);
	}

	if (strlen($color) == 6) {
		$hex = array($color[0].$color[1], $color[2].$color[3], $color[4].$color[5]);
	} elseif (strlen($color) == 3) {
		$hex = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
	} else {
		return $default;
	}

	$rgb = array_map('hexdec', $hex);

	if ($opacity) {
		if (abs($opacity) > 1) {
			$opacity = 1.0;
		}

		$output = 'rgba('.implode(",", $rgb).','.$opacity.')';
	} else {
		$output = 'rgb('.implode(",", $rgb).')';
	}

	return $output;
}

/* ------------------------------------------------------------------------ */
/* Helper - expand allowed tags()
/* Source: https://gist.github.com/adamsilverstein/10783774
/* ------------------------------------------------------------------------ */
function minti_expand_allowed_tags() {
	$my_allowed = wp_kses_allowed_html('post');
	// iframe
	$my_allowed['iframe'] = array(
		'src'             => array(),
		'height'          => array(),
		'width'           => array(),
		'frameborder'     => array(),
		'allowfullscreen' => array(),
	);
	return $my_allowed;
}

/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */
?>