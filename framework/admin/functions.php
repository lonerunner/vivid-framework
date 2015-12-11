<?php
/*
 * Just in case let's prevent direct access to the files.
 * */
if ( ! defined( 'ABSPATH' ) ) die( 'Nope! Not gonna happen!' );

/*
 * This is base file for theme admin options. This file stores initial settings
 * and configuration for theme activation and admin options
 * */

/*
 * A Warm welcome message
 *
 * When user activates theme let's display thank you
 * message and link to theme options
 * */
if (is_admin() && $pagenow == "themes.php" && isset($_GET['activated']) ) {

	function vivid_framework_welcome_theme_settings() {
		echo '<div class="updated is-dismissible">';
		echo '<h2>Thank you for using our themes. </h2>';
		echo '<p>This theme comes with Options Panel. To configure theme settings go to <a href="' . admin_url('admin.php?page=themeoptions') .'">Theme Options.</a></p>';
		echo '</div>';
	}
	add_action( 'admin_notices', 'vivid_framework_welcome_theme_settings' );
}

/*
 * Check if user can edit theme options
 *
 * If user can't edit theme options there is no need to load
 * all of the theme functions
 * */

if (current_user_can('edit_theme_options')) {
	// Load menu page
	add_action( 'admin_menu', 'vivid_framework_options_menu' );

	// Load settings for theme
	add_action( 'admin_init', 'vivid_framework_settings_init' );
}

/*
 * Add admin menu with theme options
 *
 * This is menu function, the action for activating menu is
 * checked first if current user can edit theme options
 * otherwise this menu won't load
 * */
function vivid_framework_options_menu() {
	add_menu_page(
		__('Theme options', 'vivid-framework'),
		__('Theme options', 'vivid-framework'),
		'edit_themes',
		'themeoptions',
		'vivid_framework_theme_options',
		'',
		87
	);
}

/*
 * Load css and js files required for our theme options to work.
 *
 * These files are loaded on on every page in admin area
 * because some of styles and scripts are required
 * for our widgets, options or dropins to work
 * */

function load_framework_admin_scripts() {

	// Registering styles
	wp_register_style( 'admin',                 FRAMEWORK_DIR . '/assets/css/admin.css' );
	wp_register_style( 'jquery-ui',             FRAMEWORK_DIR . '/assets/components/jquery-ui/jquery-ui.css' );
	wp_register_style( 'select2',               FRAMEWORK_DIR . '/assets/components/select2/css/select2.css' );
	wp_register_style( 'formstone-dropdown',    FRAMEWORK_DIR . '/assets/components/formstone/css/dropdown.css' );
	wp_register_style( 'formstone-checkbox',    FRAMEWORK_DIR . '/assets/components/formstone/css/checkbox.css' );

	// Load styles
	wp_enqueue_style( 'admin' );
	wp_enqueue_style( 'jquery-ui' );
	wp_enqueue_style( 'select2' );
	wp_enqueue_style( 'formstone-dropdown' );
	wp_enqueue_style( 'formstone-checkbox' );
	wp_enqueue_style( 'wp-color-picker' );


	// Registering scripts
	wp_register_script( 'admin-js',             FRAMEWORK_DIR . '/assets/js/admin.js' );
	wp_register_script( 'select2',              FRAMEWORK_DIR . '/assets/components/select2/js/select2.min.js' );
	wp_register_script( 'formstone-core',       FRAMEWORK_DIR . '/assets/components/formstone/js/core.js' );
	wp_register_script( 'formstone-dropdown',   FRAMEWORK_DIR . '/assets/components/formstone/js/dropdown.js' );
	wp_register_script( 'formstone-checkbox',   FRAMEWORK_DIR . '/assets/components/formstone/js/checkbox.js' );
	wp_register_script( 'repeatable-fields',    FRAMEWORK_DIR . '/assets/js/repeatable-fields.js' );

	// Load scripts
	wp_enqueue_script( 'post' );
	wp_enqueue_script( 'jquery-ui-tabs',        array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-ui-tooltip',     array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-ui-datepicker',  array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-ui-slider',      array( 'jquery' ), false, true );
	wp_enqueue_script( 'wp-color-picker',       array( 'jquery' ), false, true );
	wp_enqueue_script( 'select2',               array( 'jquery' ), false, true );
	wp_enqueue_script( 'formstone-core',        array( 'jquery' ), false, true );
	wp_enqueue_script( 'formstone-dropdown',    array( 'jquery', 'formstone-core' ), false, true );
	wp_enqueue_script( 'formstone-checkbox',    array( 'jquery', 'formstone-core' ), false, true );
	wp_enqueue_script( 'repeatable-fields',     array( 'jquery' ), false, true );
	wp_enqueue_script( 'admin-js',              array( 'jquery' ), false, true );

	// Load media uploader
	//wp_enqueue_media();

}
add_action( 'admin_enqueue_scripts', 'load_framework_admin_scripts' );

/*
 * Register theme settings
 *
 * Registers new settings fields that can be used in wp options
 * register settings must have same name as settings_fields
 * register_setting( $option_group, $option_name, $sanitize_callback )
 *
 * This option further requires pages
 * admin/options.page.php for options page and validating inputs
 * */

function vivid_framework_settings_init() {
	register_setting( 'vivid_framework_theme_options', THEME_BASE_NAME .'_options', 'vivid_framework_sanitize_options' );
}
