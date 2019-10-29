<?php 

require_once dirname( __FILE__ ) . '/vendor/class-tgm-plugin-activation.php';


add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
	$plugins = array(
		/** This is an example of how to include a plugin pre-packaged with a theme */
		array(
			'name'     => 'Autoptimize', // The plugin name
			'slug'     => 'autoptimize', // The plugin slug (typically the folder name)
			//remove source if you want it to be downloaded from wordpress plguin repo
			//'source'   => get_stylesheet_directory() . '/assets/plugins/autoptimize.zip', // The plugin source
			'required' => true
		),
		array(
			'name'	  => 'ACF Pro',
			'slug'	  => 'advanced-custom-fields-pro',
			'source'   => get_stylesheet_directory() . '/assets/plugins/advanced-custom-fields-pro.zip', // The plugin source
		),
		array(
			'name'	  => 'ACF Content Analysis for Yoast SEO',
			'slug'	  => 'acf-content-analysis-for-yoast-seo',
		),
		array(
			'name'	  => 'Wordfence Security',
			'slug'	  => 'wordfence',
		),
		array(
			'name'	  => 'Yoast SEO',
			'slug'	  => 'wordpress-seo',
		),
		array(
			'name'	  => 'Duplicator Pro',
			'slug'	  => 'duplicator-pro',
		),
		array(
			'name'	  => 'BackWUP',
			'slug'	  => 'backwpup',
		),
		array(
			'name'	  => 'BackWUP',
			'slug'	  => 'backwpup',
		),
		array(
			'name'	  => 'Super Progressive Web Apps',
			'slug'	  => 'super-progressive-web-apps',
		),
		array(
			'name'	  => 'Akismet Anti-Spam',
			'slug'	  => 'akismet',
			'required' => true
		),
		array(
			'name'	  => 'WebP Express',
			'slug'	  => 'webp-express',
		),
		array(
			'name'	  => 'Brozzme DB Prefix & Tools Addons',
			'slug'	  => 'brozzme-db-prefix-change',
		),
		array(
			'name'	  => 'reSmush.it Image Optimizer',
			'slug'	  => 'resmushit-image-optimizer',
		),
		array(
			'name'	  => 'Comet Cache Pro',
			'slug'	  => 'comet-cache-pro',
			'source'   => get_stylesheet_directory() . '/assets/plugins/gravityforms.zip', 
			'required' => true
		),
		array(
			'name'	  => 'Gravity Forms Pro',
			'slug'	  => 'gravityforms',
			'source'   => get_stylesheet_directory() . '/assets/plugins/gravityforms.zip', 
			'required' => true
		)
	);

	$theme_text_domain = 'tgmpa';

	$config = array(
		/*'domain'       => $theme_text_domain,         // Text domain - likely want to be the same as your theme. */
		/*'default_path' => '',                         // Default absolute path to pre-packaged plugins */
		/*'menu'         => 'install-my-theme-plugins', // Menu slug */
		'strings'      	 => array(
			/*'page_title'             => __( 'Install Required Plugins', $theme_text_domain ), // */
			/*'menu_title'             => __( 'Install Plugins', $theme_text_domain ), // */
			/*'instructions_install'   => __( 'The %1$s plugin is required for this theme. Click on the big blue button below to install and activate %1$s.', $theme_text_domain ), // %1$s = plugin name */
			/*'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', $theme_text_domain ), // %1$s = plugin name, %2$s = plugins page URL */
			/*'button'                 => __( 'Install %s Now', $theme_text_domain ), // %1$s = plugin name */
			/*'installing'             => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name */
			/*'oops'                   => __( 'Something went wrong with the plugin API.', $theme_text_domain ), // */
			/*'notice_can_install'     => __( 'This theme requires the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', $theme_text_domain ), // %1$s = plugin name, %2$s = TGMPA page URL */
			/*'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', $theme_text_domain ), // %1$s = plugin name */
			/*'notice_can_activate'    => __( 'This theme requires the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', $theme_text_domain ), // %1$s = plugin name, %2$s = plugins page URL */
			/*'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', $theme_text_domain ), // %1$s = plugin name */
			/*'return'                 => __( 'Return to Required Plugins Installer', $theme_text_domain ), // */
		),
	);
	tgmpa( $plugins, $config );
}