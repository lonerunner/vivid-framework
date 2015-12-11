<?php
/*
 * Just in case let's prevent direct access to the files.
 * */
if ( ! defined( 'ABSPATH' ) ) die( 'Nope! Not gonna happen!' );

/*
 * Calls the class on the post edit screen.
 * */
function call_vivid_framework_metaboxClass() {
	global $theme_metabox;

	// Check to see if variable is set
	if( isset($theme_metabox) ) {
		foreach ( $theme_metabox as $key => $value ) {
				// Load a metabox class for each metabox list in array
				new vivid_framework_metaboxClass( $key, $value );
		}
	}
}

/*
 * Call the metabox function only if current user can edit posts and pages
 * */
if ( current_user_can( 'edit_posts' ) ) {
	add_action( 'load-post.php', 'call_vivid_framework_metaboxClass' );
	add_action( 'load-post-new.php', 'call_vivid_framework_metaboxClass' );
}

class vivid_framework_metaboxClass {

	public function __construct( $key, $value ) {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		$this->id = $key;
		$this->title = $value['title'];
		$this->screen = $value['screen'];
		$this->location = $value['location'];
		$this->fields = $value['options'];

		// And if metabox is selected for specific page template load a script to show or hide metabox field
		if( in_array( 'page', $value['screen'] ) && array_key_exists( 'template', $value ) ) {
			if( !empty( $value['template'] ) ) {
				$this->template = $value['template'];
				add_action( 'admin_print_footer_scripts', array( $this, 'add_meta_box_script') );
			}
		}
	}

	public function add_meta_box( $post_type ) {
		if ( in_array( $post_type, $this->screen )) {
			add_meta_box(
				$this->id,
				$this->title,
				array( $this, 'render_meta_box_content' ),
				$post_type,
				$this->location,
				'high'
			);
		}
	}

	public function render_meta_box_content( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( '_meta_box_nonce', '_meta_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$saved_options = get_post_meta( $post->ID, $this->id, true );

		// Display the form, using the current value.
		vivid_framework_input_fields( $this->fields, $saved_options, $this->id );

	}

	public function add_meta_box_script() { ?>
		<script type='text/javascript'>
             jQuery(document).ready(function($) {
	             $('#page_template').change(function() {
		             $('#<?php echo $this->id ?>').toggle($(this).val() == '<?php echo $this->template ?>');
	             }).change();
             });
		</script>
	<?php }

	public function save( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 * */

		// Check if our nonce is set.
		if ( ! isset( $_POST['_meta_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['_meta_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, '_meta_box_nonce' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
		// so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;

		} else {

		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		}

		// OK, its safe for us to save the data now.

		if ( in_array( get_post_type( $post_id ), $this->screen )) {
			// Sanitize the user input.
			$output = vivid_framework_validate_inputs( $_POST[ $this->id ], $this->fields );

			// Update the meta field.
			update_post_meta( $post_id, $this->id, $output );
		}
	}
}