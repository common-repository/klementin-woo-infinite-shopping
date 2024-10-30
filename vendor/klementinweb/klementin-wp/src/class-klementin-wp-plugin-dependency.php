<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Klementin_wp_plugin_dependency {

	public function check_if_dependency_plugin_is_active( $this_plugin, $dependency_plugin, $error_text ) {
		add_action( 'admin_init', function () use ( $error_text, $this_plugin, $dependency_plugin ) {
			if ( is_admin() && current_user_can( 'activate_plugins' ) && ! is_plugin_active( $dependency_plugin ) ) {
				add_action( 'admin_notices', function () use ( $error_text, $this_plugin ) {
					?>
                    <div class="error"><p><?php echo esc_html($error_text); ?></p></div>
					<?php
				} );

				deactivate_plugins( $this_plugin );

				if ( isset( $_GET['activate'] ) ) {
					unset( $_GET['activate'] );
				}
			}
		} );
	}

}