<?php
function popmake_plugin_action_links($links, $file) {
	if($file == plugin_basename(POPMAKE)) {
		$settings_page_url = admin_url('edit.php?post_type=popup&page=settings');
		$plugin_action_links = apply_filters('popmake_action_links', array(
			//'settings' => '<a href="'. $settings_page_url .'">'.__( 'Settings', 'popup-maker' ).'</a>',
			'extensions' => '<a href="https://wppopupmaker.com/extensions?utm_source=WP+Admin+Plugins+Page&utm_medium=Text+Link&utm_campaign=Extensions" target="_blank">'.__('Extensions', 'popup-maker' ).'</a>',
		));
		foreach($plugin_action_links  as $link) {
			array_unshift( $links, $link );
		}
	}
	return $links;
}
add_filter('plugin_action_links', 'popmake_plugin_action_links', 10, 2);


function popmake_admin_header() {
	if(popmake_is_admin_page()) {
		do_action('popmake_admin_header');
	}
}
add_action('admin_header', 'popmake_admin_header');



function popmake_admin_notice() {
	if(popmake_is_admin_page()) {
		$banner_v1 = get_user_meta( get_current_user_id(), '_popmake_dismiss_optin_newsletter_promo_banner_v1', true );
		$banner_v2 = get_user_meta( get_current_user_id(), '_popmake_dismiss_optin_newsletter_promo_banner_v2', true );
		$banner_v3 = get_user_meta( get_current_user_id(), '_popmake_dismiss_optin_newsletter_promo_banner_v3', true );

		if(!$banner_v2 && !$banner_v3) {?>
			<div class="popmake-optin popmake-newsletter-optin">
				<a href="https://wppopupmaker.com/newsletter-sign-up?utm_source=Popmake+WP+Admin&utm_medium=Notification+Banner&utm_campaign=Newsletter+Signup" target="_blank" class="newsletter-banner">
					<img src="<?php echo POPMAKE_URL; ?>/assets/images/admin/newsletter-banner_v3.png"/>
				</a>
				<a class="popmake-optin-dismiss" data-optin-name="newsletter_promo_banner_v3" data-optin-type="user"><?php _e( 'No Thanks', 'popup-maker' ); ?></a>
			</div><?php
		}
		do_action('popmake_admin_notice');
	}
}
add_action( 'admin_notices', 'popmake_admin_notice' );



function popmake_admin_footer() {
	if(popmake_is_admin_page()) {
		do_action('popmake_admin_footer');
	}
}
add_action('admin_print_footer_scripts', 'popmake_admin_footer', 1000);