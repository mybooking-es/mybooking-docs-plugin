<?php

/**
 * MYBOOKING PORTFOLIO CPT
 * -----------------------
 *
 * @link              https://mybooking.es
 * @since             1.0.3
 * @package           Mybooking_Docs
 * @version:          1.0.0
 *
 * Description:       Custom Post Type for portfolio articles
 */


// Reject direct requests for this file
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Register Mybooking Portfolio Custom Post Type
 *
 * @since 1.0.1
 */
function mybooking_portfolio() {

	$labels = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'mybooking-docs' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'mybooking-docs' ),
		'menu_name'             => __( 'Mybooking Portfolio', 'mybooking-docs' ),
		'name_admin_bar'        => __( 'Mybooking Portfolio', 'mybooking-docs' ),
		'archives'              => __( 'Portfolio Archives', 'mybooking-docs' ),
		'attributes'            => __( 'Portfolio Attributes', 'mybooking-docs' ),
		'parent_item_colon'     => __( 'Parent Portfolio:', 'mybooking-docs' ),
		'all_items'             => __( 'All Portfolio', 'mybooking-docs' ),
		'add_new_item'          => __( 'Add New Portfolio', 'mybooking-docs' ),
		'add_new'               => __( 'Add New', 'mybooking-docs' ),
		'new_item'              => __( 'New Portfolio', 'mybooking-docs' ),
		'edit_item'             => __( 'Edit Portfolio', 'mybooking-docs' ),
		'update_item'           => __( 'Update Portfolio', 'mybooking-docs' ),
		'view_item'             => __( 'View Portfolio', 'mybooking-docs' ),
		'view_items'            => __( 'View Portfolio', 'mybooking-docs' ),
		'search_items'          => __( 'Search Portfolio', 'mybooking-docs' ),
		'not_found'             => __( 'Not found', 'mybooking-docs' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'mybooking-docs' ),
		'featured_image'        => __( 'Featured Image', 'mybooking-docs' ),
		'set_featured_image'    => __( 'Set featured image', 'mybooking-docs' ),
		'remove_featured_image' => __( 'Remove featured image', 'mybooking-docs' ),
		'use_featured_image'    => __( 'Use as featured image', 'mybooking-docs' ),
		'insert_into_item'      => __( 'Insert into Portfolio', 'mybooking-docs' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'mybooking-docs' ),
		'items_list'            => __( 'Portfolio list', 'mybooking-docs' ),
		'items_list_navigation' => __( 'Portfolio list navigation', 'mybooking-docs' ),
		'filter_items_list'     => __( 'Filter Portfolio list', 'mybooking-docs' ),
	);
	$rewrite = array(
		'slug'                  => 'portfolio-showroom',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'mybooking-docs' ),
		'description'           => __( 'Mybooking tutorial and guides.', 'mybooking-docs' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 100,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'mybooking_portfolio', 0 );


/**
 * Register taxonomies for Portfolio CPT
 *
 * @since 1.0.2
 */
function mybooking_portfolio_taxonomies() {
    register_taxonomy(
        'portfolio-items',
        'portfolio',
        array(
            'labels' => array(
                'name' 					=> __( 'Portfolio category', 'mybooking-docs' ),
                'add_new_item' 	=> __( 'Add Portfolio category', 'mybooking-docs' ),
                'new_item_name' => __( 'New Portfolio category', 'mybooking-docs' )
            ),
            'show_ui' 					=> true,
						'show_in_rest' 			=> true,
						'show_admin_column' => true,
            'show_tagcloud' 		=> false,
            'hierarchical' 			=> true,

        )
    );
}
add_action( 'init', 'mybooking_portfolio_taxonomies', 0 );


/**
 * Add templates for new taxonomies
 *
 * @since 1.0.2
 */

// Help
function mybooking_portfolio_single_template( $single_portfolio_template ){
 	global $post;

	if ( $post->post_type == 'portfolio' ) {
	  $single_portfolio_template = plugin_dir_path(__FILE__) . 'templates/single-portfolio.php';
	}
	return $single_portfolio_template;
}
add_filter( 'single_template','mybooking_portfolio_single_template' );
