<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://beneon.com
 * @since      1.0.0
 *
 * @package    Beneon
 * @subpackage Beneon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Beneon
 * @subpackage Beneon/admin
 * @author     beneon <info@beneon.com>
 */
class Beneon_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Beneon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Beneon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/beneon-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Beneon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Beneon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js', array( 'jquery' ), '4.0.13', true );

		wp_enqueue_script( 'beneon-admin-js', plugin_dir_url( __FILE__ ) . 'js/beneon-admin.js', array( 'jquery' ), '1.0', true );

		// wp_localize_script(
		// 'beneon-admin-js',
		// 'cmb2_l10',
		// array(
		// 'ajax_nonce' => wp_create_nonce( 'cmb2_ajax_nonce' ),
		// 'ajax_url'   => admin_url( 'admin-ajax.php' ),
		// )
		// );
	}

	/**
	 * Add admin menu element.
	 *
	 * @return void
	 */
	public function add_menu() {
		if ( class_exists( 'WooCommerce' ) ) {
			global $submenu, $menu;
			$icon = BENEON_URL . 'admin/images/beneon-dashicon.png';

			// Add the main menu.
			add_menu_page(
				'BeNeon',
				'BeNeon',
				'manage_product_terms',
				'beneon-dashboard',
				array( $this, 'get_dashboard' ),
				$icon,
				10
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Dashboard', 'beneon' ),
				__( 'Dashboard', 'beneon' ),
				'manage_product_terms',
				'beneon-dashboard',
				array( $this, 'get_dashboard' )
			);

			// Add submenus.
			add_submenu_page(
				'beneon-dashboard',
				__( 'Color Groups', 'beneon' ),
				__( 'Color Groups', 'beneon' ),
				'manage_product_terms',
				'edit.php?post_type=beneon-color',
				false
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Font Groups', 'beneon' ),
				__( 'Font Groups', 'beneon' ),
				'manage_product_terms',
				'edit.php?post_type=beneon-font',
				false
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Scenes', 'beneon' ),
				__( 'Scenes', 'beneon' ),
				'manage_product_terms',
				'edit.php?post_type=beneon-scene',
				false
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Neon Templates', 'beneon' ),
				__( 'Neon Templates', 'beneon' ),
				'manage_product_terms',
				'edit.php?post_type=beneon-template',
				false
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Request a Quote', 'beneon' ),
				__( 'Request a Quote', 'beneon' ),
				'manage_product_terms',
				'edit.php?post_type=beneon-quote',
				false
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Configuration', 'beneon' ),
				__( 'Configuration', 'beneon' ),
				'manage_product_terms',
				'edit.php?post_type=beneon-config',
				false
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Settings', 'beneon' ),
				__( 'Settings', 'beneon' ),
				'manage_product_terms',
				'beneon-settings',
				array( $this, 'get_settings_page' )
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Orders', 'beneon' ),
				__( 'Orders', 'beneon' ),
				'manage_product_terms',
				'edit.php?post_type=beneon-order',
				false
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Cart', 'beneon' ),
				__( 'Cart', 'beneon' ),
				'manage_product_terms',
				'beneon-cart',
				array( $this, 'get_left_cart_content' )
			);

			// External Links as submenus
			add_submenu_page(
				'beneon-dashboard',
				__( 'Support', 'beneon' ),
				__( 'Support', 'beneon' ),
				'manage_product_terms',
				'beneon-support',
				array( $this, 'redirect_support' )
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Documentation', 'beneon' ),
				__( 'Documentation', 'beneon' ),
				'manage_product_terms',
				'beneon-documentation',
				array( $this, 'redirect_documentation' )
			);

			add_submenu_page(
				'beneon-dashboard',
				__( 'Go Pro', 'beneon' ),
				__( 'Go Pro', 'beneon' ),
				'manage_product_terms',
				'beneon-go-pro',
				array( $this, 'redirect_go_pro' )
			);
		}
	}

	/**
	 * Redirection to support page.
	 *
	 * @return void
	 */
	public function redirect_support() {
		wp_redirect( 'https://blyd3d.com/support' );
		exit;
	}

	/**
	 * Redirection to documentations page.
	 *
	 * @return void
	 */
	public function redirect_documentation() {
		wp_redirect( 'https://docs.blyd3d.com/neonapp' );
		exit;
	}

	/**
	 * Redirection to register page.
	 *
	 * @return void
	 */
	public function redirect_go_pro() {
		wp_redirect( 'https://blyd3d.com/pro/register' );
		exit;
	}


	/**
	 * Register post type.
	 */
	public function register_post_type() {

		$args = array(
			'labels'              => 'label',
			'hierarchical'        => false,
			'description'         => '',
			'supports'            => array( 'title' ),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'query_var'           => false,
			'can_export'          => true,
		);

		// Colors Post type.

		$labels = array(
			'name'               => __( 'Color Group', 'beneon' ),
			'singular_name'      => __( 'Color Group', 'beneon' ),
			'add_new'            => __( 'New Color Group', 'beneon' ),
			'add_new_item'       => __( 'New Color Group', 'beneon' ),
			'edit_item'          => __( 'Edit Color Group', 'beneon' ),
			'new_item'           => __( 'New Color Group', 'beneon' ),
			'view_item'          => __( 'View Color Group', 'beneon' ),
			'not_found'          => __( 'No Color Group found', 'beneon' ),
			'not_found_in_trash' => __( 'No Color Group in the trash', 'beneon' ),
			'menu_name'          => __( 'Color Group', 'beneon' ),
			'all_items'          => __( 'Color Group', 'beneon' ),
		);

		$args['labels'] = $labels;

		register_post_type( 'beneon-color', $args );

		$labels = array(
			'name'               => __( 'Font Group', 'beneon' ),
			'singular_name'      => __( 'Font Group', 'beneon' ),
			'add_new'            => __( 'New Font Group', 'beneon' ),
			'add_new_item'       => __( 'New Font Group', 'beneon' ),
			'edit_item'          => __( 'Edit Font Group', 'beneon' ),
			'new_item'           => __( 'New Font Group', 'beneon' ),
			'view_item'          => __( 'View Font Group', 'beneon' ),
			'not_found'          => __( 'No Font Group found', 'beneon' ),
			'not_found_in_trash' => __( 'No Font Group in the trash', 'beneon' ),
			'menu_name'          => __( 'Font Group', 'beneon' ),
			'all_items'          => __( 'Font Group', 'beneon' ),
		);

		$args['labels'] = $labels;

		register_post_type( 'beneon-font', $args );

		$labels = array(
			'name'               => __( 'Scenes', 'beneon' ),
			'singular_name'      => __( 'Scenes', 'beneon' ),
			'add_new'            => __( 'New Scenes', 'beneon' ),
			'add_new_item'       => __( 'New Scenes', 'beneon' ),
			'edit_item'          => __( 'Edit Scenes', 'beneon' ),
			'new_item'           => __( 'New Scenes', 'beneon' ),
			'view_item'          => __( 'View Scenes', 'beneon' ),
			'not_found'          => __( 'No Scenes found', 'beneon' ),
			'not_found_in_trash' => __( 'No Scenes in the trash', 'beneon' ),
			'menu_name'          => __( 'Scenes', 'beneon' ),
			'all_items'          => __( 'Scenes', 'beneon' ),
		);

		$args['labels'] = $labels;

		register_post_type( 'beneon-scene', $args );

		$labels = array(
			'name'               => __( 'Neon Template', 'beneon' ),
			'singular_name'      => __( 'Neon Template', 'beneon' ),
			'add_new'            => __( 'New Neon Template', 'beneon' ),
			'add_new_item'       => __( 'New Neon Template', 'beneon' ),
			'edit_item'          => __( 'Edit Neon Template', 'beneon' ),
			'new_item'           => __( 'New Neon Template', 'beneon' ),
			'view_item'          => __( 'View Neon Template', 'beneon' ),
			'not_found'          => __( 'No Neon Template found', 'beneon' ),
			'not_found_in_trash' => __( 'No Neon Template in the trash', 'beneon' ),
			'menu_name'          => __( 'Neon Template', 'beneon' ),
			'all_items'          => __( 'Neon Template', 'beneon' ),
		);

		$args['labels'] = $labels;

		register_post_type( 'beneon-template', $args );

		$labels = array(
			'name'               => __( 'Request a quote', 'beneon' ),
			'singular_name'      => __( 'Request a quote', 'beneon' ),
			'add_new'            => __( 'New Request a quote', 'beneon' ),
			'add_new_item'       => __( 'New Request a quote', 'beneon' ),
			'edit_item'          => __( 'Edit Request a quote', 'beneon' ),
			'new_item'           => __( 'New Request a quote', 'beneon' ),
			'view_item'          => __( 'View Request a quote', 'beneon' ),
			'not_found'          => __( 'No Request a quote found', 'beneon' ),
			'not_found_in_trash' => __( 'No Request a quote in the trash', 'beneon' ),
			'menu_name'          => __( 'Request a quote', 'beneon' ),
			'all_items'          => __( 'Request a quote', 'beneon' ),
		);

		$args['labels'] = $labels;

		register_post_type( 'beneon-quote', $args );

		$labels = array(
			'name'               => __( 'Order', 'beneon' ),
			'singular_name'      => __( 'Order', 'beneon' ),
			'add_new'            => __( 'New Order', 'beneon' ),
			'add_new_item'       => __( 'New Order', 'beneon' ),
			'edit_item'          => __( 'Edit Order', 'beneon' ),
			'new_item'           => __( 'New Order', 'beneon' ),
			'view_item'          => __( 'View Order', 'beneon' ),
			'not_found'          => __( 'No Order found', 'beneon' ),
			'not_found_in_trash' => __( 'No Order in the trash', 'beneon' ),
			'menu_name'          => __( 'Order', 'beneon' ),
			'all_items'          => __( 'Order', 'beneon' ),
		);

		$args['labels'] = $labels;

		register_post_type( 'beneon-order', $args );

		$labels = array(
			'name'               => __( 'Configuration', 'beneon' ),
			'singular_name'      => __( 'Configuration', 'beneon' ),
			'add_new'            => __( 'New Configuration', 'beneon' ),
			'add_new_item'       => __( 'New Configuration', 'beneon' ),
			'edit_item'          => __( 'Edit Configuration', 'beneon' ),
			'new_item'           => __( 'New Configuration', 'beneon' ),
			'view_item'          => __( 'View Configuration', 'beneon' ),
			'not_found'          => __( 'No Configuration found', 'beneon' ),
			'not_found_in_trash' => __( 'No Configuration in the trash', 'beneon' ),
			'menu_name'          => __( 'Configuration', 'beneon' ),
			'all_items'          => __( 'Configuration', 'beneon' ),
		);

		$args['labels'] = $labels;

		register_post_type( 'beneon-config', $args );
	}

	/**
	 * Get settings page.
	 *
	 * @return void
	 */
	public function get_settings_page() {
		var_dump( 'Setting page' );
	}

	/**
	 * Get left cart content.
	 *
	 * @return void
	 */
	public function get_left_cart_content() {
		var_dump( 'cart content' );
	}

	/**
	 * Add meta boxes.
	 *
	 * @return void
	 */
	public function add_meta_boxes() {
		$this->get_neon_color_content();
		$this->get_font_content();
		$this->get_scene_content();
		$this->get_neon_template_content();
		$this->add_interface_metaboxes();
		$this->add_dimension_metabox();
		$this->add_default_field_metabox();
		$this->add_beneon_output_metabox();
		$this->add_pricing_metabox();
	}

	/**
	 * Get neon color content.
	 *
	 * @return void
	 */
	public function get_neon_color_content() {
		// Prefix for the fields.
		$prefix = 'beneon_';

		// Define the metabox and fields.
		$cmb = new_cmb2_box(
			array(
				'id'           => $prefix . 'neon_colors_metabox',
				'title'        => __( 'Neon Colors', 'beneon' ),
				'object_types' => array( 'beneon-color' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			)
		);

		// Add a group field.
		$group_field_id = $cmb->add_field(
			array(
				'id'          => $prefix . 'neon_colors',
				'type'        => 'group',
				'description' => __( 'Add multiple neon color combinations', 'beneon' ),
				'options'     => array(
					'group_title'   => __( 'Neon Color {#}', 'beneon' ),
					'add_button'    => __( 'Add Another Neon Color', 'beneon' ),
					'remove_button' => __( 'Remove Neon Color', 'beneon' ),
					'sortable'      => true,
				),
			)
		);

		// Add fields to the group.
		$cmb->add_group_field(
			$group_field_id,
			array(
				'name'    => __( 'Neon Text Color', 'beneon' ),
				'desc'    => __( 'Select the color of the neon text.', 'beneon' ),
				'id'      => 'text_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff',
			)
		);

		$cmb->add_group_field(
			$group_field_id,
			array(
				'name'    => __( 'Neon Light Color', 'beneon' ),
				'desc'    => __( 'Select the color of the neon light.', 'beneon' ),
				'id'      => 'light_color',
				'type'    => 'colorpicker',
				'default' => '#eeee22',
			)
		);

		$cmb->add_group_field(
			$group_field_id,
			array(
				'name'         => __( 'Example Colors', 'beneon' ),
				'desc'         => __( 'Upload one or more example images or videos.', 'beneon' ),
				'id'           => 'example_colors',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ),
				'query_args'   => array( 'type' => array( 'image', 'video' ) ),
				'text'         => array(
					'add_upload_files_text' => __( 'Add Example Colors', 'beneon' ),
					'remove_image_text'     => __( 'Remove Image', 'beneon' ),
					'file_text'             => __( 'File:', 'beneon' ),
					'file_download_text'    => __( 'Download', 'beneon' ),
					'remove_text'           => __( 'Remove', 'beneon' ),
				),
			)
		);
	}

	/**
	 * Get a google font.
	 *
	 * @return void
	 */
	public function get_font_content() {
		// Prefix for the fields.
		$prefix = 'beneon_';

		// Define the metabox and fields.
		$cmb = new_cmb2_box(
			array(
				'id'           => $prefix . 'neon_fonts_metabox',
				'title'        => __( 'Neon Fonts', 'beneon' ),
				'object_types' => array( 'beneon-font' ), // Type de post.
				'context'      => 'normal', // Affichage sous le titre du post.
				'priority'     => 'high',
				'show_names'   => true, // Afficher les noms des champs à gauche.
			)
		);

		// Add a group field for fonts.
		$fonts_group_field_id = $cmb->add_field(
			array(
				'id'          => $prefix . 'fonts',
				'type'        => 'group',
				'description' => __( 'Add multiple fonts for neon text', 'beneon' ),
				'options'     => array(
					'group_title'   => __( 'Font {#}', 'beneon' ), // {#} gets replaced by row number.
					'add_button'    => __( 'Add Another Font', 'beneon' ),
					'remove_button' => __( 'Remove Font', 'beneon' ),
					'sortable'      => true, // Allows reordering of entries.
				),
			)
		);

		// Field for Google Fonts select (Using AJAX for options).
		$cmb->add_group_field(
			$fonts_group_field_id,
			array(
				'name'            => __( 'Google Font', 'beneon' ),
				'desc'            => __( 'Select a Google font', 'beneon' ),
				'id'              => $prefix . 'google_font',
				'type'            => 'select',
				'options_cb'      => array( $this, 'get_google_fonts_options' ), // Callback function for AJAX options.
				'attributes'      => array(
					'data-placeholder' => __( 'Select a Google Font', 'beneon' ),
				),
				'escape_cb'       => false, // Prevent escaping of HTML in AJAX response.
				'sanitization_cb' => false, // No need for sanitization as CMB2 handles it.
			)
		);

		// Field for uploading custom font file.
		$cmb->add_group_field(
			$fonts_group_field_id,
			array(
				'name'       => __( 'Custom Font File', 'beneon' ),
				'desc'       => __( 'Upload a custom font file (TTF, OTF, WOFF, WOFF2)', 'beneon' ),
				'id'         => $prefix . 'custom_font_file',
				'type'       => 'file',
				'query_args' => array(
					'type' => array( 'ttf', 'otf', 'woff', 'woff2' ),
				),
				'text'       => array(
					'add_upload_file_text' => __( 'Upload Custom Font', 'beneon' ),
				),
			)
		);
	}


	/**
	 * Function to populate Google Fonts select options.
	 *
	 * @return array
	 */
	public function get_google_fonts_options() {
		$google_fonts      = file_get_contents( BENEON_DIR . '/includes/api/google-fonts.json' );
		$google_fonts_data = json_decode( $google_fonts, true );

		$fonts = array();
		foreach ( $google_fonts_data['items'] as $font ) {
			$fonts[ $font['family'] ] = $font['family'];
		}

		return $fonts;
	}

	/**
	 * Get scene content.
	 *
	 * @return void
	 */
	public function get_scene_content() {
		// Prefix for the fields.
		$prefix = 'beneon_';

		// Define the metabox and fields.
		$cmb = new_cmb2_box(
			array(
				'id'           => $prefix . 'neon_scene_metabox',
				'title'        => __( 'Scene Group', 'beneon' ),
				'object_types' => array( 'beneon-scene' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			)
		);

		// Add a group field.
		$group_field_id = $cmb->add_field(
			array(
				'id'          => $prefix . 'scene_group',
				'type'        => 'group',
				'description' => __( 'Add multiple scene combinations', 'beneon' ),
				'options'     => array(
					'group_title'   => __( 'scene {#}', 'beneon' ),
					'add_button'    => __( 'Add Another scene', 'beneon' ),
					'remove_button' => __( 'Remove scene', 'beneon' ),
					'sortable'      => true,
				),
			)
		);

		$cmb->add_group_field(
			$group_field_id,
			array(
				'name'    => __( 'Name', 'beneon' ),
				'desc'    => __( 'Scene name.', 'beneon' ),
				'id'      => 'scene_name',
				'type'    => 'text',
				'default' => 'New York',
			)
		);

		$cmb->add_group_field(
			$group_field_id,
			array(
				'name'         => __( 'Example scene', 'beneon' ),
				'desc'         => __( 'Upload one or more example images or videos.', 'beneon' ),
				'id'           => 'example_scenes',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ),
				'query_args'   => array( 'type' => array( 'image', 'video' ) ),
				'text'         => array(
					'add_upload_files_text' => __( 'Add Example scenes', 'beneon' ),
					'remove_image_text'     => __( 'Remove Image', 'beneon' ),
					'file_text'             => __( 'File:', 'beneon' ),
					'file_download_text'    => __( 'Download', 'beneon' ),
					'remove_text'           => __( 'Remove', 'beneon' ),
				),
			)
		);
	}

	/**
	 * Get scene content.
	 *
	 * @return void
	 */
	public function get_neon_template_content() {
	}

	/**
	 * Get interface metaboxes.
	 *
	 * @return void
	 */
	public function add_interface_metaboxes() {
		$prefix = 'beneon_';

		// Interface Metabox
		$cmb_interface = new_cmb2_box(
			array(
				'id'           => $prefix . 'interface_metabox',
				'title'        => __( 'Interface', 'beneon' ),
				'object_types' => array( 'beneon-config' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			)
		);

		$cmb_interface->add_field(
			array(
				'name'       => __( 'Page', 'beneon' ),
				'id'         => $prefix . 'page',
				'type'       => 'select',
				'options_cb' => 'beneon_get_post_options',
			)
		);

		$cmb_interface->add_field(
			array(
				'name'        => __( 'Product', 'beneon' ),
				'id'          => $prefix . 'products',
				'type'        => 'post_search_text',
				'post_type'   => 'product',
				'select_type' => 'checkbox',
			)
		);

		$cmb_interface->add_field(
			array(
				'name' => __( 'Text Color', 'beneon' ),
				'id'   => $prefix . 'text_color',
				'type' => 'colorpicker',
			)
		);

		$cmb_interface->add_field(
			array(
				'name' => __( 'Button Color', 'beneon' ),
				'id'   => $prefix . 'button_color',
				'type' => 'colorpicker',
			)
		);

		$cmb_interface->add_field(
			array(
				'name' => __( 'Button Background Color', 'beneon' ),
				'id'   => $prefix . 'button_bg_color',
				'type' => 'colorpicker',
			)
		);

		$cmb_interface->add_field(
			array(
				'name' => __( 'Configurator Background', 'beneon' ),
				'id'   => $prefix . 'configurator_bg',
				'type' => 'colorpicker',
			)
		);

		$cmb_interface->add_field(
			array(
				'name'    => __( 'Preview Position', 'beneon' ),
				'id'      => $prefix . 'preview_position',
				'type'    => 'radio_inline',
				'options' => array(
					'left'  => __( 'Left', 'beneon' ),
					'right' => __( 'Right', 'beneon' ),
				),
			)
		);

		$cmb_interface->add_field(
			array(
				'name'    => __( '3D Preview', 'beneon' ),
				'id'      => $prefix . '3d_preview',
				'type'    => 'radio_inline',
				'options' => array(
					'yes' => __( 'Yes', 'beneon' ),
					'no'  => __( 'No', 'beneon' ),
				),
			)
		);

		$cmb_interface->add_field(
			array(
				'name'       => __( '360° Rotation', 'beneon' ),
				'id'         => $prefix . '360_rotation',
				'type'       => 'radio_inline',
				'options'    => array(
					'yes' => __( 'Yes', 'beneon' ),
					'no'  => __( 'No', 'beneon' ),
				),
				'show_on_cb' => 'beneon_show_if_3d_preview_enabled',
			)
		);
	}

	/**
	 * Get dimension metaboxes.
	 *
	 * @return void
	 */
	public function add_dimension_metabox() {
		$prefix = 'beneon_';

		$cmb_dimension = new_cmb2_box(
			array(
				'id'           => $prefix . 'dimension_metabox',
				'title'        => __( 'Dimension', 'beneon' ),
				'object_types' => array( 'beneon-config' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			)
		);

		$cmb_dimension->add_field(
			array(
				'name'    => __( 'Use Default Dimension', 'beneon' ),
				'id'      => $prefix . 'use_default_dimension',
				'type'    => 'radio_inline',
				'options' => array(
					'yes' => __( 'Yes', 'beneon' ),
					'no'  => __( 'No', 'beneon' ),
				),
			)
		);

		$cmb_dimension->add_field(
			array(
				'name' => __( 'Height', 'beneon' ),
				'id'   => $prefix . 'height',
				'type' => 'text_small',
			)
		);

		$cmb_dimension->add_field(
			array(
				'name' => __( 'Width', 'beneon' ),
				'id'   => $prefix . 'width',
				'type' => 'text_small',
			)
		);

		$cmb_dimension->add_field(
			array(
				'name'         => __( 'Default Price (S)', 'beneon' ),
				'id'           => $prefix . 'default_price_s',
				'type'         => 'text_money',
				'before_field' => '$',
			)
		);

		// Add fields for M, L, XL, XXL similarly...

		$cmb_dimension->add_field(
			array(
				'name' => __( 'Custom Dimension Height', 'beneon' ),
				'id'   => $prefix . 'custom_height',
				'type' => 'text_small',
			)
		);

		$cmb_dimension->add_field(
			array(
				'name' => __( 'Custom Dimension Width', 'beneon' ),
				'id'   => $prefix . 'custom_width',
				'type' => 'text_small',
			)
		);

		$cmb_dimension->add_field(
			array(
				'name'         => __( 'Custom Default Price', 'beneon' ),
				'id'           => $prefix . 'custom_default_price',
				'type'         => 'text_money',
				'before_field' => '$',
			)
		);
	}

	/**
	 * Get default field metaboxes.
	 *
	 * @return void
	 */
	public function add_default_field_metabox() {
		$prefix = 'beneon_';

		$cmb_default_field = new_cmb2_box(
			array(
				'id'           => $prefix . 'default_field_metabox',
				'title'        => __( 'Default Field', 'beneon' ),
				'object_types' => array( 'beneon-config' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			)
		);

		$cmb_default_field->add_field(
			array(
				'name'       => __( 'Select Color', 'beneon' ),
				'id'         => $prefix . 'select_color',
				'type'       => 'select',
				'options_cb' => 'beneon_get_post_options',
			)
		);

		$cmb_default_field->add_field(
			array(
				'name'       => __( 'Select Font', 'beneon' ),
				'id'         => $prefix . 'select_font',
				'type'       => 'select',
				'options_cb' => 'beneon_get_post_options',
			)
		);

		$cmb_default_field->add_field(
			array(
				'name'       => __( 'Select Custom Field', 'beneon' ),
				'id'         => $prefix . 'select_custom_field',
				'type'       => 'select',
				'options_cb' => 'beneon_get_post_options',
			)
		);
	}

	/**
	 * Get output metaboxes.
	 *
	 * @return void
	 */
	public function add_beneon_output_metabox() {
		$prefix = 'beneon_';

		$cmb_output = new_cmb2_box(
			array(
				'id'           => $prefix . 'output_metabox',
				'title'        => __( 'Output', 'beneon' ),
				'object_types' => array( 'beneon-config' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			)
		);

		$cmb_output->add_field(
			array(
				'name'    => __( 'Format', 'beneon' ),
				'id'      => $prefix . 'format',
				'type'    => 'select',
				'options' => array(
					'png'      => __( 'PNG', 'beneon' ),
					'jpeg'     => __( 'JPEG', 'beneon' ),
					'svg'      => __( 'SVG', 'beneon' ),
					'pdf'      => __( 'PDF', 'beneon' ),
					'pdf_png'  => __( 'PDF + PNG', 'beneon' ),
					'pdf_jpeg' => __( 'PDF + JPEG', 'beneon' ),
					'pdf_svg'  => __( 'PDF + SVG', 'beneon' ),
				),
			)
		);

		$cmb_output->add_field(
			array(
				'name' => __( 'Height', 'beneon' ),
				'id'   => $prefix . 'output_height',
				'type' => 'text_small',
			)
		);

		$cmb_output->add_field(
			array(
				'name' => __( 'Width', 'beneon' ),
				'id'   => $prefix . 'output_width',
				'type' => 'text_small',
			)
		);

		$cmb_output->add_field(
			array(
				'name' => __( 'Watermark Text', 'beneon' ),
				'id'   => $prefix . 'watermark_text',
				'type' => 'text',
			)
		);

		$cmb_output->add_field(
			array(
				'name' => __( 'Watermark Logo', 'beneon' ),
				'id'   => $prefix . 'watermark_logo',
				'type' => 'file',
			)
		);
	}


	/**
	 * Get pricing metaboxes.
	 *
	 * @return void
	 */
	public function add_pricing_metabox() {
		$prefix = 'beneon_';

		$cmb_pricing = new_cmb2_box(
			array(
				'id'           => $prefix . 'pricing_metabox',
				'title'        => __( 'Pricing', 'beneon' ),
				'object_types' => array( 'beneon-config' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			)
		);

		$cmb_pricing->add_field(
			array(
				'name' => __( 'Discount', 'beneon' ),
				'id'   => $prefix . 'discount',
				'type' => 'text_small',
			)
		);

		$cmb_pricing->add_field(
			array(
				'name'    => __( 'Custom Pricing Rules', 'beneon' ),
				'id'      => $prefix . 'pricing_rules',
				'type'    => 'group',
				'options' => array(
					'group_title'   => __( 'Rule {#}', 'beneon' ),
					'add_button'    => __( 'Add Another Rule', 'beneon' ),
					'remove_button' => __( 'Remove Rule', 'beneon' ),
					'sortable'      => true,
				),
			)
		);

		$cmb_pricing->add_group_field(
			$prefix . 'pricing_rules',
			array(
				'name'    => __( 'Condition', 'beneon' ),
				'id'      => 'condition',
				'type'    => 'select',
				'options' => array(
					'='  => __( 'Equal to', 'beneon' ),
					'!=' => __( 'Not equal to', 'beneon' ),
					'>'  => __( 'Greater than', 'beneon' ),
					'>=' => __( 'Greater than or equal to', 'beneon' ),
					'<'  => __( 'Less than', 'beneon' ),
					'<=' => __( 'Less than or equal to', 'beneon' ),
				),
			)
		);

		$cmb_pricing->add_group_field(
			$prefix . 'pricing_rules',
			array(
				'name'    => __( 'Parameter', 'beneon' ),
				'id'      => 'parameter',
				'type'    => 'select',
				'options' => array(
					'width'       => __( 'Neon Width', 'beneon' ),
					'height'      => __( 'Neon Height', 'beneon' ),
					'text_length' => __( 'Neon Text Length', 'beneon' ),
					'square'      => __( 'Neon Square', 'beneon' ),
					'price'       => __( 'Price', 'beneon' ),
					'color'       => __( 'Color', 'beneon' ),
					'font'        => __( 'Font', 'beneon' ),
				),
			)
		);

		$cmb_pricing->add_group_field(
			$prefix . 'pricing_rules',
			array(
				'name' => __( 'Value', 'beneon' ),
				'id'   => 'value',
				'type' => 'text_small',
			)
		);

		$cmb_pricing->add_group_field(
			$prefix . 'pricing_rules',
			array(
				'name'         => __( 'Price Adjustment', 'beneon' ),
				'id'           => 'price_adjustment',
				'type'         => 'text_money',
				'before_field' => '$',
			)
		);
	}
}
