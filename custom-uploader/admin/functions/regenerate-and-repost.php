<?php

/**
 * Regenerate Google Short URL and post to social networks (Facebook
 * and Tumblr for now). This file is called from the image edit
 * admin page when the user wants to generate the google short url
 * and post to all the enabled social networks.
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
	
	$expected_referer = get_bloginfo('url') . '/wp-admin/post.php';
	$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];
	
	if(strpos($referer, $expected_referer) !== false) {
		$attach_id = empty($_GET['attach_id']) ? 0 : (int)$_GET['attach_id'];
		
		if($attach_id) {
			$short_url = $image_uploader->create_short_url($attach_id);
			$facebook_id = $image_uploader->post_to_facebook($attach_id);
			$tumblr_id = $image_uploader->post_to_tumblr($attach_id);
			$instagram_code = $image_uploader->post_to_instagram($attach_id);
			
			if(strlen($short_url) == 0 or $facebook_id == 0 or $tumblr_id == 0 or strlen($instagram_code) == 0) {
				if(strlen($short_url) == 0)
					echo 'Error regenerating short url!';
				if($facebook_id == 0)
					echo 'Error posting to Facebook!';
				if($tumblr_id == 0)
					echo 'Error posting to Tumblr!';
				if(strlen($instagram_code) == 0)
					echo 'Error posting to Instagram!';
				die();
			}
			
			header('Location: ' . $referer);
		}
	}
}

die('Nothing to see here!');

?>
