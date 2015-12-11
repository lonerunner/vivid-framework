<?php
/*
 * Just in case let's prevent direct access to the files.
 * */
if ( ! defined( 'ABSPATH' ) ) die( 'Nope! Not gonna happen!' );

/*
 * Input fields to display to theme options or metaboxes
 * */
function vivid_framework_input_fields( $default_options, $saved_options, $field_name ) {
	foreach( $default_options as $key => $value ) {

		if( !empty( $saved_options ) ) {
			if ( array_key_exists( $key, $saved_options ) ) {
				$value['std'] = $saved_options[$key];
			}
		}

		if( $value['type'] == 'section-open' ) { ?>

			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">
					<div class="handlediv" title="Click to toggle"><br></div>
					<h3 class="hndle">
						<span><?php esc_attr_e( $value['title'], 'vivid-framework' ); ?></span>
					</h3>
					<div class="inside">

		<?php }

		elseif( $value['type'] == 'section-close' ) { ?>

					</div>
				</div>
			<div class="clear"></div>
			</div>

		<?php }

		elseif( $value['type'] == 'tab-open' ) { ?>

			<div id="tab-<?php echo $value['name'] ?>">

		<?php }

		elseif( $value['type'] == 'tab-close' ) { ?>

			</div>

		<?php }

		else { ?>

			<table class="form-table">
				<tr valign="top"><th scope="row"><?php esc_attr_e( $value['title'], 'vivid-framework' ) ?></th>
					<td class="vf-fields">

						<?php switch( $value['type'] ) {

							case 'text': ?>

								<input type="text" name="<?php echo $field_name ?>[<?php echo $key ?>]" value="<?php echo $value['std']; ?>" <?php if( !empty($value['class']) ) { ?> class="<?php echo $value['class'] ?>" <?php } ?> />

							<?php break;

							case 'textarea': ?>

								<textarea name="<?php echo $field_name ?>[<?php echo $key ?>]" <?php if( !empty($value['class']) ) { ?> class="<?php echo $value['class'] ?>" <?php } ?> rows="10" ><?php esc_attr_e( $value['std'], 'vivid-framework' ) ?></textarea>

							<?php break;

							case 'select': ?>

								<select name="<?php echo $field_name ?>[<?php echo $key ?>]" class="vf-select" >


									<option <?php if( empty($value['std']) ) { echo 'selected="selected"'; } ?> value=""><?php _e( 'Select an option', 'vivid-framework' ) ?></option>

									<?php foreach( $value['options'] as $val => $name ) { ?>
										<option <?php if ( $value['std']  == $val) { echo 'selected="selected"'; } ?> value="<?php echo $val ?>"><?php esc_attr_e( $name, 'vivid-framework' ) ?></option>
									<?php } ?>

								</select>

							<?php break;

							case 'multiselect': ?>

								<select name="<?php echo $field_name ?>[<?php echo $key ?>][]" class="vf-select" multiple>

									<?php foreach( $value['options'] as $val => $name ) { ?>
										<option <?php if ( in_array( $val,  $value['std'] ) ) { echo 'selected="selected"'; } ?> value="<?php echo $val ?>"><?php esc_attr_e( $name, 'vivid-framework' ) ?></option>
									<?php } ?>

								</select>

							<?php break;

							case 'select2': ?>


								<select name="<?php echo $field_name ?>[<?php echo $key ?>]" class="select2 vf-select" >

									<?php foreach( $value['options'] as $val => $name ) { ?>
										<option <?php if ( $value['std']  == $val) { echo 'selected="selected"'; } ?> value="<?php echo $val ?>"><?php esc_attr_e( $name, 'vivid-framework' ) ?></option>
									<?php } ?>

								</select>

							<?php break;

							case 'select2multi': ?>


								<select name="<?php echo $field_name ?>[<?php echo $key ?>][]" class="select2 vf-select" multiple>

									<?php foreach( $value['options'] as $val => $name ) { ?>
										<option <?php if ( in_array( $val,  $value['std'] ) ) { echo 'selected="selected"'; } ?> value="<?php echo $val ?>"><?php esc_attr_e( $name, 'vivid-framework' ) ?></option>
									<?php } ?>

								</select>

							<?php break;

							case 'radio': ?>

								<?php foreach( $value['options'] as $val => $name ) { ?>
									<input type="radio" name="<?php echo $field_name ?>[<?php echo $key ?>]" id="<?php echo $key . $val ?>" value="<?php echo $val ?>" <?php if ( $value['std']  == $val) { echo 'checked'; } ?>>
									<label for="<?php echo $key . $val ?>"><?php esc_attr_e( $name, 'vivid-framework' ) ?></label>
								<?php } ?>

							<?php break;

							case 'checkbox': ?>

								<?php foreach( $value['options'] as $val => $name ) { ?>
									<input type="checkbox" name="<?php echo $field_name ?>[<?php echo $key ?>][]" id="<?php echo $key . $val ?>" value="<?php echo $val ?>" <?php if ( in_array( $val,  $value['std'] ) ) { echo 'checked'; } ?>>
									<label for="<?php echo $key . $val ?>"><?php esc_attr_e( $name, 'vivid-framework' ) ?></label>
								<?php } ?>

							<?php break;

							case 'selecter': ?>
								<div class="vf-selecter">
									<select name="<?php echo $field_name ?>[<?php echo $key ?>][]" class="selecter vf-select" multiple>

										<?php foreach( $value['options'] as $val => $name ) { ?>
											<option <?php if ( in_array( $val,  $value['std'] ) ) { echo 'selected="selected"'; } ?> value="<?php echo $val ?>"><?php esc_attr_e( $name, 'vivid-framework' ) ?></option>
										<?php } ?>

									</select>
								</div>
							<?php break;

							case 'toggle': ?>

								<?php foreach( $value['options'] as $val => $name ) { ?>
									<input type="checkbox" name="<?php echo $field_name ?>[<?php echo $key ?>][]" id="<?php echo $val ?>" value="<?php echo $val ?>" class="togglebox" <?php if ( in_array( $val,  $value['std'] ) ) { echo 'checked'; } ?>>
									<label for="<?php echo $val ?>"><?php esc_attr_e( $name, 'vivid-framework' ) ?></label>
								<?php } ?>

							<?php break;

							case 'editor': ?>

								<?php wp_editor( $value['std'], $key, $value['options'] ); ?>

							<? break;

							case 'colorpicker': ?>

								<input type="text" name="<?php echo $field_name ?>[<?php echo $key ?>]" class='color-picker' value="<?php echo $value['std'] ?>" />

							<?php break;

							case 'date': ?>

								<input type="date" id="<?php echo $key ?>" name="<?php echo $field_name ?>[<?php echo $key ?>]" value="<?php echo $value['std'] ?>" class="date-picker" />

							<?php break;

							case 'slider': ?>

								<div class="vf-slider">
									<div class="vf-range-slider-<?php echo $key ?>"></div>
									<p>
										<input type="text" name="<?php echo $field_name ?>[<?php echo $key ?>]" class="vf-range-slider-value-<?php echo $key ?> small-text" value="<?php echo $value['std'] ?>" />
									</p>
								</div>

								<script>
									jQuery(document).ready(function($) {
										$( '.vf-range-slider-<?php echo $key ?>' ).slider({
											orientation: '<?php echo $value['orient'] ?>',
											range: '<?php echo $value['range'] ?>',
											min: <?php echo $value['min'] ?>,
											max: <?php echo $value['max'] ?>,
											value: <?php echo $value['std'] ?>,
											step: <?php echo $value['step'] ?>,
											slide: function(event, ui) {
												$( '.vf-range-slider-value-<?php echo $key ?>' ).val(ui.value);
											}
										});
										$( '.vf-range-slider-value-<?php echo $key ?>' ).val( $( '.vf-range-slider-<?php echo $key ?>' ).slider( 'value' ) );
									});
								</script>

							<?php break;

							case 'upload': ?>

								<div class="vf-upload">
									<div class="vf-img-holder">
										<?php if( !empty($value['std']) ) { ?>
											<img style="width:100%" src="<?php echo $value['std'] ?>">
										<?php } ?>
									</div>

									<a class="vf-add-media button <?php if( !empty($value['std']) ) { echo 'hidden'; } ?>" href="#">
										<?php esc_attr_e( 'Select image', 'vivid-framework' ) ?>
									</a>
									<a class="vf-del-media button <?php if( empty($value['std']) ) { echo 'hidden'; } ?>" href="#">
										<?php esc_attr_e( 'Remove image', 'vivid-framework' ) ?>
									</a>

									<input type="hidden" class="vf-img-id" id="<?php echo $key ?>" name="<?php echo $field_name ?>[<?php echo $key ?>]" value="<?php echo $value['std'] ?>" />
								</div>

							<?php break;

							case 'repeatabletext': ?>

							<div class="vf-repeatable-fields">
								<table class="vf-repeatable-wrapper">

									<tbody class="vf-repeatable-container">
									<tr class="vf-repeatable-template vf-repeatable-row">
										<td>
											<span class="vf-repeatable-move dashicons dashicons-sort"></span>
											<input type="text" name="<?php echo $field_name ?>[<?php echo $key ?>][vf-repeatable-input-placeholder]" />
											<span class="vf-repeatable-remove button">Remove</span>
										</td>
									</tr>

									<?php if( !empty($value['std']) ) {
										foreach( $value['std'] as $val ) { ?>

											<tr class="vf-repeatable-row">
												<td>
													<span class="vf-repeatable-move dashicons dashicons-sort"></span>
													<input type="text" name="<?php echo $field_name ?>[<?php echo $key ?>][]" value="<?php echo $val ?>" />
													<span class="vf-repeatable-remove button"><?php esc_attr_e( 'Remove', 'vivid-framework' ) ?></span>
												</td>
											</tr>

										<?php }
									} ?>

									</tbody>
									<tfoot>
									<tr>
										<td width="10%" colspan="4"><span class="vf-repeatable-add button"><?php esc_attr_e( 'Add New', 'vivid-framework') ?></span></td>
									</tr>
									</tfoot>
								</table>
							</div>

							<?php break;


						} ?>

						<?php if( !empty($value['desc']) ) { ?>

							<p class="vf-description">
								<span class="description"><?php esc_attr_e( $value['desc'], 'vivid-framework' ); ?></span>
							</p>

						<?php } ?>

						<?php if( !empty($value['tip']) ) { ?>

							<div class="vf-tooltip">
								<span class="dashicons dashicons-editor-help tooltip" title="<?php esc_attr_e( $value['tip'], 'vivid-framework') ?>"></span>
							</div>

						<?php } ?>
					</td>
				</tr>
			</table>
		<?php }
	}
}