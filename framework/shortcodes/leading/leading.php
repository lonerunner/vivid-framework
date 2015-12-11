<?php
/*
 * Example of enclosing shortcode
 * Usage
 * [leading]Here is some leading text[/leading]
 * */

/*
 * For more instructions about shortcodes please read in dropcap shortcode file
 * /framework/shortcodes/dropcap/dropcap.php
 * */
function leading_function( $atts, $content = null ) {
	return '<p class="leading-text">' . $content . '</p>';
}
add_shortcode( 'leading', 'leading_function' );

function leading_form() { ?>

	<textarea class="large-text" rows="10" id="content"></textarea>

<? }

function leading_styles() {
	wp_enqueue_style( 'leading-style', FRAMEWORK_DIR . '/shortcodes/leading/leading-style.css' );
}
add_action( 'wp_enqueue_scripts', 'leading_styles' );