<?php

/**
 * MYBOOKING DOCS CPT
 * ------------------
 *
 * @link              https://mybooking.es
 * @since             1.0.3
 * @package           Mybooking_Docs
 * @version:          1.0.0
 *
 * Description:       Custom Post Type for documentation articles focused on developers
 */


// Reject direct requests for this file
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Register Mybooking Docs Custom Post Type
 *
 * @since 1.0.1
 */
function mybooking_docs() {

	$labels = array(
		'name'                  => _x( 'Docs', 'Post Type General Name', 'mybooking-docs' ),
		'singular_name'         => _x( 'Doc', 'Post Type Singular Name', 'mybooking-docs' ),
		'menu_name'             => __( 'Mybooking Docs', 'mybooking-docs' ),
		'name_admin_bar'        => __( 'Mybooking Doc', 'mybooking-docs' ),
		'archives'              => __( 'Doc Archives', 'mybooking-docs' ),
		'attributes'            => __( 'Doc Attributes', 'mybooking-docs' ),
		'parent_item_colon'     => __( 'Parent Doc:', 'mybooking-docs' ),
		'all_items'             => __( 'All Docs', 'mybooking-docs' ),
		'add_new_item'          => __( 'Add New Doc', 'mybooking-docs' ),
		'add_new'               => __( 'Add New', 'mybooking-docs' ),
		'new_item'              => __( 'New Doc', 'mybooking-docs' ),
		'edit_item'             => __( 'Edit Doc', 'mybooking-docs' ),
		'update_item'           => __( 'Update Doc', 'mybooking-docs' ),
		'view_item'             => __( 'View Doc', 'mybooking-docs' ),
		'view_items'            => __( 'View Docs', 'mybooking-docs' ),
		'search_items'          => __( 'Search Doc', 'mybooking-docs' ),
		'not_found'             => __( 'Not found', 'mybooking-docs' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'mybooking-docs' ),
		'featured_image'        => __( 'Featured Image', 'mybooking-docs' ),
		'set_featured_image'    => __( 'Set featured image', 'mybooking-docs' ),
		'remove_featured_image' => __( 'Remove featured image', 'mybooking-docs' ),
		'use_featured_image'    => __( 'Use as featured image', 'mybooking-docs' ),
		'insert_into_item'      => __( 'Insert into Doc', 'mybooking-docs' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Doc', 'mybooking-docs' ),
		'items_list'            => __( 'Docs list', 'mybooking-docs' ),
		'items_list_navigation' => __( 'Docs list navigation', 'mybooking-docs' ),
		'filter_items_list'     => __( 'Filter Docs list', 'mybooking-docs' ),
	);
	$rewrite = array(
		'slug'                  => 'docs',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Doc', 'mybooking-docs' ),
		'description'           => __( 'Mybooking technical articles.', 'mybooking-docs' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 100,
		'menu_icon'             => 'dashicons-editor-alignleft',
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
	register_post_type( 'docs', $args );

}
add_action( 'init', 'mybooking_docs', 0 );


/**
 * Register taxonomies for Docs CPT
 *
 * @since 1.0.2
 */
function mybooking_docs_taxonomies() {
    register_taxonomy(
        'developer-docs',
        'docs',
        array(
            'labels' => array(
                'name' 					=> __( 'Docs category', 'mybooking-docs' ),
                'add_new_item' 	=> __( 'Add Docs category', 'mybooking-docs' ),
                'new_item_name' => __( 'New Docs category', 'mybooking-docs' )
            ),
            'show_ui' 					=> true,
						'show_in_rest' 			=> true,
						'show_admin_column' => true,
            'show_tagcloud' 		=> false,
            'hierarchical' 			=> true,

        )
    );
}
add_action( 'init', 'mybooking_docs_taxonomies', 0 );


// Docs
function mybooking_docs_single_template( $single_docs_template ){
 	global $post;

	if ( $post->post_type == 'docs' ) {
	  $single_docs_template = plugin_dir_path(__FILE__) . 'templates/single-docs.php';
	}
	return $single_docs_template;
}
add_filter( 'single_template','mybooking_docs_single_template' );

function mybooking_docs_archives_template( $archive_docs_template ){
  global $post;

  if ( $post->post_type == 'docs' ) {
    $archive_docs_template = plugin_dir_path(__FILE__) . 'templates/archives-docs.php';
  }
  return $archive_docs_template;
}
add_filter( 'archive_template','mybooking_docs_archives_template' );
