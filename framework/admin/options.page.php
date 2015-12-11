<?php
/*
 * Just in case let's prevent direct access to the files.
 * */
if ( ! defined( 'ABSPATH' ) ) die( 'Nope! Not gonna happen!' );

/*
 * Theme Options display
 *
 * This is the function that is defined in admin_menu
 * it is called by add_menu_page and is required
 * to display theme options
 *
 * */
function vivid_framework_theme_options() {

    /*
     * Data required to pass to input fields
     * First get theme options
     * Second get saved options if there are any
     * And lastly set the options name for the fields
     * Field name should be unique to prevent
     * overwriting some other options
     * */
    global $theme_options;
    $saved_options = get_option( THEME_BASE_NAME . '_options' );
    $field_name = THEME_BASE_NAME . '_options';
    ?>
    <div class="wrap">
        <h2><?php esc_attr_e( THEME_NAME . ' Options', 'vivid-framework' ) ?></h2>

        <?php if( isset($_GET['settings-updated'])  == true ) { ?>
            <div id="message" class="updated">
                <p><strong><?php _e( 'Settings saved.', 'vivid-framework' ) ?></strong></p>
            </div>
        <?php } ?>

        <form method="post" action="options.php">

        <?php settings_fields( 'vivid_framework_theme_options' ); ?>

            <div id="tabs">
                <ul>
                    <? foreach( $theme_options as $value ) {
                        if( $value['type'] == 'tab-open' ) { ?>
                            <li><a href="#tab-<?php echo $value['name'] ?>"><?php esc_attr_e( $value['title'], 'vivid-framework') ?></a></li>
                        <?php }
                    } ?>
                </ul>
                <div id="post-body" class="metabox-holder">
                    <div id="post-body-content">
                        <?php vivid_framework_input_fields( $theme_options, $saved_options, $field_name ) ?>
                    </div>
                </div>
            </div>

            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'vivid-framework' ) ?>" />
            </p>
        </form>
    </div>

<?php

}

/*
 * This function is to validate framework options
 * */

function vivid_framework_sanitize_options( $input ) {
    global $theme_options;

    $output = vivid_framework_validate_inputs( $input, $theme_options );

    return $output;
}