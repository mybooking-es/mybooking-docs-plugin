<?php

/**
 * MYBOOKING DOCS PLUGIN
 * ---------------------
 *
 * @link              https://mybooking.es
 * @since             1.0.0
 * @package           Mybooking_Docs
 *
 * @wordpress-plugin
 * Plugin Name:       Mybooking Docs
 * Plugin URI:        https://mybooking.es
 * Description:       Simple plugin to create a Custom Post Types for Mybooking's documentation
 * Version:           1.0.3
 * Author:            Mybooking Team
 * Author URI:        https://mybooking.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mybooking-docs
 * Domain Path:       /languages
 */


// Reject direct requests for this file
if ( ! defined( 'WPINC' ) ) { die; }


function mybooking_docs_css( ) {
	wp_register_style(
		'style',
		plugins_url( '/style.css', __FILE__ )
	);
	wp_enqueue_style(
	 'style',
	 plugin_dir_url( __FILE__ ) . 'style.css'
	);
}
add_action( 'wp_enqueue_scripts', 'mybooking_docs_css' );


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



/**
 * Create sidebars for templates
 *
 * @since 1.0.2
 */
function mybooking_docs_sidebars() {
    register_sidebar( array(
        'name'          => __( 'Mybooking Docs sidebar Top', 'mybooking-docs' ),
        'id'            => 'sidebar-top',
        'description'   => __( 'Widgets in this area will be shown on all docs pages and posts.', 'mybooking-docs' ),
        'before_widget' => '<div id="%1$s" class="mybooking-docs_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-docs_widget-title">',
        'after_title'   => '</h2>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Mybooking Docs sidebar bottom', 'mybooking-docs' ),
        'id'            => 'sidebar-bottom',
        'description'   => __( 'Widgets in this area will be shown on all docs pages and posts.', 'mybooking-docs' ),
        'before_widget' => '<div id="%1$s" class="mybooking-docs_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-docs_widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'mybooking_docs_sidebars' );


/**
 * Generate breadcrumbs
 *
 * @since 1.0.2
 * @see https://wordpress.stackexchange.com/a/221476
 *
 * Usage: <?php echo mybooking_breadcrumbs(); ?>
 */
function mybooking_breadcrumbs()
{
    // Set variables for later use
    $here_text        = '';
    $home_link        = home_url('/');
    $home_text        = __( 'Home' );
    $link_before      = '<span typeof="v:Breadcrumb">';
    $link_after       = '</span>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a class="mybooking-breadcrumb_item"' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = ' ⟶ ';              // Delimiter between crumbs
    $before           = '<span class="mybooking-breadcrumb_item current">'; // Tag before the current crumb
    $after            = '</span>';                // Tag after the current crumb
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';

    /**
     * Set our own $wp_the_query variable. Do not use the global variable version due to
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() )
    {
        /**
         * Set our own $post variable. Do not use the global variable version due to
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );

        // Set variables
        $title          = apply_filters( 'the_title', $post_object->post_title );
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';

        if ( 'post' === $post_type )
        {
            // Get the post categories
            $categories = get_the_category( $post_id );
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];

                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a class="mybooking-breadcrumb_item"',   $link_before . '<a class="mybooking-breadcrumb_item"' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
            }
        }

        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) )
        {
            $post_type_object = get_post_type_object( $post_type );
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );

            $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
        }

        // Get post parents if $parent !== 0
        if ( 0 !== $parent )
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );

                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse( $parent_links );

            $parent_string = implode( $delimiter, $parent_links );
        }

        // Lets build the breadcrumb trail
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }

        if ( $post_type_link )
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

        if ( $category_links )
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() )
    {
        if (    is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
            $parent_term_string = '';

            if ( 0 !== $term_parent )
            {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );

                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                    $term_parent = $term->parent;
                }

                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }

            if ( $parent_term_string ) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }

        } elseif ( is_author() ) {

            $breadcrumb_trail = __( 'Author archive for ') .  $before . $queried_object->data->display_name . $after;

        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }

            if ( is_year() ) {

                $breadcrumb_trail = $before . $year . $after;

            } elseif( is_month() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

            } elseif( is_day() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }

        } elseif ( is_post_type_archive() ) {

            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

        }
    }

    // Handle the search page
    if ( is_search() ) {
        $breadcrumb_trail = __( 'Search query for: ' ) . $before . get_search_query() . $after;
    }

    // Handle 404's
    if ( is_404() ) {
        $breadcrumb_trail = $before . __( 'Error 404' ) . $after;
    }

    // Handle paged pages
    if ( is_paged() ) {
        $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
        $page_addon   = $before . sprintf( __( ' ( Page %s )' ), number_format_i18n( $current_page ) ) . $after;
    }

    $breadcrumb_output_link  = '';
    $breadcrumb_output_link .= '<div class="mybooking-breadcrumb">';
    if (    is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if ( is_paged() ) {
            $breadcrumb_output_link .= $here_text;
            $breadcrumb_output_link .= '<a class="mybooking-breadcrumb_item" href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        $breadcrumb_output_link .= $here_text;
        $breadcrumb_output_link .= '<a class="mybooking-breadcrumb_item" href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</div><!-- .breadcrumbs -->';

    return $breadcrumb_output_link;
}
