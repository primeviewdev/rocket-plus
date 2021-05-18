<?php
	require_once('includes/libs/wp_bootstrap_navwalker.php');
	require_once('includes/libs/class-tgm-plugin-activation.php');
	require_once('includes/theme-settings/asset-import.php');
	require_once('includes/theme-settings/page-settings.php');
	require_once('includes/theme-settings/theme-settings.php');
	// require_once('modules/custom-sidebar-widget.php');
	require_once('modules/custom-module.php');
	require_once('modules/optimizations.php');


	function developerShortcode( $atts ) { 
		return do_shortcode(get_option('developer'));
	}

	function copyrightShortcode( $atts ) { 
		return do_shortcode(get_option('copyright'));
	}

	function phoneShortcode( $atts ) { 
		return do_shortcode(get_option('phonenumber'));
	}

	function address1Shortcode( $atts ) { 
		return do_shortcode(get_option('address1'));
	}

	function address2Shortcode( $atts ) { 
		return do_shortcode(get_option('address2'));
	}

	function emailAddressShortcode( $atts ) { 
		return do_shortcode(get_option('email-address'));
	}


	/**
	 * Social Media Shortcode
	 */
	function socialMediaShortcode( $atts ) {
		// Assign default values
		
		$mode   = "";
		$return = "Invalid value!";
		
		extract( shortcode_atts( array(
			'mode' =>  $mode
		), $atts ) );
		
		if($mode == "facebook"){
			$return = get_option('facebook');
		}
		else if($mode == "twitter"){
			$return = get_option('twitter');
		}
		else if($mode == "google_plus"){
			$return = get_option('google_plus');
		}
		else if($mode == "linkedin"){
			$return = get_option('linkedin');
		}
		else if($mode == "youtube"){
			$return = get_option('youtube');
		}
		else if($mode == "instagram"){
			$return = get_option('instagram');
		}
		else if($mode == "pinterest"){
			$return = get_option('pinterest');
		}
		
		return $return;
	}

	/**
	 * Get Present Year
	 */
	function getPresentYear( $atts ){
		return date('Y');
	}
	
	/**
	 * Admin Favicon
	 */
	function adminFavicon() {
		echo '<link href="'.get_option('admin_favicon').'" rel="icon" type="image/x-icon">';
	}
	
	function excerpt_more( $more ) {
		return '';
	}
	
	function rocket_excerpt($length) {
		if(strlen(get_the_excerpt()) >= $length){
			$excerpt =  substr(get_the_excerpt(),0,$length).'...';
		}else{
			$excerpt = get_the_excerpt();
		}
		return $excerpt;
	}
	
	/**
	 * Custom Blog Pagination
	 */
	function my_pagination() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer
		
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
	}

	function requiredPlugins() {

		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'               => 'Contact Form DB', // The plugin name.
				'slug'               => 'contact-form-7-to-database-extension', // The plugin slug (typically the folder name).
				'source'             => get_stylesheet_directory() . '/plugins/contact-form-7-to-database-extension-2.10.32.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			array(
				'name'               => 'Rocket Theme - Override Morphing Search', // The plugin name.
				'slug'               => 'rocket-override-morphing-search', // The plugin slug (typically the folder name).
				'source'             => get_stylesheet_directory() . '/plugins/rocket-override-morphing-search.zip', // The plugin source.
				'required'  => false,
				'force_activation' => false,
				'force_deactivation' => false
			),
			array(
				'name'               => 'Infinte Post Scroll', // The plugin name.
				'slug'               => 'clever-infinite-scroll', // The plugin slug (typically the folder name).
				'source'             => get_template_directory() . '/plugins/clever-infinite-scroll.zip', // The plugin source.
				'required'  => false,
				'force_activation' => false,
				'force_deactivation' => false
			),
			array(
				'name'      => 'Max Mega Menu', //repo name
				'slug'      => 'megamenu', //url
				'required'  => true,
				'force_activation' => true,
				'force_deactivation' => false
			),
			array(
				'name'      => 'Yoast SEO', //repo name
				'slug'      => 'wordpress-seo', //url
				'required'  => true,
				'force_activation' => true,
				'force_deactivation' => false
			),
			array(
				'name'      => 'Classic Editor', //repo name
				'slug'      => 'classic-editor', //url
				'required'  => true,
				'force_activation' => true,
				'force_deactivation' => true
			),
			array(
				'name'      => 'Contact Form 7', //repo name
				'slug'      => 'contact-form-7', //url
				'required'  => true,
				'force_activation' => true,
				'force_deactivation' => false
			),
			array(
				'name'      => 'Advanced Custom Fields', //repo name
				'slug'      => 'advanced-custom-fields', //url
				'required'  => false,
				'force_activation' => false,
				'force_deactivation' => false
			),
			array(
				'name'      => 'Zone Ratings', //repo name
				'slug'      => 'zone-ratings', //url
				'source'    => '/zekinah/Zone-Ratings/archive/master.zip',
				'external_url' => 'https://github.com/zekinah/Zone-Ratings',
				'version'	=> '1.9.0',
				'required'  => false,
				'force_activation' => false,
				'force_deactivation' => false
			),
			array(
				'name'      => 'Zone Cookie', //repo name
				'slug'      => 'zone-cookie', //url
				'source'    => '/zekinah/Zone-Cookie/archive/master.zip',
				'external_url' => 'https://wordpress.org/plugins/zone-cookie/',
				'version'	=> '1.0.3',
				'required'  => false,
				'force_activation' => false,
				'force_deactivation' => false
			),
			array(
				'name'      => 'Zone Redirect', //repo name
				'slug'      => 'zone-redirect', //url
				'source'    => '/zekinah/Zone-Redirect/archive/master.zip',
				'external_url' => 'https://wordpress.org/plugins/zone-redirect/',
				'version'	=> '1.0.4',
				'required'  => false,
				'force_activation' => false,
				'force_deactivation' => false
			)	
		);

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => __( 'Rocket Framework Recommended Plugins', 'tgmpa' ),
				'menu_title'                      => __( 'Rocket Theme Plugins', 'tgmpa' ),
				'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
				'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
				'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
				'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		tgmpa( $plugins, $config );

	}

	function enqueue_color_picker( $hook ) {
		// first check that $hook_suffix is appropriate for your admin page
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'backend-script-handle', get_template_directory_uri().'/assets/js/backend.js', array( 'wp-color-picker' ), false, true );
	}

	function fixed_dp_paragraph_tinymce() {
		echo "<script type='text/javascript'>
	
		setTimeout(function(){
            jQuery(window).scroll(function() {
				styleAttr = jQuery('.mce-top-part .mce-toolbar-grp').attr('style');
				listAttr = styleAttr.trim().split(' ');
				if(listAttr[1] == 'fixed;') {
					jQuery('.mce-floatpanel').css('position','fixed');
				} else {
					jQuery('.mce-floatpanel').css('position','absolute');
				}
			});
        },5000)
	
		</script>";
	}
	add_action('admin_footer', 'fixed_dp_paragraph_tinymce');

	/*
	* Enable Shortcodes on Widgets
	*/
	add_filter( 'widget_text', 'do_shortcode' );
	
	/**
	 * Register and enqueue a custom stylesheet in the WordPress admin.
	 */
	function rocketAdminStyle() {
		wp_register_style( 'backend-css-styles', get_template_directory_uri() . '/assets/css/backend.css', false, '1.0.0' );
		wp_enqueue_style( 'backend-css-styles' );
		wp_register_style( 'backend-js-script',  get_template_directory_uri().'/assets/js/backend.js',array('jquery'), false, '1.0.0');
		wp_enqueue_script( 'backend-js-script');
	}

	/**
	 * Function Init 
	 */
	function launchRocket(){
		/**
		 * Load on frontend
		 */

		add_action( 'wp_enqueue_scripts', 'rocketStyle' );
		add_action( 'wp_enqueue_scripts', 'rocketScript' );
		
		/**
		 * Inline CSS 
		 */
		add_action( 'wp_head', 'dynamicCSS',100);
		
		/**
		* Inline JS
		*/
		add_action( 'wp_head', 'dynamicJS',100);
		
		/**
		 * Remove Version
		 */
		add_filter( 'script_loader_src', 'removeScriptVersion', 15, 1 );
		add_filter( 'style_loader_src', 'removeScriptVersion', 15, 1 );
		
		/**
		 * Excerpt Length
		 */
		// add_filter('excerpt_length', 'new_excerpt_length');	
		  
		/**
		 * Async JS Version
		 */
		// add_filter( 'clean_url', 'asyncJS', 11, 1 );
	
		/** 
		 * Load on admin
		 */
		if(is_admin()){
			/**
			 * Theme Styles
			 */
			add_action( 'admin_enqueue_scripts', 'rocketAdminStyle' );
			/**
			 * Theme Options
			 */
			add_action( 'admin_menu', 'rocketThemeOptions' );
			add_action( 'admin_init', 'rocketThemeSettings');

			// Custom Sidebar 
			// add_action( 'init', 'initializeCustomSidebars');
			// add_action( 'admin_menu', 'rocketCustomSidebars');
			// add_action( 'admin_init', 'rocketCustomSidebarSettings');
			// add_action( 'admin_init', 'insertCustomSidebars');
			
			
			
			
			/** 
			 * Admin Favicon
			 */
			 add_action('admin_head', 'adminFavicon');
			 
			/**
			 * Theme Features
			 */
			 add_theme_support( 'post-thumbnails' ); 
			 add_action( 'admin_enqueue_scripts', 'enqueue_color_picker' );
			 
		}

		/**
		 * Plugin Dep
		 */
		 add_action( 'tgmpa_register', 'requiredPlugins' ); 
		  
		/**
		 * Sidebar
		 **/
		add_action( 'widgets_init', 'rocketHeader' );	 	
		add_action( 'widgets_init', 'rocketFooter' );	 	
		add_action( 'widgets_init', 'ctaBeforeFooter' );	 
		add_action( 'widgets_init', 'rocketSidebar' );
		
		//add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
		
		/**
		 * Rocket Menu
		 */
		register_nav_menu( 'primary', __( 'Primary Menu', 'rocket' ) );
		register_nav_menu( 'mobile', __( 'Mobile Menu', 'rocket' ) );

		/**
		 * Shortcode
		 */
		add_shortcode( 'rocketmenu', 'getMenuNavigation' ); //[rocketmenu]
		add_shortcode( 'year', 'getPresentYear' ); //[year]
		add_shortcode( 'social-media', 'socialMediaShortcode' ); //[social-media mode="facebook"]
		add_shortcode( 'copyright', 'copyrightShortcode' ); //[copyright]
		add_shortcode( 'developer', 'developerShortcode' ); //[developer]
		add_shortcode( 'phonenumber', 'phoneShortcode' ); //[phonenumber]
		add_shortcode( 'address1', 'address1Shortcode' ); //[address1]
		add_shortcode( 'address2', 'address2Shortcode' ); //[address2]
		add_shortcode( 'emailaddress', 'emailAddressShortcode' ); //[address2]
		add_shortcode('recent-posts', 'pull_blog_posts'); //[recent-posts post=5 template=news ]
	}	
	
	/** 
	 * Initialize WP Rocket Framework
	 */
	launchRocket();

