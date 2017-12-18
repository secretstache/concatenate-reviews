<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.secretstache.com/
 * @since      1.0.0
 *
 * @package    Online_Reviews
 * @subpackage Online_Reviews/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Online_Reviews
 * @subpackage Online_Reviews/admin
 * @author     Secret Stache Media, LLC <dev.postfactum@gmail.com>
 */
class Online_Reviews_Admin {

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
		 * defined in Online_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Online_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/online-reviews-admin.css', array(), $this->version, 'all' );

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
		 * defined in Online_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Online_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/online-reviews-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Online Reviews CPT
	 *
	 * @since    1.0.0
	 */
	public function online_reviews_cpt() {

		$cap_type 		= 'page';
		$plural 		= 'Online Reviews';
		$single 		= 'Online Review';
		$cpt_name 		= 'online_reviews';
		$text_domain 	= 'copi';

		$opts = array(
			'can_export' 					=> TRUE,
			'capability_type' 				=> $cap_type,
			'description' 					=> '',
			'exclude_from_search' 			=> FALSE,
			'has_archive' 					=> FALSE,
			'hierarchical'	 				=> FALSE,
			'map_meta_cap' 					=> TRUE,
			'menu_icon' 					=> 'dashicons-admin-comments',
			'menu_position' 				=> 25,
			'public' 						=> FALSE,
			'publicly_querable' 			=> TRUE,
			'query_var' 					=> TRUE,
			'register_meta_box_cb'			=> '',
			'rewrite' 						=> FALSE,
			'show_in_admin_bar'				=> TRUE,
			'show_in_menu'					=> TRUE,
			'show_in_nav_menu' 				=> TRUE,
			'show_ui' 						=> TRUE,
			'supports' 						=> array( 'title' ),
			'taxonomies' 					=> array(),
			'show_in_rest' 					=> TRUE
		);

		$opts['capabilities'] = array(
			'delete_others_posts'			=> "delete_others_{$cap_type}s",
			'delete_post'					=> "delete_{$cap_type}",
			'delete_posts'					=> "delete_{$cap_type}s",
			'delete_private_posts'			=> "delete_private_{$cap_type}s",
			'delete_published_posts'		=> "delete_published_{$cap_type}s",
			'edit_others_posts'				=> "edit_others_{$cap_type}s",
			'edit_post'						=> "edit_{$cap_type}",
			'edit_posts'					=> "edit_{$cap_type}s",
			'edit_private_posts'			=> "edit_private_{$cap_type}s",
			'edit_published_posts'			=> "edit_published_{$cap_type}s",
			'publish_posts'					=> "publish_{$cap_type}s",
			'read_post'						=> "read_{$cap_type}",
			'read_private_posts'			=> "read_private_{$cap_type}s"
		);

		$opts['labels'] = array(
			'add_new'						=> esc_html__( "Add New {$single}", $text_domain ),
			'add_new_item'					=> esc_html__( "Add New {$single}", $text_domain ),
			'all_items'						=> esc_html__( $plural, $text_domain ),
			'edit_item'						=> esc_html__( "Edit {$single}", $text_domain ),
			'menu_name'						=> esc_html__( $plural, $text_domain ),
			'name'							=> esc_html__( $plural, $text_domain ),
			'name_admin_bar'				=> esc_html__( $single, $text_domain ),
			'new_item'						=> esc_html__( "New {$single}", $text_domain ),
			'not_found'						=> esc_html__( "No {$plural} Found", $text_domain ),
			'not_found_in_trash'			=> esc_html__( "No {$plural} Found in Trash", $text_domain ),
			'parent_item_colon'				=> esc_html__( "Parent {$plural} :", $text_domain ),
			'search_items'					=> esc_html__( "Search {$plural}", $text_domain ),
			'singular_name'					=> esc_html__( $single, $text_domain ),
			'view_item'						=> esc_html__( "View {$single}", $text_domain )
		);

		$opts['rewrite'] = array(
			'ep_mask'						=> EP_PERMALINK,
			'feeds'							=> FALSE,
			'pages'							=> TRUE,
			'slug'							=> esc_html__( strtolower( $plural ), $text_domain ),
			'with_front'					=> FALSE
		);

		$opts = apply_filters( 'online-review-cpt-options', $opts );

		register_post_type( strtolower( $cpt_name ), $opts );

	}

	/**
	 * Add daily interval to CRON schedules
	 * @since   1.0.0
	 */
	function cron_add_daily( $schedules ) {
	
		$schedules['daily'] = array(
			'interval'	=> 60 * 60 * 24,
			'display'	=> __( 'Every day' )
		);

		return $schedules;
		
	}

	/**
	 * Add the scheduling if it doesn't already exist
	 * @since   1.0.0
	 */
	function setup_schedule() {

		if ( !wp_next_scheduled( 'check_new_reviews' ) ) {
			wp_schedule_event( time(), 'daily', 'check_new_reviews' );
		}

	}

	/**
	 * Add the function that takes care of adding new reviews as Online Reviews CPT
	 * @since   1.0.0
	 */
	function add_new_reviews() {
	 	
	 	global $wpdb;

	 	$new_post = array(
	    	'post_title'  => 'test',
	    	'post_status' => 'publish',
		    'post_type'   => 'online_reviews',
		);

		$post_id = wp_insert_post( $new_post );

		add_post_meta( $post_id, '_author', 'Alex' );

	}

}
