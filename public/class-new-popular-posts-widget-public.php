<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://about.me/rashadulalam
 * @since      1.0.0
 *
 * @package    New_Popular_Posts_Widget
 * @subpackage New_Popular_Posts_Widget/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    New_Popular_Posts_Widget
 * @subpackage New_Popular_Posts_Widget/public
 * @author     Rashadul Alam <rashadul91@gmail.com>
 */
class New_Popular_Posts_Widget_Public {

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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in New_Popular_Posts_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The New_Popular_Posts_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/new-popular-posts-widget-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fontello.css', array(), $this->version, 'all' );

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
		 * defined in New_Popular_Posts_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The New_Popular_Posts_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/new-popular-posts-widget-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Save post views
	 *
	 * @since    1.0.0
	 */
	public function nppw_save_post_views() {
		
		$content = get_the_content();
		 if( is_single() ):
			$metaKey = 'nppw_post_views';

			$views = get_post_meta( get_the_ID(), $metaKey, true );
			$count = ( empty( $views ) ? 0 : $views );
			$count++;

			update_post_meta( get_the_ID(), $metaKey, $count );
		endif;
		
		return $content;
	}



}
