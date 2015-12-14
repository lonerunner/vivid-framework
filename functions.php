<?php
/*
 * Path to the framework and load framework initial file
 * */
require_once( get_template_directory() . '/framework/bootstrap.php' );

/*
 * All available options for the theme, metaboxes and shortcodes
 * You can put this anywhere you want as long as it's accessible
 * to the framework functions.
 * */
$theme_options = array (

	// This opens new tab
	array(
		'title' => 'General',
		'name'  => 'general',
		'type'  => 'tab-open'
	),
		// This opens new section
		array(
			'title' => 'Simple Text inputs',
			'type' => 'section-open'
		),

			'repeatable_text' => array(
				'title' => 'Repeatable fields',
				'desc'  => 'These are repeatable fields with sorting',
				'type'  => 'repeatabletext',
				'std'   => ''
			),

			'upload' => array(
				'title' => 'Upload',
				'desc'  => 'upload',
				'type'  => 'upload',
				'std'   => ''
			),

			'second_upload' => array(
				'title' => 'Another Upload',
				'desc'  => 'upload',
				'type'  => 'upload',
				'std'   => ''
			),


			'basic_slider' => array(
				'title'     => 'Ui Slider min to max',
				'desc'      => 'Animated Range Slider with min slide and vertical align',
				'type'      => 'slider',
				'tip'       => 'Tool tip for the slider',
				'orient'    => 'vertical',
				'std'       => '37',
				'range'     => 'min',
				'min'       => '1',
				'max'       => '200',
				'step'      => '1'
			),

			'basic_slider_max' => array(
				'title'     => 'Ui slider max to min',
				'desc'      => 'Animated range slider with max to min slide',
				'type'      => 'slider',
				'orient'    => 'horizontal',
				'std'       => '156',
				'range'     => 'max',
				'min'       => '100',
				'max'       => '500',
				'step'      => '20',
			),

			'basic_datepicker' => array(
				'title'     => 'Date picker',
				'desc'      => 'This is date picker field',
				'type'      => 'date',
				'std'       =>  date('Y-m-d') // Every date must be in format Y-m-d otherwise it won't validate
			),

			'basic_colorpicker' => array(
				'title'     => 'Color Picker',
				'desc'      => 'Color picker field',
				'type'      => 'colorpicker',
				'std'       => '#bada55'
			),

			'second_basic_colorpicker' => array(
				'title'     => 'Another color Picker',
				'desc'      => 'Color picker field',
				'type'      => 'colorpicker',
				'std'       => '#323500'
			),

			'basic_editor' => array(
				'title'     => 'Editor field',
				'desc'      => 'This is editor field',
				'type'      => 'editor',
				'options'   => array(
								'wpautop' => true,
								'media_buttons' => true,
								'textarea_name' => THEME_BASE_NAME . '_options[basic_editor]', // We must make workaround here to pass the correct name to text editor for array to save in options
								'textarea_rows' => 6,
							), // For full list of options check http://codex.wordpress.org/Function_Reference/wp_editor
				'std'       => 'This is some text inside editor field', // Content inside editor, this is wp_editor($content) but since all option fields are 'std' this will use content variable for editor
				'tip'       => 'Some tool tip hover text'
			),


			'toggle' => array(
				'title'     => 'Toggle box',
				'desc'      => 'A checkbox with toggle on off option',
				'type'      => 'toggle',
				'options'   => array(
								'bikes'     => 'Bikes',
								'cars'      => 'Cars',
								'trucks'    => 'Trucks',
								'busses'    => 'Busses',
								'planes'    => 'Planes'
							),
				'std'       => array( 'trucks', 'planes' )
			),


			'selecter' => array(
				'title'     => 'Dropdown selecter with scroll',
				'desc'      => 'Selecter will display multi select options in nice style',
				'type'      => 'selecter',
				'options'   => array(
							'bmw'       => 'BMW',
							'audi'      => 'Audi',
							'opel'      => 'Opel',
							'mercedes'  => 'Mercedes',
							'ford'      => 'Ford',
							'mazda'     => 'Mazda',
							'kia'       => 'Kia',
							'zastava'   => 'Zastava',
							'fiat'      => 'Fiat',
							'renault'   => 'Renault'
							),
				'std'       => array( 'bmw', 'audi', 'mazda' )
			),

			'basic_checkbox' => array(
				'title'     => 'Check box field',
				'desc'      => 'This is check box fields',
				'type'      => 'checkbox',
				'options'   => array(
							'bmw'   => 'BMW',
							'audi'  => 'Audi',
							'opel'  => 'Opel'
							),
				'std'       => array('bmw')
			),

			'basic_radiobox' => array(
				'title'     => 'Radio box field',
				'desc'      => 'This is radio box fields',
				'type'      => 'radio',
				'options'   => array(
							'bmw'   => 'BMW',
							'audi'  => 'Audi',
							'opel'  => 'Opel'
							),
				'std'       => 'bmw'
			),


			// Simple text input field
			'basic_text' => array(
				'title' => 'Regular text with description and tooltip',
				'desc'  => 'Enter the link to your logo image',
				'type'  => 'text',
				'std'   => 'Some basic text',
				'tip'   => 'Some tool tip hover text',
				'class' => 'regular-text'
			),

			'small_text' => array(
				'title' => 'Small text field',
				'desc'  => '',
				'type'  => 'text',
				'std'   => '',
				'class' => 'small-text'
			),

			'large_text' => array(
				'title' => 'Large text field',
				'type'  => 'text',
				'std'   => '',
				'class' => 'large-text'
			),

			'all_options_text' => array(
				'title' => 'All Options Class',
				'type'  => 'text',
				'std'   => '',
				'class' => 'all-options'
			),

		// Close the section
		array(
			'type' => 'section-close'
		),


		// This opens new section
		array(
			'title' => 'Simple Text inputs',
			'type' => 'section-open'
		),

			// Simple text input field
			'basictextarea' => array(
				'title' => 'Textarea with some description and tooltip',
				'desc'  => 'This is text area which contains description and tooltip with some text entered inside area field',
				'type'  => 'textarea',
				'std'   => 'Some text in this area field',
				'tip'   => 'Some tool tip hover text with small additional explanations',
			),

			'basic_textarea_empty' => array(
				'title' => 'Textarea without description and tooltip',
				'type'  => 'textarea',
				'std'   => 'Some text in this area',
			),

			'large_textarea' => array(
				'title' => 'Large textarea field',
				'desc'  => 'This is text area which contains description and tooltip with some text entered inside area field',
				'type'  => 'textarea',
				'std'   => '',
				'class' => 'large-text',
				'tip'   => 'Some tool tip hover text with small additional explanations',
			),

			'all_options_textarea' => array(
				'title' => 'All Options Class',
				'type'  => 'textarea',
				'std'   => '',
				'class' => 'all-options'
			),

		// Close the section
		array(
			'type'  => 'section-close'
		),

		array(
			'title' => 'Select Boxes',
			'type'  => 'section-open'
		),

			'simple_selectbox' => array(
				'title'     => 'Select box',
				'desc'      => '',
				'type'      => 'select',
				'options'   => array(
								'audi'      => 'Audi',
								'bmw'       => 'BMW',
								'mercedes'  => 'Mercedes',
								'ford'      => 'Ford',
								'opel'      => 'Opel'
								),
				'std'       => 'mercedes'
			),

			'selectbox_novalue' => array(
				'title'     => 'Select box with no value set',
				'desc'      => 'This select box has no value selected',
				'type'      => 'select',
				'options'   => array(
								'audi'      => 'Audi',
								'bmw'       => 'BMW',
								'mercedes'  => 'Mercedes',
								'ford'      => 'Ford',
								'opel'      => 'Opel'
								),
				'std'       => ''
			),

			'multi_selectbox' => array(
				'title'     => 'Multi select box',
				'desc'      => '',
				'type'      => 'multiselect',
				'options'   => array(
								'audi'      => 'Audi',
								'bmw'       => 'BMW',
								'mercedes'  => 'Mercedes',
								'ford'      => 'Ford',
								'opel'      => 'Opel'
								),
				'std'       => array('bmw', 'ford')
			),

			'select2box' => array(
				'title'     => 'Select field with select2 plugin',
				'desc'      => '',
				'type'      => 'select2',
				'options'   => array(
								'audi'      => 'Audi',
								'bmw'       => 'BMW',
								'mercedes'  => 'Mercedes',
								'ford'      => 'Ford',
								'opel'      => 'Opel'
								),
				'std'       => 'bmw'
			),

			'another_select2box' => array(
				'title'     => 'Another select field with select2',
				'desc'      => '',
				'type'      => 'select2multi',
				'options'   => array(
					'audi'      => 'Audi',
					'bmw'       => 'BMW',
					'mercedes'  => 'Mercedes',
					'ford'      => 'Ford',
					'opel'      => 'Opel'
				),
				'std'       => array('bmw', 'ford')
			),

		array(
			'type'  => 'section-close'
		),

	// Close the tab before opening new one
	array(
		'type' => 'tab-close'
	),

);
$theme_metabox = array(

	// The id of the metabox is named key of array
	'metabox_one' => array(
		'title'     => 'Metabox one', // Correspond to metabox title
		'screen'    => array( 'post', 'page' ), // Correspond to metabox screen option, it can be post, page, or custom post type
		'location'  => 'normal', // Possition of the metabox, correspond to context option, normal, advanced or side position.
		'template'  => 'page-galleries.php', // If metabox is only intended for specific page template load it here.
		'options'   => array(
			'basic_slider_max' => array(
				'title'     => 'Ui slider max to min',
				'desc'      => 'Animated range slider with max to min slide',
				'type'      => 'slider',
				'orient'    => 'horizontal',
				'std'       => '156',
				'range'     => 'max',
				'min'       => '100',
				'max'       => '500',
				'step'      => '20',
			),

			'basic_datepicker' => array(
				'title'     => 'Date picker',
				'desc'      => 'This is date picker field',
				'type'      => 'date',
				'std'       =>  date('Y-m-d') // Every date must be in format Y-m-d otherwise it won't validate
			),

			'basic_colorpicker' => array(
				'title'     => 'Color Picker',
				'desc'      => 'Color picker field',
				'type'      => 'colorpicker',
				'std'       => '#bada55'
			)
		)
	),

	'metabox_second' => array(
		'title'     => 'Second metabox',
		'screen'    => array( 'post', 'page' ),
		'location'  => 'normal',
		'template'  => 'page-portfolio.php', // If metabox is only intended for specific page template load it here.
		'options'   => array(
			'basic_editor' => array(
				'title'     => 'Editor field',
				'desc'      => 'This is editor field',
				'type'      => 'editor',
				'options'   => array(
					'wpautop' => true,
					'media_buttons' => true,
					'textarea_name' => THEME_BASE_NAME . '_options[basic_editor]', // We must make workaround here to pass the correct name to text editor for array to save in options
					'textarea_rows' => 6,
				), // For full list of options check http://codex.wordpress.org/Function_Reference/wp_editor
				'std'       => 'This is some text inside editor field', // Content inside editor, this is wp_editor($content) but since all option fields are 'std' this will use content variable for editor
				'tip'       => 'Some tool tip hover text'
			),

			'toggle' => array(
				'title'     => 'Toggle box',
				'desc'      => 'A checkbox with toggle on off option',
				'type'      => 'toggle',
				'options'   => array(
					'bikes'     => 'Bikes',
					'cars'      => 'Cars',
					'trucks'    => 'Trucks',
					'busses'    => 'Busses',
					'planes'    => 'Planes'
				),
				'std'       => array( 'trucks', 'planes' )
			),

			'selecter' => array(
				'title'     => 'Dropdown selecter with scroll',
				'desc'      => 'Selecter will display multi select options in nice style',
				'type'      => 'selecter',
				'options'   => array(
					'bmw'       => 'BMW',
					'audi'      => 'Audi',
					'opel'      => 'Opel',
					'mercedes'  => 'Mercedes',
					'ford'      => 'Ford',
					'mazda'     => 'Mazda',
					'kia'       => 'Kia',
					'zastava'   => 'Zastava',
					'fiat'      => 'Fiat',
					'renault'   => 'Renault'
				),
				'std'       => array( 'bmw', 'audi', 'mazda' )
			),

			'basic_checkbox' => array(
				'title'     => 'Check box field',
				'desc'      => 'This is check box fields',
				'type'      => 'checkbox',
				'options'   => array(
					'bmw'   => 'BMW',
					'audi'  => 'Audi',
					'opel'  => 'Opel'
				),
				'std'       => array('bmw')
			)
		)
	)
);
$theme_shortcodes = array(
	'dropcap'   => 'Dropcap',
	'leading'   => 'Leading text'
);

