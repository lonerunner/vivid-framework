# Introduction
**Vivid Framework** is built as foundation to Vivid Themes for easier theme management and configuration. The framework it self is intended to help developing themes with ease and speed by incorporating extended funcionality for adding theme options, metaboxes and shortcodes easily by adding options to the array list. I have tried to keep the framework as light as possible and as much as possible to follow coding standards according to WordPress codex.


# Supported fields
- **text**
- **textarea**
- **select**
- **multiselect**
- **select2**
- **select2multi**
- **radio**
- **checkbox**
- **selecter**
- **toggle**
- **editor**
- **colorpicker**
- **date**
- **slider**
- **upload**
- **repeatabletext**

# How to install
All files that you need for framework to work are inside **framework** folder. Just copy **framework** folder to your theme folder and include `/framework/bootstrap.php` file in your theme `functions.php` file

You can put this at the very top in `functions.php`

```
/*
 * Path to the framework and load framework initial file
 * */
require_once( get_template_directory() . '/framework/bootstrap.php' );
```

### Setup theme options
To create theme options you need to have global variable named exactly `$theme_options`, otherwise you won't see options page. You can set the variable anywhere you want as long as it's globally accessible. My recommendation is to have it in your theme `functions.php` file. The variable should contain an array of all of the options you want to set to your theme. Below is the list of all the options you can set

###### Tabs
If you are adding tabs to theme options, you can use tab-open and tab-close to define tabs between option fields. Any input fields like textarea, select, checkbox must be between `tab-open` and `tab-close` array.

```
// This opens new tab
array(
    'title' => 'General', // Required for tab title
    'name'  => 'general', // Required for tab id, must be without spaces and special characters
    'type'  => 'tab-open' // Required and it is always the same 'tab-open'
),

// Simple text input field
'basic_text' => array(
    'title' => 'Text field',
    'desc'  => 'Description for the text field',
    'type'  => 'text',
    'std'   => 'Default value',
    'tip'   => 'Tooltip to show on hover',
    'class' => 'regular-text'
),

// Close the tab before opening new one
array(
    'type' => 'tab-close'
),
```

###### Sections
You can also add drag and drop sections which you can open and close. These sections are basically sortable boxes already implemented in WordPress. For sortable boxes is the same as for tabs, add array with type `section-open`, add array of any input fields, and close the section with array type `section-close`.

```
// This opens new section
array(
    'title' => 'Simple Text inputs',
    'type' => 'section-open'
),

// Simple text input field
'basic_text' => array(
    'title' => 'Text field',
    'desc'  => 'Description for the text field',
    'type'  => 'text',
    'std'   => 'Default value',
    'tip'   => 'Tooltip to show on hover',
    'class' => 'regular-text'
),

// Close the section
array(
    'type' => 'section-close'
),
```
You can add sections inside tabs, and tabs inside sections, but remember always to close section or tab before opening new one. Both sections and tabs don't need to have named array key, in opposite, all other input fields must have named array key.

###### Fields
All fields must have named array key, otherwise loop through an array will fail to fetch the fields and display them. Fields must be lowercase no spaces, no special characters and with unique name.

###### Text field
Display simple text field
```
// Simple text input field
'basic_text' => array(
    'title' => 'Text field title', // Required for title to display
    'desc'  => 'Description text', // Not required 
    'type'  => 'text', // Required and important
    'std'   => 'Some basic text', // Default value it can be anything you set or empty
    'tip'   => 'Some tool tip hover text', // Not required
    'class' => 'regular-text' // Input field class not required.
),
```

###### Textarea
Display textarea field
```
// Simple text input field
'basic_textarea' => array(
    'title' => 'Textarea with some description and tooltip',
    'desc'  => 'This is text area which contains description and tooltip with some text entered inside area field',
    'type'  => 'textarea',
    'std'   => 'Some text in this area field',
    'tip'   => 'Some tool tip hover text with small additional explanations',
),
```

###### Select
Display select box
```
// Single select box
'simple_selectbox' => array(
    'title'     => 'Select box',
    'desc'      => '',
    'type'      => 'select',
    // Options for dropdown select list
    'options'   => array(
                    'audi'      => 'Audi',
                    'bmw'       => 'BMW',
                    'mercedes'  => 'Mercedes',
                    'ford'      => 'Ford',
                    'opel'      => 'Opel'
                    ),
    // Default value, if empty or not set the select box will show 'Select an option' text
    'std'       => 'mercedes'
),
```

###### Multi Select
Display select box with multiple select options
```
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
    // In multi select box you can set an array of values for selected fields by default
    'std'       => array('bmw', 'ford')
),
```

###### Select 2
Select 2 is a good jQuery replacement for select boxes which brings few additional options
>Select2 gives you a customizable select box with support for searching, tagging, remote data sets, infinite scrolling, and many other highly used options. 

More about the plugin you can check on the link https://select2.github.io/

```
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
```

###### Multi Select 2
There is also an option to select multiple fields
```
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
```

###### Radio
Standard radio box field
```
'basic_radiobox' => array(
    'title'     => 'Radio box field',
    'desc'      => '',
    'type'      => 'radio',
    'options'   => array(
                'bmw'   => 'BMW',
                'audi'  => 'Audi',
                'opel'  => 'Opel'
                ),
    'std'       => 'bmw'
),
```

###### Checkbox
Standard checkbox field
```
'basic_checkbox' => array(
    'title'     => 'Check box field',
    'desc'      => 'This is check box fields',
    'type'      => 'checkbox',
    'options'   => array(
                'bmw'   => 'BMW',
                'audi'  => 'Audi',
                'opel'  => 'Opel'
                ),
    // Checkbox must have an array default value, even if it's a single checkbox
    'std'       => array('bmw')
),
```

###### Selecter
This plugin is part of Formstone collection, it's jQuery plugin for replacing default select box. Here it's intended to replace multiple select elements with nice select list.

More about the plugin you can check on the link https://formstone.it/components/dropdown/
```
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
```

###### Toggle
Toggle is another plugin from Formstone collection, it replaces checkboxes with nice toggle on or off funcionality.

More about the plugin you can check on the link https://formstone.it/components/checkbox/
```
'toggle' => array(
    'title'     => 'Toggle box',
    'desc'      => 'A checkbox with toggle on off option',
    'type'      => 'toggle',
    'options'   => array(
                    'bikes'     => 'Bikes',
                    'cars'      => 'Cars',
                    'trucks'    => 'Trucks',
                    'buses'     => 'Buses',
                    'planes'    => 'Planes'
                ),
    'std'       => array( 'trucks', 'planes' )
),
```

###### Editor
Displays WordPress native built in editor. 
```
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
```
Please keep in mind that inside `options` a `textarea_name` field must be according to option and field name in order for editor to save the content in database.

###### Color Picker
Uses WordPress built in color picker to select color for your option field
```
'basic_colorpicker' => array(
    'title'     => 'Color Picker',
    'desc'      => 'Color picker field',
    'type'      => 'colorpicker',
    'std'       => '#bada55' // Only hex values are acceptable
),
```

###### Date Picker
Implemented datepicker widget from jQuery UI
```
'basic_datepicker' => array(
    'title'     => 'Date picker',
    'desc'      => 'This is date picker field',
    'type'      => 'date',
    'std'       =>  date('Y-m-d') // Every date must be in format Y-m-d otherwise it won't validate
),
```

###### Slider
Slider is also one of widgets from jQuery UI. You can select vertical or horizontal slider with min or max value and stepping when you drag a slider.
```
'basic_slider' => array(
    'title'     => 'Ui Slider',
    'desc'      => 'Animated Range Slider',
    'type'      => 'slider',
    'orient'    => 'vertical', // Required 'vertical' or 'horizontal'
    'std'       => '37', 
    'range'     => 'min', // Required 'min' or 'max'
    'min'       => '1', // Required min value
    'max'       => '200', // Required max value
    'step'      => '1' // Required stepping of values
),
```

###### Upload
Using a built in WordPress media uploader for uploading and selecting images.
```
'upload' => array(
    'title' => 'Upload box',
    'desc'  => 'Built in media uploader for images',
    'type'  => 'upload',
    'std'   => ''
),
```

###### Repeatable Text
Thanks to Rhyzz jQuery plugin which is based on jQuery UI, repeatable fields are easy to make. For now i have made only repeatable text field, but you can make your own sets of repeatable fields easily.

More about the plugin you can check on the link http://www.rhyzz.com/repeatable-fields.html
```
'repeatable_text' => array(
    'title' => 'Repeatable fields',
    'desc'  => 'These are repeatable fields with sorting',
    'type'  => 'repeatabletext',
    'std'   => ''
),
```

### Setup Meta Boxes
To setup metaboxes is almost the same as setting up theme options. You need to have global variable named exactly `$theme_metabox`. The variable should be also an array with list of options. The difference here is that for metaboxes, you must set an array with metabox id and values, than inside `'options'` you set fields for metabox. You can add metabox to any post, page or custom field. And also if you have page templates and metabox is intended for only specific page template you can define that template in `'template'` field and metabox will show or hide when that specific template is selected or not.
```
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
```

### Shortcodes
For shortcodes i took a bit different approach. Because shortcodes are not always the same, and will vary from theme to theme, you will have to make your own shortcodes. Thus it is not that hard. But you will have to follow some coding standard.

For example making a shortcode named `heading`:

First inside `/framework/shortcodes/` folder you must create folder exactly the same name as your shortcode name `/framework/shortcodes/heading/` And inside the folder of your shortcode create initial `.php` file also the same name as your shortcode `heading.php`.

Inside your shortcode `.php` file you have to follow 2 function naming standards. One function is to register shortcode and other function is to create a form which will display your shortcode on the shortcode list.

```
function heading_function(){
    // shortcode code inside
}
add_shortcode( 'heading', 'heading_function' );
```
This will register your shortcode and return formated shortcode to front-end when shortcode is used in editor. What parameters and coding, will you use inside a function is up to your shortcode requirements.

```
function heading_form() {
    // input fields to display available options of shortcode in shortcode list in editor
}
```
This function is used in shortcode list when WordPress editor is active. Inside function you can create any input fields you want to display as an option to your shortcode. Input field must have name same as shortcode attribute.

For more how it looks please take a look at dropcap shortcode example.

And lastly, for shortcodes to work you must have global variable named exactly `$theme_shortcodes` with list of all shortcodes you use in the theme.

### Donate to the Development
If you find this framework useful or helped you in any way, i would appreciate any donations. Donations will help out with more free time for further development. 

[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YUEFT7E5JP8A2)

### Credits
- Thanks to https://codex.wordpress.org/ for extensive informations and documentation.
- https://select2.github.io/ for jQuery select and multiselect boxes
- https://formstone.it/components/dropdown/ for multiselect scroll box
- https://formstone.it/components/checkbox/ for toggle jQuery plugins
- http://www.rhyzz.com/repeatable-fields.html for repeatable fields
- My website http://onedesign.me
- Framework website http://vividthemes.com/framework

### ToDo List

- More flexible approach for shortcodes.
- Metaboxes for taxonomies. Now since WordPress 4.4 natively supports term meta, we can implement metaboxes to terms, categories, tags more easily without creating new fields to database.

### Changelog
##### v2.0
- Complete framework redesign, the old code is dropped completely.