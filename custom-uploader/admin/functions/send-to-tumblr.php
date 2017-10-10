<?php

/**
 * Send image to Tumblr. This file is called from the image edit admin page
 * when the user wants to post (or repost) the image to Tumblr.
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
			$tumblr_id = $image_uploader->post_to_tumblr($attach_id);
			if($tumblr_id)
				header('Location: ' . $referer);
		}
	}
}

die('Nothing to see here!');

?>
