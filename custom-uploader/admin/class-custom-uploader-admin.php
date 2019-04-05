<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://americodias.com
 * @since      1.0.0
 *
 * @package    Custom_Uploader
 * @subpackage Custom_Uploader/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Uploader
 * @subpackage Custom_Uploader/admin
 * @author     Américo Dias <americo.dias@gmail.com>
 */
class Custom_Uploader_Admin {

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
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $options   The current options.
	 */
	private $options;

	/**
	 * Current active tab on the custom uploader options menu.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $active_tab   The active tab.
	 */
	private $active_tab;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = get_option( 'cup_options' );

        if( isset( $_GET[ 'tab' ] ) ) {
            $this->active_tab = $_GET[ 'tab' ];
        } else {
            $this->active_tab = 'tab_one';
        }

		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Uploader_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Uploader_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-uploader-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Uploader_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Uploader_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-uploader-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the options page to the admin area.
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function add_plugin_page() {
		add_options_page(
			'Custom Uploader', // page_title
			'Custom Uploader', // menu_title
			'manage_options', // capability
			'custom-uploader', // menu_slug
			array( $this, 'create_admin_page' ) // function
		);
	}

	/**
	 * Create the admin page
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function create_admin_page() {
		?>
		<div class="wrap">
			<h2>Custom Uploader</h2>
			<!--<div class="description">This is description of the page.</div>-->
			<p></p>

            <h2 class="nav-tab-wrapper">
                <a href="?page=custom-uploader&tab=tab_one" class="nav-tab <?php echo $this->active_tab == 'tab_one' ? 'nav-tab-active' : ''; ?>">Bitly URL Shortener</a>
                <a href="?page=custom-uploader&tab=tab_two" class="nav-tab <?php echo $this->active_tab == 'tab_two' ? 'nav-tab-active' : ''; ?>">Facebook</a>
				<a href="?page=custom-uploader&tab=tab_three" class="nav-tab <?php echo $this->active_tab == 'tab_three' ? 'nav-tab-active' : ''; ?>">Tumblr</a>
				<a href="?page=custom-uploader&tab=tab_four" class="nav-tab <?php echo $this->active_tab == 'tab_four' ? 'nav-tab-active' : ''; ?>">Instagram</a>
				<a href="?page=custom-uploader&tab=tab_five" class="nav-tab <?php echo $this->active_tab == 'tab_five' ? 'nav-tab-active' : ''; ?>">Galleries</a>
            </h2>

            <form method="post" action="options.php">
				<input type="hidden" name="tab" value="<?php echo $this->active_tab; ?>">
	            <?php

	                if( strcmp($this->active_tab, 'tab_one') == 0 ) {

						settings_fields( 'custom-uploader' );
						do_settings_sections( 'custom-uploader-1' );

	                } elseif( strcmp($this->active_tab, 'tab_two') == 0 )  {

						settings_fields( 'custom-uploader' );
						do_settings_sections( 'custom-uploader-2' );

	                } elseif( strcmp($this->active_tab, 'tab_three') == 0 )  {

						settings_fields( 'custom-uploader' );
						do_settings_sections( 'custom-uploader-3' );

	                } elseif( strcmp($this->active_tab, 'tab_four') == 0 )  {

						settings_fields( 'custom-uploader' );
						do_settings_sections( 'custom-uploader-4' );

	                } elseif( strcmp($this->active_tab, 'tab_five') == 0 )  {

						settings_fields( 'custom-uploader' );
						do_settings_sections( 'custom-uploader-5' );

	                }

					submit_button();
	            ?>
			</form>
		</div>
	<?php
	}

	/**
	 * Initialize the options page
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function page_init() {

		register_setting(
			'custom-uploader', // option_group
			'cup_options', // cup_options
			array( $this, 'sanitize' ) // sanitize_callback
		);

		/* Gooogle URL Shortner Section
		*******************************/
		add_settings_section(
			'bitly_url_shortener', // id
			'', // title
			array( $this, 'bitly_url_shortener_section_info' ), // callback
			'custom-uploader-1' // page
		);

		add_settings_field(
			'bitly_url_shortener_is_enabled', // id
			'Enable', // title
			array( $this, 'bitly_url_shortener_is_enabled_callback' ), // callback
			'custom-uploader-1', // page
			'bitly_url_shortener' // section
		);

		add_settings_field(
			'bitly_url_shortener_generic_access_token', // id
			'Bitly URL Shortener Generic Access Token', // title
			array( $this, 'bitly_url_shortener_generic_access_token_callback' ), // callback
			'custom-uploader-1', // page
			'bitly_url_shortener', // section
			array(  // The array of arguments to pass to the callback. In this case, just a description.
            'Bitly Generic Access Token',
        	)
		);

		add_settings_field(
			'bitly_url_shortener_domain', // id
			'Bitly URL Shortener Domain', // title
			array( $this, 'bitly_url_shortener_domain_callback' ), // callback
			'custom-uploader-1', // page
			'bitly_url_shortener', // section
			array(  // The array of arguments to pass to the callback. In this case, just a description.
            'Bitly Domain (i.e. bit.ly)',
        	)
		);

		/* Facebook Section
		*******************/
		add_settings_section(
			'facebook', // id
			'', // title
			array( $this, 'facebook_section_info' ), // callback
			'custom-uploader-2' // page
		);

		add_settings_field(
			'facebook_is_enabled', // id
			'Enable', // title
			array( $this, 'facebook_is_enabled_callback' ), // callback
			'custom-uploader-2', // page
			'facebook' // section
		);

		add_settings_field(
			'facebook_app_id', // id
			'App ID', // title
			array( $this, 'facebook_app_id_callback' ), // callback
			'custom-uploader-2', // page
			'facebook' // section
		);

		add_settings_field(
			'facebook_app_secret', // id
			'App Secret', // title
			array( $this, 'facebook_app_secret_callback' ), // callback
			'custom-uploader-2', // page
			'facebook' // section
		);

		add_settings_field(
			'facebook_api_key', // id
			'API key', // title
			array( $this, 'facebook_api_key_callback' ), // callback
			'custom-uploader-2', // page
			'facebook' // section
		);

		add_settings_field(
			'facebook_mobile_album_id', // id
			'Mobile Album ID', // title
			array( $this, 'facebook_mobile_album_id_callback' ), // callback
			'custom-uploader-2', // page
			'facebook' // section
		);

		/* Tumblr Section
		*****************/
		add_settings_section(
			'tumblr', // id
			'', // title
			array( $this, 'tumblr_section_info' ), // callback
			'custom-uploader-3' // page
		);

		add_settings_field(
			'ftumblr_is_enabled', // id
			'Enable', // title
			array( $this, 'tumblr_is_enabled_callback' ), // callback
			'custom-uploader-3', // page
			'tumblr' // section
		);

		add_settings_field(
			'tumblr_consumer_key', // id
			'Tumblr Consumer Key', // title
			array( $this, 'tumblr_consumer_key_callback' ), // callback
			'custom-uploader-3', // page
			'tumblr' // section
		);

		add_settings_field(
			'tumblr_consumer_secret', // id
			'Tumblr Consumer Secret', // title
			array( $this, 'tumblr_consumer_secret_callback' ), // callback
			'custom-uploader-3', // page
			'tumblr' // section
		);

		add_settings_field(
			'tumblr_oauth_token', // id
			'Tumblr OAuth Token', // title
			array( $this, 'tumblr_oauth_token_callback' ), // callback
			'custom-uploader-3', // page
			'tumblr' // section
		);

		add_settings_field(
			'tumblr_oauth_secret', // id
			'Tumblr OAuth Secret', // title
			array( $this, 'tumblr_oauth_secret_callback' ), // callback
			'custom-uploader-3', // page
			'tumblr' // section
		);

		add_settings_field(
			'tumblr_blog_name', // id
			'Tumblr Blog Name', // title
			array( $this, 'tumblr_blog_name_callback' ), // callback
			'custom-uploader-3', // page
			'tumblr' // section
		);
		/*
		add_settings_field(
			'tumblr_authenticate', // id
			'', // title
			array( $this, 'tumblr_authenticate_callback' ), // callback
			'custom-uploader-3', // page
			'tumblr' // section
		);
		*/

		/* Instagram Section
		*************************/
		add_settings_section(
			'instagram', // id
			'', // title
			array( $this, 'instagram_section_info' ), // callback
			'custom-uploader-4' // page
		);

		add_settings_field(
			'instagram_is_enabled', // id
			'Enable', // title
			array( $this, 'instagram_is_enabled_callback' ), // callback
			'custom-uploader-4', // page
			'instagram' // section
		);

		add_settings_field(
			'instagram_username', // id
			'Username', // title
			array( $this, 'instagram_username_callback' ), // callback
			'custom-uploader-4', // page
			'instagram' // section
		);

		add_settings_field(
			'instagram_password', // id
			'Password', // title
			array( $this, 'instagram_password_callback' ), // callback
			'custom-uploader-4', // page
			'instagram' // section
		);

		/* Mobile Gallery Section
		*************************/
		add_settings_section(
			'galleries', // id
			'', // title
			array( $this, 'galleries_section_info' ), // callback
			'custom-uploader-5' // page
		);

		add_settings_field(
			'mobile_gallery_id', // id
			'Mobile Gallery ID', // title
			array( $this, 'mobile_gallery_id_callback' ), // callback
			'custom-uploader-5', // page
			'galleries' // section
		);

		add_settings_field(
			'dslr_gallery_id', // id
			'dSLR Gallery ID', // title
			array( $this, 'dslr_gallery_id_callback' ), // callback
			'custom-uploader-5', // page
			'galleries' // section
		);


	}


	/**
	 * Get the image sizes set by the current theme. Save them as an option
	 * so when the custom uploader is called outside WordPress, it knows
	 * which image sizes it has to generate. This is needed because the
	 * theme is not loaded currectly even after using the switch_to_blog()
	 * function.
	 *
	 * @since 1.0.0
	 * @return array of image sizes
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	private function get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		return $sizes;
	}

	/**
	 * Sanitize input fields
	 *
	 * @since 1.0.0
	 * @param array $input
	 * @return array of sanitized inputs
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function sanitize($input) {
		$sanitary_values = $this->options;

		if($_POST['tab'] === 'tab_one') {
			if ( array_key_exists( 'cup_bitly_url_shortener_is_enabled', $input ) )
				$sanitary_values['cup_bitly_url_shortener_is_enabled'] = true;
			else
				$sanitary_values['cup_bitly_url_shortener_is_enabled'] = false;

			$sanitary_values['cup_bitly_url_shortener_generic_access_token'] = sanitize_text_field( $input['cup_bitly_url_shortener_generic_access_token'] );

			$sanitary_values['cup_bitly_url_shortener_domain'] = sanitize_text_field( $input['cup_bitly_url_shortener_domain'] );
		}

		elseif($_POST['tab'] === 'tab_two') {
			if ( array_key_exists( 'cup_facebook_is_enabled', $input ) )
				$sanitary_values['cup_facebook_is_enabled'] = true;
			else
				$sanitary_values['cup_facebook_is_enabled'] = false;

			if ( isset( $input['cup_facebook_app_id'] ) )
				$sanitary_values['cup_facebook_app_id'] = sanitize_text_field( $input['cup_facebook_app_id'] );

			if ( isset( $input['cup_facebook_app_secret'] ) )
				$sanitary_values['cup_facebook_app_secret'] = sanitize_text_field( $input['cup_facebook_app_secret'] );

			if ( isset( $input['cup_facebook_api_key'] ) )
				$sanitary_values['cup_facebook_api_key'] = esc_textarea( $input['cup_facebook_api_key'] );

			if ( isset( $input['cup_facebook_mobile_album_id'] ) )
				$sanitary_values['cup_facebook_mobile_album_id'] = sanitize_text_field( $input['cup_facebook_mobile_album_id'] );
		}

		elseif($_POST['tab'] === 'tab_three') {
			if ( array_key_exists( 'cup_tumblr_is_enabled', $input ) )
				$sanitary_values['cup_tumblr_is_enabled'] = true;
			else
				$sanitary_values['cup_tumblr_is_enabled'] = false;

			if ( isset( $input['cup_tumblr_consumer_key'] ) )
				$sanitary_values['cup_tumblr_consumer_key'] = sanitize_text_field( $input['cup_tumblr_consumer_key'] );

			if ( isset( $input['cup_tumblr_consumer_secret'] ) )
				$sanitary_values['cup_tumblr_consumer_secret'] = sanitize_text_field( $input['cup_tumblr_consumer_secret'] );

			if ( isset( $input['cup_tumblr_oauth_token'] ) )
				$sanitary_values['cup_tumblr_oauth_token'] = sanitize_text_field( $input['cup_tumblr_oauth_token'] );

			if ( isset( $input['cup_tumblr_oauth_secret'] ) )
				$sanitary_values['cup_tumblr_oauth_secret'] = sanitize_text_field( $input['cup_tumblr_oauth_secret'] );

			if ( isset( $input['cup_tumblr_blog_name'] ) )
				$sanitary_values['cup_tumblr_blog_name'] = sanitize_text_field( $input['cup_tumblr_blog_name'] );
		}
		elseif($_POST['tab'] === 'tab_four') {
			if ( array_key_exists( 'cup_instagram_is_enabled', $input ) )
				$sanitary_values['cup_instagram_is_enabled'] = true;
			else
				$sanitary_values['cup_instagram_is_enabled'] = false;

			if ( isset( $input['cup_instagram_username'] ) )
				$sanitary_values['cup_instagram_username'] = sanitize_text_field( $input['cup_instagram_username'] );

			if ( isset( $input['cup_instagram_password'] ) )
				$sanitary_values['cup_instagram_password'] = sanitize_text_field( $input['cup_instagram_password'] );
		}
		elseif($_POST['tab'] === 'tab_five') {
			if ( isset( $input['cup_mobile_gallery_id'] ) )
				$sanitary_values['cup_mobile_gallery_id'] = sanitize_text_field( $input['cup_mobile_gallery_id'] );

			if ( isset( $input['cup_dslr_gallery_id'] ) )
				$sanitary_values['cup_dslr_gallery_id'] = sanitize_text_field( $input['cup_dslr_gallery_id'] );
		}

		$sanitary_values['image_sizes'] = $this->get_image_sizes();

		return $sanitary_values;
	}

	/**
	 * Bitly URL shortener tab info
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function bitly_url_shortener_section_info() {
	}

	/**
	 * Facebook tab info
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function facebook_section_info() {
	}

	/**
	 * Tumblr tab info
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function tumblr_section_info() {
		$tumblr_autenticate_url = plugins_url( 'functions/tumblr-autenticate.php', __FILE__ ) . '?blog_id=' . get_current_blog_id();
		$tumblr_callback_url = plugins_url( 'functions/tumblr-callback.php', __FILE__ ) . '?blog_id=' . get_current_blog_id();
		echo '<p>Insert the Comsumer Key/Secret and then use this <a href="' . $tumblr_autenticate_url . '">activation link</a> to get OAuth Token/Secret.</p>';
		echo '<p>Please define your call back url as follows: <strong>' . $tumblr_callback_url . '</strong></p>';
	}

	/**
	 * Instagram info
	 *
	 * @since 1.1.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function instagram_section_info() {
	}

	/**
	 * Galleries tab info
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function galleries_section_info() {
	}

	/**
	 * Callback for facebook_is_enabled
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function facebook_is_enabled_callback() {
		printf(
			'<input type="checkbox" name="cup_options[cup_facebook_is_enabled]" id="cup_facebook_is_enabled" value="cup_facebook_is_enabled" %s> <label for="cup_facebook_is_enabled">Activate Facebook</label>',
			( isset( $this->options['cup_facebook_is_enabled'] ) && $this->options['cup_facebook_is_enabled'] === true ) ? 'checked' : ''
		);
	}

	/**
	 * Callback for facebook_app_id
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function facebook_app_id_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_facebook_app_id]" id="cup_facebook_app_id" value="%s">',
			isset( $this->options['cup_facebook_app_id'] ) ? esc_attr( $this->options['cup_facebook_app_id']) : ''
		);
	}

	/**
	 * Callback for facebook_app_secret
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function facebook_app_secret_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_facebook_app_secret]" id="cup_facebook_app_secret" value="%s">',
			isset( $this->options['cup_facebook_app_secret'] ) ? esc_attr( $this->options['cup_facebook_app_secret']) : ''
		);
	}

	/**
	 * Callback for facebook_api_key
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function facebook_api_key_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="cup_options[cup_facebook_api_key]" id="cup_facebook_api_key">%s</textarea>',
			isset( $this->options['cup_facebook_api_key'] ) ? esc_attr( $this->options['cup_facebook_api_key']) : ''
		);
	}

	/**
	 * Callback for facebook_mobile_album_id
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function facebook_mobile_album_id_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_facebook_mobile_album_id]" id="cup_facebook_mobile_album_id" value="%s">',
			isset( $this->options['cup_facebook_mobile_album_id'] ) ? esc_attr( $this->options['cup_facebook_mobile_album_id']) : ''
		);
	}

	/**
	 * Callback for mobile_gallery_id
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function mobile_gallery_id_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_mobile_gallery_id]" id="cup_mobile_gallery_id" value="%s">',
			isset( $this->options['cup_mobile_gallery_id'] ) ? esc_attr( $this->options['cup_mobile_gallery_id']) : ''
		);
	}

	/**
	 * Callback for dslr_gallery_id
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function dslr_gallery_id_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_dslr_gallery_id]" id="cup_dslr_gallery_id" value="%s">',
			isset( $this->options['cup_dslr_gallery_id'] ) ? esc_attr( $this->options['cup_dslr_gallery_id']) : ''
		);
	}

	/**
	 * Callback for bitly_url_shortener_is_enabled
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function bitly_url_shortener_is_enabled_callback() {
		printf(
			'<input type="checkbox" name="cup_options[cup_bitly_url_shortener_is_enabled]" id="cup_bitly_url_shortener_is_enabled" value="cup_bitly_url_shortener_is_enabled" %s> <label for="cup_bitly_url_shortener_is_enabled">Activate Bitly URL Shortener</label>',
			( isset( $this->options['cup_bitly_url_shortener_is_enabled'] ) && $this->options['cup_bitly_url_shortener_is_enabled'] === true ) ? 'checked' : ''
		);
	}

	/**
	 * Callback for bitly_url_shortener_generic_access_token
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function bitly_url_shortener_generic_access_token_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_bitly_url_shortener_generic_access_token]" id="cup_bitly_url_shortener_generic_access_token" value="%s">',
			isset( $this->options['cup_bitly_url_shortener_generic_access_token'] ) ? esc_attr( $this->options['cup_bitly_url_shortener_generic_access_token']) : ''
		);
	}

	/**
	 * Callback for bitly_url_shortener_domain
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function bitly_url_shortener_domain_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_bitly_url_shortener_domain]" id="cup_bitly_url_shortener_domain" value="%s">',
			isset( $this->options['cup_bitly_url_shortener_domain'] ) ? esc_attr( $this->options['cup_bitly_url_shortener_domain']) : ''
		);
	}

	/**
	 * Callback for tumblr_is_enabled
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function tumblr_is_enabled_callback() {
		printf(
			'<input type="checkbox" name="cup_options[cup_tumblr_is_enabled]" id="cup_tumblr_is_enabled" value="cup_tumblr_is_enabled" %s> <label for="cup_tumblr_is_enabled">Activate Tumblr</label>',
			( isset( $this->options['cup_tumblr_is_enabled'] ) && $this->options['cup_tumblr_is_enabled'] === true ) ? 'checked' : ''
		);
	}

	/**
	 * Callback for tumblr_blog_name
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function tumblr_blog_name_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_tumblr_blog_name]" id="cup_tumblr_blog_name" value="%s">',
			isset( $this->options['cup_tumblr_blog_name'] ) ? esc_attr( $this->options['cup_tumblr_blog_name']) : ''
		);
	}

	/**
	 * Callback for tumblr_consumer_key
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function tumblr_consumer_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_tumblr_consumer_key]" id="cup_tumblr_consumer_key" value="%s">',
			isset( $this->options['cup_tumblr_consumer_key'] ) ? esc_attr( $this->options['cup_tumblr_consumer_key']) : ''
		);
	}

	/**
	 * Callback for tumblr_consumer_secret
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function tumblr_consumer_secret_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_tumblr_consumer_secret]" id="cup_tumblr_consumer_secret" value="%s">',
			isset( $this->options['cup_tumblr_consumer_secret'] ) ? esc_attr( $this->options['cup_tumblr_consumer_secret']) : ''
		);
	}

	/**
	 * Callback for tumblr_oauth_token
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function tumblr_oauth_token_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_tumblr_oauth_token]" id="cup_tumblr_oauth_token" value="%s">',
			isset( $this->options['cup_tumblr_oauth_token'] ) ? esc_attr( $this->options['cup_tumblr_oauth_token']) : ''
		);
	}

	/**
	 * Callback for tumblr_oauth_secret
	 *
	 * @since 1.0.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function tumblr_oauth_secret_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_tumblr_oauth_secret]" id="cup_tumblr_oauth_secret" value="%s">',
			isset( $this->options['cup_tumblr_oauth_secret'] ) ? esc_attr( $this->options['cup_tumblr_oauth_secret']) : ''
		);
	}

	/**
	 * Callback for instagram_is_enabled
	 *
	 * @since 1.1.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function instagram_is_enabled_callback() {
		printf(
			'<input type="checkbox" name="cup_options[cup_instagram_is_enabled]" id="cup_instagram_is_enabled" value="cup_instagram_is_enabled" %s> <label for="cup_instagram_is_enabled">Activate Instagram</label>',
			( isset( $this->options['cup_instagram_is_enabled'] ) && $this->options['cup_instagram_is_enabled'] === true ) ? 'checked' : ''
		);
	}

	/**
	 * Callback for instagram_username
	 *
	 * @since 1.1.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function instagram_username_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_instagram_username]" id="cup_instagram_username" value="%s">',
			isset( $this->options['cup_instagram_username'] ) ? esc_attr( $this->options['cup_instagram_username']) : ''
		);
	}

	/**
	 * Callback for instagram_password
	 *
	 * @since 1.1.0
	 * @return void
	 * @author Américo Dias <americo.dias@gmail.com>
	 */
	public function instagram_password_callback() {
		printf(
			'<input class="regular-text" type="text" name="cup_options[cup_instagram_password]" id="cup_instagram_password" value="%s">',
			isset( $this->options['cup_instagram_password'] ) ? esc_attr( $this->options['cup_instagram_password']) : ''
		);
	}

}
