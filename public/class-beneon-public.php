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
               $settings = get_option( 'beneon_settings', array() );
               $fonts      = isset( $settings['fonts'] ) ? array_map( 'trim', explode( ',', $settings['fonts'] ) ) : array( 'Arial', 'Courier New', 'Times New Roman' );
               $colors     = isset( $settings['colors'] ) ? array_map( 'trim', explode( ',', $settings['colors'] ) ) : array( '#ff0000', '#00ff00', '#0000ff' );
               $sizes      = isset( $settings['sizes'] ) ? array_map( 'trim', explode( ',', $settings['sizes'] ) ) : array( '60', '80', '100' );
               $backboards = isset( $settings['backboards'] ) ? array_map( 'trim', explode( ',', $settings['backboards'] ) ) : array( 'Cut to shape', 'Rectangle' );
               $scenes     = isset( $settings['scenes'] ) ? array_map( 'trim', explode( ',', $settings['scenes'] ) ) : array( 'Living room', 'Bedroom', 'Office' );
               $extras     = isset( $settings['extras'] ) ? array_map( 'trim', explode( ',', $settings['extras'] ) ) : array( 'Dimmer', 'Remote' );

               ob_start();
               ?>
               <div id="beneon-configurator" class="beneon-container">
                       <div id="beneon-preview" class="beneon-preview"></div>
                       <div class="beneon-options">
                       <label>
                               <?php esc_html_e( 'Text', 'beneon' ); ?>
                               <input type="text" id="beneon-text" />
                       </label>
                       <label>
                               <?php esc_html_e( 'Font', 'beneon' ); ?>
                               <select id="beneon-font">
                                       <?php foreach ( $fonts as $font ) : ?>
                                               <option value="<?php echo esc_attr( $font ); ?>"><?php echo esc_html( $font ); ?></option>
                                       <?php endforeach; ?>
                               </select>
                       </label>
                       <label>
                               <?php esc_html_e( 'Color', 'beneon' ); ?>
                               <select id="beneon-color">
                                       <?php foreach ( $colors as $color ) : ?>
                                               <option value="<?php echo esc_attr( $color ); ?>" style="color:<?php echo esc_attr( $color ); ?>;">
                                                       <?php echo esc_html( $color ); ?>
                                               </option>
                                       <?php endforeach; ?>
                               </select>
                       </label>
                       <label>
                               <?php esc_html_e( 'Size', 'beneon' ); ?>
                               <select id="beneon-size">
                                       <?php foreach ( $sizes as $size ) : ?>
                                               <option value="<?php echo esc_attr( $size ); ?>"><?php echo esc_html( $size ); ?></option>
                                       <?php endforeach; ?>
                               </select>
                       </label>
                       <label>
                               <?php esc_html_e( 'Backboard', 'beneon' ); ?>
                               <select id="beneon-backboard">
                                       <?php foreach ( $backboards as $shape ) : ?>
                                               <option value="<?php echo esc_attr( $shape ); ?>"><?php echo esc_html( $shape ); ?></option>
                                       <?php endforeach; ?>
                               </select>
                       </label>
                       <label>
                               <?php esc_html_e( 'Scene', 'beneon' ); ?>
                               <select id="beneon-scene">
                                       <?php foreach ( $scenes as $scene ) : ?>
                                               <option value="<?php echo esc_attr( $scene ); ?>"><?php echo esc_html( $scene ); ?></option>
                                       <?php endforeach; ?>
                               </select>
                       </label>
                       <fieldset>
                               <legend><?php esc_html_e( 'Extras', 'beneon' ); ?></legend>
                               <?php foreach ( $extras as $extra ) : ?>
                                       <label class="beneon-extra"><input type="checkbox" value="<?php echo esc_attr( $extra ); ?>" /> <?php echo esc_html( $extra ); ?></label>
                               <?php endforeach; ?>
                       </fieldset>
                       <label>
                               <?php esc_html_e( 'Upload design', 'beneon' ); ?>
                               <input type="file" id="beneon-file" />
                       </label>
                       <button type="button" class="button add-to-cart"><?php esc_html_e( 'Add to cart', 'beneon' ); ?></button>
                       <button type="button" class="button request-quote"><?php esc_html_e( 'Request a quote', 'beneon' ); ?></button>
                       </div>
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
