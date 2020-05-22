<?php
/**
 * Class that adds the metabox for Custom Layouts custom post type.
 *
 * @package Neve_Pro\Modules\Custom_Layouts\Admin
 */

namespace Neve_Pro\Modules\Custom_Layouts\Admin;

/**
 * Class Layouts_Metabox
 *
 * @package Neve_Pro\Modules\Custom_Layouts\Admin
 */
class Layouts_Metabox {

	/**
	 * Custom layouts location.
	 *
	 * @var array
	 */
	private $layouts;

	/**
	 * The theme hooks.
	 *
	 * @var array
	 */
	private $theme_hooks;

	/**
	 * Post types.
	 *
	 * @var array
	 */
	private $post_types;

	/**
	 * All the registered taxonomies.
	 *
	 * @var array
	 */
	private $all_taxonomies;

	/**
	 * User roles.
	 *
	 * @var array
	 */
	private $user_roles;

	/**
	 * Users.
	 *
	 * @var array
	 */
	private $users;

	/**
	 * Pages.
	 *
	 * @var array
	 */
	private $pages;

	/**
	 * Posts.
	 *
	 * @var array
	 */
	private $posts;

	/**
	 * Page templates.
	 *
	 * @var array
	 */
	private $page_templates;

	/**
	 * Archive types.
	 *
	 * @var array
	 */
	private $archive_types;

	/**
	 * User login status.
	 *
	 * @var array
	 */
	private $login_status;

	/**
	 * Root rules.
	 *
	 * @var array
	 */
	private $root_ruleset;

	/**
	 * End rules.
	 *
	 * @var array
	 */
	private $end_ruleset;

	/**
	 * Page types.
	 *
	 * @var array
	 */
	private $page_types;

	/**
	 * Ruleset map.
	 *
	 * @var array
	 */
	private $ruleset_map;

	/**
	 * Conditional logic value.
	 *
	 * @var string
	 */
	private $conditional_logic_value;

	/**
	 * Availabele dynamic tags ma[.
	 *
	 * @var array
	 */
	public static $magic_tags = array(
		'archive_taxonomy' => array(
			'category' => array( '{title}', '{description}' ),
			'post_tag' => array( '{title}', '{description}' ),
		),
		'archive_type'     => array(
			'author' => array( '{author}', '{author_description}', '{author_avatar}' ),
			'date'   => array( '{date}' ),
		),
	);

	/**
	 * Layouts_Metabox constructor.
	 */
	public function __construct() {
		require_once( get_template_directory() . '/globals/utilities.php' );
	}

	/**
	 * Setup class properties.
	 */
	public function setup_props() {
		$this->layouts = array(
			'header'    => __( 'Header', 'neve' ),
			'footer'    => __( 'Footer', 'neve' ),
			'hooks'     => __( 'Hooks', 'neve' ),
			'not_found' => __( '404 Page', 'neve' ),
		);

		if ( defined( 'PWA_VERSION' ) ) {
			$this->layouts['offline']      = __( 'Offline Page', 'neve' );
			$this->layouts['server_error'] = __( 'Internal Server Error Page', 'neve' );
		}

		$this->page_types     = array(
			'front_page' => __( 'Front Page', 'neve' ),
			'posts_page' => __( 'Posts Page', 'neve' ),
			'not_found'  => __( '404', 'neve' ),
		);
		$this->login_status   = array(
			'logged_in'  => __( 'Logged In', 'neve' ),
			'logged_out' => __( 'Logged Out', 'neve' ),
		);
		$this->theme_hooks    = neve_hooks();
		$this->post_types     = $this->get_post_types();
		$this->all_taxonomies = $this->get_all_taxonomies();
		$this->user_roles     = $this->get_user_roles();
		$this->users          = $this->get_users();
		$this->pages          = $this->get_page_post_list( 'page' );
		$this->posts          = $this->get_page_post_list();
		$this->page_templates = $this->get_templates();
		$this->archive_types  = $this->get_archive_types();

		$this->root_ruleset = array(
			'post'    => array(
				'label'   => __( 'Post', 'neve' ),
				'choices' => array(
					'post_type'     => __( 'Post Type', 'neve' ),
					'post_taxonomy' => __( 'Post Taxonomy', 'neve' ),
					'post_author'   => __( 'Post Author', 'neve' ),
					'post'          => __( 'Post', 'neve' ),
				),
			),
			'page'    => array(
				'label'   => __( 'Page', 'neve' ),
				'choices' => array(
					'page_type'     => __( 'Page Type', 'neve' ),
					'page_template' => __( 'Page Template', 'neve' ),
					'page'          => __( 'Page', 'neve' ),
				),
			),
			'archive' => array(
				'label'   => __( 'Archive', 'neve' ),
				'choices' => array(
					'archive_type'     => __( 'Archive Type', 'neve' ),
					'archive_taxonomy' => __( 'Archive Taxonomy', 'neve' ),
					'archive_term'     => __( 'Archive Term', 'neve' ),
					'archive_author'   => __( 'Archive Author', 'neve' ),
				),
			),
			'user'    => array(
				'label'   => __( 'User', 'neve' ),
				'choices' => array(
					'user_status' => __( 'User Status', 'neve' ),
					'user_role'   => __( 'User Role', 'neve' ),
					'user'        => __( 'User', 'neve' ),
				),
			),
		);

		$this->end_ruleset = array(
			'post_types'     => $this->post_types,
			'posts'          => $this->posts,
			'page_templates' => $this->page_templates,
			'pages'          => $this->pages,
			'page_type'      => $this->page_types,
			'terms'          => $this->all_taxonomies,
			'taxonomies'     => $this->all_taxonomies,
			'archive_types'  => $this->archive_types,
			'users'          => $this->users,
			'user_status'    => $this->login_status,
			'user_roles'     => $this->user_roles,
		);

		$this->ruleset_map = array(
			'post_types'     => array( 'post_type' ),
			'posts'          => array( 'post' ),
			'page_templates' => array( 'page_template' ),
			'pages'          => array( 'page' ),
			'page_type'      => array( 'page_type' ),
			'terms'          => array( 'post_taxonomy', 'archive_term' ),
			'taxonomies'     => array( 'archive_taxonomy' ),
			'archive_types'  => array( 'archive_type' ),
			'users'          => array( 'user', 'post_author', 'archive_author' ),
			'user_status'    => array( 'user_status' ),
			'user_roles'     => array( 'user_role' ),
		);
	}

	/**
	 * Get the post types.
	 *
	 * @return array
	 */
	private function get_post_types() {
		$post_types = array_filter(
			get_post_types( array( 'public' => true ) ),
			function ( $post_type ) {
				$excluded = array( 'attachment', 'neve_custom_layouts' );
				if ( in_array( $post_type, $excluded, true ) ) {
					return false;
				}

				return true;
			}
		);
		foreach ( $post_types as $post_type ) {
			$pt_object                = get_post_type_object( $post_type );
			$post_types[ $post_type ] = $pt_object->label;
		}

		return $post_types;
	}

	/**
	 * Get all the taxonomies.
	 *
	 * @return array
	 */
	private function get_all_taxonomies() {
		$taxonomies = array();
		foreach ( $this->post_types as $post_type => $label ) {
			$all_taxes = get_object_taxonomies( $post_type );
			foreach ( $all_taxes as $single_tax ) {
				$tax_obj   = get_taxonomy( $single_tax );
				$tax_terms = get_terms( array( 'taxonomy' => $single_tax ) );

				$taxonomies[ $post_type ][] = array(
					'nicename' => $tax_obj->label,
					'name'     => $tax_obj->name,
					'terms'    => $tax_terms,
				);
			}
		}

		return $taxonomies;
	}

	/**
	 * Get all user roles.
	 *
	 * @return array
	 */
	private function get_user_roles() {
		global $wp_roles;
		$roles              = $wp_roles->get_names();
		$user_roles_choices = array(
			'all' => esc_html__( 'All', 'neve' ),
		);
		foreach ( $roles as $role_slug => $role_name ) {
			$user_roles_choices[ $role_slug ] = $role_name;
		}

		return $user_roles_choices;
	}

	/**
	 * Get the site users.
	 *
	 * @return array
	 */
	private function get_users() {
		$users    = array();
		$wp_users = get_users();

		foreach ( $wp_users as $user_data ) {
			$users[ $user_data->ID ] = $user_data->display_name;
		}

		return $users;
	}

	/**
	 * Get the pages and posts.
	 *
	 * @param string $type [post/page].
	 *
	 * @return array
	 */
	private function get_page_post_list( $type = 'post' ) {
		if ( $type === 'post' ) {
			$posts = get_posts();
		}

		if ( $type === 'page' ) {
			$posts = array_filter(
				get_pages(),
				function ( $item ) {
					if ( (string) $item->ID === get_option( 'page_for_posts' ) ) {
						return false;
					}
					if ( (string) $item->ID === get_option( 'woocommerce_shop_page_id' ) ) {
						return false;
					}

					return true;
				}
			);
		}
		$post_list = array();

		if ( ! empty( $posts ) ) {
			foreach ( $posts as $post ) {
				$post_list[ $post->ID ] = $post->post_title;
			}
		}

		return $post_list;
	}

	/**
	 * Gets the page templates.
	 *
	 * @return array|null
	 */
	private function get_templates() {
		require_once ABSPATH . 'wp-admin/includes/theme.php';

		return array_flip( get_page_templates() );
	}

	/**
	 * Get available archive types.
	 *
	 * @return array
	 */
	private function get_archive_types() {
		$archive_types = array(
			'date'   => __( 'Date', 'neve' ),
			'author' => __( 'Author', 'neve' ),
			'search' => __( 'Search', 'neve' ),
		);

		return array_merge( $archive_types, $this->get_post_types() );
	}

	/**
	 * Initialize function.
	 */
	public function init() {
		if ( ! is_admin() ) {
			return;
		}

		add_action( 'init', array( $this, 'setup_props' ) );
		add_action( 'add_meta_boxes', array( $this, 'create_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_post_data' ) );
	}

	/**
	 * Create meta box.
	 */
	public function create_meta_box() {
		$post_type = get_post_type();
		if ( $post_type !== 'neve_custom_layouts' ) {
			return;
		}
		add_meta_box(
			'custom-layouts-settings',
			__( 'Custom Layout Settings', 'neve' ),
			array( $this, 'meta_box_markup' ),
			$post_type,
			'normal',
			'high'
		);
	}

	/**
	 * Save meta fields.
	 *
	 * @param int $post_id Post id.
	 */
	public function save_post_data( $post_id ) {
		$this->save_layout( $post_id, $_POST );
		$this->save_hook( $post_id, $_POST );
		$this->save_priority( $post_id, $_POST );
		$this->save_conditional_rules( $post_id, $_POST );
	}

	/**
	 * Save layout meta option.
	 *
	 * @param int   $post_id Post id.
	 * @param array $post Post array.
	 *
	 * @return bool
	 */
	private function save_layout( $post_id, $post ) {
		if ( ! array_key_exists( 'nv-custom-layout', $post ) ) {
			return false;
		}

		$choices = array( 'header', 'footer', 'hooks', 'not_found', 'offline', 'server_error' );
		if ( ! in_array( $post['nv-custom-layout'], $choices, true ) ) {
			return false;
		}
		update_post_meta(
			$post_id,
			'custom-layout-options-layout',
			$post['nv-custom-layout']
		);

		return true;
	}

	/**
	 * Save hook meta option.
	 *
	 * @param int   $post_id Post id.
	 * @param array $post Post array.
	 *
	 * @return bool
	 */
	private function save_hook( $post_id, $post ) {
		if ( ! array_key_exists( 'nv-custom-hook', $post ) ) {
			return false;
		}

		$hooks           = neve_hooks();
		$available_hooks = array();
		foreach ( $hooks as $list_of_hooks ) {
			$available_hooks = array_merge( $available_hooks, $list_of_hooks );
		}
		if ( ! in_array( $post['nv-custom-hook'], $available_hooks, true ) ) {
			return false;
		}

		update_post_meta(
			$post_id,
			'custom-layout-options-hook',
			$post['nv-custom-hook']
		);

		return true;
	}

	/**
	 * Save priority meta option.
	 *
	 * @param int   $post_id Post id.
	 * @param array $post Post array.
	 *
	 * @return bool
	 */
	private function save_priority( $post_id, $post ) {
		if ( ! array_key_exists( 'nv-custom-priority', $post ) ) {
			return false;
		}
		update_post_meta(
			$post_id,
			'custom-layout-options-priority',
			(int) $post['nv-custom-priority']
		);

		return true;
	}

	/**
	 * Save the conditional rules.
	 *
	 * @param int   $post_id post ID.
	 * @param array $post $_POST variables.
	 */
	private function save_conditional_rules( $post_id, $post ) {
		if ( empty( $post['custom-layout-conditional-logic'] ) ) {
			return;
		}
		update_post_meta(
			$post_id,
			'custom-layout-conditional-logic',
			$post['custom-layout-conditional-logic']
		);
	}

	/**
	 * Meta box HTML.
	 *
	 * @param \WP_Post $post Post.
	 */
	public function meta_box_markup( $post ) {
		$this->conditional_logic_value = $this->get_conditional_logic_value( $post );
		$layout                        = get_post_meta( $post->ID, 'custom-layout-options-layout', true );
		echo '<table class="nv-custom-layouts-settings">';
		echo '<tr>';
		echo '<td>';
		echo '<label>' . esc_html__( 'Layout', 'neve' ) . '</label>';
		echo '</td>';
		echo '<td>';
		echo '<select id="nv-custom-layout" name="nv-custom-layout">';
		echo '<option value="0">' . esc_html__( 'Select', 'neve' ) . '</option>';
		foreach ( $this->layouts as $layout_value => $layout_name ) {
			echo '<option ' . selected( $layout_value, $layout ) . ' value="' . esc_attr( $layout_value ) . '">' . esc_html( $layout_name ) . '</option>';
		}
		echo '</select>';
		echo '</td>';
		echo '</tr>';

		$hooks = neve_hooks();
		$hook  = get_post_meta( $post->ID, 'custom-layout-options-hook', true );
		$class = ( $layout !== 'hooks' ? 'hidden' : '' );
		if ( ! empty( $hooks ) ) {
			echo '<tr class="' . esc_attr( $class ) . '">';
			echo '<td>';
			echo '<label>' . esc_html__( 'Hooks', 'neve' ) . '</label>';
			echo '</td>';
			echo '<td>';
			echo '<select id="nv-custom-hook" name="nv-custom-hook">';
			foreach ( $hooks as $hook_cat_slug => $hook_cat ) {
				echo '<optgroup label="' . esc_html( ucwords( $hook_cat_slug ) ) . '">';
				foreach ( $hook_cat as $hook_value ) {
					$hook_label = View_Hooks::beautify_hook( $hook_value );
					echo '<option ' . selected( $hook_value, $hook ) . ' value="' . esc_attr( $hook_value ) . '">' . esc_html( $hook_label ) . '</option>';
				}
				echo '</optgroup>';
			}
			echo '</select>';
			echo '</td>';
			echo '</tr>';

			$priority = get_post_meta( $post->ID, 'custom-layout-options-priority', true );
			if ( empty( $priority ) && $priority !== 0 ) {
				$priority = 10;
			}
			echo '<tr class="' . esc_attr( $class ) . '">';
			echo '<td>';
			echo '<label>' . esc_html__( 'Priority', 'neve' ) . '</label>';
			echo '</td>';
			echo '<td>';
			echo '<input value="' . esc_attr( $priority ) . '" type="number" id="nv-custom-priority" name="nv-custom-priority" min="1" max="150" step="1"/>';
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';

		$this->render_conditional_logic_setup( $post );
		$this->render_rule_group_template();
		?>
		<input type="hidden" class="nv-conditional-meta-collector" name="custom-layout-conditional-logic" id="custom-layout-conditional-logic" value="<?php echo esc_attr( $this->conditional_logic_value ); ?>"/>
		<?php
	}

	/**
	 * Get the conditional logic meta value.
	 *
	 * @param \WP_Post $post the post object.
	 *
	 * @return mixed|string
	 */
	private function get_conditional_logic_value( $post ) {
		$value = get_post_meta( $post->ID, 'custom-layout-conditional-logic', true );

		if ( empty( $value ) ) {
			$value = '{}';
		}

		return $value;
	}

	/**
	 * Render the conditional logic.
	 */
	private function render_conditional_logic_setup( $post ) {
		$value  = json_decode( $this->conditional_logic_value, true );
		$layout = get_post_meta( $post->ID, 'custom-layout-options-layout', true );
		$class  = ( empty( $layout ) || $layout === 'not_found' || $layout === 'offline' || $layout === 'server_error' ? 'hidden' : '' );
		?>
		<div id="nv-conditional" class="<?php echo esc_attr( $class ); ?>">
			<div>
				<label><?php echo esc_html__( 'Conditional Logic', 'neve' ); ?></label>
				<p>
					<span class="dashicons dashicons-info"></span>
					<i>
					<?php echo esc_html__( 'If no conditional logic is selected, the Custom Layout will be applied site-wide.', 'neve' ); ?>
					</i>
				</p>
			</div>
			<div class="nv-rules-wrapper">
				<div class="nv-rule-groups">
					<?php
					if ( ! is_array( $value ) || empty( $value ) ) {
						$this->display_magic_tags();
						$this->render_rule_group();
					} else {
						$index = 0;
						foreach ( $value as $rule_group ) {
							$magic_tags = $this->get_magic_tags( $rule_group );
							$this->display_magic_tags( $magic_tags, $index );
							$this->render_rule_group( $rule_group );
							$index++;
						}
					}
					?>
				</div>
				<div class="rule-group-actions">
					<button class="button button-primary nv-add-rule-group"><?php esc_html_e( 'Add Rule Group', 'neve' ); ?></button>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Get magic tags based on current rules.
	 *
	 * @param array $rule_group Set of rules.
	 *
	 * @return array
	 */
	private function get_magic_tags( $rule_group ) {
		$all_magic_tags = array();
		foreach ( $rule_group as $rule ) {
			if ( $rule['condition'] !== '===' ) {
				return array();
			}

			if ( empty( $rule['root'] ) || empty( $rule['end'] ) ) {
				return array();
			}

			if ( ! array_key_exists( $rule['root'], self::$magic_tags ) ) {
				return array();
			}

			$end_array = self::$magic_tags[ $rule['root'] ];
			if ( ! array_key_exists( $rule['end'], $end_array ) ) {
				return array();
			}

			$all_magic_tags = array_merge( $all_magic_tags, $end_array[ $rule['end'] ] );
		}

		return $all_magic_tags;
	}

	/**
	 * Render rule group.
	 *
	 * @param array $rules The rules.
	 */
	private function render_rule_group( $rules = array() ) {
		if ( empty( $rules ) ) {
			$rules[] = array(
				'root'      => '',
				'condition' => '===',
				'end'       => '',
			);
		}
		?>
		<div class="nv-rule-group-wrap">
			<div class="nv-rule-group">
				<div class="nv-group-inner">
					<?php foreach ( $rules as $rule ) { ?>
						<div class="individual-rule">
							<div class="rule-wrap root_rule">
								<select class="nv-slim-select root-rule">
									<option value="" <?php echo $rule['root'] === '' ? 'selected' : ''; ?>><?php echo esc_html__( 'Select', 'neve' ); ?></option>
									<?php
									foreach ( $this->root_ruleset as $option_group_slug => $option_group ) {
										echo '<optgroup label="' . esc_attr( $option_group['label'] ) . '">';
										foreach ( $option_group['choices'] as $slug => $label ) {
											echo '<option value="' . esc_attr( $slug ) . '" ' . ( $slug === $rule['root'] ? 'selected' : '' ) . ' >' . esc_html( $label ) . '</option>';
										}
										echo '</optgroup>';
									}
									?>
								</select>
							</div>
							<div class="rule-wrap condition">
								<select class="nv-slim-select condition-rule">
									<option value="==="
										<?php echo esc_attr( $rule['condition'] === '===' ? 'selected' : '' ); ?>>
										<?php echo esc_html__( 'is equal to', 'neve' ); ?></option>
									<option value="!=="
										<?php echo esc_attr( $rule['condition'] === '!==' ? 'selected' : '' ); ?>>
										<?php echo esc_html__( 'is not equal to', 'neve' ); ?></option>
								</select>
							</div>
							<div class="rule-wrap end_rule">
								<?php
								foreach ( $this->end_ruleset as $ruleset_slug => $options ) {
									$this->render_end_option( $ruleset_slug, $options, $rule['end'], $rule['root'] );
								}
								?>
							</div>
							<div class="actions-wrap">
								<button class="remove action button button-secondary">
									<i class="dashicons dashicons-no"></i>
								</button>
								<button class="duplicate action button button-primary">
									<i class="dashicons dashicons-plus"></i>
								</button>
							</div>
							<span class="operator and"><?php esc_html_e( 'AND', 'neve' ); ?></span>
						</div>
					<?php } ?>
				</div>
				<div class="rule-group-actions">
					<button class="button button-secondary nv-remove-rule-group"><?php esc_html_e( 'Remove Rule Group', 'neve' ); ?></button>
				</div>
			</div>
			<span class="operator or"><?php esc_html_e( 'OR', 'neve' ); ?></span>
		</div>
		<?php
	}

	/**
	 * Display magic tags/
	 *
	 * @param array $magic_tags Array of magic tags.
	 *
	 * @return bool
	 */
	private function display_magic_tags( $magic_tags = '', $index = 0 ) {
		echo '<div class="nv-magic-tags" id="nv-magic-tags-group-' . $index . '">';
		if ( ! empty( $magic_tags ) ) {
			echo '<p>' . esc_html__( 'You can add the following tags in your template:', 'neve' ) . '</p>';
			echo '<ul class="nv-available-tags-list">';
			foreach ( $magic_tags as $magic_tag ) {
				echo '<li>' . $magic_tag . '</li>';
			}
			echo '</ul>';
		}
		echo '</div>';

		return true;
	}

	/**
	 * Render the end option.
	 *
	 * @param string $slug the ruleset slug.
	 * @param array  $args the ruleset options.
	 * @param string $end_val the ruleset end value.
	 * @param string $root_val the ruleset root value.
	 */
	private function render_end_option( $slug, $args, $end_val, $root_val ) {
		?>
		<div class="single-end-rule <?php echo esc_attr( join( ' ', $this->ruleset_map[ $slug ] ) ); ?>">
			<select name="<?php echo esc_attr( $slug ); ?>"
					class="nv-slim-select end-rule">
				<option value="" <?php echo esc_attr( $end_val === '' ? 'selected' : '' ); ?>><?php echo esc_html__( 'Select', 'neve' ); ?></option>
				<?php
				switch ( $slug ) {
					case 'terms':
						foreach ( $args as $post_type_slug => $taxonomies ) {
							foreach ( $taxonomies as $taxonomy ) {
								if ( ! is_array( $taxonomy['terms'] ) || empty( $taxonomy['terms'] ) ) {
									continue;
								}
								echo '<optgroup label="' . $taxonomy['nicename'] . ' (' . $post_type_slug . ' - ' . $taxonomy['name'] . ')">';
								foreach ( $taxonomy['terms'] as $term ) {
									if ( ! $term instanceof \WP_Term ) {
										continue;
									}
									echo '<option value="' . esc_attr( $taxonomy['name'] ) . '|' . esc_attr( $term->slug ) . '" ' . esc_attr( ( $taxonomy['name'] ) . '|' . esc_attr( $term->slug ) === $end_val ? 'selected' : '' ) . '>' . esc_html( $term->name ) . '</option>';
								}
							}
							echo '</optgroup>';
						}
						break;
					case 'taxonomies':
						foreach ( $args as $post_type_slug => $taxonomies ) {
							foreach ( $taxonomies as $taxonomy ) {
								if ( ! is_array( $taxonomy['terms'] ) || empty( $taxonomy['terms'] ) ) {
									continue;
								}
								echo '<option value="' . esc_attr( $taxonomy['name'] ) . '" ' . esc_attr( (string) $taxonomy['name'] === $end_val ? 'selected' : '' ) . '>' . $taxonomy['nicename'] . ' (' . $post_type_slug . ' - ' . $taxonomy['name'] . ')' . '</option>';
							}
						}
						break;
					default:
						foreach ( $args as $value => $label ) {
							echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( (string) $value === $end_val ? 'selected' : '' ) . '>' . esc_html( $label ) . '</option>';
						}
						break;
				}
				?>
			</select>
		</div>
		<?php
	}

	/**
	 * Render the rule group template.
	 */
	private function render_rule_group_template() {
		?>
		<div class="nv-rule-group-template">
			<?php $this->render_rule_group(); ?>
		</div>
		<?php
	}
}
