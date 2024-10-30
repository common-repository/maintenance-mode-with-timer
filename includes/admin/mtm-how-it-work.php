<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Maintenance Mode with Timer
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Action to add menu
add_action('admin_menu', 'mtm_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @since 1.0.0
 */
function mtm_register_design_page() {
	add_submenu_page( 'mtm-settings', __('How it works - Maintenance Mode with Timer', 'maintenance-mode-with-timer'), __('How It Works', 'maintenance-mode-with-timer'), 'manage_options', 'mtm-how-it-work', 'mtm_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @since 1.0.0
 */
function mtm_designs_page() { ?>

	<div class="wrap wpcdt-wrap">

		<style type="text/css">
			.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
			.wpos-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
			.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
			.wpcdt-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
			.wpcdt-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
			.button-orange{background: #ff2700 !important;border-color: #ff2700 !important; font-weight: 600;}
		</style>
		<h2><?php esc_html_e('How it Works', 'maintenance-mode-with-timer'); ?></h2>
		<!-- <div class="post-box-container"> -->
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
			
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="meta-box-sortables">
						<div class="postbox">
							<div class="postbox-header">
								<h2 class="hndle">
									<span><?php esc_html_e( 'How It Works - Display and shortcode', 'maintenance-mode-with-timer' ); ?></span>
								</h2>
							</div>
							<div class="inside">
								<table class="form-table">
									<tbody>
										<tr>
											<th>
												<label><?php esc_html_e('Getting Started with Maintenance Mode -WPOS', 'maintenance-mode-with-timer'); ?>:</label>
											</th>
											<td>
												<ul>
													<li><?php esc_html_e('Step-1: This plugin creates a Maintenance Mode -WPOS tab in WordPress menu section', 'maintenance-mode-with-timer'); ?></li>
													<li><?php esc_html_e('Step-2: Go to Maintenance Mode -WPOS enable maintenance mode', 'maintenance-mode-with-timer'); ?></li>
													<li><?php esc_html_e('Step-3: you website in on maintenance mode now !!!', 'maintenance-mode-with-timer'); ?></li>
												</ul>
												<strong>NOTE: Maintenance Mode will be not seen to logged in users.</strong>
											</td>
										</tr>
									</tbody>
								</table>
							</div><!-- .inside -->
						</div><!-- #general -->
					</div><!-- .meta-box-sortables -->
				</div><!-- #post-body-content -->
				
				<!--Upgrad to Pro HTML -->
				<div id="postbox-container-1" class="postbox-container">
					
					<div class="meta-box-sortables">
						<div class="postbox wpos-pro-box">

							<h3 class="hndle">
								<span><?php esc_html_e( 'Upgrade to Pro Version', 'maintenance-mode-with-timer' ); ?></span>
							</h3>
							<div class="inside">
								<p>
								<ul>
									<li>5 attaractive template</li>
									<li>Circle Countdown Timer</li>
									<li>Flip Countdown Timer</li>
									<li>12+ Timer Design</li>
									<li>Custom CSS option</li>
									<li>Newsletter Subscription form Integration.</li>
									<li>Fully Responsive</li>
									<li>100% Multilanguage</li>
							 	</ul>
								</p> <br/>
								<a class="button button-primary wpos-button-full button-orange" href="https://www.essentialplugin.com/wordpress-plugin/maintenance-mode-pro/?utm_source=WP&utm_medium=Maintenance-Mode&utm_campaign=Check-Designs-Solutions" target="_blank"><?php esc_html_e('Grab Now', 'maintenance-mode-with-timer'); ?></a>
							</div><!-- .inside -->
						</div><!-- #general -->
					</div><!-- .meta-box-sortables -->

					<!-- Help to improve this plugin! -->
					<div class="meta-box-sortables">
						<div class="postbox">
								<h3 class="hndle">
									<span><?php esc_html_e( 'Help to improve this plugin!', 'maintenance-mode-with-timer' ); ?></span>
								</h3>
								<div class="inside">
									<p>Enjoyed this plugin? You can help by rate this plugin <a href="https://wordpress.org/support/plugin/maintenance-mode-with-timer/reviews/?filter=5" target="_blank">5 stars!</a></p>
								</div><!-- .inside -->
						</div><!-- #general -->
					</div><!-- .meta-box-sortables -->
				</div><!-- #post-container-1 -->

			</div><!-- #post-body -->
		</div><!-- #poststuff -->
		<!-- </div> --><!-- #post-box-container -->
	</div><!-- end .wpcdt-wrap -->
<?php }