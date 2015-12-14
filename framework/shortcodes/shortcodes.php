<?php
/*
 * Just in case let's prevent direct access to the files.
 * */
if ( ! defined( 'ABSPATH' ) ) die( 'Nope! Not gonna happen!' );

/*
 * Load the shortcodes function
 * Since shortcodes require front-end and back-end access we have to load this every time,
 * this will check if $theme_shortcodes variable exists and loop through the array and
 * try to load every registered shortcode in the array.
 * When adding new shortcode you have to always add it to the $theme_shortcodes list.
 * */
function vivid_framework_load_shortcodes() {
	global $theme_shortcodes;
	// Check if $theme_shortcodes variable is set
	if( isset($theme_shortcodes) ) {
		foreach( $theme_shortcodes as $key => $name ){
			/* Include shortcode file
			 * The code looks a bit confusing, but all it does is take a key name from array
			 * and load the shortcode with a properly named path and file
			 * example: /framework/shortcodes/dropcap/dropcap.php
			 */
			require_once( FRAMEWORK_PATH . '/shortcodes/' . $key . '/' . $key . '.php');
		}
		// Load shortcodes to the admin footer for the editor
		add_action( 'admin_footer', 'vivid_framework_shortcodes_selector' );
		// Add button to editor
		add_action( 'media_buttons', 'vivid_framework_media_shortcodes_button' );
	}
}
add_action('init', 'vivid_framework_load_shortcodes');

/*
 * If shortcodes exists and WordPress editor is loaded this
 * will display the shortcode button to the editor
 * */
function vivid_framework_media_shortcodes_button() { ?>
	<a href="#TB_inline?width=750&inlineId=vf-shortcodes" id="vf-shortcodes-button" class="button button-primary thickbox" title="Shortcode selector">Add shortcode</a>
<?php }


/*
 * If shortcodes exists and WordPress editor is loaded, we have to load thickbox and content inside
 * with some shortcode selector and options for each shortcode, and lastly jquery that will grab
 * those options on select and load shortcode into editor.
 * */
function vivid_framework_shortcodes_selector() {
	global $theme_shortcodes;
	add_thickbox(); ?>
	<div id="vf-shortcodes" style="display:none;">
		<div class="vf-shortcode-selector">
			<select class="vf-shortcodes-select">

				<option></option>
				<?php foreach( $theme_shortcodes as $key => $name ) { ?>
					<option value="<?php echo $key ?>"><?php echo $name ?></option>
				<?php } ?>

			</select>
		</div>

		<div class="vf-output-shortcodes">
			<?php foreach( $theme_shortcodes as $key => $name ) { ?>
				<div id="<?php echo $key ?>">
					<h2><?php echo $name ?></h2>
					<?php $form = $key . '_form';
					if(function_exists($form)) { ?>
						<p><?php $form(); ?></p>
					<?php }
					?>
					<a href="#" class="button-primary vf-submit-shortcode">Insert shortcode</a>
				</div>
			<?php } ?>
		</div>
	</div>
	<script>
		jQuery(document).ready(function($) {

			//Hide the forms until one is selected
			$(".vf-output-shortcodes").children().hide();

			//Name of the select that you will be watching for a change
			$(".vf-shortcodes-select").change(function() {
				if ($(this).val() !== '') {
					$("#" + $(this).val()).show().siblings().hide();
				}
				else {
					$(".vf-output-shortcodes").children().hide();
				}
			}).select2({
				placeholder: "Select shortcode from the list",
				allowClear: true
			});

			$('.vf-submit-shortcode').click(function(event) {
				event.preventDefault();
				var shortcodeName = $(this).closest('div').attr('id');
				var inputs = $('#' + shortcodeName).find(':input');
				var inputsVal = '[' + shortcodeName;

				inputs.each(function() {
					if($(this).attr('id') != 'content') {
						inputsVal += ' ' + $(this).attr('name') + '="' + $(this).val() + '"';
						console.log(inputsVal);
					}
				});

				inputs.each(function() {
					if($(this).attr('id') == 'content' ) {
						inputsVal += ']' + $(this).val() + '[/' + shortcodeName;
					}
				});

				inputsVal += ']';
				window.send_to_editor(inputsVal);
			});

		});

	</script>
<?php }
