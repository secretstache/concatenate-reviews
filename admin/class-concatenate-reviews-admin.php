<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://secretstache.com/
 * @since      1.0.0
 *
 * @package    Concatenate_Reviews
 * @subpackage Concatenate_Reviews/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Concatenate_Reviews
 * @subpackage Concatenate_Reviews/admin
 * @author     Secret Stache Media <dev.postfactum@gmail.com>
 */
class Concatenate_Reviews_Admin {

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
		 * defined in Concatenate_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Concatenate_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/concatenate-reviews-admin.css', array(), $this->version, 'all' );

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
		 * defined in Concatenate_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Concatenate_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/concatenate-reviews-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Online Reviews CPT
	 *
	 * @since    1.0.0
	 */
	public function online_review_cpt() {

		$cap_type 		= 'page';
		$plural 		= 'Online Reviews';
		$single 		= 'Online Review';
		$cpt_name 		= 'ssm_online_review';
		$slug			= 'online-review';
		$text_domain 	= 'cr';

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
			'supports' 						=> array( 'title', 'editor' ),
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
			'slug'							=> esc_html__( strtolower( $slug ), $text_domain ),
			'with_front'					=> FALSE
		);

		$opts = apply_filters( 'ssm-online-review-cpt-options', $opts );

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
	 * Get the list of hashes of already posted ssm_online_reviews.
	 *
 	 * @since   1.0.0
	 * @uses 	get_posts()
	 */
	function get_posted_reviews() {

		$reviews = get_posts( array( 'numberposts' => -1, 'post_type' => 'ssm_online_review' ) );
		$posted_reviews = array();

		foreach ($reviews as $review) {
			array_push($posted_reviews, get_post_meta( $review->ID, '_hash', true ) );
		}
			
		return $posted_reviews;

	}

	/**
	 * Function to get all of the reviews from database, loop through each of them and post it to WP if it's hash isn't in posted_reviews.
	 *
	 * @since   1.0.0
 	 * @uses 	get_results()
 	 * @uses 	wp_insert_post()
	 * @uses 	add_post_meta()
	 */
	function post_new_reviews( $social_network, $table, $posted_reviews ) {

	 	global $wpdb;

		$table_name = $wpdb->prefix . $table;
		$reviews = array();

		if ( $social_network == "google" ) {

			$rows = $wpdb->get_results("select hash, rating, text, time, author_name, author_url from {$table_name}");

			foreach ( $rows as $obj ) {
				array_push( $reviews, array( 'hash' => $obj->hash, 'rating' => $obj->rating, 'text' => $obj->text, 'time' => strtotime( $obj->time ), 'author_name' => $obj->author_name, 'link' => $obj->author_url ) );
			}

		} else {

			$rows = $wpdb->get_results("select hash, rating, text, time, author_name, url from {$table_name}");

			foreach ( $rows as $obj ) {
				array_push( $reviews, array( 'hash' => $obj->hash, 'rating' => $obj->rating, 'text' => $obj->text, 'time' => strtotime( $obj->time ), 'author_name' => $obj->author_name, 'link' => $obj->url ) );
			}
			
		}

		foreach ($reviews as $review) {
			
			if ( !in_array( $review['hash'], $posted_reviews ) ) {

					$new_post = array(
				    	'post_title'	=> $review['author_name'],
				    	'post_content'	=> $review['text'],
				    	'post_status' 	=> 'publish',
					    'post_type'   	=> 'ssm_online_review',
					);

					$post_id = wp_insert_post( $new_post );

					add_post_meta( $post_id, '_social_network', $social_network );
					add_post_meta( $post_id, '_rating', $review['rating'] );
					add_post_meta( $post_id, '_time', $review['time'] );
					add_post_meta( $post_id, '_link', $review['link'] );
					add_post_meta( $post_id, '_hash', $review['hash'] );

			}
		}
		
	}

	/**
	 * Callback function for check_new_reviews custom CRON function.
	 *
	 * @since   1.0.0
 	 * @uses 	get_posted_reviews()
	 * @uses 	post_new_reviews()
	 */
	function check_new_reviews_cb() {
	 	
	 	$posted_reviews = Concatenate_Reviews_Admin::get_posted_reviews();

	 	Concatenate_Reviews_Admin::post_new_reviews( 'google', 'grp_google_review', $posted_reviews );
	 	Concatenate_Reviews_Admin::post_new_reviews( 'yelp', 'yrw_yelp_review', $posted_reviews );
	}

}
