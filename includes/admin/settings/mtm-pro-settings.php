<?php
/**
 * Settings Page
 *
 * @package Maintenance Mode with Timer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div class="wrap mtm-settings">

	<h2><?php esc_attr_e( 'Maintenanace Mode - Settings', 'maintenance-mode-with-timer' ); ?></h2>

	<?php
	// Messages
	if( ! empty( $_POST['mtm_reset_settings'] ) ) {

		// Reset message
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>' . esc_html__( 'All settings reset successfully.', 'maintenance-mode-with-timer') . '</strong></p>
			</div>';

	} elseif( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ) {

		// Success message
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.esc_html__( "Your changes saved successfully.", "maintenance-mode-with-timer" ).'</strong></p>
			</div>';

	}

	?>

	<!-- Plugin reset settings form -->
	<form action="" method="post" id="mtm-reset-sett-form" class="mtm-right mtm-reset-sett-form">
		<input type="submit" class="button button-primary mtm-confirm mtm-btn mtm-reset-sett mtm-resett-sett-btn mtm-reset-sett" name="mtm_reset_settings" id="mtm-reset-sett" value="<?php esc_html_e( 'Reset All Settings', 'maintenance-mode-with-timer' ); ?>" />
		<?php wp_nonce_field( 'mtm_reset_settings', 'mtm_reset_sett_nonce' ); ?>
	</form>

	<form action="options.php" method="POST" id="mtm-settings-form" class="mtm-settings-form">

		<?php settings_fields( 'mtm_plugin_options' ); ?>

		<div class="textright mtm-clearfix">
			<input type="submit" name="mtm_settings_submit" class="button button-primary right mtm-btn mtm-sett-submit mtm-sett-submit" value="<?php esc_attr_e('Save Changes','maintenance-mode-with-timer'); ?>" />
		</div>

		<!-- General Settings Starts -->
		<div id="mtm-general-sett" class="post-box-container mtm-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">
						<div class="postbox-header">
							<!-- Settings box title -->
							<h2 class="hndle">
								<span><?php esc_attr_e( 'General Settings', 'maintenance-mode-with-timer' ); ?></span>
							</h2>
						</div>
						<div class="inside" id="123">
						
							<table class="form-table mtm-general-sett-tbl">
								<tbody>
									<tr>
										<th>
											<label for="mtm-enable-maintenance"><?php esc_attr_e('Enable Maintenance Mode', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-enable-maintenance" type="checkbox" name="mtm_options[is_maintenance_mode]" value="1" <?php checked(mtm_get_option('is_maintenance_mode'),1); ?>/><br/>
											<span class="description"><?php esc_attr_e('Check this box to enable maintenance mode.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<th>
											<label for="mtm-web-logo"><?php esc_attr_e('Website Logo', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-web-logo" type="text" name="mtm_options[maintenance_mode_company_logo]" value="<?php echo esc_attr( mtm_get_option('maintenance_mode_company_logo') ); ?>" id="maintenance-mode-company-logo" class="regular-text mtm-default-img mtm-img-upload-input" />
											<input type="button" name="mtm_default_img" class="button-secondary mtm-img-uploader" value="<?php esc_attr_e( 'Upload Image', 'maintenance-mode-with-timer'); ?>" />
											<input type="button" name="mtm_default_img_clear" id="mtm-default-img-clear" class="button button-secondary mtm-image-clear" value="<?php esc_attr_e( 'Clear', 'maintenance-mode-with-timer'); ?>" /> <br />
											<span class="description"><?php esc_attr_e( 'Upload website logo.', 'maintenance-mode-with-timer' ); ?></span>
											<?php
												$maintenance_mode_company_logo = '';
												if( mtm_get_option('maintenance_mode_company_logo') ) { 
													$maintenance_mode_company_logo = '<img src="'.esc_url(mtm_get_option('maintenance_mode_company_logo')).'" alt="" />';
												}
											?>
											<div class="mtm-imgs-preview"><?php echo $maintenance_mode_company_logo; ?></div>
										</td>
									</tr>

									<tr>
										<th>
											<label for="mtm-logo-width"><?php esc_attr_e('Website Logo Width', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-logo-width" type="number" step="10" name="mtm_options[maintenance_mode_company_logo_width]" value="<?php echo esc_attr( mtm_get_option('maintenance_mode_company_logo_width') ); ?>"/> <?php esc_attr_e('Px', 'maintenance-mode-with-timer'); ?><br/>
											<span class="description"><?php esc_attr_e('Enter website logo width.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<th>
											<label for="mtm-title"><?php esc_attr_e('Maintenance Mode Title', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-title" type="text" name="mtm_options[maintenance_mode_title]" value="<?php echo esc_attr( mtm_get_option('maintenance_mode_title') ); ?>" class="large-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter maintenance mode title.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<th>
											<label for="maintenance-mode-text"><?php esc_attr_e('Enter Maintenance Mode Message', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<?php 
											$content 	= mtm_get_option('maintenance_mode_text');
											$editor_id 	= 'maintenance-mode-text';
											$settings 	= array(
																'media_buttons'	=> false,
																'textarea_rows'	=> 8,
																'textarea_name'	=> 'mtm_options[maintenance_mode_text]',
															);
											wp_editor($content, $editor_id, $settings); ?>
											<span class="description"><?php esc_attr_e('Enter maintenance mode message.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<td colspan="2">
											<input type="submit" id="mtm-settings-submit" name="mtm_settings_submit" class="button button-primary right" value="<?php esc_attr_e('Save Changes','maintenance-mode-with-timer'); ?>" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Timer Settings Starts -->
		<div id="mtm-general-sett" class="post-box-container mtm-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<div class="postbox-header">
							<!-- Settings box title -->
							<h2 class="hndle">
								<span><?php esc_attr_e( 'Timer Settings', 'maintenance-mode-with-timer' ); ?></span>
							</h2>
						</div>
						
						<div class="inside">
							
							<table class="form-table mtm-general-sett-tbl">
								<tbody>
									<tr>
										<th>
											<label for="mtm-countdown-time-date"><?php esc_attr_e('Expiry Date & Time', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<?php 	$date  = mtm_get_option('maintenance_mode_expire_time');
													$date  = ($date != '') ? $date : current_time('Y-m-d H:m:s'); ?>
											<input type="text" name="mtm_options[maintenance_mode_expire_time]" value="<?php echo esc_attr($date); ?>" class="regular-text mtm-countdown-time-date mtm-countdown-datepicker" id="mtm-countdown-time-date" /><br/>
											<span class="description"><?php esc_attr_e('Select timer expiry Date and Time.', 'maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<td colspan="2">
											<input type="submit" id="mtm-settings-submit" name="mtm_settings_submit" class="button button-primary right" value="<?php esc_attr_e('Save Changes','maintenance-mode-with-timer'); ?>" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Timer Settings Ends -->
		
		<!-- Socials Settings Starts -->
		<div id="mtm-general-sett" class="post-box-container mtm-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">
						
						<div class="postbox-header">
							<!-- Settings box title -->
							<h2 class="hndle">
								<span><?php esc_attr_e( 'Socials Settings', 'maintenance-mode-with-timer' ); ?></span>
							</h2>
						</div>

						<div class="inside">
						
							<table class="form-table mtm-general-sett-tbl">
								<tbody>
									<tr>
										<th>
											<label for="mtm-pro-fb"><?php esc_attr_e('Facebook', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-fb" type="text" name="mtm_options[mtm_facebook]" value="<?php echo esc_attr(mtm_get_option('mtm_facebook')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter facebook URl.','maintenance-mode-with-timer'); ?></span>
										</td>
										
										<th>
											<label for="mtm-pro-twitter"><?php esc_attr_e('Twitter', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-twitter" type="text" name="mtm_options[mtm_twitter]" value="<?php echo esc_attr(mtm_get_option('mtm_twitter')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter twitter URl.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<th>
											<label for="mtm-pro-linkedin"><?php esc_attr_e('Linkedin', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-linkedin" type="text" name="mtm_options[mtm_linkedin]" value="<?php echo esc_attr(mtm_get_option('mtm_linkedin')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter linkedin URl.','maintenance-mode-with-timer'); ?></span>
										</td>
								
										<th>
											<label for="mtm-pro-github"><?php esc_attr_e('Github', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-github" type="text" name="mtm_options[mtm_github]" value="<?php echo esc_attr(mtm_get_option('mtm_github')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter github URl.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<th>
											<label for="mtm-pro-yoututbe"><?php esc_attr_e('Youtube', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-yoututbe" type="text" name="mtm_options[mtm_youtube]" value="<?php echo esc_attr(mtm_get_option('mtm_youtube')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter github URl.','maintenance-mode-with-timer'); ?></span>
										</td>
									
										<th>
											<label for="mtm-pro-pinterest"><?php esc_attr_e('Pinterest', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-pinterest" type="text" name="mtm_options[mtm_pinterest]" value="<?php echo esc_attr(mtm_get_option('mtm_pinterest')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter pinterest URl.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<th>
											<label for="mtm-pro-insta"><?php esc_attr_e('Instagram', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-insta" type="text" name="mtm_options[mtm_instagram]" value="<?php echo esc_attr(mtm_get_option('mtm_instagram')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter instagram URl.','maintenance-mode-with-timer'); ?></span>
										</td>
									
										<th>
											<label for="mtm-pro-email"><?php esc_attr_e('Email', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-email" type="email" name="mtm_options[mtm_email]" value="<?php echo esc_attr(mtm_get_option('mtm_email')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter Your Email Address.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>

									<tr>
										<th>
											<label for="mtm-pro-gplus"><?php esc_attr_e('Google+', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-gplus" type="text" name="mtm_options[mtm_google_plus]" value="<?php echo esc_attr(mtm_get_option('mtm_google_plus')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter google plus URl.','maintenance-mode-with-timer'); ?></span>
										</td>
									
										<th>
											<label for="mtm-pro-tubmlr"><?php esc_attr_e('Tumblr', 'maintenance-mode-with-timer'); ?></label>
										</th>
										<td>
											<input id="mtm-pro-tubmlr" type="text" name="mtm_options[mtm_tumblr]" value="<?php echo esc_attr(mtm_get_option('mtm_tumblr')); ?>" class="regular-text" /><br/>
											<span class="description"><?php esc_attr_e('Enter tumblr URL.','maintenance-mode-with-timer'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<input type="submit" id="mtm-settings-submit" name="mtm_settings_submit" class="button button-primary right" value="<?php esc_attr_e('Save Changes','maintenance-mode-with-timer'); ?>" />
										</td>
									</tr>
								</tbody>
						 	</table>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #mtm-general-sett -->
		<!-- Socials Settings Ends -->
	</form><!-- end .mtm-settings-form -->
</div><!-- end .mtm-settings -->