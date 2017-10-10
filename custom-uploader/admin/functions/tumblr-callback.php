<?php

/**
 * Tumblr Callback - Handles the callback from tumblr, after authorizing
 * the application. Gets the oauth_token and the oauth_secret.
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
	
	$expected_referer = 'https://www.tumblr.com/oauth/authorize';
	$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
	
	if(strpos($referer, $expected_referer) !== false) {
		$custom_uploader_options = get_option( 'cup_options' );
		$tumblr_consumer_key = $custom_uploader_options['cup_tumblr_consumer_key']; 
		$tumblr_consumer_secret = $custom_uploader_options['cup_tumblr_consumer_secret']; 
		$tumblr_oauth_token_secret = $custom_uploader_options['cup_tumblr_oauth_token_secret']; 
		
		if($tumblr_consumer_key && $tumblr_consumer_secret) {

		
			$oauth_token = empty($_GET['oauth_token']) ? null : (string)$_GET['oauth_token'];
			$oauth_verifier = empty($_GET['oauth_verifier']) ? null : (string)$_GET['oauth_verifier'];
			
			$client = new Tumblr\API\Client($tumblr_consumer_key, $tumblr_consumer_secret);
			$requestHandler = $client->getRequestHandler();
			$requestHandler->setBaseUrl('https://www.tumblr.com/');
		
			$client->setToken($oauth_token, $tumblr_oauth_token_secret);
		
			$resp = $requestHandler->request('POST', 'oauth/access_token', array('oauth_verifier' => $oauth_verifier));
			$out = $result = $resp->body;
			$data = array();
			parse_str($out, $data);

			// and print out our new keys
			$token = $data['oauth_token'];
			$secret = $data['oauth_token_secret'];

			$custom_uploader_options['cup_tumblr_oauth_token'] = $token;
			$custom_uploader_options['cup_tumblr_oauth_secret'] = $secret;
			
			update_option( 'cup_options', $custom_uploader_options );
			
			$admin_url = get_admin_url( $_blog_id, 'options-general.php?page=custom-uploader&tab=tab_three');
			// tell the user where to go
			header('Location: ' . $admin_url);
		}
	}
}

die('Nothing to see here!');

?>