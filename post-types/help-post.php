<?php

/**
 * MYBOOKING HELP CPT
 * ------------------
 *
 * @link              https://mybooking.es
 * @since             1.0.3
 * @package           Mybooking_Docs
 * @version:          1.0.0
 *
 * Description:       Custom Post Type for documentation articles focused on customers

 */


// Reject direct requests for this file
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Register Mybooking Help Custom Post Type
 *
 * @since 1.0.1
 */
function mybooking_help() {

	$labels = array(
		'name'                  => _x( 'Help', 'Post Type General Name', 'mybooking-docs' ),
		'singular_name'         => _x( 'Help', 'Post Type Singular Name', 'mybooking-docs' ),
		'menu_name'             => __( 'Mybooking Help', 'mybooking-docs' ),
		'name_admin_bar'        => __( 'Mybooking Help', 'mybooking-docs' ),
		'archives'              => __( 'Help Archives', 'mybooking-docs' ),
		'attributes'            => __( 'Help Attributes', 'mybooking-docs' ),
		'parent_item_colon'     => __( 'Parent Help:', 'mybooking-docs' ),
		'all_items'             => __( 'All Help', 'mybooking-docs' ),
		'add_new_item'          => __( 'Add New Help', 'mybooking-docs' ),
		'add_new'               => __( 'Add New', 'mybooking-docs' ),
		'new_item'              => __( 'New Help', 'mybooking-docs' ),
		'edit_item'             => __( 'Edit Help', 'mybooking-docs' ),
		'update_item'           => __( 'Update Help', 'mybooking-docs' ),
		'view_item'             => __( 'View Help', 'mybooking-docs' ),
		'view_items'            => __( 'View Help', 'mybooking-docs' ),
		'search_items'          => __( 'Search Help', 'mybooking-docs' ),
		'not_found'             => __( 'Not found', 'mybooking-docs' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'mybooking-docs' ),
		'featured_image'        => __( 'Featured Image', 'mybooking-docs' ),
		'set_featured_image'    => __( 'Set featured image', 'mybooking-docs' ),
		'remove_featured_image' => __( 'Remove featured image', 'mybooking-docs' ),
		'use_featured_image'    => __( 'Use as featured image', 'mybooking-docs' ),
		'insert_into_item'      => __( 'Insert into Help', 'mybooking-docs' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Help', 'mybooking-docs' ),
		'items_list'            => __( 'Help list', 'mybooking-docs' ),
		'items_list_navigation' => __( 'Help list navigation', 'mybooking-docs' ),
		'filter_items_list'     => __( 'Filter Help list', 'mybooking-docs' ),
	);
	$rewrite = array(
		'slug'                  => 'help',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Help', 'mybooking-docs' ),
		'description'           => __( 'Mybooking tutorial and guides.', 'mybooking-docs' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 100,
		'menu_icon'             => 'dashicons-editor-help',
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
	register_post_type( 'help', $args );

}
add_action( 'init', 'mybooking_help', 0 );


/**
 * Register taxonomies for Help CPT
 *
 * @since 1.0.2
 */
function mybooking_help_taxonomies() {
    register_taxonomy(
        'help-center',
        'help',
        array(
            'labels' => array(
                'name' 					=> __( 'Help category', 'mybooking-docs' ),
                'add_new_item' 	=> __( 'Add Help category', 'mybooking-docs' ),
                'new_item_name' => __( 'New Help category', 'mybooking-docs' )
            ),
            'show_ui' 					=> true,
						'show_in_rest' 			=> true,
						'show_admin_column' => true,
            'show_tagcloud' 		=> false,
            'hierarchical' 			=> true,

        )
    );
}
add_action( 'init', 'mybooking_help_taxonomies', 0 );


/**
 * Add templates for new taxonomies
 *
 * @since 1.0.2
 */

// Help
function mybooking_help_single_template( $single_help_template ){
 	global $post;

	if ( $post->post_type == 'help' ) {
	  $single_help_template = plugin_dir_path(__FILE__) . 'templates/single-docs.php';
	}
	return $single_help_template;
}
add_filter( 'single_template','mybooking_help_single_template' );

function mybooking_help_archives_template( $archive_help_template ){
  global $post;

  if ( $post->post_type == 'help' ) {
    $archive_help_template = plugin_dir_path(__FILE__) . 'templates/archives-docs.php';
  }
  return $archive_help_template;
}
add_filter( 'archive_template','mybooking_help_archives_template' );
