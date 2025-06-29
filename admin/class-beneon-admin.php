<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://blyd3d.com
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
 * @author     BLYD3D <info@blyd3d.com>
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
        * Option name used to store settings.
        *
        * @var string
        */
       private $option_name = 'beneon_settings';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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

               wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/beneon-admin.js', array( 'jquery' ), $this->version, false );

       }

       /**
        * Add admin menu for plugin settings.
        */
       public function add_menu() {
               add_menu_page(
                       __( 'BeNeon Settings', 'beneon' ),
                       'BeNeon',
                       'manage_options',
                       'beneon',
                       array( $this, 'render_settings_page' )
               );
       }

       /**
        * Register plugin settings.
        */
       public function register_settings() {
               register_setting( 'beneon', $this->option_name );

               add_settings_section(
                       'beneon_general',
                       __( 'Configurator Options', 'beneon' ),
                       '__return_false',
                       'beneon'
               );

               add_settings_field(
                       'fonts',
                       __( 'Fonts (comma separated)', 'beneon' ),
                       array( $this, 'field_fonts' ),
                       'beneon',
                       'beneon_general'
               );

               add_settings_field(
                       'colors',
                       __( 'Colors (comma separated hex values)', 'beneon' ),
                       array( $this, 'field_colors' ),
                       'beneon',
                       'beneon_general'
               );

               add_settings_field(
                       'sizes',
                       __( 'Sizes (comma separated numbers)', 'beneon' ),
                       array( $this, 'field_sizes' ),
                       'beneon',
                       'beneon_general'
               );
       }

       /**
        * Fonts input field.
        */
       public function field_fonts() {
               $options = get_option( $this->option_name );
               $fonts   = isset( $options['fonts'] ) ? esc_attr( $options['fonts'] ) : 'Arial,Courier New,Times New Roman';
               echo '<input type="text" name="' . esc_attr( $this->option_name ) . '[fonts]" value="' . $fonts . '" class="regular-text" />';
       }

       /**
        * Colors input field.
        */
       public function field_colors() {
               $options = get_option( $this->option_name );
               $colors  = isset( $options['colors'] ) ? esc_attr( $options['colors'] ) : '#ff0000,#00ff00,#0000ff';
               echo '<input type="text" name="' . esc_attr( $this->option_name ) . '[colors]" value="' . $colors . '" class="regular-text" />';
       }

       /**
        * Sizes input field.
        */
       public function field_sizes() {
               $options = get_option( $this->option_name );
               $sizes   = isset( $options['sizes'] ) ? esc_attr( $options['sizes'] ) : '60,80,100';
               echo '<input type="text" name="' . esc_attr( $this->option_name ) . '[sizes]" value="' . $sizes . '" class="regular-text" />';
       }

       /**
        * Render settings page.
        */
       public function render_settings_page() {
               ?>
               <div class="wrap">
                       <h1><?php esc_html_e( 'BeNeon Settings', 'beneon' ); ?></h1>
                       <form method="post" action="options.php">
                               <?php
                               settings_fields( 'beneon' );
                               do_settings_sections( 'beneon' );
                               submit_button();
                               ?>
                       </form>
               </div>
               <?php
       }

}
