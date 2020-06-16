<?php
/**
 * The file that defines css and js files loaded for the plugin
 *
 * A class definition that includes css and js files used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/AgriLife/af4-extension-unit/blob/master/src/class-assets.php
 * @since      0.1.0
 * @package    af4-extension-unit
 * @subpackage af4-extension-unit/src
 */

namespace Extension_Unit;

/**
 * Add assets
 *
 * @since 0.1.0
 */
class Assets {

	/**
	 * Initialize the class
	 *
	 * @since 0.1.0
	 * @return void
	 */
	public function __construct() {

		// Register global styles used in the theme.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ), 2 );

		// Enqueue extension styles.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 2 );

	}

	/**
	 * Registers all styles used within the plugin
	 *
	 * @since 0.1.0
	 * @return void
	 */
	public function register_styles() {

		global $wp_query;
		$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

		wp_register_style(
			'extensionunit-styles',
			EXUNAF4_DIR_URL . 'css/style.css',
			array( 'agriflex-default-styles' ),
			filemtime( EXUNAF4_DIR_PATH . 'css/style.css' ),
			'screen'
		);

		// If body class is page-template-default or post-template-default.
		if ( is_singular( 'post' ) || ( is_singular( 'page' ) && ( ! $template_name || 'default' === $template_name ) ) ) {

			wp_register_style(
				'extensionunit-default-template-styles',
				EXUNAF4_DIR_URL . 'css/template-default.css',
				array( 'extensionunit-styles' ),
				filemtime( EXUNAF4_DIR_PATH . 'css/template-default.css' ),
				'screen'
			);

		}

	}

	/**
	 * Enqueues extension styles
	 *
	 * @since 0.1.0
	 * @return void
	 */
	public function enqueue_styles() {

		global $wp_query;
		$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

		wp_enqueue_style( 'extensionunit-styles' );

		// If body class is page-template-default or post-template-default.
		if ( is_singular( 'post' ) || ( is_singular( 'page' ) && ( ! $template_name || 'default' === $template_name ) ) ) {

			wp_enqueue_style( 'extensionunit-default-template-styles' );

		}

	}

}
