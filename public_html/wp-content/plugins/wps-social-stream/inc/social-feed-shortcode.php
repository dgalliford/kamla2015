<?php
function swp_social_grid_shortcode($attr,$content=null){
	global $wpdb,$animate_slider_tables;
	$grid_table = $wpdb->base_prefix.$animate_slider_tables;
	$cat_id = $taxonomi_name = $tag_id = $post_id = '';
	extract(shortcode_atts( array(
		'id' => ''
	), $attr));
	$grid_data = $wpdb->get_row("select * from ".$grid_table." where id=".$id);
	if(count($grid_data) == 1){
		$grid = unserialize($grid_data->slider_params);

		echo do_shortcode('[swp_social fb_num="'.$grid["fb_num"].'" gplus_type="'.$grid["gplus_type"].'" gplus_num="'.$grid["gplus_num"].'" twitter_type="'.$grid["twitter_type"].'" twitter_num="'.$grid["twitter_num"].'" instagram_type="'.$grid["instagram_type"].'" instagram_num="'.$grid["instagram_num"].'" youtube_num="'.$grid["youtube_num"].'" tumblr_num="'.$grid["tumblr_num"].'" vimeo_num="'.$grid["vimeo_num"].'" post_type="'.$grid["post_type"].'" skin_type="'.$grid["skin_type"].'" car_display_item="'.$grid["car_display_item"].'" car_pagination="'.$grid["car_pagination"].'" car_pagination_num="'.$grid["car_pagination_num"].'" car_navigation="'.$grid["car_navigation"].'" car_autoplay="'.$grid["car_autoplay"].'" car_autoplay_time="'.$grid["car_autoplay_time"].'" grid_columns_count_for_desktop="'.$grid["grid_columns_count_for_desktop"].'" grid_columns_count_for_tablet="'.$grid["grid_columns_count_for_tablet"].'" grid_columns_count_for_mobile="'.$grid["grid_columns_count_for_mobile"].'" excerpt_length="'.$grid["excerpt_length"].'" hide_media="'.$grid["hide_media"].'" filter="'.$grid["filter"].'" sort_filter="'.$grid["sort_filter"].'" loadmore="'.$grid["loadmore"].'" date_sorting="'.$grid["date_sorting"].'" fb_id="'.$grid["fb_id"].'" gplus_id="'.$grid["gplus_id"].'" twitter_id="'.$grid["twitter_id"].'" instagram_id="'.$grid["instagram_id"].'" youtube_id="'.$grid["youtube_id"].'" youtube_playlist_id="'.$grid["youtube_playlist_id"].'" tumblr_id="'.$grid["tumblr_id"].'" vimeo_id="'.$grid["vimeo_id"].'" loadmore_text="'.$grid["loadmore_text"].'" effect="'.$grid["effect"].'" svc_class="'.$grid["svc_class"].'" pbgcolor="'.$grid["pbgcolor"].'" pbghcolor="'.$grid["pbghcolor"].'" tcolor="'.$grid["tcolor"].'" ftcolor="'.$grid["ftcolor"].'" ftacolor="'.$grid["ftacolor"].'" ftabgcolor="'.$grid["ftabgcolor"].'" loder_color="'.$grid["loder_color"].'" car_navigation_color="'.$grid["car_navigation_color"].'"]');
	}else{
		_e('Not Found Social Feed.','swp-social');
	}

}
function swp_social_layout_shortcode($attr,$content=null){
	
	extract(shortcode_atts( array(
		'fb_id' => '',
		'fb_num' => '',
		'gplus_type' => '',
		'gplus_id' => '',
		'gplus_num' => '',
		'twitter_type' => '',
		'twitter_id' => '',
		'twitter_num' => '',
		'instagram_type' => '',
		'instagram_id' => '',
		'instagram_num' => '',
		'youtube_id' => '',
		'youtube_playlist_id' => '',
		'youtube_num' => '',
		'tumblr_id' => '',
		'tumblr_num' => '',
		'vimeo_id' => '',
		'vimeo_num' => '',
		'post_type' => '',
		'skin_type' => '',
		'car_display_item' => '4',
		'car_pagination' => '',
		'car_pagination_num' => '',
		'car_navigation' => '',
		'car_autoplay' => '',
		'car_autoplay_time' => '5',
		'grid_columns_count_for_desktop' => '',
		'grid_columns_count_for_tablet' => '',
		'grid_columns_count_for_mobile' => '',
		'excerpt_length' => '',
		'hide_media' => '',
		'filter' => '',
		'sort_filter' => '',
		'loadmore' => '',
		'loadmore_text' => '',
		'date_sorting' => '',
		'effect' => '',
		'svc_class' => '',
		'pbgcolor' => '',
		'pbghcolor' => '',
		'tcolor' => '',
		'ftcolor' => '',
		'ftacolor' => '',
		'ftabgcolor' => '',
		'loder_color' => '',
		'car_navigation_color' => ''
	), $attr));

	wp_register_style( 'svc-social-css', plugins_url('../assets/css/css.css', __FILE__));
	wp_enqueue_style( 'svc-social-css');
	wp_enqueue_style( 'vcyt-bootstrap-css' );
	wp_enqueue_style( 'svc-megnific-css' );
	wp_enqueue_style( 'svc-social-animate-css');

	wp_enqueue_script('svc-megnific-js');
	$svc_social_id = rand(100,7000);
	ob_start();
	?>
<style type="text/css">
<?php if($ftcolor != ''){?>
.svc_sort_div_<?php echo $svc_social_id;?>{background:<?php echo $ftabgcolor;?> !important; color:<?php echo $ftacolor;?> !important;}
.svc_sort_div a i{ color:<?php echo $ftacolor;?> !important;}
<?php }?>

<?php if($skin_type == 'template'){$skint = '';}elseif($skin_type == 'template1'){$skint = '1';}elseif($skin_type == 'template2'){$skint = '2';}
if($pbgcolor != ''){?>
.vc_social_tm<?php echo $skint;?>{ background:<?php echo $pbgcolor;?> !important;}
<?php }
if($pbghcolor != ''){?>
.vc_social_tm<?php echo $skint;?>:hover{ background:<?php echo $pbghcolor;?> !important;}
<?php }
if($tcolor != ''){?>
.vc_social_tm<?php echo $skint;?> .svc-author-title{ color:<?php echo $tcolor;?>  !important;}
<?php }
if($ftcolor != ''){?>
.svc_social_filter_ul_<?php echo $svc_social_id;?> li{ border:1px solid <?php echo $ftcolor;?> !important;}
.svc_social_filter_ul_<?php echo $svc_social_id;?> li a{ color:<?php echo $ftcolor;?> !important;}
<?php }
if($ftacolor != ''){?>
.svc_social_filter_ul_<?php echo $svc_social_id;?> li.active a{ color:<?php echo $ftacolor;?> !important;}
<?php }
if($ftabgcolor != ''){?>
.svc_social_filter_ul_<?php echo $svc_social_id;?> li.active{ background:<?php echo $ftabgcolor;?> !important;border:1px solid <?php echo $ftabgcolor;?> !important;}
<?php }
if($loder_color != ''){?>
.svc_social_stream_container_<?php echo $svc_social_id;?> nav#svc_infinite div.loading-spinner .ui-spinner .side .fill{background:<?php echo $loder_color;?> !important;}
.svc_load_more_<?php echo $svc_social_id;?>.svc_carousel_loadmore{ color:<?php echo $loder_color;?> !important;}
<?php }
if($car_navigation_color != ''){?>
.owl-theme .owl-controls .owl-buttons div{ background:<?php echo $car_navigation_color;?> !important;}
.owl-theme .owl-controls .owl-page span{ background:<?php echo $car_navigation_color;?> !important;}
<?php }?>
</style>
    <div>
    	<div class="svc_mask <?php echo $svc_class;?>" id="svc_mask_<?php echo $svc_social_id;?>">
            <div id="loader"></div>
        </div>
        <section class="feed svc_social_stream_container svc_social_stream_container_<?php echo $svc_social_id;?> <?php echo $svc_class;?>">
        <?php if($filter == 'yes' && $post_type == 'post_layout'){?>
        <div class="svc_social_filter_div">
        	<ul class="svc_social_filter_ul svc_social_filter_ul_<?php echo $svc_social_id;?>">
				<li data-filter="*" class="active"><a href="javascript:;">All</a></li>
				<?php if($fb_id != ''){?>
            	<li data-filter="svc_facebook"><a href="javascript:;">Facebook</a></li>
				<?php }
				if($twitter_id != ''){?>
                <li data-filter="svc_twitter"><a href="javascript:;">Twitter</a></li>
				<?php }
				if($gplus_id != ''){?>
                <li data-filter="svc_gplus"><a href="javascript:;">Gplus</a></li>
				<?php }
				if($instagram_id != ''){?>
                <li data-filter="svc_instagram"><a href="javascript:;">Instagram</a></li>
				<?php }
				if($youtube_id != ''){?>
                <li data-filter="svc_youtube"><a href="javascript:;">YouTube</a></li>
				<?php }
				if($tumblr_id != ''){?>
                <li data-filter="svc_tumblr"><a href="javascript:;">Tumblr</a></li>
				<?php }
				if($vimeo_id != ''){?>
                <li data-filter="svc_vimeo"><a href="javascript:;">Vimeo</a></li>
				<?php }?>
            </ul>
            
            <?php if($sort_filter == 'yes' && $post_type == 'post_layout'){
				
				$output = '
				<div class="svc_fl svc_sort_div svc_sort_div_'.$svc_social_id.'">
					<div class="svc_sort_title">'.__(ucwords ( str_replace('_',' ','Date') ),'js_composer').'</div>
					<a href="javascript:;" class="svc_active" id="svc_sort_asc_'.$svc_social_id.'"><i class="fa fa-chevron-up"></i></a>
					<a href="javascript:;" class="" id="svc_sort_desc_'.$svc_social_id.'"><i class="fa fa-chevron-down"></i></a>
				</div>';
				echo $output;
			}?>
            </div>
            <?php
        }?>
			<div class="social-feed-container social-feed-container_<?php echo $svc_social_id;?>" style="width:100%;" id="svc_social_stream_<?php echo $svc_social_id;?>">
			</div>
            <?php if($loadmore == 'yes' && $post_type == 'post_layout'){?>
			<div class="load_more_main_div <?php echo $svc_class;?>">
				<nav id="svc_infinite" class="svc_infinite_<?php echo $svc_social_id;?>">
				  <div class="loading-spinner loading-spinner_<?php echo $svc_social_id;?>">
					<div class="ui-spinner">
					  <span class="side side-left">
						<span class="fill"></span>
					  </span>
					  <span class="side side-right">
						<span class="fill"></span>
					  </span>
					</div>
				  </div>
				  <a href="javascript:;" data-facebook="" data-twitter="" data-gplus="" data-instagram="" data-tumblr="" data-youtube="" data-vimeo="" class="svc_load_more_<?php echo $svc_social_id;?> svc_carousel_loadmore" id="social_load_more_btn_<?php echo $svc_social_id;?>" rel="<?php echo $svc_social_id;?>"><?php if($loadmore_text != ''){ _e($loadmore_text,'swp-social');}else{ _e('Show More','swp-social');}?></a>
				</nav>
			</div>
            <?php }?>
        </section>
    </div>
	<script>
    jQuery(document).ready(function() {
		var iso_cont = jQuery('.social-feed-container_<?php echo $svc_social_id;?>');
		<?php  if($sort_filter == 'yes' && $post_type == 'post_layout'){?>
		jQuery('#svc_sort_asc_<?php echo $svc_social_id;?>').click(function() {
			jQuery('.svc_sort_div_<?php echo $svc_social_id;?> a').removeClass('svc_active');
			jQuery(this).addClass('svc_active');
			iso_cont.isotope({
			  sortBy: 'date',
			  sortAscending : true
			});
		});
		jQuery('#svc_sort_desc_<?php echo $svc_social_id;?>').click(function() {
			jQuery('.svc_sort_div_<?php echo $svc_social_id;?> a').removeClass('svc_active');
			jQuery(this).addClass('svc_active');
			iso_cont.isotope({
			  sortBy: 'date',
			  sortAscending : false
			});
		});
		<?php }?>
		<?php if($filter == 'yes' && $post_type == 'post_layout'){?>
		jQuery('.svc_social_filter_ul_<?php echo $svc_social_id;?> li').on( 'click', function(e) {
		  e.preventDefault();
		  jQuery('.svc_social_filter_ul_<?php echo $svc_social_id;?> li').removeClass('active');
		  jQuery(this).addClass('active');
		  var filterValue = jQuery(this).attr('data-filter');
		  
		  var filterValue = '';
		  jQuery('.svc_social_filter_ul_<?php echo $svc_social_id;?> li').each(function(){
		  	if(jQuery(this).hasClass('active')){
				var v = jQuery(this).attr('data-filter');
				if(typeof v != 'undefined' ){
					if(v === '*'){
						filterValue += v;
					}else{
						filterValue += '.'+v;
					}
				}
			}
		  });
		  iso_cont.isotope({transformsEnabled: false,isResizeBound: false,transitionDuration: 0}).isotope({ filter: filterValue }).isotope();
		});
		<?php }
		if($loadmore == 'yes' && $post_type == 'post_layout'){?>
		jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').click(function(){
			jQuery('.loading-spinner_<?php echo $svc_social_id;?>').show();
			jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').hide();
			jQuery('.social-feed-container_<?php echo $svc_social_id;?>').svc_social_stream({
				grid_columns_count_for_desktop:'<?php echo $grid_columns_count_for_desktop;?>',
				grid_columns_count_for_tablet:'<?php echo $grid_columns_count_for_tablet;?>',
				grid_columns_count_for_mobile:'<?php echo $grid_columns_count_for_mobile;?>',
				stream_id:'<?php echo $svc_social_id;?>',
				length: <?php echo $excerpt_length;?>,
				<?php if($effect != ''){?>
				effect:'<?php echo $effect;?>',
				<?php }?>
                show_media: <?php echo ($hide_media == 'yes') ? 'false' : 'true';?>,
				template: '<?php echo plugins_url( ltrim( 'template/'.$skin_type.'.html', '/' ), __FILE__ );?>',
				<?php if($gplus_id != ''){?>
				google: {
					accounts: ["<?php echo $gplus_type.$gplus_id;?>"],
					limit: <?php echo $gplus_num;?>,
                    access_token: 'AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4',
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-gplus'),
					showmore:true
				},
				<?php }
				if($fb_id != ''){?>
				facebook: {
					accounts: ["@<?php echo $fb_id;?>"],
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-facebook'),
					showmore:true
				},
				<?php }
				if($twitter_id != ''){?>
				twitter: {
                    accounts: ["<?php echo $twitter_type.$twitter_id;?>"], // @ user id #for search result
					limit: <?php echo $twitter_num;?>,
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-twitter'),
					showmore:true,
                    consumer_key: 'UaXiG364zfkqhkkK6ckFSRtoy', // make sure to have your app read-only
                    consumer_secret: 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V', // make sure to have your app read-only
                },
				<?php }
				if($instagram_id != ''){?>
				instagram: {
                    accounts: ["<?php echo $instagram_type.$instagram_id;?>"], //@ for user # user serach
                    loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-instagram'),
					showmore:true
                },
				<?php }
				if($tumblr_id != ''){?>
				tumblr: {
                    accounts: ["@<?php echo $tumblr_id;?>"], //for @flipkart page
                    limit: <?php echo $tumblr_num;?>,
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-tumblr'),
					showmore:true,
                    api_key: 'HXre7XQapYZgmz6mDlPfv0wAzYHz93tyxyCA94wDw9wG6ATMiI'
                },
				<?php }
				if($youtube_id != ''){?>
				youtube: {
					accounts: ["<?php echo $youtube_id;?>"],
                    limit: <?php echo $youtube_num;?>,
					<?php if($youtube_playlist_id != ''){?>
					playlistid: '<?php echo $youtube_playlist_id;?>',
					<?php }?>
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-youtube'),
					showmore:true,
                    access_token: 'AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4'
				},
				<?php }
				if($vimeo_id != ''){?>
				vimeo: {
                    accounts: ["<?php echo $vimeo_id;?>"], //for @user723916 page
					loadmore:jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').attr('data-vimeo'),
					showmore:true,
                },
				<?php }?>
				callback: function(dataa_social) {
					var dd = 0;
					var iitem = jQuery( dataa_social );
					
					iitem.imagesLoaded( function() {
					jQuery('.loading-spinner_<?php echo $svc_social_id;?>').hide();
					jQuery('#social_load_more_btn_<?php echo $svc_social_id;?>').show();
					iso_cont.append( iitem ).isotope( 'appended',iitem);
					wps_megnific_script();
						jQuery("[vc-social-effect]").viewportChecker({
							classToAdd: '<?php echo $effect;?>', // Class to add to the elements when they are visible
							classToRemove: 'opacity0', // Class to remove before adding 'classToAdd' to the elements
							callbackFunction: function(elem, action){
								if(action == 'add'){
									elem.removeAttr('vc-social-effect');
								}
							},
						});
					});
					/*iso_cont.append( iitem ).isotope( 'appended',iitem);
					iso_cont.isotope();
					setTimeout(function(){
						jQuery("[vc-social-effect]").each(function(index, element) {
                            var ef = jQuery(this).attr('vc-social-effect');
							jQuery(this).addClass(ef).removeClass('opacity0').removeAttr('vc-social-effect');
                        });
						var sdi = setInterval(function(){
							iso_cont.isotope();
							if(dd>5){
								clearInterval(sdi);
							}
							dd++;
						},800);
					},500);*/
                }
			});
		});
		<?php }
		if($post_type == 'post_layout'){?>
		iso_cont.isotope({
			itemSelector: '.svc-social-item',
			getSortData: {
				date: function (elem) {
					return Date.parse(jQuery(elem).attr('dt-create'));
				}
			},
			<?php if($date_sorting == 'yes'){?>
			sortBy: 'date',
			sortAscending : false,
			<?php }?>
			transformsEnabled: false,
			  isResizeBound: false,
			  transitionDuration: '0',
			  filter: '*',
			  layoutMode: 'masonry',
			  masonry: {
				columnWidth: 1
			  }
		});
		jQuery(window).resize(function(){
				iso_cont.isotope();
		});
		<?php }else{?>
		iso_cont.owlCarousel({
			<?php if($car_autoplay == 'yes'){?>
			autoPlay: <?php echo $car_autoplay_time*1000;?>,
			<?php }?>
			items : <?php echo $car_display_item;?>,
			pagination:<?php if($car_pagination == 'yes'){echo 'true';}else{echo 'false';}?>,
			navigation: <?php if($car_navigation == 'yes'){echo 'false';}else{echo 'true';}?>,
			<?php if($car_pagination == 'yes' && $car_pagination_num == 'yes'){?>
			paginationNumbers:true,
			<?php }
			if($synced == 'yes' && $car_display_item == 1){?>
			afterAction : svc_syncPosition_<?php echo $svc_grid_id;?>,
			responsiveRefreshRate : 200,
			<?php }?>
			navigationText: [
				"<i class='fa fa-chevron-left icon-white'></i>",
				"<i class='fa fa-chevron-right icon-white'></i>"
			]
		});
		<?php }?>
        var vc_social_updateFeed_<?php echo $svc_social_id;?> = function() {
            jQuery('.social-feed-container_<?php echo $svc_social_id;?>').svc_social_stream({
				<?php if($gplus_id != ''){?>
				google: {
                    accounts: ["<?php echo $gplus_type.$gplus_id;?>"],//for page #113649881831517330739 for profile @digital.inspiration
                    limit: <?php echo $gplus_num;?>,
                    access_token: 'AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4'
                },
				<?php }if($fb_id != ''){?>
                facebook: {
                    accounts: ["@<?php echo $fb_id;?>"], //for @digital.inspiration page
                    limit: <?php echo $fb_num;?>,
                    access_token: '150849908413827|a20e87978f1ac491a0c4a721c961b68c'
                },
				<?php }
				if($twitter_id != ''){?>
                twitter: {
                    accounts: ["<?php echo $twitter_type.$twitter_id;?>"], // @shabbyapple user id #for search result
                    limit: <?php echo $twitter_num;?>,
                    consumer_key: 'UaXiG364zfkqhkkK6ckFSRtoy', // make sure to have your app read-only
                    consumer_secret: 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V', // make sure to have your app read-only
                },
				<?php }
				if($instagram_id != ''){?>
				instagram: {
                    accounts: ["<?php echo $instagram_type.$instagram_id;?>"], //@shabbyapple for user # user serach
                    limit: <?php echo $instagram_num;?>,
                    client_id: 'c47fb3449fbf4dcea3d52aab52630556'
                },
				<?php }
				if($tumblr_id != ''){?>
				tumblr: {
                    accounts: ["@<?php echo $tumblr_id;?>"], //for @itunes page
                    limit: <?php echo $tumblr_num;?>,
                    api_key: 'HXre7XQapYZgmz6mDlPfv0wAzYHz93tyxyCA94wDw9wG6ATMiI'
                },
				<?php }
				if($youtube_id != ''){?>
				youtube: {
					accounts: ["<?php echo $youtube_id;?>"],
                    limit: <?php echo $youtube_num;?>,
					<?php if($youtube_playlist_id != ''){?>
					playlistid: '<?php echo $youtube_playlist_id;?>',
					<?php }?>
                    access_token: 'AIzaSyAJKeuhWtuqt7tp8gfg2bWeCXjPSj2Ev_4'
				},
				<?php }
				if($vimeo_id != ''){?>
				vimeo: {
                    accounts: ["<?php echo $vimeo_id;?>"], //for @user723916 page
					limit: <?php echo $vimeo_num;?>,
                },
				<?php }
				if($post_type == 'post_layout'){?>
				grid_columns_count_for_desktop:'<?php echo $grid_columns_count_for_desktop;?>',
				grid_columns_count_for_tablet:'<?php echo $grid_columns_count_for_tablet;?>',
				grid_columns_count_for_mobile:'<?php echo $grid_columns_count_for_mobile;?>',
				<?php }else{?>
				grid_columns_count_for_desktop:'',
				grid_columns_count_for_tablet:'',
				grid_columns_count_for_mobile:'',
				<?php }?>
				stream_id:'<?php echo $svc_social_id;?>',
                length: <?php echo $excerpt_length;?>,
				<?php if($effect != ''){?>
				effect:'<?php echo $effect;?>',
				<?php }?>
                show_media: <?php echo ($hide_media == 'yes') ? 'false' : 'true';?>,
				template: '<?php echo plugins_url( ltrim( 'template/'.$skin_type.'.html', '/' ), __FILE__ );?>',
                // Moderation function - if returns false, template will have class hidden
                moderation: function(content) {
                    return (content.text) ? content.text.indexOf('fuck') == -1 : true;
                },
                //update_period: 5000,
                // When all the posts are collected and displayed - this function is evoked
                callback: function(dataa_social) {
                    console.log('all posts are collected');
					<?php if($post_type == 'post_layout'){?>
					var dd = 0;
					var sdasd = jQuery( dataa_social );
					iso_cont.isotope( 'insert',sdasd);
					iso_cont.imagesLoaded( function() {
						//iso_cont.isotope();
						setTimeout(function(){
							
							var sdi = setInterval(function(){
								iso_cont.isotope();
								if(dd>10){
									clearInterval(sdi);
								}
								dd++;
							},800);
							
							iso_cont.isotope();
							setTimeout(function(){
								jQuery('.svc_social_stream_container_<?php echo $svc_social_id;?>').show();
								jQuery('#svc_mask_<?php echo $svc_social_id;?>').hide();
								jQuery("[vc-social-effect]").viewportChecker({
									classToAdd: '<?php echo $effect;?>', // Class to add to the elements when they are visible
									classToRemove: 'opacity0', // Class to remove before adding 'classToAdd' to the elements
									callbackFunction: function(elem, action){
										if(action == 'add'){
											elem.removeAttr('vc-social-effect');
										}
									},
								});
								/*jQuery("[vc-social-effect]").each(function(index, element) {
									var ef = jQuery(this).attr('vc-social-effect');
									jQuery(this).addClass(ef).removeClass('opacity0').removeAttr('vc-social-effect');
								});*/
							},1000);
						},1000);
					});
					<?php }else{?>
					iso_cont.data('owlCarousel').addItem(dataa_social);
					jQuery('.svc_social_stream_container_<?php echo $svc_social_id;?>').show();
					jQuery('#svc_mask_<?php echo $svc_social_id;?>').hide();
					jQuery("[vc-social-effect]").each(function(index, element) {
						var ef = jQuery(this).attr('vc-social-effect');
						jQuery(this).addClass(ef).removeClass('opacity0').removeAttr('vc-social-effect');
					});
					<?php }?>
                }
            });
        };
        vc_social_updateFeed_<?php echo $svc_social_id;?>();
    });
    </script>
	
	<?php
	$message = ob_get_clean();
	return $message;
}
