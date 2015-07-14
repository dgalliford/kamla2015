<script type="text/javascript">
jQuery(function($){
	//on-off start
	$(".on_off label").click(function(){
		var id = $(this).attr('id');
		var data = $(this).attr('data');
		if(data == 'y'){
			$('.'+id).show();
		}
		if(data == 'n'){
			$('.'+id).hide();
		}
        $(this).parent('div').children('label').removeClass("on");
        $(this).addClass("on");
    });
	//on-off end

	$('.post-list-tabs-menu li').click(function(){
		var tab = $(this).attr('data-tab-index');
		$('.post-list-tabs-menu li').removeClass('spl_active');
		$(this).addClass('spl_active');
		$('.spl_tabs').hide();
		$('#'+tab).show();
	});
	
	$('#grid_query').click(function(){
		$('#grid_query_div').slideToggle();	
	});
});
</script>
<style type="text/css">
.new_fields{ background:#fff; margin-top:0px; padding:5px 5px 0; border:1px solid #e7e4e4; border-top:0px;}
.widefat.dataa,.widefat.dataa td{ border:0px; box-shadow:none; cursor:move;}
.post-list-tabs-menu li {
    background: none repeat scroll 0 0 #fff;
    cursor: pointer;
    float: left;
    padding: 0.7%;
    text-align: center;
    width: 9.69%;
}
.post-list-tabs-menu li.spl_active {
    background: #002B36;
	color:#fff;
}
.post-list-tabs-menu {
    clear: both;
    list-style: none outside none;
}
.spost_button {
    background: #002b36 !important;
    border: 1px solid #002b36 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    font-size: 15px !important;
    height: 36px !important;
    line-height: 2em !important;
}
</style>

<?php 
$grid = $difault_grid_array;
if(isset($_GET['sid'])){
$id = intval($_GET['sid']);
$grid_data = $wpdb->get_row("select * from ".self::$table_prefix.self::TABLE_SLIDERS_NAMES." where id=".$id);
$grid_ori = unserialize($grid_data->slider_params);
$grid = array_merge($difault_grid_array,$grid_ori);
}
//echo "<pre>";print_r($grid);echo "</pre>";?>
<ul class="post-list-tabs-menu">
	<li data-tab-index="fb_tab" class="spl_active"><i class="fa fa-facebook"></i></li>
	<li data-tab-index="gplus_tab" class=""><i class="fa fa-google"></i></li>
	<li data-tab-index="twit_tab" class=""><i class="fa fa-twitter"></i></li>
	<li data-tab-index="insta_tab" class=""><i class="fa fa-instagram"></i></li>
	<li data-tab-index="you_tab" class=""><i class="fa fa-youtube"></i></li>
	<li data-tab-index="tumb_tab" class=""><i class="fa fa-tumblr"></i></li>
	<li data-tab-index="vime_tab" class=""><i class="fa fa-vimeo-square"></i></li>
	<li data-tab-index="general_tab" class=""><?php _e('General','swp-social');?></li>
	<li data-tab-index="color_tab" class=""><?php _e('Color Setting','swp-social');?></li>
</ul>

<div id="fb_tab" class="spl_tabs" style="display:block;">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">
				<table class="anew_slider_setting">	
					<tr>	
						<th><strong class="afl"><?php _e('User Or Page ID','swp-social');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['fb_id'];?>" name="fb_id">
						<p class="description"><?php _e('Enter Facebook Page or User id.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','swp-social');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['fb_num'];?>" name="fb_num" max="100" min="1" data-check-depen="yes" id="spost_car_display_item">
						<p class="description"><?php _e('Set Limit for feed par page.','swp-social');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="gplus_tab" class="spl_tabs">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
					<tr>	
						<th><strong class="afl"><?php _e('Select Type','swp-social');?> :</strong></th>	
						<td>	
						<select name="gplus_type">
                        	<option value="#" <?php selected( $grid['instagram_type'], '#' ); ?>>For Page ID or name</option>
                            <option value="@" <?php selected( $grid['instagram_type'], '@' ); ?>>For User Profile ID or name</option>
                        </select>
						<p class="description"><?php _e('Select Google Plus feed type.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('User Or Page ID','swp-social');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['gplus_id'];?>" name="gplus_id">
						<p class="description"><?php _e('Enter Google Plus Page or Profile id.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','swp-social');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['gplus_num'];?>" name="gplus_num" max="100" min="1" data-check-depen="yes" id="spost_car_display_item">
						<p class="description"><?php _e('Set Limit for feed par page.','swp-social');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="twit_tab" class="spl_tabs">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
					<tr>	
						<th><strong class="afl"><?php _e('Select Type','swp-social');?> :</strong></th>	
						<td>	
						<select name="twitter_type">
                        	<option value="@" <?php selected( $grid['twitter_type'], '@' ); ?>>For User</option>
                            <option value="#" <?php selected( $grid['twitter_type'], '#' ); ?>>For Search Feed"</option>
                        </select>
						<p class="description"><?php _e('Select Twitter User feed type.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('User ID','swp-social');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['twitter_id'];?>" name="twitter_id">
						<p class="description"><?php _e('Enter Twitter User id.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','swp-social');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['twitter_num'];?>" name="twitter_num" max="100" min="1">
						<p class="description"><?php _e('Set Limit for feed par page.','swp-social');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="insta_tab" class="spl_tabs">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
					<tr>	
						<th><strong class="afl"><?php _e('Select Type','swp-social');?> :</strong></th>	
						<td>	
						<select name="instagram_type">
                        	<option value="@" <?php selected( $grid['instagram_type'], '@' ); ?>>For User</option>
                            <option value="#" <?php selected( $grid['instagram_type'], '#' ); ?>>For Search Feed"</option>
                        </select>
						<p class="description"><?php _e('Select Instagram User feed type.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('User ID','swp-social');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['instagram_id'];?>" name="instagram_id">
						<p class="description"><?php _e('Enter Instagram User id.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','swp-social');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['instagram_num'];?>" name="instagram_num" max="100" min="1">
						<p class="description"><?php _e('Set Limit for feed par page.','swp-social');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="you_tab" class="spl_tabs">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">	
					<tr>	
						<th><strong class="afl"><?php _e('User ID','swp-social');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['youtube_id'];?>" name="youtube_id">
						<p class="description"><?php _e('Enter Youtube User id.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Enter Playlist ID','swp-social');?>:</strong></th>	
						<td>	
						<input type="text" value="<?php echo $grid['youtube_playlist_id'];?>" name="youtube_playlist_id">
						<p class="description"><?php _e('Enter Youtube Enter Playlist ID.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','swp-social');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['youtube_num'];?>" name="youtube_num" max="100" min="1">
						<p class="description"><?php _e('Set Limit for feed par page.','swp-social');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="tumb_tab" class="spl_tabs">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">	
					<tr>	
						<th><strong class="afl"><?php _e('Page ID','swp-social');?>:</strong></th>	
						<td>	
							<input type="text" value="<?php echo $grid['tumblr_id'];?>" name="tumblr_id">
							<p class="description"><?php _e('Enter Tumblr page id.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','swp-social');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['tumblr_num'];?>" name="tumblr_num" max="100" min="1">
						<p class="description"><?php _e('Set Limit for feed par page.','swp-social');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="vime_tab" class="spl_tabs">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">	
					<tr>	
						<th><strong class="afl"><?php _e('User ID','swp-social');?>:</strong></th>	
						<td>	
							<input type="text" value="<?php echo $grid['vimeo_id'];?>" name="vimeo_id">
							<p class="description"><?php _e('Enter Vimeo user id.','swp-social');?></p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Count per page limit','swp-social');?>:</strong></th>	
						<td>
						<input type="number" step="1" value="<?php echo $grid['vimeo_num'];?>" name="vimeo_num" max="100" min="1">
						<p class="description"><?php _e('Set Limit for feed par page.','swp-social');?></p>	
						</td>	
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="general_tab" class="spl_tabs">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
                	<tr>
						<th><strong class="afl"><?php _e('Title','swp-social');?> :</strong></th>	
						<td>
						<input type="text" name="title" value="<?php echo $grid['title'];?>">
						<p class="description"><?php _e('Enter Post grid title','swp-social');?></p>	
						</td>
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Social Grid Type','spost-grid');?> :</strong></th>	
						<td>	
						<select name="post_type" id="spost_grid_type" data-check-depen="yes">
							<option value="post_layout" <?php selected( $grid['post_type'], 'post_layout' ); ?>><?php _e('Feed Layout','spost-grid');?></option>
							<option value="carousel" <?php selected( $grid['post_type'], 'carousel' ); ?>><?php _e('Carousel','spost-grid');?></option>
						</select>
						<p class="description">Select Feed Grid Type.</p></td>	
					</tr>
					<tr>		
						<th><strong class="afl"><?php _e('Skin type','swp-social');?>:</strong></th>	
						<td>	
							<select name="skin_type" id="spost_skin_type" data-check-depen="yes">
                            	<option value="template" <?php selected( $grid['skin_type'], 'template' ); ?>>Style1</option>
                                <option value="template1" <?php selected( $grid['skin_type'], 'template1' ); ?>>Style2</option>
                                <option value="template2" <?php selected( $grid['skin_type'], 'template2' ); ?>>Style3</option>
                           </select>
					<p class="description"><?php _e('Choose skin type for grid layout','swp-social');?>.</p></td>	
					</tr>
					<tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Items Display','spost-grid');?> :</strong></th>	
						<td>	
						<input type="number" step="1" value="<?php echo $grid['car_display_item'];?>" name="car_display_item" max="100" min="1" data-check-depen="yes" id="spost_car_display_item">
						<p class="description"><?php _e('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width','spost-grid');?></p>
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Show pagination','spost-grid');?> :</strong></th>	
						<td>	
						<input type="checkbox" name="car_pagination" value="yes" id="spost_car_pagination" data-check-depen="yes" <?php checked( $grid['spost_car_pagination'], 'yes' ); ?>><?php _e('Yes','spost-grid');?>
						<p class="description"><?php _e('Show pagination','spost-grid');?></p>	
						</td>
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_car_pagination" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('Show pagination Numbers','spost-grid');?> :</strong></th>	
						<td>	
						<input type="checkbox" name="car_pagination_num" value="yes" <?php checked( $grid['car_pagination_num'], 'yes' ); ?>><?php _e('Yes','spost-grid');?>
						<p class="description"><?php _e('Show numbers inside pagination buttons.','spost-grid');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Hide navigation','spost-grid');?> :</strong></th>	
						<td>	
						<input type="checkbox" name="car_navigation" value="yes" <?php checked( $grid['car_navigation'], 'yes' ); ?>><?php _e('Yes','spost-grid');?>
						<p class="description"><?php _e('Display "next" and "prev" buttons.','spost-grid');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('AutoPlay','spost-grid');?> :</strong></th>	
						<td>	
						<input type="checkbox" name="car_autoplay" value="yes" id="spost_car_autoplay" data-check-depen="yes" <?php checked( $grid['car_autoplay'], 'yes' ); ?>><?php _e('Yes','spost-grid');?>
						<p class="description"><?php _e('Set Slider Autoplay.','spost-grid');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_car_autoplay" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('autoPlay Time','spost-grid');?> :</strong></th>	
						<td>	
						<input type="number" step="1" value="<?php echo $grid['car_autoplay_time'];?>" name="car_autoplay_time" max="100" min="1"><?php _e('seconds','spost-grid');?>
						<p class="description"><?php _e('Set Autoplay slider speed.','spost-grid');?></p>	
						</td>
					</tr>
					<tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Desktop Columns Count','swp-social');?> :</strong></th>	
						<td>	
						<select name="grid_columns_count_for_desktop">
                        	<option value="vcyt-col-md-12" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcyt-col-md-12' ); ?>><?php _e('1 Column','swp-social');?></option>
                            <option value="vcyt-col-md-6" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcyt-col-md-6' ); ?>><?php _e('2 Columns','swp-social');?></option>
                            <option value="vcyt-col-md-4" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcyt-col-md-4' ); ?>><?php _e('3 Columns','swp-social');?></option>
                            <option value="vcyt-col-md-3" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcyt-col-md-3' ); ?>><?php _e('4 Columns','swp-social');?></option>
                            <option value="vcyt-col-md-15" <?php selected( $grid['grid_columns_count_for_desktop'], 'vcyt-col-md-15' ); ?>><?php _e('5 Columns','swp-social');?></option>
                        </select>
						<p class="description"><?php _e('Choose Desktop(PC Mode) Columns Count','swp-social');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Tablet Columns Count','swp-social');?> :</strong></th>	
						<td>	
						<select name="grid_columns_count_for_tablet">
                        	<option value="vcyt-col-sm-12" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcyt-col-sm-12' ); ?>><?php _e('1 Column','swp-social');?></option>
                            <option value="vcyt-col-sm-6" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcyt-col-sm-6' ); ?>><?php _e('2 Columns','swp-social');?></option>
                            <option value="vcyt-col-sm-4" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcyt-col-sm-4' ); ?>><?php _e('3 Columns','swp-social');?></option>
                            <option value="vcyt-col-sm-4" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcyt-col-sm-4' ); ?>><?php _e('3 Columns','swp-social');?></option>
                            <option value="vcyt-col-sm-3" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcyt-col-sm-3' ); ?>><?php _e('4 Columns','swp-social');?></option>
                            <option value="vcyt-col-sm-15" <?php selected( $grid['grid_columns_count_for_tablet'], 'vcyt-col-sm-15' ); ?>><?php _e('5 Columns','swp-social');?></option>
                        </select>
						<p class="description"><?php _e('Choose Tablet Columns Count','swp-social');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Mobile Columns Count','swp-social');?> :</strong></th>	
						<td>	
						<select name="grid_columns_count_for_mobile">
                        	<option value="vcyt-col-xs-12" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcyt-col-xs-12' ); ?>><?php _e('1 Column','swp-social');?></option>
                            <option value="vcyt-col-xs-6" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcyt-col-xs-6' ); ?>><?php _e('2 Columns','swp-social');?></option>
                            <option value="vcyt-col-xs-4" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcyt-col-xs-4' ); ?>><?php _e('3 Columns','swp-social');?></option>
                            <option value="vcyt-col-xs-3" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcyt-col-xs-3' ); ?>><?php _e('4 Columns','swp-social');?></option>
                            <option value="vcyt-col-xs-15" <?php selected( $grid['grid_columns_count_for_mobile'], 'vcyt-col-xs-15' ); ?>><?php _e('5 Columns','swp-social');?></option>
                        </select>
						<p class="description"><?php _e('Choose Mobile Columns Count','swp-social');?></p>	
						</td>	
					</tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Description Length','swp-social');?></strong></th>
                        <td>
							<input type="number" step="1" value="<?php echo $grid['excerpt_length'];?>" name="excerpt_length" max="900" min="10">
                            <p class="description"><?php _e('set Description length.default:20','swp-social');?></p>
                        </td>
                    </tr>
                    <tr>	
						<th><strong class="afl"><?php _e('Hide Media','swp-social');?>:</strong></th>	
						<td>	
						<input type="checkbox" value="yes" name="hide_media" <?php checked( $grid['hide_media'], 'yes' ); ?>/><?php _e('Yes','swp-social');?>
						<p class="description"><?php _e('If you check not display Media Image in feed.','swp-social');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Show filter','swp-social');?>:</strong></th>	
						<td>	
						<input type="checkbox" value="yes" name="filter" id="swp_filter" data-check-depen="yes" <?php checked( $grid['filter'], 'yes' ); ?>/><?php _e('Yes, Please','swp-social');?>
						<p class="description"><?php _e('Add Social Filter to top of the page.','swp-social');?></p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_filter" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('Show Sorting Filter','swp-social');?>:</strong></th>	
						<td>	
						<input type="checkbox" value="yes" name="sort_filter" <?php checked( $grid['sort_filter'], 'yes' ); ?>/><?php _e('Yes','swp-social');?>
						<p class="description"><?php _e('Display Sorting Filter.','swp-social');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Show more','swp-social');?>:</strong></th>	
						<td>	
						<input type="checkbox" value="yes" name="loadmore" id="swp_loadmore" data-check-depen="yes" <?php checked( $grid['loadmore'], 'yes' ); ?>/><?php _e('Yes','swp-social');?>
						<p class="description"><?php _e('add Show more feed button.','swp-social');?></p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_loadmore" data-attr="checkbox">
						<th><strong class="afl"><?php _e('Show more text','swp-social');?> :</strong></th>	
						<td>
						<input type="text" name="loadmore_text" value="<?php echo $grid['loadmore_text'];?>">
						<p class="description"><?php _e('add Show more button text.Default:Show More','swp-social');?></p>	
						</td>
					</tr>
					<tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">
						<th><strong class="afl"><?php _e('Onload Date sorting','swp-social');?> :</strong></th>	
						<td>
						<input type="checkbox" value="yes" name="date_sorting" <?php checked( $grid['date_sorting'], 'yes' ); ?>/><?php _e('Yes','swp-social');?>
						<p class="description"><?php _e('set Onload feed Date sorting.','swp-social');?></p>	
						</td>
					</tr>
                    <tr data-depen-set="true" data-value="post_layout" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Feed load Effect','swp-social');?> :</strong></th>	
						<td>
						<select name="effect">
                        <?php foreach($animations as $animation){?>
                        	<option value="<?php echo $animation;?>" <?php selected( $grid['effect'], $animation ); ?>><?php echo $animation;?></option>
						<?php }?>
                        </select>
						<p class="description"><?php _e('Select Feed load effect.','swp-social');?>.</p>	
						</td>	
					</tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Extra class name','swp-social');?></strong></th>
                        <td>
                            <input type="text" name="svc_class" value="<?php echo $grid['svc_class'];?>"/>
                            <p class="description"><?php _e('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.','swp-social');?></p>
                        </td>
                    </tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="color_tab" class="spl_tabs">
	<div class="metabox-holder" id="dashboard-widgets" style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="vertical-top">	
					<tr>
						<th><strong class="afl"><?php _e('Post Background Color','swp-social');?> :</strong></th>
						<td>	
							<input type="text" class="my-color-field" name="pbgcolor" data-default-color="" value="<?php echo $grid['pbgcolor'];?>"/>	
						<p class="description"><?php _e('set post background color.','swp-social');?></p></td>
					</tr>	
					<tr>	
						<th><strong class="afl"><?php _e('Post hover Background Color','swp-social');?> :</strong></th>
						<td>	
						<input type="text" class="my-color-field" name="pbghcolor" data-default-color="" value="<?php echo $grid['pbghcolor'];?>"/>	
						<p class="description"><?php _e('set post hover background color','swp-social');?>.</p>	
						</td>	
					</tr>
					<tr>	
						<th><strong class="afl"><?php _e('Title Color','swp-social');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="tcolor" data-default-color="" value="<?php echo $grid['tcolor'];?>"/>	
							<p class="description"><?php _e('Set Title Color','swp-social');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_filter" data-attr="checkbox">
						<th><strong class="afl"><?php _e('Filter text and border color','swp-social');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="ftcolor" data-default-color="" value="<?php echo $grid['ftcolor'];?>"/>	
							<p class="description"><?php _e('Set Filter text and border color','swp-social');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_filter" data-attr="checkbox">
						<th><strong class="afl"><?php _e('Active Filter text color','swp-social');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="ftacolor" data-default-color="" value="<?php echo $grid['ftacolor'];?>"/>	
							<p class="description"><?php _e('Set Active Filter text color','swp-social');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_filter" data-attr="checkbox">
						<th><strong class="afl"><?php _e('Active Filter text background color','swp-social');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="ftabgcolor" data-default-color="" value="<?php echo $grid['ftabgcolor'];?>"/>	
							<p class="description"><?php _e('Set Active Filter text background color','swp-social');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="swp_loadmore" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('Load more Loader and Text Color','swp-social');?> :</strong></th>	
						<td>	
							<input type="text" class="my-color-field" name="loder_color" data-default-color="" value="<?php echo $grid['loder_color'];?>"/>	
							<p class="description"><?php _e('set Load More Loader and Text color.','swp-social');?>.</p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="carousel" data-id="spost_grid_type" data-attr="select">	
						<th><strong class="afl"><?php _e('Navigation and Pagination color','spost-grid');?> :</strong></th>	
						<td>
						<input type="text" class="my-color-field" name="car_navigation_color" data-default-color="" value="<?php echo $grid['car_navigation_color'];?>"/>
						<p class="description"><?php _e('Set Navigation and Pagination color','spost-grid');?>.</p>	
						</td>
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>


<?php if(isset($_GET['sid'])){?>
<input type="submit" class="button-primary spost_button" value="<?php _e('Update Setting','swp-social');?>" name="spost_Update_Setting" style="width:100%;">
<?php }else{?>
<input type="submit" class="button-primary spost_button" value="<?php _e('Save Setting','swp-social');?>" name="spost_save_Setting" style="width:100%;">
<?php }?>
