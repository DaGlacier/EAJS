<?php
/**
 * Custom Layouts Main Class
 *
 * @package Neve Pro Addon
 */

namespace Neve_Pro\Modules\Custom_Layouts;

use Neve_Pro\Core\Abstract_Module;
use Neve_Pro\Modules\Custom_Layouts\Admin\Builders\Loader;
use Neve_Pro\Modules\Custom_Layouts\Admin\Layouts_Metabox;

/**
 * Class Module
 *
 * @package Neve_Pro\Modules\Custom_Layouts
 */
class Module extends Abstract_Module {

	/**
	 * Custom layouts posts map.
	 *
	 * @var array $post_map
	 */
	public static $post_map = array();

	/**
	 * Holds the base module namespace
	 * Used to load submodules.
	 *
	 * @var string $module_namespace
	 */
	private $module_namespace = 'Neve_Pro\Modules\Custom_Layouts';

	/**
	 * Define module properties.
	 *
	 * @access  public
	 * @return void
	 * @property string $this->slug        The slug of the module.
	 * @property string $this->name        The pretty name of the module.
	 * @property string $this->description The description of the module.
	 * @property string $this->order       Optional. The order of display for the module. Default 0.
	 * @property boolean $this->active      Optional. Default `false`. The state of the module by default.
	 *
	 * @version 1.0.0
	 */
	public function define_module_properties() {
		$this->slug          = 'custom_layouts';
		$this->name          = __( 'Custom Layouts', 'neve' );
		$this->description   = __( 'Easily create custom headers and footers as well as adding your own custom code or content in any of the hooks locations.', 'neve' );
		$this->documentation = array(
			'url'   => 'https://docs.themeisle.com/article/1062-custom-layouts-module',
			'label' => __( 'Learn more', 'neve' ),
		);
		$this->order         = 6;
	}

	/**
	 * Check if module should load.
	 *
	 * @return bool
	 */
	function should_load() {
		return $this->settings->is_module_active( 'custom_layouts' );
	}

	/**
	 * Run Custom Layouts module.
	 */
	function run_module() {
		$this->do_admin_actions();
		if ( $this->map_custom_layouts() === true ) {
			$this->do_public_actions();
		}
	}

	/**
	 * Do admin related actions.
	 */
	private function do_admin_actions() {
		$this->register_custom_post_type();
		$this->load_submodules();
		$this->run_hooks();

		return true;
	}

	/**
	 * Register Custom Layouts post type.
	 */
	private function register_custom_post_type() {

		$labels = array(
			'name'          => esc_html_x( 'Custom Layouts', 'advanced-hooks general name', 'neve-pro-addon' ),
			'singular_name' => esc_html_x( 'Custom Layout', 'advanced-hooks singular name', 'neve-pro-addon' ),
			'search_items'  => esc_html__( 'Search Custom Layouts', 'neve-pro-addon' ),
			'all_items'     => esc_html__( 'Custom Layouts', 'neve-pro-addon' ),
			'edit_item'     => esc_html__( 'Edit Custom Layout', 'neve-pro-addon' ),
			'view_item'     => esc_html__( 'View Custom Layout', 'neve-pro-addon' ),
			'add_new'       => esc_html__( 'Add New', 'neve-pro-addon' ),
			'update_item'   => esc_html__( 'Update Custom Layout', 'neve-pro-addon' ),
			'add_new_item'  => esc_html__( 'Add New', 'neve-pro-addon' ),
			'new_item_name' => esc_html__( 'New Custom Layout Name', 'neve-pro-addon' ),
		);

		$args = array(
			'labels'              => $labels,
			'show_in_menu'        => 'themes.php',
			'public'              => true,
			'show_ui'             => true,
			'query_var'           => true,
			'can_export'          => true,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => true,
			'show_in_rest'        => true,
			'supports'            => array( 'title', 'editor', 'elementor' ),
		);

		register_post_type( 'neve_custom_layouts', apply_filters( 'neve_custom_layouts_post_type_args', $args ) );
	}

	/**
	 * Load admin files.
	 */
	private function load_submodules() {
		$submodules = array(
			$this->module_namespace . '\Rest\Server',
			$this->module_namespace . '\Admin\Layouts_Metabox',
			$this->module_namespace . '\Admin\PHP_Editor_Admin',
			$this->module_namespace . '\Admin\View_Hooks',
		);

		foreach ( $submodules as $index => $mod ) {
			if ( class_exists( $mod ) ) {
				$mod_{$index} = new $mod;
				$mod_{$index}->init();
			}
		}
	}

	/**
	 * Add hooks and filters.
	 */
	private function run_hooks() {
		/**
		 * Allow custom layouts cpt to be edited with Beaver Builder.
		 */
		if ( class_exists( 'FLBuilderModel', false ) ) {
			add_filter( 'fl_builder_post_types', array( $this, 'beaver_compatibility' ), 10, 1 );
		}

		/**
		 * Add a custom template for Custom Layouts cpt preview.
		 */
		add_filter( 'single_template', array( $this, 'custom_layouts_single_template' ) );

		/**
		 * Enqueue admin scripts and styles.
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		/**
		 * Remove custom layouts transient.
		 */
		add_action( 'save_post', array( $this, 'remove_custom_layouts_transient' ) );

		/**
		 * Add support for Brizy.
		 */
		add_filter( 'brizy_supported_post_types', array( $this, 'register_brizy_support' ) );

		/** Drop page templates for custom layouts post type */
		add_filter( 'theme_neve_custom_layouts_templates', '__return_empty_array', PHP_INT_MAX );
	}

	/**
	 * Add support for brizy editor in custom layouts.
	 *
	 * @param array $post_types Brizy post types support.
	 *
	 * @return array
	 */
	public function register_brizy_support( $post_types ) {
		$post_types[] = 'neve_custom_layouts';
		return $post_types;
	}

	/**
	 * Map custom layouts.
	 *
	 * @return bool
	 */
	private function map_custom_layouts() {
		if ( $this->is_builder_preview() ) {
			return true;
		}
		$cache = get_transient( 'custom_layouts_posts_map' );
		if ( ! empty( $cache ) ) {
			self::$post_map = $cache;

			return true;
		}
		$query = new \WP_Query(
			array(
				'post_type'              => 'neve_custom_layouts',
				'posts_per_page'         => 100,
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
				'fields'                 => 'ids',
				'post_status'            => 'publish',
			)
		);
		if ( ! $query->have_posts() ) {
			return false;
		}
		foreach ( $query->posts as $pid ) {
			$layout   = get_post_meta( $pid, 'custom-layout-options-layout', true );
			$priority = get_post_meta( $pid, 'custom-layout-options-priority', true );
			if ( $layout === 'hooks' ) {
				$layout = get_post_meta( $pid, 'custom-layout-options-hook', true );
			}
			self::$post_map[ $layout ][ $pid ] = $priority;
		}
		set_transient( 'custom_layouts_posts_map', self::$post_map, DAY_IN_SECONDS );

		return true;
	}

	/**
	 * Check if is builder preview.
	 *
	 * @return bool
	 */
	private function is_builder_preview() {
		if ( array_key_exists( 'preview', $_GET ) && ! empty( $_GET['preview'] ) ) {
			return true;
		}

		if ( array_key_exists( 'elementor-preview', $_GET ) && ! empty( $_GET['elementor-preview'] ) ) {
			return true;
		}

		if ( array_key_exists( 'brizy-edit', $_GET ) && ! empty( $_GET['brizy-edit'] ) ) {
			return true;
		}

		if ( class_exists( 'FLBuilderModel', false ) ) {
			if ( \FLBuilderModel::is_builder_active() === true ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Load public files.
	 */
	private function do_public_actions() {
		if ( is_admin() ) {
			return false;
		}

		Loader::register( $this->module_namespace . '\Admin\Builders\\' );

		return true;
	}

	/**
	 * Remove custom layouts transient at post save.
	 *
	 * @param int $post_id Post id.
	 *
	 * @return bool
	 */
	function remove_custom_layouts_transient( $post_id ) {
		if ( wp_is_post_revision( $post_id ) ) {
			return false;
		}

		$post_type = get_post_type( $post_id );

		if ( 'neve_custom_layouts' !== $post_type ) {
			return false;
		}
		delete_transient( 'custom_layouts_posts_map' );

		return true;
	}

	/**
	 * Add Beaver Builder Compatibility
	 *
	 * @param array $value Post types.
	 *
	 * @return array
	 */
	public function beaver_compatibility( $value ) {
		$value[] = 'neve_custom_layouts';

		return $value;
	}

	/**
	 * Set path to neve_custom_layouts template.
	 *
	 * @param string $single Path to single.php .
	 *
	 * @return string
	 */
	public function custom_layouts_single_template( $single ) {
		global $post;
		if ( $post->post_type === 'neve_custom_layouts' && file_exists( plugin_dir_path( __FILE__ ) . 'admin/template.php' ) ) {
			return plugin_dir_path( __FILE__ ) . 'admin/template.php';
		}

		return $single;
	}

	/**
	 * Enqueue scripts.
	 */
	public function admin_enqueue_scripts() {
		global $pagenow;
		if ( ! in_array( $pagenow, array( 'post.php', 'post-new.php' ), true ) ) {
			return;
		}

		global $post;
		if ( $post !== null && $post->post_type !== 'neve_custom_layouts' ) {
			return;
		}

		if ( ! function_exists( 'wp_enqueue_code_editor' ) ) {
			return;
		}

		wp_enqueue_code_editor(
			array(
				'type'       => 'application/x-httpd-php',
				'codemirror' => array(
					'indentUnit' => 2,
					'tabSize'    => 2,
				),
			)
		);
		wp_enqueue_script( 'neve-pro-addon-custom-layout', NEVE_PRO_INCLUDES_URL . 'modules/custom_layouts/assets/js/script.js', array(), NEVE_PRO_VERSION );
		wp_localize_script(
			'neve-pro-addon-custom-layout',
			'neveCustomLayouts',
			array(
				'customEditorEndpoint' => rest_url( '/wp/v2/neve_custom_layouts/' . $post->ID ),
				'nonce'                => wp_create_nonce( 'wp_rest' ),
				'phpError'             => esc_html__( 'There are some errors in your PHP code. Please fix them before saving the code.', 'neve-pro-addon' ),
				'magicTags'            => Layouts_Metabox::$magic_tags,
				'strings'              => array(
					'magicTagsDescription' => esc_html__( 'You can add the following tags in your template:', 'neve' ),
				),
			)
		);

		$this->rtl_enqueue_style( 'neve-pro-addon-custom-layouts', NEVE_PRO_INCLUDES_URL . 'modules/custom_layouts/assets/admin_style.min.css', array(), NEVE_PRO_VERSION );

	}
}
