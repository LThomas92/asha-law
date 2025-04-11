<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Asha_&_Law
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function asha_law_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'asha_law_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function asha_law_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'asha_law_pingback_header' );

function custom_post_type() {

	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Quizzes', 'Post Type General Name' ),
			'singular_name'       => _x( 'Quiz', 'Post Type Singular Name'),
			'menu_name'           => __( 'Quizzes'),
			'parent_item_colon'   => __( 'Parent Quiz'),
			'all_items'           => __( 'All Quizzes' ),
			'view_item'           => __( 'View Quiz' ),
			'add_new_item'        => __( 'Add New Quiz' ),
			'add_new'             => __( 'Add New' ),
			'edit_item'           => __( 'Edit Quiz' ),
			'update_item'         => __( 'Update Quiz' ),
			'search_items'        => __( 'Search Quiz' ),
			'not_found'           => __( 'Not Found' ),
			'not_found_in_trash'  => __( 'Not found in Trash' ),
		);

	// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'quizzes'),
			'description'         => __( 'quizzes'),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_icon'           => 'dashicons-groups',
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,

		);

		// Registering your Custom Post Type
		register_post_type('quizzes', $args );
	}

	add_action( 'init', 'custom_post_type', 0 );
