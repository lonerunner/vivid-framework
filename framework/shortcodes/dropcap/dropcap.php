<?php
/*
 * Example of self-closing shortcode.
 * Usage
 * [dropcap letter="T"]
 * */

/*
 * Shortcode function that gets executed when the content is called
 * */
function dropcap_function( $atts ) {
	// Attributes
	extract( shortcode_atts(
			array(
				'letter' => '',
			), $atts )
	);
	return '<div class="dropcap">' . $letter . '</div>';
}
add_shortcode( 'dropcap', 'dropcap_function' );

/*
 * Shortcode form for shortcodes list
 * This get's called when WordPress editor is called. This form displays input options to popup area on selected shortcode list.
 * Each input must have an name attribute exactly the same as shortcode attribute. And if shortcode is self-closing you can't set
 * name attribute named 'content', otherwise if shortcode is enclosing you must have input field with name 'content'. The loop inside
 * javascript will loop through each input field and check if there is a field with name 'content', this will basically
 * determine if shortcode is enclosing or self-closing. This 'dropcap' shortcode example is for self-closing shortcode.
 *
 * Shortcode function must also always have same name as registered shortcode following with '_form()', so dropcap
 * shortcode must have function named dropcap_form().
 * */
function dropcap_form() { ?>

	<input type="text" name="letter"/>

<?php }

/*
 * This is optional, you can add styles to your own css file anywherewhere you want to store css files and include in the theme
 * or sometimes style is even applied already in the theme so you only need a function.
 * But my suggestion is if your shortcode is more complex and standalone with a lot of styling you should include your own .css file
 * */
function dropcap_styles() {
	wp_enqueue_style( 'dropcap-style', FRAMEWORK_DIR . '/shortcodes/dropcap/dropcap-style.css' );
}
add_action( 'wp_enqueue_scripts', 'dropcap_styles' );