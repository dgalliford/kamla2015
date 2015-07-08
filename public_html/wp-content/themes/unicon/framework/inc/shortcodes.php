<?php

function minti_shortcodes_formatter($content) {
	$block = join("|",array(
		"minti_alert", 
		"minti_blockquote", 
		"minti_recentposts", 
		"minti_bloglist",
		"minti_bloglistmodern", 
		"minti_box",
		"minti_callout",
		"minti_category_image",
		"minti_clear",
		"minti_center",
		"minti_counter",
		"minti_divider",
		"minti_dropcap",
		"minti_gallery",
		"minti_googlefont",
		"minti_googlemaps",
		"minti_headline",
		"minti_icon",
		"minti_iconbox",
		"minti_image",
		"minti_imageslider",
		"minti_imagebox",
		"minti_br",
		"minti_list",
		"minti_listitem",
		"minti_member",
		"minti_portfolio",
		"minti_pricingplan",
		"minti_progressbar",
		"minti_pullquote",
		"minti_spacer",
		"minti_social",
		"minti_table",
		"minti_testimonial",
		"minti_testimonialslider",
		"minti_text",
		"minti_title",
		"minti_toggle",
		"minti_tooltip",
		"minti_video",
		"minti_visibility"
	));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

	return $rep;
}

add_filter('the_content', 'minti_shortcodes_formatter');
add_filter('widget_text', 'minti_shortcodes_formatter');

/*-----------------------------------------------------------------------------------*/
/* Alert
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_alert_function')) {
	function minti_alert_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'type'  => 'warning',
			'close' => 'true'
		), $atts ) );

		if($close == 'false') {
			$var1 = '';
		} else{
			$var1 = '<span class="close" href="#"></span>';
		}

		return '<div class="alert-message ' . esc_attr($type) . '">' . $var1 . '<div>' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode('minti_alert', 'minti_alert_function');
}

/*-----------------------------------------------------------------------------------*/
/* Blockquote
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_blockquote_function')) {
	function minti_blockquote_function( $atts, $content = null) {
		extract( shortcode_atts( array(), $atts ) );
		
		return '<blockquote><p>' . do_shortcode($content) . '</p></blockquote>';
	}
	add_shortcode('minti_blockquote', 'minti_blockquote_function');
}

/*-----------------------------------------------------------------------------------*/
/* Blog
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_recentposts_function')) {
	function minti_recentposts_function($atts){
		extract(shortcode_atts(array(
			'posts'      => '4',
			'categories' => 'all',
			'style' 	 => 'grey'
		), $atts));
		
		global $post;

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_status'    => 'publish'
		);
		
		if($categories != 'all'){
			$str = $categories;
			$arr = explode(',', $str); // string to array

			$args['tax_query'][] = array(
				'taxonomy'  => 'category',
				'field'   => 'slug',
				'terms'   => $arr
			);
		}

		wp_enqueue_script('minti-carousel');

		$wp_query = new WP_Query($args);
		$out = '';

		if( $wp_query->have_posts() ) :

			$out .= '<div class="latest-blog style-'.esc_attr($style).'"">';

			$out .= '<div class="blog-carousel">';  
		
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
		  
		  		$blog_thumbnail= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portfolio' );

		  		$out .= '<div class="blog-item">';

		  		if($blog_thumbnail[0] != ''){
		  
		  		$out .= '<a href="'.esc_url(get_permalink()).'" title="' . esc_attr(get_the_title()) . '" class="blog-pic"><img src="'.esc_url($blog_thumbnail[0]).'" alt="" /><span class="blog-overlay"></span><i class="fa fa-align-left"></i></a>';
		  		
		  		}
		  		
		  		$out .= '<div class="blog-item-description">
							<h4><a href="'.esc_url(get_permalink()).'" title="' . esc_attr(get_the_title()) . '">'.esc_html(get_the_title()) .'</a></h4>
					  		<div>'.wp_kses_post(minti_custom_excerpt(20)).'</div>
					  		<span>'.esc_attr(get_the_date()).'</span>
				  		</div>';

				$out .= '</div>';
		  
			endwhile;

			$out .='</div>';
		
			$out .='</div><div class="clear"></div>';
		
		 	wp_reset_postdata();
	  
		endif;

		return $out;
	}
	add_shortcode('minti_recentposts', 'minti_recentposts_function');
}

/*-----------------------------------------------------------------------------------*/
/* Bloglist
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_bloglist_function')) {
	function minti_bloglist_function($atts){
		extract(shortcode_atts(array(
			'posts'      => '3',
			'categories' => 'all',
			'layout'     => 'vertical',
			'style'		 => 'date',
		), $atts));
		
		global $post;

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_status'    => 'publish'
		);

		if($categories != 'all'){
			$str = $categories;
			$arr = explode(',', $str); // string to array

			$args['tax_query'][] = array(
				'taxonomy'  => 'category',
				'field'   => 'slug',
				'terms'   => $arr
			);
		}

		$wp_query = new WP_Query($args);
		$out = '';

		if( $wp_query->have_posts() ) :

			$out .= '<div class="latest-blog '.esc_attr($layout).' clearfix">';  

			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				if($layout != 'horizontal'){
					$return = '';
					$return2 = minti_limit_words(get_the_excerpt(), '25');
				} else {
					$return = 'horizontal vc_col-sm-3';
					$return2 = minti_limit_words(get_the_excerpt(), '15');
				}

				if($style != 'date'){
					$blog_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
					$return3 = '<div class="blog-list-item-thumb"><a href="'.esc_url(get_permalink()).'" title="' . esc_attr(get_the_title()) . '"><img src="'.esc_url($blog_thumbnail[0]).'" alt="" /></a></div>';
				} else {
					$return3 = '<div class="blog-list-item-date">'.get_the_time('d').'<span>'.get_the_time('M').'</span></div>';
				}
				
				$out .= '<div class="latest-blog-list '.$return.' clearfix wpb_content_element">
							'.$return3.'
						  	<div class="blog-list-item-description">
								<h4><a href="'.esc_url(get_permalink()).'" title="' . esc_attr(get_the_title()) . '">'.esc_html(get_the_title()) .'</a></h4>
							  	<div class="blog-list-item-excerpt">'.$return2.'.. <a href="'. esc_url(get_permalink()) . '">' .__( 'Read More &rarr;', 'minti' ) . '</a></div>
							</div>
					  	</div>';
		  
			endwhile;

			$out .= '</div>';  
		
			wp_reset_postdata();
	  
		endif;

		return $out;
	}
	add_shortcode('minti_bloglist', 'minti_bloglist_function');
}

/*-----------------------------------------------------------------------------------*/
/* Bloglist Modern
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_bloglistmodern_function')) {
	function minti_bloglistmodern_function($atts){
		extract(shortcode_atts(array(
			'posts'      => '3',
			'categories' => 'all',
		), $atts));
		
		global $post;

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_status'    => 'publish'
		);

		if($categories != 'all'){
			$str = $categories;
			$arr = explode(',', $str); // string to array

			$args['tax_query'][] = array(
				'taxonomy'  => 'category',
				'field'   => 'slug',
				'terms'   => $arr
			);
		}

		$wp_query = new WP_Query($args);
		$out = '';

		if( $wp_query->have_posts() ) :

			$out .= '<div class="latest-blog-modern clearfix"><ul class="latest-blog-list-modern">'; 

			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				
			  	$out .= '<li>
			  		<a href="'.esc_url(get_permalink()).'" title="' . esc_attr(get_the_title()) . '">
			  			<span>'.esc_html(get_the_time('F d, Y')).'</span>
						<h4>'.esc_html(get_the_title()) .'</h4>
					</a>
				</li>';
		  
			endwhile;

			$out .= '</ul></div>';  
		
			wp_reset_postdata();
	  
		endif;

		return $out;
	}
	add_shortcode('minti_bloglistmodern', 'minti_bloglistmodern_function');
}

/*-----------------------------------------------------------------------------------*/
/* Box
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_box_function')) {
	function minti_box_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'style' => '1'
		), $atts ) );

		return '<div class="box clearfix style-' .esc_attr($style). ' wpb_content_element">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('minti_box', 'minti_box_function');
}

/*-----------------------------------------------------------------------------------*/
/* Button
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_button_function')) {
	function minti_button_function( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'link'      => '#',
			'size'    	=> 'medium',
			'target'    => '_self',
			'color'     => 'color-3',
			'icon'		=> '',
			'appear'	=> 'false',
			'class'		=> ''
		), $atts));
		
		if($icon == '') {
			$return2 = "";
		}
		else{
			$return2 = "<i class='fa ".esc_attr($icon)."'></i>";
		}

		if($appear == 'false') {
			$out = "<a href=\"" .esc_url($link). "\" target=\"" .esc_attr($target). "\" class=\"button ".esc_attr($color)." ".esc_attr($size)." ".esc_attr($class)."\">". $return2 . "". do_shortcode($content). "</a>";
		}
		else{
			$out = "<a href=\"" .esc_url($link). "\" target=\"" .esc_attr($target). "\" class=\"button button-appear ".esc_attr($color)." ".esc_attr($size)." ".esc_attr($class)."\"><span>". do_shortcode($content). "". $return2 . "</span></a>";
		}
		
		return $out;
	}
	add_shortcode('minti_button', 'minti_button_function');
}

/*-----------------------------------------------------------------------------------*/
/* Callout
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_callout_function')) {
	function minti_callout_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'buttontext' => 'Button',
			'buttoncolor' => 'color-6',
			'bgcolor' => '#fafafa',
			'textcolor' => '#777777', 
			'url' => '',
			'target'  => '_self',
		), $atts ) );
		
		return '<div class="callout clearfix" style="background-color:'.esc_attr($bgcolor).'; color:'.esc_attr($textcolor).';">
		<div class="callout-text">' . do_shortcode($content) . '</div>
			<div class="callout-button"><a class="button medium ' .esc_attr($buttoncolor). '" href="' .esc_url($url). '" target="' .esc_attr($target). '">' .esc_html($buttontext). '</a></div>
		</div>';
	}
	add_shortcode('minti_callout', 'minti_callout_function');
}

/*-----------------------------------------------------------------------------------*/
/* Callout
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_category_image_function')) {
	function minti_category_image_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'image' => '',
			'url' => '#',
			'target'  => '_self',
			'height' => '100px;',
			'color' => 'light',
		), $atts ) );

		if($image != ''){
			$img_src = wp_get_attachment_image_src($image, 'standard');
			$return = $img_src[0];
		} else{
			$return = '';
		}
		
		return '<a href="'.esc_url($url).'" target="' .esc_attr($target). '" class="catimage wpb_content_element color-' .esc_attr($color). '" style="height: '.esc_attr($height).';">
			<span style="background-image: url('.esc_url($return).'); height: '.esc_attr($height).';"></span>
			<div class="catimage-overlay clearfix" style="height: '.esc_attr($height).';">
				<div class="catimage-text">' . do_shortcode($content) . '</div>
			</div></a>';
	}
	add_shortcode('minti_category_image', 'minti_category_image_function');
}

/*-----------------------------------------------------------------------------------*/
/* Clear
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_clear_function')) {
	function minti_clear_function() {
		return '<div class="clear"></div>';
	}
	add_shortcode('minti_clear', 'minti_clear_function');
}

/*-----------------------------------------------------------------------------------*/
/* Center
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_center_function')) {
	function minti_center_function($atts, $content = null) {
		return '<div style="text-align: center;">' . do_shortcode($content) . '</div>'; 
	}
	add_shortcode('minti_center', 'minti_center_function');
}

/*-----------------------------------------------------------------------------------*/
/* Counter
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_counter_function')) {
	function minti_counter_function( $atts ) {
		extract(shortcode_atts(array(
			'number' => '197',
			'title'  => '',
			'color'  => '#666666'
		), $atts));
		
		return '<div class="counter clearfix wpb_content_element"><div class="counter-number" style="color: '.esc_attr($color).' !important;">' .esc_html($number). '</div><span class="counter-title">' .esc_html($title). '</span></div>';
	}
	add_shortcode('minti_counter', 'minti_counter_function');
}

/*-----------------------------------------------------------------------------------*/
/* Divider
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_divider_function')) {
	function minti_divider_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'style' => '1',
			'icon' => '',
			'margin' => ''
		), $atts ) );
		  
		if($margin == '') {
			$return = "";
		} else{
			$return = "style='margin:".esc_attr($margin)." !important;'";
		}

		if($style == '8' && $icon != '') {
			$return2 = '<div class="divider-icon"><i class="fa '.esc_attr($icon).'"></i></div>';
		} else{
			$return2 = "";
		}
		  
		return '<div class="divider divider' .esc_attr($style). '" ' .$return. '>' .$return2. '</div>';  
	}
	add_shortcode('minti_divider', 'minti_divider_function');
}

/*-----------------------------------------------------------------------------------*/
/* Dropcap
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_dropcap_function')) {
	function minti_dropcap_function($atts, $content = null) {
		extract(shortcode_atts(array(
			'style'      => ''
		), $atts));

		if($style == '') {
			$return = "";
		} else{
			$return = "dropcap-".$style;
		}

		return "<span class='dropcap ". esc_attr($return) ."'>" .esc_html($content). "</span>";
	}
	add_shortcode('minti_dropcap', 'minti_dropcap_function');
}

/*-----------------------------------------------------------------------------------*/
/* Gallery
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_gallery_function')) {
	function minti_gallery_function( $atts ) {
		extract(shortcode_atts(array(
			'ids'      	=> '',
			'link'     => '',
			'columns' => '',
			'style' => '1'
		), $atts));
		
		return do_shortcode('<div class="gallery-style-'.esc_attr($style).'">[gallery ids="'. esc_attr($ids) .'" link="'. esc_attr($link) .'" columns="'. esc_attr($columns) .'"]</div>');
	}
	add_shortcode('minti_gallery', 'minti_gallery_function');
}

/*-----------------------------------------------------------------------------------*/
/* Google Font
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_googlefont_function')) {
	function minti_googlefont_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'font' => 'Swanky and Moo Moo',
			'size' => '42px',
			'margin' => '0px'
		), $atts ) );
		  
		$google = preg_replace("/ /","+",$font);

		return '<link href="//fonts.googleapis.com/css?family='.esc_attr($google).':400,700&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese" rel="stylesheet" type="text/css">
		<div class="googlefont" style="font-family:\'' .esc_attr($font). '\', serif !important; font-size:' .esc_attr($size). ' !important; margin: ' .esc_attr($margin). ' !important;">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('minti_googlefont', 'minti_googlefont_function');
}

/*-----------------------------------------------------------------------------------*/
/* Google Maps */
/*-----------------------------------------------------------------------------------*/
function minti_load_googlemaps() {
	wp_register_script( 'google-maps-api', '//maps.google.com/maps/api/js?sensor=false', false, NULL, true);
}
add_action( 'wp_enqueue_scripts', 'minti_load_googlemaps' );

function minti_googlemaps_function($attr) {
	$attr = shortcode_atts(array(	
		'lat'   => '0', 
		'lon'    => '0',
		'id' => 'map',
		'z' => '1',
		'w' => '400',
		'h' => '300',
		'maptype' => 'ROADMAP',
		'address' => '',
		'kml' => '',
		'kmlautofit' => 'yes',
		'marker' => '',
		'markerimage' => '',
		'traffic' => 'no',
		'bike' => 'no',
		'fusion' => '',
		'start' => '',
		'end' => '',
		'infowindow' => '',
		'infowindowdefault' => 'yes',
		'directions' => '',
		'hidecontrols' => 'false',
		'scale' => 'false',
		'scrollwheel' => 'true',
		'style' => 'full',
		'colorscheme' => ''
		), $attr);

	wp_print_scripts( 'google-maps-api' );

	$returnme = '<div id="' .esc_attr($attr['id']) . '" style="height:' . esc_attr($attr['h']) . 'px;" class="google_map ' . esc_attr($attr['style']) . ' wpb_content_element"></div>';

	//directions panel
	if($attr['start'] != '' && $attr['end'] != '') 
	{
		$panelwidth = $attr['w']-20;
		$returnme .= '
		<div id="directionsPanel" style="width:' . esc_attr($panelwidth) . 'px;height:' . esc_attr($attr['h']) . 'px;border:1px solid gray;padding:10px;overflow:auto;"></div><br>
		';
	}

	$getScheme = NULL;
	if($attr['colorscheme'] != '') {
		$getScheme = 'styles: '.rawurldecode(base64_decode($attr['colorscheme'])).',';
	}

	$returnme .= '
    <script type="text/javascript">

		var latlng = new google.maps.LatLng(' . esc_js($attr['lat']) . ', ' . esc_js($attr['lon']) . ');
		var myOptions = {
			zoom: ' . esc_js($attr['z']) . ',
			center: latlng,
			scrollwheel: ' . esc_js($attr['scrollwheel']) .',
			disableDefaultUI: ' . esc_js($attr['hidecontrols']) .',
			scaleControl: ' . esc_js($attr['scale']) .',
			// mapTypeControl: false,
			//rotateControl: false,
			panControl: false,
		    //scaleControl: false,
		    streetViewControl: false,
		    '. $getScheme .'
  			//overviewMapControl: false,
			mapTypeId: google.maps.MapTypeId.' . esc_js($attr['maptype']) . '
		};
		var ' . esc_js($attr['id']) . ' = new google.maps.Map(document.getElementById("' . esc_js($attr['id']) . '"),
		myOptions);
		';
				
		//kml
		if($attr['kml'] != '') 
		{
			if($attr['kmlautofit'] == 'no') 
			{
				$returnme .= '
				var kmlLayerOptions = {preserveViewport:true};
				';
			}
			else
			{
				$returnme .= '
				var kmlLayerOptions = {preserveViewport:false};
				';
			}
			$returnme .= '
			var kmllayer = new google.maps.KmlLayer(\'' . html_entity_decode($attr['kml']) . '\',kmlLayerOptions);
			kmllayer.setMap(' . esc_js($attr['id']) . ');
			';
		}

		//directions
		if($attr['start'] != '' && $attr['end'] != '') 
		{
			$returnme .= '
			var directionDisplay;
			var directionsService = new google.maps.DirectionsService();
		    directionsDisplay = new google.maps.DirectionsRenderer();
		    directionsDisplay.setMap(' . esc_js($attr['id']) . ');
    		directionsDisplay.setPanel(document.getElementById("directionsPanel"));

				var start = \'' . esc_js($attr['start']) . '\';
				var end = \'' . esc_js($attr['end']) . '\';
				var request = {
					origin:start, 
					destination:end,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});


			';
		}
		
		//traffic
		if($attr['traffic'] == 'yes')
		{
			$returnme .= '
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(' . esc_js($attr['id']) . ');
			';
		}
	
		//bike
		if($attr['bike'] == 'yes')
		{
			$returnme .= '			
			var bikeLayer = new google.maps.BicyclingLayer();
			bikeLayer.setMap(' . esc_js($attr['id']) . ');
			';
		}
		
		//fusion tables
		if($attr['fusion'] != '')
		{
			$returnme .= '			
			var fusionLayer = new google.maps.FusionTablesLayer(' . esc_js($attr['fusion']) . ');
			fusionLayer.setMap(' . esc_js($attr['id']) . ');
			';
		}
	
		//address
		if($attr['address'] != '')
		{
			$returnme .= '
		    var geocoder_' . esc_js($attr['id']) . ' = new google.maps.Geocoder();
			var address = \'' . esc_js($attr['address']) . '\';
			geocoder_' . $attr['id'] . '.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					' . esc_js($attr['id']) . '.setCenter(results[0].geometry.location);
					';
					
					if ($attr['marker'] !='')
					{
						//add custom image
						if ($attr['markerimage'] !='')
						{
							$image_src = wp_get_attachment_image_src($attr['markerimage'], 'full');
							$returnme .= 'var image = "'. esc_url($image_src[0]) .'";';
						}
						$returnme .= '
						var marker = new google.maps.Marker({
							map: ' . esc_js($attr['id']) . ', 
							';
							if ($attr['markerimage'] !='')
							{
								$returnme .= 'icon: image,';
							}
						$returnme .= '
							position: ' . esc_js($attr['id']) . '.getCenter()
						});
						';

						//infowindow
						if($attr['infowindow'] != '') 
						{
							//first convert and decode html chars
							$thiscontent = htmlspecialchars_decode(preg_replace( "/\r|\n/", "", $attr['infowindow'])); // HTML allowed, no escaping
							$returnme .= '
							var contentString = \'' . $thiscontent . '\';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
										
							google.maps.event.addListener(marker, \'click\', function() {
							  infowindow.open(' . esc_js($attr['id']) . ',marker);
							});
							';

							//infowindow default
							if ($attr['infowindowdefault'] == 'yes')
							{
								$returnme .= '
									infowindow.open(' . esc_js($attr['id']) . ',marker);
								';
							}
						}
					}
			$returnme .= '
				} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
			';
		}

		//marker: show if address is not specified
		if ($attr['marker'] != '' && $attr['address'] == '')
		{
			//add custom image
			if ($attr['markerimage'] !='')
			{
				$returnme .= 'var image = "'. esc_url($attr['markerimage']) .'";';
			}

			$returnme .= '
				var marker = new google.maps.Marker({
				map: ' . esc_js($attr['id']) . ', 
				';
				if ($attr['markerimage'] !='')
				{
					$returnme .= 'icon: image,';
				}
			$returnme .= '
				position: ' . esc_js($attr['id']) . '.getCenter()
			});
			';

			//infowindow
			if($attr['infowindow'] != '') 
			{
				$returnme .= '
				var contentString = \'' . esc_js($attr['infowindow']) . '\';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
							
				google.maps.event.addListener(marker, \'click\', function() {
				  infowindow.open(' . esc_js($attr['id']) . ',marker);
				});
				';
				//infowindow default
				if ($attr['infowindowdefault'] == 'yes')
				{
					$returnme .= '
						infowindow.open(' . esc_js($attr['id']) . ',marker);
					';
				}				
			}
		}

		$returnme .= '</script>';
		
		return $returnme;
}
add_shortcode('minti_googlemaps', 'minti_googlemaps_function');

/*-----------------------------------------------------------------------------------*/
/* Icon
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_icon_function')) {
	function minti_icon_function( $atts ) {
		extract(shortcode_atts(array(
			'icon'      	=> 'fa-phone',
			'color'     	=> 'inherit',
			'size'      	=> 'small',
			'margin'		=> '0'
		), $atts));
		
		return '<i class="fa '. esc_attr($icon) .' minti-icon" style="color:'.esc_attr($color).' !important; font-size: '.esc_attr($size).'; margin: '.esc_attr($margin).'"></i>';
	}
	add_shortcode('minti_icon', 'minti_icon_function');
}

/*-----------------------------------------------------------------------------------*/
/* Iconbox
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_iconbox_function')) {
	function minti_iconbox_function( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'icon'      	=> 'fa-phone',
			'iconimg'		=> '',
			'title'			=> '',
			'iconcolor'		=> 'accent',
			'textcolor'		=> 'dark',
			'style'			=> '1'
		), $atts));

		if($iconimg == ''){
			$symbol = '<i class="fa '. esc_attr($icon) .' boxicon"></i>';
		}
		else{
			$img_src = wp_get_attachment_image_src($iconimg, 'full');
			$symbol = "<img src='".esc_url($img_src[0])."' class='iconimg' />";
		}
		
		if($style == '1') {
			$out = '<div class="iconbox wpb_content_element iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).'"><h3>'.$symbol.''. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></div>';
		}
		elseif($style == '2') {
			$out = '<div class="iconbox wpb_content_element iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).' clearfix"><div class="iconbox-icon">'.$symbol.'</div><div class="iconbox-content"><h3>'. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></div></div>';
		}
		elseif($style == '3') {
			$out = '<div class="iconbox wpb_content_element iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).'">'.$symbol.'<h3>'. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></div>';
		}
		elseif($style == '4') {
			$out = '<div class="iconbox wpb_content_element iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).' clearfix"><div class="iconbox-icon">'.$symbol.'</div><div class="iconbox-content"><h3>'. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></div></div>';
		}
		elseif($style == '5') {
			$out = '<div class="iconbox wpb_content_element iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).' clearfix"><div class="iconbox-icon">'.$symbol.'</div><div class="iconbox-content"><h3>'. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></div></div>';
		}
		elseif($style == '6') {
			$out = '<div class="iconbox wpb_content_element iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).' clearfix">'.$symbol.'<h3>'. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></div>';
		}
		elseif($style == '7') {
			$out = '<div class="iconbox iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).' clearfix">'.$symbol.'<h3>'. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></div>';
		}
		elseif($style == '8') {
			$out = '<div class="iconbox iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).' clearfix"><h3>'. esc_html($title) .'</h3>'.$symbol.'<p>'. do_shortcode($content) . '</p></div>';
		}
		elseif($style == '9') {
			$out = '<div class="flip"><div class="iconbox iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).' card clearfix"><div class="iconbox-box1 face front"><table><tr><td>'.$symbol.'<h3>'. esc_html($title) .'</h3></td></tr></table></div><div class="iconbox-box2 face back"><table><tr><td><h3>'. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></td></tr></table></div></div></div>';
		}
		elseif($style == '10') {
			$out = '<div class="iconbox iconbox-style-'.esc_attr($style).' icon-color-'.esc_attr($iconcolor).' color-'.esc_attr($textcolor).' clearfix">'.$symbol.'<h3>'. esc_html($title) .'</h3><p>'. do_shortcode($content) . '</p></div>';
		}
		else{
			$out = '';
		}
		
		return $out;
	}
	add_shortcode('minti_iconbox', 'minti_iconbox_function');
}

/*-----------------------------------------------------------------------------------*/
/* Image
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_image_function')) {
	function minti_image_function( $atts ) {
		extract(shortcode_atts(array(
			'img'      	=> '',
			'align'     => 'left',
			'animation' => '',
			'delay'   	=> '0',
			'lightbox'  => 'false',
			'url'      	=> '',
			'target'    => '_self',
			'extraclass'    => ''
		), $atts));

		$el_class = null;
		$caption = null;
		$return_caption = null;

		// Get Image
		if(!empty($img)) {
			$img_src = wp_get_attachment_image_src($img, 'full');
			$img_url = $img_src[0];
		}

		// Animation
		if(!empty($animation) && $animation != 'none') {
			 $el_class .= ' animate';
			
			 $column_animation = str_replace(" ","-",$animation);
			 $delay = intval($delay);
		}

		$caption = get_post($img)->post_excerpt;

		if(!empty($caption)){
			$return_caption = '<span class="single_image-caption">'. esc_html($caption) .'</span>';
		}

		// URL
		if($lightbox == 1 && $url == '') {
			$return = '<a href="'.esc_url($img_url).'" class="prettyPhoto" rel="prettyPhoto[image]"><img src="'. esc_url($img_url) .'" alt="" /></a>';
		}
		elseif($lightbox == 1 && $url != '') {
			$return = '<a href="'.esc_url($url).'" class="prettyPhoto" rel="prettyPhoto[image]"><img src="'. esc_url($img_url) .'" alt="" /></a>';
		}
		elseif($lightbox == 0 && $url != '') {
			$return = '<a href="'.esc_url($url).'" ><img src="'. esc_url($img_url) .'" alt="" /></a>';
		}		
		else{
			$return = '<img src="'. esc_url($img_url) .'" alt="" />';
		}
		
		
		return '<div class="single_image wpb_content_element align-'. esc_attr($align) .' '. esc_attr($el_class) .'" data-animation="'.esc_attr($animation).'" data-delay="'.esc_attr($delay).'">'.$return.''.$return_caption.'</div>';
	}
	add_shortcode('minti_image', 'minti_image_function');
}

/*-----------------------------------------------------------------------------------*/
/* Imagebox 
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_imagebox_function')) {
	function minti_imagebox_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'img' => '',
			'url' => '',
			'style' => '1'
		), $atts ) );

		if($url == '') {
			$return2 = "";
			$return3 = "";
		} else{
			$return2 = "<a href='".esc_url($url)."'>";
			$return3 = "</a>";
		}

		if(!empty($img)) {
			$img_src = wp_get_attachment_image_src($img, 'portfolio');
			$return = "<div class='imagebox-img'>".$return2."<img src='".esc_url($img_src[0])."' alt='' />".$return3."</div>";
		} else{
			$return = "";
		}
		  
		return '<div class="imagebox wpb_content_element style-'.esc_attr($style).'">' .$return. '' . do_shortcode($content) . '</div>';
	}
	add_shortcode('minti_imagebox', 'minti_imagebox_function');
}

/*-----------------------------------------------------------------------------------*/
/* Image Slider
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_imageslider_function')) {
	function minti_imageslider_function( $atts ) {
		extract(shortcode_atts(array(
			'ids'      	=> '',
		), $atts));

		$out = '';

		if ($ids != ""){
			$out .= '<div class="flexslider wpb_content_element"><ul class="slides">';
			// Separate our comma separated list into an array
			$ids = explode(",", $ids);
			//loop through our new array
			foreach ($ids as $image){
				$out .= "<li><img src='" . wp_get_attachment_url($image) . "' alt='' /></li>";
			}
			$out .= '</ul></div>';
		}
		
		return $out;
	}
	add_shortcode('minti_imageslider', 'minti_imageslider_function');
}

/*-----------------------------------------------------------------------------------*/
/* Line Break (br)
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_br_function')) {
	function minti_br_function() {
		return '<br />';
	}
	add_shortcode('minti_br', 'minti_br_function');
}

/*-----------------------------------------------------------------------------------*/
/* List & Listitem
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_list_function')) {
	function minti_list_function( $atts, $content = null ) {
		extract(shortcode_atts(array(), $atts));

		return '<ul class="styled-list fa-ul">'. do_shortcode($content) . '</ul>';
	}
	add_shortcode('minti_list', 'minti_list_function');
}

/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_listitem_function')) {
	function minti_listitem_function( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'icon'      => 'fa-check'
		), $atts));

		return '<li><i class="fa '.esc_attr($icon).'"></i>'. do_shortcode($content) . '</li>';
	}
	add_shortcode('minti_listitem', 'minti_listitem_function');
}

/*-----------------------------------------------------------------------------------*/
/* Member
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_member_function')) {
	function minti_member_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'img' 	=> '',
			'name' 	=> '',
			'url'		=> '',
			'role'	=> '',
			'twitter' => '',
			'facebook' => '',
			'skype' => '',
			'google' => '',
			'linkedin' => '',
			'mail' => '',
		), $atts ) );
		  
		if($url != '') {
			$returnurl = "<a href='".esc_url($url)."'>";
			$returnurl2 = "</a>";
		} else {
			$returnurl = "";
			$returnurl2 = "";
		}

		if(!empty($img)) {
			$img_src = wp_get_attachment_image_src($img, 'full');
			$return = "<div class='member-img'>".$returnurl."<img src='".esc_url($img_src[0])."' alt='' />".$returnurl2."</div>";
		} else{
			$return = "";
		}
		  
		  
		if( $twitter != '' || $facebook != '' || $skype != '' || $google != '' || $linkedin != '' || $mail != '' ){
			$return8 = '<ul class="social-icons clearfix">';
			$return9 = '</ul>';

			if($twitter != '') {
				$return2 = '<li class="social-icon social-twitter"><a href="' .esc_url($twitter). '" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
			} else{
				$return2 = ''; 
			}

			if($facebook != '') {
				$return3 = '<li class="social-icon social-facebook"><a href="' .esc_url($facebook). '" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
			} else{
				$return3 = ''; 
			}

			if($skype != '') {
				$return4 = '<li class="social-icon social-skype"><a href="' .esc_url($skype). '" target="_blank" title="Skype"><i class="fa fa-skype"></i></a></li>';
			} else{
				$return4 = ''; 
			}

			if($google != '') {
				$return5 = '<li class="social-icon social-google"><a href="' .esc_url($google). '" target="_blank" title="Google+"><i class="fa fa-google-plus"></i></a></li>';
			} else{
				$return5 = ''; 
			}


			if($linkedin != '') {
				$return6 = '<li class="social-icon social-linkedin"><a href="' .esc_url($linkedin). '" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>';
			}
			else{
				$return6 = ''; 
			}

			if($mail != '') {
				$return7 = '<li class="social-icon social-email"><a href="mailto:' .esc_attr($mail). '" title="Mail"><i class="fa fa-send-o"></i></a></li>';
			}
			else{
				$return7 = ''; 
			}
		}  else {
			$return2 = '';
			$return3 = ''; 
			$return4 = ''; 
			$return5 = ''; 
			$return6 = ''; 
			$return7 = '';
			$return8 = ''; 
			$return9 = ''; 
		}   
		
		return '<div class="member wpb_content_element">' .$return. '<h4>' .esc_html($name). '</h4><div class="member-role">' .esc_html($role). '</div><div class="member-content"><p>' . do_shortcode($content) . '</p></div>' .$return8. '' .$return2. '' .$return3. '' .$return4. '' .$return5. '' .$return6. '' .$return7. '' .$return9. '</div>';
	}
	add_shortcode('minti_member', 'minti_member_function');
}

/*-----------------------------------------------------------------------------------*/
/* Portfolio
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists('is_plugin_active')){ include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); } // load is_plugin_active() function if no available
if(is_plugin_active('unicon_portfolio_cpt/unicon_portfolio_cpt.php')){ 
if (!function_exists('minti_portfolio_function')) {
	function minti_portfolio_function($atts){
	extract(shortcode_atts(array(
		'projects'      => '9',
		'style' => 'default', // default, grid, nomargin, masonry
		'columns' => '3', // only for default, grid, nomargin
		'filters' => 'all',
		'overlay' => 'icon', // icon, name, effect,
		'showfilter' => 'no',
		'pagination' => 'no'
	), $atts));
	
	global $wp_query;
	global $post;
	global $paged;

	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }

	$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => intval($projects),
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish',
		'paged' => $paged
	);
		
	if($filters != 'all' && $filters != ''){
		// string to array
		$str = $filters;
		$arr = explode(',', $str);
		  
		$args['tax_query'][] = array(
			'taxonomy'  => 'portfolio_filter',
			'field'   => 'slug',
			'terms'   => $arr
		);
	}

	query_posts($args);

	ob_start(); // start buffer

	if( $wp_query->have_posts() ) :
		
	$randomnumber = rand(); ?>

	<div class="portfolio-element">

	<?php 
	if($showfilter == 'yes'){ 

		// Get Filters from Shortcode Options
		if($filters != '' && $filters != 'all') {
			$portfolio_filters = explode(',', $filters);
		} else {
			$portfolio_filters = get_terms('portfolio_filter');
			$arraytostring = '';
			foreach($portfolio_filters as $portfolio_filter){
				$arraytostring .= $portfolio_filter->slug . ',';
			}
			$arraytostring = rtrim($arraytostring,','); // Remove last commata;
			$portfolio_filters = explode(',', $arraytostring); // Create array
		} 
		?>

		<div class="portfolio-filters" data-id="<?php echo intval($randomnumber); ?>">
			<div class="container">
				<div class="sixteen columns clearfix">
					<?php if($portfolio_filters): ?>
						<ul class="clearfix">
							<li><a href="#" data-filter="*" class="filter-all active"><?php _e('All', 'minti'); ?></a></li>	
							<?php foreach($portfolio_filters as $portfolio_filter => $value){ ?>
								<?php $filter_name = get_term_by('slug',$value,'portfolio_filter'); ?>
								<li><a href="#" data-filter=".term-<?php echo esc_attr($value); ?>"><?php echo esc_html($filter_name->name); ?></a></li>
							<?php } ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>

	<?php } //end if showfilter ?>

	<?php if($style != 'nomargin' && $style != 'masonry'){ ?>
		<div class="container">
	<?php } ?>

				<div id="<?php echo intval($randomnumber); ?>" class="portfolio-items portfolio-<?php echo esc_attr($style); ?> portfolio-overlay-<?php echo esc_attr($overlay); ?> clearfix" data-id="<?php echo intval($randomnumber); ?>">  
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

						<?php // LIGHTBOX
						if(get_post_meta( get_the_ID(), "minti_portfolio-lightbox", true ) == '1') {
							$lightboxicon = 'icon-minti-search';
						} else {
							$lightboxicon = 'icon-minti-plus';
						} ?>

						<?php // COLUMNS      
						if($columns == '3'){
							$column_output = 'one-third column';
						} elseif($columns == '4') {
							$column_output = 'four columns';
						} elseif($columns == '2') {
							$column_output = 'eight columns';
						} ?>

					<?php // STYLE = DEFAULT -------------------------------------------------------------- /
					if($style == 'default'){ ?>

							<?php // GET FEATURED IMAGE 
							if ( has_post_thumbnail()) { $portfolio_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portfolio' ); } ?>
							
							<?php // GET FILTER
							$terms = get_the_terms( get_the_ID(), 'portfolio_filter' ); ?>   

							<div class="<?php if($terms) : foreach ($terms as $term) { echo 'term-'.esc_attr($term->slug).' '; } endif; ?>portfolio-item <?php echo esc_attr($column_output); ?>">
								<div class="portfolio-image"><?php if(get_post_meta( get_the_ID(), "minti_portfolio-lightbox", true ) == '1') { echo '<a href="'. esc_url(wp_get_attachment_url( get_post_thumbnail_id() )) .'" class="prettyPhoto" rel="prettyPhoto[portfolio]" title="'.esc_attr(get_the_title()).'">'; } else { echo '<a href="'. esc_url(get_permalink()) .'" title="'.esc_attr(get_the_title()).'">'; } ?><div class="portfolio-image-img"><img src="<?php echo esc_url($portfolio_thumbnail[0]); ?>" alt="" /></div><?php if($overlay == 'default'){ echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"></div>'; } elseif($overlay == 'icon') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"></div><i class="'.esc_attr($lightboxicon).'"></i>'; } elseif($overlay == 'name') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"><span>' .esc_html(get_the_title()). '</span><i class="'.esc_attr($lightboxicon).'"></i></div>'; } elseif($overlay == 'effect') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"><span>'.esc_html(get_the_title()).'</span></div>'; } ?></a></div>
								<h4><a href="<?php echo the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h4>
								<span class="portfolio-subtitle"><?php echo esc_html(get_post_meta( get_the_ID(), "minti_subtitle", true )); ?></span>
							</div>

					<?php // STYLE = GRID -------------------------------------------------------------- /
					} elseif($style == 'grid'){ ?>

							<?php // GET FEATURED IMAGE 
							if ( has_post_thumbnail()) { $portfolio_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'widetall' ); } ?>
							
							<?php // GET FILTER
							$terms = get_the_terms( get_the_ID(), 'portfolio_filter' ); ?>   

							<div class="<?php if($terms) : foreach ($terms as $term) { echo 'term-'.esc_attr($term->slug).' '; } endif; ?>portfolio-item <?php echo esc_attr($column_output); ?>">
								<div class="portfolio-image"><?php if(get_post_meta( get_the_ID(), "minti_portfolio-lightbox", true ) == '1') { echo '<a href="'. esc_url(wp_get_attachment_url( get_post_thumbnail_id() )) .'" class="prettyPhoto" rel="prettyPhoto[portfolio]" title="'.esc_attr(get_the_title()).'">'; } else { echo '<a href="'. esc_url(get_permalink()) .'" title="'.esc_attr(get_the_title()).'">'; } ?><div class="portfolio-image-img"><img src="<?php echo esc_url($portfolio_thumbnail[0]); ?>" alt="" /></div><?php if($overlay == 'default'){ echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"></div>'; } elseif($overlay == 'icon') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"></div><i class="'.esc_attr($lightboxicon).'"></i>'; } elseif($overlay == 'name') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"><span>' .esc_html(get_the_title()). '</span><i class="'.esc_attr($lightboxicon).'"></i></div>'; } elseif($overlay == 'effect') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"><span>'.esc_html(get_the_title()).'</span></div>'; } ?></a></div>
							</div>

					<?php // STYLE = NOMARGIN -------------------------------------------------------------- /
					} elseif($style == 'nomargin'){ ?>

							<?php // GET FEATURED IMAGE 
							if ( has_post_thumbnail()) { $portfolio_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'portfolio' ); } ?>
							
							<?php // GET FILTER
							$terms = get_the_terms( get_the_ID(), 'portfolio_filter' ); ?>   

							<div class="<?php if($terms) : foreach ($terms as $term) { echo 'term-'.esc_attr($term->slug).' '; } endif; ?>portfolio-item nomargin">
								<div class="portfolio-image"><?php if(get_post_meta( get_the_ID(), "minti_portfolio-lightbox", true ) == '1') { echo '<a href="'. esc_url(wp_get_attachment_url( get_post_thumbnail_id() )) .'" class="prettyPhoto" rel="prettyPhoto[portfolio]" title="'.esc_attr(get_the_title()).'">'; } else { echo '<a href="'. esc_url(get_permalink()) .'" title="'.esc_attr(get_the_title()).'">'; } ?><div class="portfolio-image-img"><img src="<?php echo esc_url($portfolio_thumbnail[0]); ?>" alt="" /></div><?php if($overlay == 'default'){ echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"></div>'; } elseif($overlay == 'icon') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"></div><i class="'.esc_attr($lightboxicon).'"></i>'; } elseif($overlay == 'name') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"><span>' .esc_html(get_the_title()). '</span><i class="'.esc_attr($lightboxicon).'"></i></div>'; } elseif($overlay == 'effect') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"><span>'.esc_html(get_the_title()).'</span></div>'; } ?></a></div>
							</div>

					<?php // STYLE = MASONRY -------------------------------------------------------------- /
					} elseif($style == 'masonry'){ ?>

							<?php // GET FEATURED IMAGE 
							if ( has_post_thumbnail()) { $portfolio_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), get_post_meta( get_the_ID(), "minti_portfolio-size", true ) ); } ?>
							
							<?php // GET FILTER
							$terms = get_the_terms( get_the_ID(), 'portfolio_filter' ); ?>   

							<div class="<?php if($terms) : foreach ($terms as $term) { echo 'term-'.esc_attr($term->slug).' '; } endif; ?>portfolio-item masonry <?php echo esc_attr(get_post_meta( get_the_ID(), "minti_portfolio-size", true )); ?>">
								<div class="portfolio-image"><?php if(get_post_meta( get_the_ID(), "minti_portfolio-lightbox", true ) == '1') { echo '<a href="'. esc_url(wp_get_attachment_url( get_post_thumbnail_id() )) .'" class="prettyPhoto" rel="prettyPhoto[portfolio]" title="'.esc_attr(get_the_title()).'">'; } else { echo '<a href="'. esc_url(get_permalink()) .'" title="'.esc_attr(get_the_title()).'">'; } ?><div class="portfolio-image-img"><img src="<?php echo esc_url($portfolio_thumbnail[0]); ?>" alt="" /></div><?php if($overlay == 'default'){ echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"></div>'; } elseif($overlay == 'icon') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"></div><i class="'.esc_attr($lightboxicon).'"></i>'; } elseif($overlay == 'name') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"><span>' .esc_html(get_the_title()). '</span><i class="'.esc_attr($lightboxicon).'"></i></div>'; } elseif($overlay == 'effect') { echo '<div class="portfolio-overlay overlay-'. esc_attr($overlay) .'"><span>'.esc_html(get_the_title()).'</span></div>'; } ?></a></div>
							</div>

					<?php } // end style ?>
					  
					<?php endwhile; ?>
				</div>

	<?php if($style != 'nomargin' && $style != 'masonry'){ ?>
		</div>
	<?php } ?>

	</div>
		
	<?php if($pagination == 'yes'){ ?>
		<div class="pagination-<?php echo $style; ?>"><?php get_template_part( 'framework/inc/nav' ); ?></div>
	<?php } ?>
	
	<?php wp_reset_query(); endif; // needs to be wp_reset_query() instead of wp_reset_postdata() so that pagination works.

	$portfolio_output = ob_get_contents(); // get buffered content

	ob_end_clean(); // clean buffer

	return $portfolio_output;
	
	}
	add_shortcode('minti_portfolio', 'minti_portfolio_function');
}
}

/*-----------------------------------------------------------------------------------*/
/* Pricing Plan
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_pricingplan_function')) {
	function minti_pricingplan_function( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'name'      => 'Premium',
			'link'      => false,
			'linkname'      => 'Sign Up',
			'price'      => '$39.00',
			'per'      => false,
			'color'    => false
		), $atts));

		if($per != false) {
			$return3 = "".$per."";
		}
		else{
			$return3 = "";
		}

		if($color != false) {
			$return = 'pricing-color-true';
		}
		else{
			$return = 'pricing-color-false';
		}

		if($link != false) {
			$return2 = '<div class="pricing-signup"><a href="'.esc_url($link).'" class="button color-5">'.esc_html($linkname).'</a></div>';
		}
		else{
			$return2 = "";
		}
		
		$out = '<div class="pricing-plan '.esc_attr($return).' wpb_content_element">
				<div class="pricing-plan-head" style="background-color:'.esc_attr($color).';">
					<h3>'.esc_html($name).'</h3>
					<div class="pricing-price"><span class="pricing-amount">'.esc_html($price).'</span><span class="pricing-per">'.esc_html($return3).'</span></div>
				</div>
				'.do_shortcode($content).'
				'.$return2.'
			</div>';

		return $out;
	}
	add_shortcode('minti_pricingplan', 'minti_pricingplan_function');
}

/*-----------------------------------------------------------------------------------*/
/* Progressbar 
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_progressbar_function')) {
	function minti_progressbar_function( $atts ) {
		extract(shortcode_atts(array(
			'percentage' => '0',
			'title'      => '',
			'color'    => '#999999'
		), $atts));

		return '<div class="progress-title clearfix">' .esc_html($title). '<span>' .esc_html($percentage). '%</span></div><div class="progressbar" data-perc="' .esc_attr($percentage). '"><div class="progress-percentage" style="background: '.esc_attr($color).' !important;"></div></div>';
	}
	add_shortcode('minti_progressbar', 'minti_progressbar_function');
}

/*-----------------------------------------------------------------------------------*/
/* Pullquote
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_pullquote_function')) {
	function minti_pullquote_function( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'align'      => 'left'
		), $atts));
	  
		return '<span class="pullquote align-'.esc_attr($align).'">' . do_shortcode($content) . '</span>';
	}
	add_shortcode('minti_pullquote', 'minti_pullquote_function');
}

/*-----------------------------------------------------------------------------------*/
/* Spacer
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_spacer_function')) {
	function minti_spacer_function( $atts) {
		extract( shortcode_atts( array(
			'height'  => '10'
		), $atts ) );

		if($height == '') {
			$return = '';
		} else{
			$return = 'style="height: '.esc_attr($height).'px;"';
		}

		return '<div class="spacer" ' . $return . '></div>';
	}
	add_shortcode('minti_spacer', 'minti_spacer_function');
}

/*-----------------------------------------------------------------------------------*/
/* Social Icons 
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_social_function')) {
	function minti_social_function( $atts) {
		extract( shortcode_atts( array(
			'icon' 	=> 'fa-twitter',
			'url'		=> '#',
			'target' 	=> '_blank'
		), $atts ) );

		return '<div class="social-icon social-big"><a href="' . esc_url($url) . '" target="' . esc_attr($target) . '"><i class="fa ' . esc_attr($icon) . '"></i></a></div>';
	}
	add_shortcode('minti_social', 'minti_social_function');
}

/*-----------------------------------------------------------------------------------*/
/* Styled Tables
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_table_function')) {
	function minti_table_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'style' 	=> '1'
		), $atts ) );

		return '<div class="custom-table-' . esc_attr($style) . '">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('minti_table', 'minti_table_function');
}

/*-----------------------------------------------------------------------------------*/
/* Testimonial
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_testimonial_function')) {
	function minti_testimonial_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'author' => '',
			'company' => '',
			'img' => ''
		), $atts ) );

		if(!empty($img)) {
			$img_src = wp_get_attachment_image_src($img, 'thumbnail');
			$return = '<div class="testimonial-img"><img src="'.esc_url($img_src[0]).'" alt="" /></div>';
		} else{
			$return = "";
		}

		return '<div class="testimonial-wrap wpb_content_element"><div class="testimonial">' . do_shortcode($content) . '</div><div class="testimonial-author">'.$return.'' .esc_html($author). '<span>' .esc_html($company). '</span></div></div>';
	}
	add_shortcode('minti_testimonial', 'minti_testimonial_function');
}

/*-----------------------------------------------------------------------------------*/
/* Testimonial Slider
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_testimonialslider_function')) {
	function minti_testimonialslider_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'testimonial_1' => '',
			'author_1' => '',
			'testimonial_2' => '',
			'author_2' => '',
			'testimonial_3' => '',
			'author_3' => '',
			'testimonial_4' => '',
			'author_4' => '',
			'testimonial_5' => '',
			'author_5' => '',
			'testimonial_6' => '',
			'author_6' => '',
		), $atts ) );

		wp_enqueue_script('minti-carousel');

		$out = '';

		$out .= '<div class="testimonial-slider-wrap wpb_content_element">';
			
			if($testimonial_1 != ''){ $out .= '<div class="testimonial-slide">' .esc_html($testimonial_1). '<span>&#45; ' .esc_html($author_1). '</span></div>'; }
			if($testimonial_2 != ''){ $out .= '<div class="testimonial-slide">' .esc_html($testimonial_2). '<span>&#45; ' .esc_html($author_2). '</span></div>'; }
			if($testimonial_3 != ''){ $out .= '<div class="testimonial-slide">' .esc_html($testimonial_3). '<span>&#45; ' .esc_html($author_3). '</span></div>'; }
			if($testimonial_4 != ''){ $out .= '<div class="testimonial-slide">' .esc_html($testimonial_4). '<span>&#45; ' .esc_html($author_4). '</span></div>'; }
			if($testimonial_5 != ''){ $out .= '<div class="testimonial-slide">' .esc_html($testimonial_5). '<span>&#45; ' .esc_html($author_5). '</span></div>'; }
			if($testimonial_6 != ''){ $out .= '<div class="testimonial-slide">' .esc_html($testimonial_6). '<span>&#45; ' .esc_html($author_6). '</span></div>'; }

		$out .= '</div>';

		return $out;
	}
	add_shortcode('minti_testimonialslider', 'minti_testimonialslider_function');
}

/*-----------------------------------------------------------------------------------*/
/* Title
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_title_function')) {
	function minti_title_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'align'   => 'left',
			'margin' => '',
		), $atts ) );

		if($margin == '') {
			$return = '';
		}
		else{
			$return = 'style="margin: '.esc_attr($margin).';"';
		}

		return '<div class="divider-title align-' . esc_attr($align) . '" '.$return.'>' . $content . '</div>';
	}
	add_shortcode('minti_title', 'minti_title_function');
}

/*-----------------------------------------------------------------------------------*/
/* Headline
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_headline_function')) {
	function minti_headline_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'type'   => 'h3',
			'margin' => '0 0 20px 0',
			'size'	 => 'fontsize-inherit',
			'color'	 => '',
			'weight' => 'fontweight-400',
			'lineheight' => 'lh-inherit',
			'class'	 => '',
			'transform'	 => 'transform-inherit',
			'align'	 => 'align-center',
			'font'	 => 'font-inherit'
		), $atts ) );

		$style = '';

		if($margin != '') {
			$style .= 'margin: '.esc_attr($margin).';';
		}
		if($color != '') {
			$style .= ' color: '.esc_attr($color).';';
		}

		return '<' . esc_attr($type) . ' class="headline '.esc_attr($font).' '.esc_attr($size).' '.esc_attr($weight).' '.esc_attr($lineheight).' '.esc_attr($align).' '.esc_attr($transform).' '.esc_attr($class).'" style="'.esc_attr($style).'">' . $content . '</' . esc_attr($type) . '>';
	}
	add_shortcode('minti_headline', 'minti_headline_function');
}

/*-----------------------------------------------------------------------------------*/
/* Toggle
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_toggle_function')) {
	function minti_toggle_function( $atts, $content = null){
		extract(shortcode_atts(array(
			'title' => '',
			'icon' => '',
			'open' => "false"
		), $atts));

		if($icon == '') {
			$return = "";
		}
		else{
			$return = "<i class='fa ".esc_attr($icon)."'></i>";
		}
		
		if($open == "true") {
			$return2 = "active";
		}
		else{
			$return2 = '';
		}
	   
	   return '<div class="toggle"><div class="toggle-title '.esc_attr($return2).'">'.$return.''.esc_html($title).'</div><div class="toggle-inner"><p>'. do_shortcode($content) . '</p></div></div>';
	}
	add_shortcode('minti_toggle', 'minti_toggle_function');
}

/*-----------------------------------------------------------------------------------*/
/* Tooltip
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_tooltip_function')) {
	function minti_tooltip_function( $atts, $content = null){
		extract(shortcode_atts(array(
			'text' => ''
		), $atts));

		return '<span class="tooltips"><a href="#" title="'.esc_attr($text).'" onclick="return false">'. do_shortcode($content) . '</a></span>';
	}
	add_shortcode('minti_tooltip', 'minti_tooltip_function');
}

/*-----------------------------------------------------------------------------------*/
/* Video
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_video_function')) {
	function minti_video_function( $atts, $content = null) {
		extract(shortcode_atts(array(
			'extraclass'  => ''
		), $atts));

		$embed_code = wp_oembed_get($content);
		return '<div class="video-embed  wpb_content_element">'. $embed_code .'</div>'; // No escape needed here
	}
	add_shortcode('minti_video', 'minti_video_function');
}

/*-----------------------------------------------------------------------------------*/
/* Visibility 
/*-----------------------------------------------------------------------------------*/
if (!function_exists('minti_visibility_function')) {
	function minti_visibility_function( $atts, $content = null) {
		extract( shortcode_atts( array(
			'show' => 'desktop'
		), $atts ) );

		return '<div class="visibility-' . esc_attr($show) . '">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('minti_visibility', 'minti_visibility_function');
}

?>