<?php
/*
 * Just in case let's prevent direct access to the files.
 * */
if ( ! defined( 'ABSPATH' ) ) die( 'Nope! Not gonna happen!' );

/*
 * Something about the framework it self
 *
 * Title:       Vivid Framework
 * URI:         http://www.vividthemes.com/framework
 * Version:     2.0
 * Author:      Aleksandar
 * Author URI:  http://www.onedesign.me
 * Description: Vivid framework is built as foundation to Vivid Themes for easier theme management and configuration. The framework
 * it self helps you to fast and with consistency add theme options, shortcodes, metaboxes with ease.
 *
 * License:     GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * You can freely use this framework in your themes or personal projects, but please consider leaving a credits and link to framework URI.
 * */

/*
 * Define some paths and basic info
 * */

// Define framework info
define( 'VIVID_FRAMEWORK_VERSION', '2.0' );
define( 'FRAMEWORK_PATH',   get_template_directory() .      '/framework' );
define( 'FRAMEWORK_DIR',    get_template_directory_uri() .  '/framework' );

// Define Theme info
define( 'THEME_BASE_NAME',  wp_get_theme()->Template );
define( 'THEME_NAME',       wp_get_theme()->Name );
define( 'THEME_VERSION',    wp_get_theme()->Version );

/*
 * Include required files for framework to work
 * Files will be separated by functions for
 * specific type of use, like admin options
 * shortcodes, metaboxes, dropins, etc...
 * */

//Base file for administration area
require_once( FRAMEWORK_PATH . '/admin/functions.php' );

// This page contains form and page style for theme options page
require_once( FRAMEWORK_PATH . '/admin/options.page.php' );

// This page contains input fields
require_once( FRAMEWORK_PATH . '/admin/input.fields.php' );

// This page is to check and sanitize inputs
require_once( FRAMEWORK_PATH . '/admin/validate.inputs.php' );

// Add metaboxes
require_once( FRAMEWORK_PATH . '/admin/metaboxes.php');

// Add shortcodes
require_once( FRAMEWORK_PATH . '/shortcodes/shortcodes.php' );