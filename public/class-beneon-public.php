<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://blyd3d.com
 * @since      1.0.0
 *
 * @package    Beneon
 * @subpackage Beneon/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Beneon
 * @subpackage Beneon/public
 * @author     BLYD3D <info@blyd3d.com>
 */
class Beneon_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
       public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

       }

       /**
        * Register plugin shortcodes.
        */
       public function register_shortcodes() {
               add_shortcode( 'beneon_configurator', array( $this, 'render_configurator' ) );
       }

       /**
        * Render the neon configurator shortcode.
        */
       public function render_configurator( $atts ) {
               ob_start();
               ?>
               <div id="beneon-configurator">
                       <div id="beneon-preview"></div>
                       <label>
                               <?php esc_html_e( 'Text', 'beneon' ); ?>
                               <input type="text" id="beneon-text" />
                       </label>
                       <label>
                               <?php esc_html_e( 'Font', 'beneon' ); ?>
                               <select id="beneon-font">
                                       <option value="Arial">Arial</option>
                                       <option value="Courier New">Courier New</option>
                                       <option value="Times New Roman">Times New Roman</option>
                               </select>
                       </label>
                       <label>
                               <?php esc_html_e( 'Color', 'beneon' ); ?>
                               <input type="color" id="beneon-color" value="#ff0000" />
                       </label>
                       <label>
                               <?php esc_html_e( 'Size', 'beneon' ); ?>
                               <input type="number" id="beneon-size" value="60" />
                       </label>
                       <label>
                               <?php esc_html_e( 'Upload design', 'beneon' ); ?>
                               <input type="file" id="beneon-file" />
                       </label>
                       <button type="button" class="button add-to-cart"><?php esc_html_e( 'Add to cart', 'beneon' ); ?></button>
                       <button type="button" class="button request-quote"><?php esc_html_e( 'Request a quote', 'beneon' ); ?></button>
               </div>
               <?php
               return ob_get_clean();
       }

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

               wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/beneon-public.css', array(), $this->version, 'all' );
               wp_enqueue_style( $this->plugin_name . '-configurator', plugin_dir_url( __FILE__ ) . 'css/beneon-configurator.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

               wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/beneon-public.js', array( 'jquery' ), $this->version, false );
               wp_enqueue_script( $this->plugin_name . '-configurator', plugin_dir_url( __FILE__ ) . 'js/beneon-configurator.js', array( 'jquery' ), $this->version, true );

	}

}
