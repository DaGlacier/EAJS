<?php
/**
 * Factory for loading the builders compatibility.
 *
 * @package Neve_Pro\Modules\Custom_Layouts\Admin\Builders
 */


namespace Neve_Pro\Modules\Custom_Layouts\Admin\Builders;

use Neve_Pro\Modules\Custom_Layouts\Module;

/**
 * Class Loader
 *
 * @package Neve_Pro\Modules\Custom_Layouts\Admin\Builders
 */
class Loader {
	/**
	 * Possible builders list.
	 *
	 * @var array List of them.
	 */
	public static $builders_list = [
		'Default_Editor',
		'Php_Editor',
		'Elementor',
		'Brizy',
		'Beaver',
	];
	/**
	 * List of possible builders.
	 *
	 * @var Abstract_Builders[] $available_builders List.
	 */
	private static $available_builders = [];
	/**
	 * Hooks map to check.
	 *
	 * @var array Hooks map.
	 */
	protected static $hooks_map = array(
		'neve_do_header'       => array(
			'hooks_to_deactivate' => array( 'neve_do_header', 'neve_do_top_bar' ),
			'posts_map_key'       => 'header',
		),
		'neve_do_footer'       => array(
			'hooks_to_deactivate' => array( 'neve_do_footer' ),
			'posts_map_key'       => 'footer',
		),
		'neve_do_404'          => array(
			'hooks_to_deactivate' => array( 'neve_do_404' ),
			'posts_map_key'       => 'not_found',
		),
		'neve_do_offline'      => array(
			'hooks_to_deactivate' => array( 'neve_do_offline' ),
			'posts_map_key'       => 'offline',
		),
		'neve_do_server_error' => array(
			'hooks_to_deactivate' => array( 'neve_do_server_error' ),
			'posts_map_key'       => 'server_error',
		),
	);

	/**
	 * Register actions and editors.
	 */
	public static function register( $namespace ) {
		if ( function_exists( 'do_blocks' ) ) {
			add_filter( 'neve_post_content', 'do_blocks' );
		}
		add_filter( 'neve_post_content', 'wptexturize' );
		add_filter( 'neve_post_content', 'convert_smilies' );
		add_filter( 'neve_post_content', 'convert_chars' );
		add_filter( 'neve_post_content', 'wpautop' );
		add_filter( 'neve_post_content', 'shortcode_unautop' );
		add_filter( 'neve_post_content', 'do_shortcode' );
		add_action( 'template_redirect', [ __CLASS__, 'render_single' ] );
		foreach ( self::$builders_list as $index => $builder ) {
			$builder = $namespace . $builder;
			$builder = new $builder;
			/**
			 * Builder instance.
			 *
			 * @var Abstract_Builders $builder Builder object.
			 */
			if ( ! $builder->should_load() ) {
				continue;
			}
			$builder->register_hooks();
			self::$available_builders[ $builder->get_builder_id() ] = $builder;
		}

		foreach ( Module::$post_map as $layout => $posts ) {
			switch ( $layout ) {
				case 'header':
					add_action( 'neve_do_header', array( __CLASS__, 'render_first_markup' ), 1 );
					break;
				case 'footer':
					add_action( 'neve_do_footer', array( __CLASS__, 'render_first_markup' ), 1 );
					break;
				case 'not_found':
					add_action( 'neve_do_404', array( __CLASS__, 'render_first_markup' ), 1 );
					break;
				case 'offline':
					add_action( 'neve_do_offline', array( __CLASS__, 'render_first_markup' ), 1 );
					break;
				case 'server_error':
					add_action( 'neve_do_server_error', array( __CLASS__, 'render_first_markup' ), 1 );
					break;
				default:
					add_action( $layout, array( __CLASS__, 'render_all_markup' ), 1 );
					break;
			}
		}

	}

	/**
	 * Render all custom layouts attached.
	 */
	public static function render_all_markup() {
		self::render_inline_markup( false );
	}

	/**
	 * Render first custom layouts attached.
	 */
	public static function render_first_markup() {
		self::render_inline_markup( true );
	}

	/**
	 * Render inline markup.
	 *
	 * @return bool Has rendered?
	 */
	public static function render_inline_markup( $single = true ) {
		// Remove rendering on custom layout.
		if ( is_singular( 'neve_custom_layouts' ) ) {
			return false;
		}
		$current_hook        = current_filter();
		$hooks_to_deactivate = isset( self::$hooks_map[ $current_hook ]['hooks_to_deactivate'] ) ? self::$hooks_map[ $current_hook ]['hooks_to_deactivate'] : [];
		$posts_map_key       = isset( self::$hooks_map[ $current_hook ]['posts_map_key'] ) ? self::$hooks_map[ $current_hook ]['posts_map_key'] : $current_hook;

		$posts = Module::$post_map[ $posts_map_key ];

		if ( empty( $posts ) ) {
			return false;
		}
		asort( $posts );
		foreach ( $posts as $post_id => $priority ) {
			$editor = Abstract_Builders::get_post_builder( $post_id );

			if ( ! isset( self::$available_builders[ $editor ] ) ) {
				continue;
			}

			if ( ! self::$available_builders[ $editor ]->check_conditions( $post_id ) ) {
				continue;
			}
			if ( $single ) {
				foreach ( $hooks_to_deactivate as $hook ) {
					remove_all_actions( $hook );
				}
			}
			self::$available_builders[ $editor ]->render( $post_id );

			if ( $single ) {
				return true;
			}
		}

		return true;
	}


	/**
	 * Footer markup on Custom Layouts preview.
	 */
	public function render_footer() {
		echo '<footer class="nv-custom-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter">';
		self::render_content();
		echo '</footer>';
	}


	/**
	 * This function handles the display on Custom Layouts preview, the single of Custom Layouts custom post type.
	 *
	 * @return bool
	 */
	public static function render_single() {
		if ( ! is_singular( 'neve_custom_layouts' ) ) {
			return false;
		}
		$post_id = get_the_ID();

		$layout = get_post_meta( $post_id, 'custom-layout-options-layout', true );
		switch ( $layout ) {
			case 'header':
				remove_all_actions( 'neve_do_header' );
				remove_all_actions( 'neve_do_top_bar' );
				add_action( 'neve_do_header', array( __CLASS__, 'render_header' ) );
				break;
			case 'footer':
				remove_all_actions( 'neve_do_footer' );
				add_action( 'neve_do_footer', array( __CLASS__, 'render_footer' ) );
				break;
			case 'offline':
			case 'server_error':
				remove_all_actions( 'neve_do_footer' );
				remove_all_actions( 'neve_do_header' );
				add_action( 'neve_custom_layouts_template_content', array( __CLASS__, 'render_content' ) );
				break;
			case 'not_found':
				add_action( 'neve_custom_layouts_template_content', array( __CLASS__, 'render_content' ) );
				break;
			default:
				remove_all_actions( 'neve_do_footer' );
				remove_all_actions( 'neve_do_header' );
				remove_all_actions( 'neve_do_top_bar' );
				remove_all_actions( 'neve_custom_layouts_template_content' );
				add_action( 'neve_custom_layouts_template_content', array( __CLASS__, 'render_content' ) );
				break;
		}

		return true;
	}


	/**
	 * Header markup on Custom Layouts preview.
	 */
	static function render_header() {
		echo '<header class="nv-custom-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">';
		self::render_content();
		echo '</header>';
	}

	/**
	 * Get the layout content.
	 */
	static public function render_content() {
		while ( have_posts() ) {
			the_post();
			$post_id = get_the_ID();
			$builder = Abstract_Builders::get_post_builder( $post_id );
			if ( $builder !== 'custom' ) {
				the_content();
				continue;
			}
			$file_name = get_post_meta( $post_id, 'neve_editor_content', true );
			if ( empty( $file_name ) ) {
				continue;
			}
			$wp_upload_dir = wp_upload_dir( null, false );
			$upload_dir    = $wp_upload_dir['basedir'] . '/neve-theme/';
			$file_path     = $upload_dir . $file_name . '.php';
			if ( file_exists( $file_path ) && is_readable( $file_path ) ) {
				include_once( $file_path );
			}
		}
	}

}
