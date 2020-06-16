<?php
/**
 * Extension Unit - AgriFlex4
 *
 * @package      af4-extension-unit
 * @author       Zachary Watkins
 * @copyright    2020 Texas A&M AgriLife Communications
 * @license      GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:  Extension Unit - AgriFlex4
 * Plugin URI:   https://github.com/AgriLife/af4-extension-unit
 * Description:  A plugin for Extension Unit websites on the AgriFlex4 theme.
 * Version:      0.1.0
 * Author:       Zachary Watkins
 * Author URI:   https://github.com/ZachWatkins
 * Author Email: zachary.watkins@ag.tamu.edu
 * Text Domain:  af4-extension-unit
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
 */

/* Define some useful constants */
define( 'EXUNAF4_DIRNAME', 'af4-extension-unit' );
define( 'EXUNAF4_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'EXUNAF4_DIR_FILE', __FILE__ );
define( 'EXUNAF4_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'EXUNAF4_TEXTDOMAIN', 'af4-extension-unit' );
define( 'EXUNAF4_TEMPLATE_PATH', EXUNAF4_DIR_PATH . 'templates' );

/**
 * The core plugin class that is used to initialize the plugin
 */
require EXUNAF4_DIR_PATH . 'src/class-extension-unit.php';
spl_autoload_register( 'Extension_Unit::autoload' );
Extension_Unit::get_instance();

/* Activation hooks */
register_activation_hook( __FILE__, 'extensionunit_activation' );

/**
 * Helper option flag to indicate rewrite rules need flushing
 *
 * @since 0.1.0
 * @return void
 */
function extensionunit_activation() {

	// Check for missing dependencies.
	$theme = wp_get_theme();
	if ( 'AgriFlex4' !== $theme->name ) {
		$error = sprintf(
			/* translators: %s: URL for plugins dashboard page */
			__(
				'Plugin NOT activated: The <strong>Extension Unit - AgriFlex4</strong> plugin needs the <strong>AgriFlex4</strong> theme to be installed and activated first. <a href="%s">Back to plugins page</a>',
				'af4-extension-unit'
			),
			get_admin_url( null, '/plugins.php' )
		);
		wp_die( wp_kses_post( $error ) );
	}

}
