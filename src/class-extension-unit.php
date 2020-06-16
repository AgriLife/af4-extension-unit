<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/AgriLife/af4-extension-unit/blob/master/src/class-extension-unit.php
 * @since      0.1.0
 * @package    af4-extension-unit
 * @subpackage af4-extension-unit/src
 */

/**
 * The core plugin class
 *
 * @since 0.1.0
 * @return void
 */
class Extension_Unit {

	/**
	 * File name
	 *
	 * @var file
	 */
	private static $file = __FILE__;

	/**
	 * Instance
	 *
	 * @var instance
	 */
	private static $instance;

	/**
	 * Initialize the class
	 *
	 * @since 0.1.0
	 * @return void
	 */
	private function __construct() {

		// Initialize.
		add_action( 'init', array( $this, 'init' ) );

		// Add Widgets.
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );

	}

	/**
	 * Initialize the various classes
	 *
	 * @since 0.1.0
	 * @return void
	 */
	public function init() {

		// Require classes.
		$this->require_classes();

	}

	/**
	 * Initialize the various classes
	 *
	 * @since 0.1.0
	 * @return void
	 */
	private function require_classes() {

		// Add assets.
		require_once EXUNAF4_DIR_PATH . '/src/class-assets.php';
		new \Extension_Unit\Assets();

		// Add Genesis hooks.
		require_once EXUNAF4_DIR_PATH . '/src/class-genesis.php';
		new \Extension_Unit\Genesis();

		// Move navigation menu below header.
		require_once EXUNAF4_DIR_PATH . '/src/class-movenavunderheader.php';
		new \Extension_Unit\MoveNavUnderHeader();

	}

	/**
	 * Register widgets
	 *
	 * @since 0.1.0
	 * @return void
	 */
	public function register_widgets() {

		require_once EXUNAF4_DIR_PATH . 'src/class-widget-af4-contact.php';
		register_widget( 'Widget_AF4_Contact' );

	}

	/**
	 * Autoloads any classes called within the theme
	 *
	 * @since 0.1.0
	 * @param string $classname The name of the class.
	 * @return void.
	 */
	public static function autoload( $classname ) {

		$filename = dirname( __FILE__ ) .
			DIRECTORY_SEPARATOR .
			str_replace( '_', DIRECTORY_SEPARATOR, $classname ) .
			'.php';

		if ( file_exists( $filename ) ) {
			require $filename;
		}

	}

	/**
	 * Return instance of class
	 *
	 * @since 0.1.0
	 * @return object.
	 */
	public static function get_instance() {

		return null === self::$instance ? new self() : self::$instance;

	}

}
