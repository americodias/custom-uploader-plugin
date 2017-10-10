<?php

/**
 * Tumblr authentication - Starts Tumblr authentication process
 * and redirects to Tumblr so the user can authorize the app.
 * After the autorization the user should be redirected to
 * tumblr-callback.php.
 *
 * @link       http://americodias.com
 * @since      1.0.0
 *
 * @package    Custom_Uploader
 * @subpackage Custom_Uploader/admin
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/../custom-uploader/class-custom-uploader-uploader.php');

$_blog_id = empty($_GET['blog_id']) ? null : (int)$_GET['blog_id'];

if($_blog_id !== null) {
	$image_uploader = new Custom_Uploader_Uploader($_blog_id);
	
	$expected_referer = get_bloginfo('url') . '/wp-admin/options-general.php';
	$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
	
	if(strpos($referer, $expected_referer) !== false) {
		$custom_uploader_options = get_option( 'cup_options' );
		$tumblr_consumer_key = $custom_uploader_options['cup_tumblr_consumer_key']; 
		$tumblr_consumer_secret = $custom_uploader_options['cup_tumblr_consumer_secret']; 
	
		$client = new Tumblr\API\Client($tumblr_consumer_key, $tumblr_consumer_secret);
		$requestHandler = $client->getRequestHandler();
		$requestHandler->setBaseUrl('https://www.tumblr.com/');

		// start the old gal up
		$resp = $requestHandler->request('POST', 'oauth/request_token', array());

		// get the oauth_token
		$out = $result = $resp->body;
		$data = array();
		parse_str($out, $data);
		
		$custom_uploader_options['cup_tumblr_oauth_token_secret'] = $data['oauth_token_secret'];
		update_option( 'cup_options', $custom_uploader_options );
		
		// tell the user where to go
		header('Location: ' . 'https://www.tumblr.com/oauth/authorize?oauth_token=' . $data['oauth_token']);
	}
}

die('Nothing to see here!');

?>