<?php
/*
Plugin Name: Meerkat
Description: Embed a Meerkat video on your site
Version: 1.0
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

define( 'meerkat_version', '1.0' );

/**
* Add meta to plugin details
*
* Add options to plugin meta line
*
* @since	1.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   	string		Links, now with settings added
*/

function meerkat_set_plugin_meta( $links, $file ) {

	if ( strpos( $file, 'meerkat.php' ) !== false ) {
		$links = array_merge( $links, array( '<a href="http://wordpress.org/support/plugin/meerkat">' . __( 'Support' ) . '</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/donate">' . __( 'Donate' ) . '</a>' ) );
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'meerkat_set_plugin_meta', 10, 2 );

/**
* Meerkat shortcode
*
* Shortcode function to output Meerkat video
*
* @since	1.0
*
* @param	string	$paras		Shortcode parameters
* @param	string	$content	Content between shortcode start and stop - ignored!
* @return	string				Output code
*/

function meerkat_shortcode( $paras = '', $content = '' ) {

	extract( shortcode_atts( array( 'username' => '', 'type' => 'portrait', 'participation' => 'true', 'cover' => '', 'muted' => 'false', 'debug' => 'true' ), $paras ) );

	// Check for any missing information

	$error = false;
	if ( $username == '' ) { $error = 'No username specified'; }
	if ( $type != 'portrait' && $type != 'square' && $type != 'bigsquare' ) { $error = 'The \'type\' should only be \'portrait\', \'square\' or \'bigsquare\''; }

	// If an error occurred output that

	if ( $error !== false ) {

		$content = '<p style="color: #f00">Meerkat embedding error: ' . $error . '</p>';

	} else {

		// If no errors, output the appropriate Meerkat script

		$newline = "\n";
		$content = $newline;

		if ( $debug == 'true' ) { $content .= '<!-- Meerkat v' . meerkat_version . ' -->' . $newline; }
		$content .= '<script class="meerkat" id="meerkat" name="meerkat" data-mute="' . $muted . '" data-social="' . $participation . '" class="mkEmbedPlayer" data-cover="' . $cover . '" data-type="' . $type . '" data-username="' . $username . '" src="http://meerkatapp.co/widgets/embed.js" type="text/javascript"></script>' . $newline;
		if ( $debug == 'true' ) { $content .= '<!-- End of Meerkat code -->' . $newline; }

	}

    return $content;
}

add_shortcode( 'meerkat', 'meerkat_shortcode' );
?>