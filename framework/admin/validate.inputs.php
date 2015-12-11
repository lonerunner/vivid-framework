<?php
/*
 * Just in case let's prevent direct access to the files.
 * */
if ( ! defined( 'ABSPATH' ) ) die( 'Nope! Not gonna happen!' );

/*
* Sanitize inputs
*
* Let's check all the fields and verify inputs
* */
function vivid_framework_validate_inputs( $input, $fields ){
	$output = array();

	// Loop through each input and get the id and values
	foreach( $input as $id => $value ) {

		// Check to see if the current option has a value. If so, process it.
		if( isset($input[$id]) ) {

			$filter = $fields[$id];

			// If filter exists with the named option filter inputs and output sanitized data
			if ( has_filter( 'vivid_framework_sanitize_' . $filter['type'] ) ) {
				$output[$id] = apply_filters( 'vivid_framework_sanitize_' . $filter['type'], $value );
			}
		}
	}

	return $output;
}

/*
 * This will sanitize all the inputs which should allow only basic text,
 * since we can use text values on select boxes and check boxes we will
 * use this for those options too.
 *
 * From the WordPress docs
 * Checks for invalid UTF-8, Convert single < characters to entity,
 * strip all tags, remove line breaks, tabs and extra white space,
 * strip octets.
 * */
function vivid_framework_sanitize_text_inputs( $input ) {

	$output = sanitize_text_field( $input );
	return $output;

}
add_filter( 'vivid_framework_sanitize_text',    'vivid_framework_sanitize_text_inputs' );
add_filter( 'vivid_framework_sanitize_select',  'vivid_framework_sanitize_text_inputs' );
add_filter( 'vivid_framework_sanitize_select2', 'vivid_framework_sanitize_text_inputs' );
add_filter( 'vivid_framework_sanitize_radio',   'vivid_framework_sanitize_text_inputs' );

/*
 * This will sanitize inputs for textareas and editor boxes,
 * it will strip all the invalid code and allow only
 * HTML elements in $allowedposttags list to format
 *
 * https://codex.wordpress.org/Function_Reference/wp_kses
 * */
function vivid_framework_sanitize_textarea_inputs( $input ) {
	global $allowedposttags;

	$output = wp_kses( $input, $allowedposttags );
	return $output;

}
add_filter( 'vivid_framework_sanitize_textarea',    'vivid_framework_sanitize_textarea_inputs' );
add_filter( 'vivid_framework_sanitize_editor',      'vivid_framework_sanitize_textarea_inputs' );


/*
 * This filter is same as text inputs filter, it will sanitize text fields
 * only difference is that this filter is applied for multiple text inputs
 * or repeatable fields, so each field checked in foreach loop
 * */
function vivid_framework_sanitize_repeatable_text_inputs( $input ) {

	$output = array();
	foreach($input as $key => $value ) {
		$output[$key] = sanitize_text_field( $value );
	}
	return $output;

}
add_filter( 'vivid_framework_sanitize_multiselect',     'vivid_framework_sanitize_repeatable_text_inputs' );
add_filter( 'vivid_framework_sanitize_select2multi',    'vivid_framework_sanitize_repeatable_text_inputs' );
add_filter( 'vivid_framework_sanitize_checkbox',        'vivid_framework_sanitize_repeatable_text_inputs' );
add_filter( 'vivid_framework_sanitize_selecter',        'vivid_framework_sanitize_repeatable_text_inputs' );
add_filter( 'vivid_framework_sanitize_toggle',          'vivid_framework_sanitize_repeatable_text_inputs' );
add_filter( 'vivid_framework_sanitize_repeatabletext',  'vivid_framework_sanitize_repeatable_text_inputs' );


/*
 * Since color hex code contains only letters from a-f and numbers
 * checking if input have correct letters and numbers
 * */
function vivid_framework_sanitize_color_inputs( $input ) {

	if( preg_match( '/^#[a-f0-9]{6}$/i', $input, $output ) ) {
		return $output[0];
	};
}
add_filter( 'vivid_framework_sanitize_colorpicker', 'vivid_framework_sanitize_color_inputs' );

/*
 * Check for correct date format. Only accepted date format
 * will be Y-m-d 2015-12-30 everything else will fail.
 * */
function vivid_framework_sanitize_date_inputs( $input ) {

	$date_from_format = date_create_from_format('Y-m-d', $input);
	if( $date_from_format == true) {
		$output = date_format($date_from_format, 'Y-m-d');

		return $output;
	};
}
add_filter( 'vivid_framework_sanitize_date', 'vivid_framework_sanitize_date_inputs' );

/*
 * This is for numeric inputs, for inputs like slider
 * where only numbers are accepted.
 * */
function vivid_framework_sanitize_numeric_inputs( $input ) {

	if( is_numeric($input) ) {
		return $input;
	}

}
add_filter( 'vivid_framework_sanitize_slider', 'vivid_framework_sanitize_numeric_inputs' );

/*
 * Check for correct image format for image upload inputs.
 * According to WordPress codex wp_check_filetype checks
 * for correct uploaded type.
 * $mimes is optional and can be changed to add or remove
 * accepted file types when needed.
 * */
function vivid_framework_sanitize_image_inputs( $input ) {

	/*
	 * Get allowed mime types according to
	 * https://codex.wordpress.org/Function_Reference/get_allowed_mime_types
	 * */
	$mimes = array(
				'jpg|jpeg|jpe'  => 'image/jpeg',
				'gif'           => 'image/gif',
				'png'           => 'image/png',
				'bmp'           => 'image/bmp',
				'tif|tiff'      => 'image/tiff',
				'ico'           => 'image/x-icon'
				);

	$filetype = wp_check_filetype( $input, $mimes );

	if ( $filetype['type'] != false ) {
		return $input;
	}

}
add_filter( 'vivid_framework_sanitize_upload', 'vivid_framework_sanitize_image_inputs' );