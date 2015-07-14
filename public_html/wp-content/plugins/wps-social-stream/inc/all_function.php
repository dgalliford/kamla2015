<?php
add_action('wp_head','swp_social_inline_css_for_imageloaded');
function swp_social_css_for_imageloaded(){
	?>
    <style>
	.svc_post_grid_list_container{ display:none;}
	#loader {background-image: url("<?php echo plugins_url('../assets/css/loader.GIF',__FILE__);?>");}
	</style>
    <?php	
}

function swp_social_grid_delete(){
	global $wpdb,$animate_slider_tables;
	$slider_table = $wpdb->base_prefix.$animate_slider_tables;
	$id = intval($_POST['id']);
	$wpdb->delete($slider_table,array('id'=>$id));
die();
}
add_action('wp_ajax_swp_social_grid_delete', 'swp_social_grid_delete' );


add_action('wp_ajax_svc_get_tweet','svc_get_tweet');
add_action('wp_ajax_nopriv_svc_get_tweet','svc_get_tweet');
function svc_get_tweet(){
	require_once('twitter_proxy.php');
	extract($_POST);
	//echo "<pre>";print_r($_POST);
	// Twitter OAuth Config options
	$oauth_access_token = '531871187-jA1LUzuKOBMYy9FTHNS8Lrq3tHFtGQxCMeJMdjwY';
	$oauth_access_token_secret = '3qQgkYWzexuLoGKMnFpIoh3MZ5UEPmiRvysBBgEDIqLBn';
	$consumer_key = 'UaXiG364zfkqhkkK6ckFSRtoy';
	$consumer_secret = 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V';
	$user_id = '78884300';
	$screen_name = $user_name;
	$count = $limit;
	
	$twitter_url = 'statuses/user_timeline.json';
	$twitter_url .= '?user_id=' . $user_id;
	$twitter_url .= '&screen_name=' . $screen_name;
	$twitter_url .= '&count=' . $count;
	if($max_id != ''){
		$twitter_url .= '&max_id=' . $max_id;
	}
	
	// Create a Twitter Proxy object from our twitter_proxy.php class
	$twitter_proxy = new TwitterProxy(
		$oauth_access_token,			// 'Access token' on https://apps.twitter.com
		$oauth_access_token_secret,		// 'Access token secret' on https://apps.twitter.com
		$consumer_key,					// 'API key' on https://apps.twitter.com
		$consumer_secret,				// 'API secret' on https://apps.twitter.com
		$user_id,						// User id (http://gettwitterid.com/)
		$screen_name,					// Twitter handle
		$count							// The number of tweets to pull out
	);
	
	// Invoke the get method to retrieve results via a cURL request
	$tweets = $twitter_proxy->get($twitter_url);
	
	echo $tweets;
wp_die();
}

add_action('wp_ajax_svc_get_search_tweet','svc_get_search_tweet');
add_action('wp_ajax_nopriv_svc_get_search_tweet','svc_get_search_tweet');
function svc_get_search_tweet(){
	require_once('twitter_proxy.php');
	extract($_POST);
	//echo "<pre>";print_r($_POST);
	// Twitter OAuth Config options
	$oauth_access_token = '531871187-jA1LUzuKOBMYy9FTHNS8Lrq3tHFtGQxCMeJMdjwY';
	$oauth_access_token_secret = '3qQgkYWzexuLoGKMnFpIoh3MZ5UEPmiRvysBBgEDIqLBn';
	$consumer_key = 'UaXiG364zfkqhkkK6ckFSRtoy';
	$consumer_secret = 'l0Ymtqh9JnuqiGULl3uvMfnqePzA03YOV9YtdAc9b6km5orW9V';
	$user_id = '78884300';
	$screen_name = $user_name;
	$count = $limit;
	
	$twitter_url = 'search/tweets.json';
	if($other == 'yes'){
		$twitter_url .= '?q=' . $q;
		$twitter_url .= '&count=' . $limit;
		$twitter_url .= '&' . $que;
		$twitter_url .= '&include_entities' . $include_entities;
	}else{
		$twitter_url .= '?q=' . $q;
		$twitter_url .= '&count=' . $count;
	}
	
	// Create a Twitter Proxy object from our twitter_proxy.php class
	$twitter_proxy = new TwitterProxy(
		$oauth_access_token,			// 'Access token' on https://apps.twitter.com
		$oauth_access_token_secret,		// 'Access token secret' on https://apps.twitter.com
		$consumer_key,					// 'API key' on https://apps.twitter.com
		$consumer_secret,				// 'API secret' on https://apps.twitter.com
		$user_id,						// User id (http://gettwitterid.com/)
		$screen_name,					// Twitter handle
		$count							// The number of tweets to pull out
	);
	
	// Invoke the get method to retrieve results via a cURL request
	$tweets = $twitter_proxy->get($twitter_url);
	
	echo $tweets;
die();		
}
?>
