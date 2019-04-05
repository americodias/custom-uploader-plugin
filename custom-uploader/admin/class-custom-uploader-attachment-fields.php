<?php

/**
* Display custom fields in the attachment page
*
* @link       http://americodias.com
* @since      1.0.0
*
* @package    Custom_Uploader
* @subpackage Custom_Uploader/includes
*/

/**
* Fired during plugin activation.
*
* This class defines all code necessary to run during the plugin's activation.
*
* @since      1.0.0
* @package    Custom_Uploader
* @subpackage Custom_Uploader/includes
* @author     Américo Dias <americo.dias@gmail.com>
*/
class Custom_Uploader_Attachment_Fields {
	/**
	* The ID of this plugin.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $plugin_name    The ID of this plugin.
	*/
	private $plugin_name;

	/**
	* The version of this plugin.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $version    The current version of this plugin.
	*/
	private $version;

	/**
	* Flag indicating if Bitly URL Shortener is active.
	*
	* @since    1.0.0
	* @access   private
	* @var      bool    $bitly_url_shortener_is_enabled    Currect state of Bitly URL Shortener.
	*/
	private $bitly_url_shortener_is_enabled;

	/**
	* Flag indicating if Facebook upload is active.
	*
	* @since    1.0.0
	* @access   private
	* @var      bool    $facebook_is_enabled    Currect state of Facebook.
	*/
	private $facebook_is_enabled;

	/**
	* Flag indicating if Tumblr upload is active.
	*
	* @since    1.0.0
	* @access   private
	* @var      bool    $tumblr_is_enabled    Currect state of Tumblr.
	*/
	private $tumblr_is_enabled;

	/**
	* Flag indicating if Instagram upload is active.
	*
	* @since    1.1.0
	* @access   private
	* @var      bool    $instagram_is_enabled    Currect state of Instagram.
	*/
	private $instagram_is_enabled;

	/**
	* Constructor
	*
	* @since	1.0.0
	* @param	string	$plugin_name	The name of this plugin.
	* @param	string	$version		The version of this plugin.
	* @author	Américo Dias <americo.dias@gmail.com>
	*/
	public function __construct($plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$cup_options = get_option( 'cup_options' );
		$this->bitly_url_shortener_is_enabled = $cup_options['cup_bitly_url_shortener_is_enabled'];
		$this->facebook_is_enabled = $cup_options['cup_facebook_is_enabled'];
		$this->tumblr_is_enabled = $cup_options['cup_tumblr_is_enabled'];
		$this->instagram_is_enabled = $cup_options['cup_instagram_is_enabled'];

		add_filter( 'attachment_fields_to_edit', array( $this, 'add_fields_to_edit'), 10, 2 );
		add_action( 'edit_attachment', array( $this, 'edit_fields' ) );
	}

	/**
	* Add fields to the edit image admin page
	*
	* @since	1.0.0
	* @param	string	$form_fields
	* @param	string	$post
	* @return	void
	* @author	Américo Dias <americo.dias@gmail.com>
	*/
	public function add_fields_to_edit( $form_fields, $post ) {

		$query_string = '?attach_id=' . $post->ID . '&blog_id=' . get_current_blog_id();

		$repost_facebook_url = plugins_url( '/functions/send-to-facebook.php' . $query_string, __FILE__ );
		$repost_tumblr_url = plugins_url( '/functions/send-to-tumblr.php' . $query_string, __FILE__ );
		$repost_instagram_url = plugins_url( '/functions/send-to-instagram.php' . $query_string, __FILE__ );
		$regenerate_bitly_short_url = plugins_url( '/functions/regenerate-bitly-short-url.php' . $query_string, __FILE__ );
		$regenerate_and_repost = plugins_url( '/functions/regenerate-and-repost.php' . $query_string, __FILE__ );

		$field_value = get_post_meta( $post->ID, 'cup_date_taken', true );
		$form_fields['cup_date_taken'] = array(
			'value' => $field_value ? $field_value : '',
			'label' => __( 'Date Taken' ),
			'helps' => __( 'Set a capture date for this attachment' )
		);

		if($this->bitly_url_shortener_is_enabled) {
			$field_value = get_post_meta( $post->ID, 'cup_bitly_short_url_id', true );
			$form_fields['cup_bitly_short_url_id'] = array(
				'value' => $field_value ? $field_value : '',
				'label' => __( 'Bitly Url Shortener ID' ),
				'helps' => __( 'Bitly Url Shortener ID Number' ) . ' (<a href="' . $regenerate_bitly_short_url .'">' . __( 'Regenerate' ) . '</a>)'
			);
		}

		if($this->facebook_is_enabled) {
			$field_value = get_post_meta( $post->ID, 'cup_facebook_id', true );
			$form_fields['cup_facebook_id'] = array(
				'value' => $field_value ? $field_value : '',
				'label' => __( 'Facebook ID' ),
				'helps' => __( 'Facebook ID Number' ) . ' (<a href="' . $repost_facebook_url .'">' . __( 'Repost' ) . '</a>)'
			);
		}
		if($this->tumblr_is_enabled) {
			$field_value = get_post_meta( $post->ID, 'cup_tumblr_id', true );
			$form_fields['cup_tumblr_id'] = array(
				'value' => $field_value ? $field_value : '',
				'label' => __( 'Tumblr ID' ),
				'helps' => __( 'Tumblr ID Number' ) . ' (<a href="' . $repost_tumblr_url .'">' . __( 'Repost' ) . '</a>)'
			);
		}
		if($this->instagram_is_enabled) {
			$field_value = get_post_meta( $post->ID, 'cup_instagram_code', true );
			$form_fields['cup_instagram_code'] = array(
				'value' => $field_value ? $field_value : '',
				'label' => __( 'Instagram Code' ),
				'helps' => __( 'Instagram Code Number' ) . ' (<a href="' . $repost_instagram_url .'">' . __( 'Repost' ) . '</a>)'
			);
		}
		$form_fields['cup_regenerate_and_repost'] = array(
			'label' => '',
			'input' => 'html',
			'html'  => '<a href="' . $regenerate_and_repost .'">' . __( 'Regenerate short url and repost to all social networks' ) . '</a>',
			'helps' => '',
		);

		return $form_fields;
	}

	/**
	* Save the custom fields
	*
	* @since	1.0.0
	* @param	string	$attachment_id
	* @return	void
	* @author	Américo Dias <americo.dias@gmail.com>
	*/
	public function edit_fields( $attachment_id ) {
		if ( isset( $_REQUEST['attachments'][$attachment_id]['cup_date_taken'] ) ) {
			$cup_date_taken = $_REQUEST['attachments'][$attachment_id]['cup_date_taken'];
			update_post_meta( $attachment_id, 'cup_date_taken', $cup_date_taken );
		}
		if ( $this->bitly_url_shortener_is_enabled && isset( $_REQUEST['attachments'][$attachment_id]['cup_bitly_short_url_id'] ) ) {
			$cup_date_taken = $_REQUEST['attachments'][$attachment_id]['cup_bitly_short_url_id'];
			update_post_meta( $attachment_id, 'cup_bitly_short_url_id', $cup_date_taken );
		}
		if ( $this->facebook_is_enabled && isset( $_REQUEST['attachments'][$attachment_id]['cup_facebook_id'] ) ) {
			$cup_date_taken = $_REQUEST['attachments'][$attachment_id]['cup_facebook_id'];
			update_post_meta( $attachment_id, 'cup_facebook_id', $cup_date_taken );
		}
		if ( $this->facebook_is_enabled && isset( $_REQUEST['attachments'][$attachment_id]['cup_tumblr_id'] ) ) {
			$cup_date_taken = $_REQUEST['attachments'][$attachment_id]['cup_tumblr_id'];
			update_post_meta( $attachment_id, 'cup_tumblr_id', $cup_date_taken );
		}
	}


}

?>
