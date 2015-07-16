<!doctype html>
<html <?php language_attributes();?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php wp_title('| ', true, 'right');?></title>
<!-- Mobile Specific Metas & Favicons -->
<?php global $minti_data;?>
<?php if ($minti_data['switch_zoom'] == 0) {?><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"><?php } else {?><meta name="viewport" content="width=1200" /><?php }?>
<?php if (isset($minti_data['media_favicon']['url']) && ($minti_data['media_favicon']['url'] != "")) {?><link rel="shortcut icon" href="<?php echo esc_url($minti_data['media_favicon']['url']);?>"><?php }?>
<?php if (isset($minti_data['media_favicon_iphone']['url']) && ($minti_data['media_favicon_iphone']['url'] != "")) {?><link rel="apple-touch-icon" href="<?php echo esc_url($minti_data['media_favicon_iphone']['url']);?>"><?php }?>
<?php if (isset($minti_data['media_favicon_iphone_retina']['url']) && ($minti_data['media_favicon_iphone_retina']['url'] != "")) {?><link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url($minti_data['media_favicon_iphone_retina']['url']);?>"><?php }?>
<?php if (isset($minti_data['media_favicon_ipad']['url']) && ($minti_data['media_favicon_ipad']['url'] != "")) {?><link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url($minti_data['media_favicon_ipad']['url']);?>"><?php }?>
<?php if (isset($minti_data['media_favicon_ipad_retina']['url']) && ($minti_data['media_favicon_ipad_retina']['url'] != "")) {?><link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url($minti_data['media_favicon_ipad_retina']['url']);?>"><?php }?>
<!-- WordPress Stuff -->
<?php wp_head();?>
</head>

<body <?php body_class('smooth-scroll');?>>
<!-- Tags for Trinidad Election 2015 -->
	<script language='JavaScript1.1' src='//pixel.mathtag.com/event/js?mt_id=795456&mt_adid=143856&v1=&v2=&v3=&s1=&s2=&s3='></script>
	<script type="text/javascript">
		var ftRandom = Math.random()*1000000;
		document.write('<iframe style="position:absolute; visibility:hidden; width:1px; height:1px;" src="https://servedby.flashtalking.com/container/6744;44712;4969;iframe/?spotName=KamlaView_Landing_Page&cachebuster='+ftRandom+'"></iframe>');
	</script>
<!-- Secure Conditional Container Tag: Trinidad Election 2015 (6744) | Get Involved Button (44713) | Trinidad Election 2015 (4969) | Expected URL: http://www.kamlaview.com/ -->
	<script type="text/javascript">
		var ftRandom = Math.random()*1000000;
		document.write('<iframe style="position:absolute; visibility:hidden; width:1px; height:1px;" src="https://servedby.flashtalking.com/container/6744;44713;4969;iframe/?spotName=Get_Involved_Button&cachebuster='+ftRandom+'"></iframe>');

	</script>

	<div class="site-wrapper <?php if ($minti_data['select_layoutstyle'] == 'boxed') {echo 'boxed-layout';} else {echo 'wrapall';}?>">

<?php
if (get_post_meta(get_the_ID(), 'minti_header', true) != 'hide') {
	// Include Header
	if ($minti_data['header_layout']) {
		get_template_part('framework/inc/headers/header-'.$minti_data['header_layout']);
	} else {
		get_template_part('framework/inc/headers/header-v1.php');
	}

	// Include Titlebar
	get_template_part('framework/inc/titlebar');
}
?>