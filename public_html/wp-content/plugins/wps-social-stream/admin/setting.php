<script type="text/javascript">
jQuery(function($){
	$('.my-color-field').wpColorPicker();
	$(".handlediv,.hndle").click(function(){
		$(this).next('h3').next('.inside').toggle();
		if($(this).parent('.postbox').hasClass('closed')){
			$(this).parent('.postbox').removeClass('closed');
		}else{
			$(this).parent('.postbox').addClass('closed');
		}
	});

});
</script>
<?php
$msg = false;
$mcode = 0;
$error = false;
if(isset($_POST['spost_save_Setting'])){
	extract($_POST);
	$ins = array(
		'slider_title' => $title,
		'slider_params' => serialize($_POST)
	);
	$wpdb->insert( self::$table_prefix.self::TABLE_SLIDERS_NAMES, $ins );
	wp_redirect( 'admin.php?page=swp-social' );exit;
}
if(isset($_POST['spost_Update_Setting'])){
	extract($_POST);
	$ins = array(
		'slider_title' => $title,
		'slider_params' => serialize($_POST)
	);
	$wpdb->update( self::$table_prefix.self::TABLE_SLIDERS_NAMES, $ins, array('id' => $_GET['sid']) );
	wp_redirect( 'admin.php?page=swp-social&view=setting&sid='.$_GET['sid'] );exit;
}
?>
<style type="text/css">
a,a:focus,a:active{ outline:none !important; box-shadow:none !important;}
.animate_slider_popup_loader{background:url(<?php echo $this->animate_plugin_url('../assets/image/default.gif');?>) no-repeat center #fff;}
.h2_logo{
	background:url(<?php echo $this->animate_plugin_url('../assets/image/round.png');?>) !important;
	background-repeat:no-repeat !important;
	box-shadow:none !important;
	background-size:42px 42px;
	display:table;
	font-size: 23px;
    font-weight: 400;
    line-height: 29px;
    padding: 6px 15px 7px 48px !important;
	margin:0 !important;
	border-bottom:0px !important;
}
.widefat td{border-bottom: 1px solid #f1f1f1;}
.aslider_required{ color:red; font-size:18px; vertical-align:middle; margin-left:2px;}
.help_btn{position: absolute; right: 15px; top: 7px;}
.afr{ float:right;}.afl{ float:left;}.apadl0{padding-left:0px !important;}.atal{text-align:left;}
.anew_slider{ margin-bottom:10px;}
.anew_slider th{ width:200px; vertical-align:top; text-align:left;}
.anew_slider1 th{ width:175px; text-align:left; vertical-align:top;}
.anew_slider_setting th{ width:176px; vertical-align:top; text-align:left;}
.delete_level,.delete_level:hover {
    background-color: #fb6f6f;
    border: 1px solid #c10f0f;
    border-radius: 3px;
    color: #fff;
	display:inline-table;
    font-size: 12px;
    font-weight: bold;
    padding: 1px 10px;
    text-shadow: 0 1px #100f0f;
}
.edit_layers,.edit_layers:hover {
    background-color: #37c536;
    border: 1px solid green;
    border-radius: 3px;
    color: #fff;
	cursor:pointer;
    font-size: 12px;
    font-weight: bold;
    padding: 2px 10px;
    text-shadow: 0 1px #5f5959;
}
.spl_tabs{ display:none;}
#grid_query{
	border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
    font-size: 13px;
    padding: 5px 18px;
    text-shadow: 1px 1px #f2f2f2;
}
#grid_query_div:before{
	border-bottom: 8px solid #ccc;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    content: "";
    height: 0;
    left: 48px;
    position: absolute;
    top: -9px;
    width: 0;
}
#grid_query_div{
	background: #f2f2f2 none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    display: none;
    padding: 10px;
	position:relative;
}
.vertical-top th{vertical-align:top;}
.spost_hidden{ display:none;}
</style>

<div class="wrap">

<div class="meta-box-sortables ui-sortable">

	<div class="postbox" style="margin-bottom:10px;">

		<div class="inside" style="padding:0 12px;">

			<h3 class="h2_logo"><a href="<?php echo self::plugin_root_url();?>" style="text-decoration:none; color:#222;"><?php echo esc_html( 'Social Stream for WordPress' ); ?></a></h3>

		</div>

	</div>

</div>

<?php if($msg == true && $mcode > 0 ){?>

<div class="<?php echo ($error == true) ? 'error' : 'updated';?>">

	<p><strong>

	<?php echo self::error_msg($mcode);?>

	</strong></p>

</div>

<?php }
$animations = array(
	'None' => '',
	'bounce'		=>	'bounce',
	'flash'			=>	'flash',
	'pulse'			=>	'pulse',
	'rubberBand'	=>	'rubberBand',
	'shake'			=>	'shake',
	'swing'			=>	'swing',
	'tada'			=>	'tada',
	'bounce'		=>	'bounce',
	'wobble'		=>	'wobble',
	'bounceIn'		=>	'bounceIn',
	'bounceInDown'	=>	'bounceInDown',
	'bounceInLeft'	=>	'bounceInLeft',
	'bounceInRight'	=>	'bounceInRight',
	'bounceInUp'	=>	'bounceInUp',
	'fadeIn'			=>	'fadeIn',
	'fadeInDown'		=>	'fadeInDown',
	'fadeInDownBig'		=>	'fadeInDownBig',
	'fadeInLeft'		=>	'fadeInLeft',
	'fadeInLeftBig'		=>	'fadeInLeftBig',
	'fadeInRight'		=>	'fadeInRight',
	'fadeInRightBig'	=>	'fadeInRightBig',
	'fadeInUp'			=>	'fadeInUp',
	'fadeInUpBig'		=>	'fadeInUpBig',
	'flip'	=>	'flip',
	'flipInX'	=>	'flipInX',
	'flipInY'	=>	'flipInY',
	'lightSpeedIn'	=>	'lightSpeedIn',
	'rotateIn'			=>	'rotateIn',
	'rotateInDownLeft'	=>	'rotateInDownLeft',
	'rotateInDownRight'	=>	'rotateInDownRight',
	'rotateInUpLeft'	=>	'rotateInUpLeft',
	'rotateInUpRight'	=>	'rotateInUpRight',
	'slideInUp' => 'slideInUp',
	'slideInDown' => 'slideInDown',
	'slideInLeft' => 'slideInLeft',
	'slideInRight' => 'slideInRight',
	'zoomIn'		=>	'zoomIn',
	'zoomInDown'	=>	'zoomInDown',
	'zoomInLeft'	=>	'zoomInLeft',
	'zoomInRight'	=>	'zoomInRight',
	'zoomInUp'		=>	'zoomInUp',
	'rollIn'	=>	'rollIn',
	'twisterInDown'	=>	'twisterInDown',
	'twisterInUp'	=>	'twisterInUp',
	'swap'			=>	'swap',
	'puffIn'	=>	'puffIn',
	'vanishIn'	=>	'vanishIn',
	'openDownLeftRetourn'	=>	'openDownLeftRetourn',
	'openDownRightRetourn'	=>	'openDownRightRetourn',
	'openUpLeftRetourn'		=>	'openUpLeftRetourn',
	'openUpRightRetourn'	=>	'openUpRightRetourn',
	'perspectiveDownRetourn'	=>	'perspectiveDownRetourn',
	'perspectiveUpRetourn'		=>	'perspectiveUpRetourn',
	'perspectiveLeftRetourn'	=>	'perspectiveLeftRetourn',
	'perspectiveRightRetourn'	=>	'perspectiveRightRetourn',
	'slideDownRetourn'	=>	'slideDownRetourn',
	'slideUpRetourn'	=>	'slideUpRetourn',
	'slideLeftRetourn'	=>	'slideLeftRetourn',
	'slideRightRetourn'	=>	'slideRightRetourn',
	'swashIn'		=>	'swashIn',
	'foolishIn'		=>	'foolishIn',
	'tinRightIn'	=>	'tinRightIn',
	'tinLeftIn'		=>	'tinLeftIn',
	'tinUpIn'		=>	'tinUpIn',
	'tinDownIn'		=>	'tinDownIn',
	'boingInUp'		=>	'boingInUp',
	'spaceInUp'		=>	'spaceInUp',
	'spaceInRight'	=>	'spaceInRight',
	'spaceInDown'	=>	'spaceInDown',
	'spaceInLeft'	=>	'spaceInLeft'
);?>
<form method="post">
<?php 

if(isset($_GET['view']) && $_GET['view'] == 'slide'){

	include('slides.php');

}elseif(isset($_GET['view']) && $_GET['view'] == 'setting'){
$difault_grid_array = array(
	'fb_id' => '',
	'fb_num' => '5',
	'gplus_type' =>'',
	'gplus_id' => '',
	'gplus_num' => '5',
	'twitter_type' => '',
	'twitter_id' => '',
	'twitter_num' => '5',
	'instagram_type' => '',
	'instagram_id' => '',
	'instagram_num' => '5',
	'youtube_id' => '',
	'youtube_playlist_id' => '',
	'youtube_num' => '5',
	'tumblr_id' => '',
	'tumblr_num' => '5',
	'vimeo_id' => '',
	'vimeo_num' => '5',
    'title' => '',
	'post_type' => '',
    'skin_type' => '',
	'car_display_item' => '4',
    'car_pagination' => '',
    'car_pagination_num' => '',
    'car_navigation' => '',
    'car_autoplay' => '',
    'car_autoplay_time' => '5',
    'grid_columns_count_for_desktop' => 'vcyt-col-md-3',
    'grid_columns_count_for_tablet' => 'vcyt-col-sm-4',
    'grid_columns_count_for_mobile' => 'vcyt-col-xs-12',
    'excerpt_length' => '150',
    'hide_media' => '',
    'filter' => '',
    'sort_filter' => '',
    'loadmore' => 'yes',
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
);
	include('grid-setting.php');

}elseif(isset($_GET['view']) && $_GET['view'] == 'grid'){

	include('grid-name.php');

}else{

	include('main.php');

}?>
</form>
<script>
jQuery(function($){
	function spost_dependency_check(){
		$('[data-depen-set]').each(function(index, element) {
			var this_tr = $(this);
			var field_value = '';
			var data_attr = this_tr.attr('data-attr');
			var data_id = this_tr.attr('data-id');
			var data_value = this_tr.attr('data-value');
			var data_value1 = this_tr.attr('data-value1');
			var data_value2 = this_tr.attr('data-value2');
			
			if(data_attr == 'checkbox'){
				if ($('#'+data_id).is(":checked")){
					field_value = $('#'+data_id).val();
				}
				if(field_value == data_value){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');	
				}
			}
			
			if(data_attr == 'select'){
				field_value = $('#'+data_id).val();
				if(field_value == data_value || field_value == data_value1 || field_value == data_value2){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');
				}
			}
			
			if(data_attr == 'number'){
				field_value = $('#'+data_id).val();
				if(field_value == data_value){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');	
				}
			}
		});
		
		setTimeout(function(){
			$('.spost_hidden').each(function(index, element) {
				var this_input = $(this);
				var closesr_id = this_input.children('td').children('input').attr('id');
				$('[data-id]').each(function(index, element) {
					var this_sss = $(this);
					if(this_sss.attr('data-id') == closesr_id){
						this_sss.addClass('spost_hidden');
					}
				});						
			});
		},800);
	}
	spost_dependency_check();
	
	$('[data-check-depen]').not('select').click(function(){
		spost_dependency_check();
	});
	$('[data-check-depen]').change(function(){
		spost_dependency_check();
	});
});
</script>

<div style="float:right; margin-top:10px; clear:both; font-weight:bold;">Social Stream Version <?php echo $anisliderVersion;?></div>

</div>
