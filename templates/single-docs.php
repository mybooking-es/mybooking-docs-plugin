<?php
/**
*		SINGLE HELP POST
*  	----------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking Docs Plugin
*   @since 1.0.2
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div id="content">
	<?php while ( have_posts() ) : the_post(); ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    	<div class="post_content mybooking-docs">
    		<div class="container" tabindex="-1">
    			<div class="row">

    				<div class="col-md-10 offset-md-1">

							<?php echo mybooking_breadcrumbs(); ?>

							<!-- Header -->
							<?php if ( empty( get_the_title() ) ) { ?>
								<h1 class="mybooking-docs_post-header untitled">
									<?php echo esc_html_x('Untitled', 'content_blog', 'mybooking'); ?>
								</h1>

							<?php } else { ?>
								<h1 class="mybooking-docs_post-header"><?php the_title(); ?></h1>
							<?php } ?>

							<p class="post_meta"><?php echo wp_kses_post( mybooking_posted_on() ); ?></p>

							<!-- Content -->
    					<div class="entry-content">
    					  <?php the_content(); ?>
    				  </div>

							<!-- Categories navigation -->

							<div class="mybooking-docs_footer-nav">
								<div class="col-md-6">

									<!-- Help categories -->
									<h3 class="mybooking-docs_categories-title">
										<span class="dashicons dashicons-welcome-learn-more"></span>
										<?php echo __('Soporte', 'mybooking-docs') ?>
									</h3>

									<ul class="mybooking-docs_categories-list">

										<?php
											$help_taxonomies = get_object_taxonomies( 'help' );
											if( count( $help_taxonomies ) > 0 ) {
												foreach( $help_taxonomies as $tax ) {
													$args = array(
															 'orderby' => 'name',
															 'show_count' => 0,
															 'pad_counts' => 0,
															 'hierarchical' => 1,
															 'show_option_all' => __( 'Ver todo','mybooking-docs' ),
															 'taxonomy' => $tax,
															 'title_li' => ''
														 );
													wp_list_categories( $args );
												}
											}
										?>
									</ul>
								</div>

								<div class="col-md-6">

									<!-- Docs categories -->
									<h3 class="mybooking-docs_categories-title">
										<span class="dashicons dashicons-editor-code"></span>
										<?php echo __('Developer', 'mybooking-docs') ?>
									</h3>

									<ul class="mybooking-docs_categories-list">

										<?php
											$docs_taxonomies = get_object_taxonomies( 'docs' );
											if( count( $docs_taxonomies ) > 0 ) {
												foreach( $docs_taxonomies as $taxonomies ) {
													$args = array(
															 'orderby' => 'name',
															 'show_count' => 0,
															 'pad_counts' => 0,
															 'hierarchical' => 1,
															 'show_option_all' => __( 'Ver todo','mybooking-docs' ),
															 'taxonomy' => $taxonomies,
															 'title_li' => ''
														 );
													wp_list_categories( $args );
												}
											}
										?>
									</ul>
								</div>
							</div>

							<!-- Link pages -->
          		<?php
          		wp_link_pages(
          			array(
          				'before' => '<div class="mybooking-entry-links">' . esc_html_x( 'Pages', 'pages_navigation', 'mybooking' ),
          				'after'  => '</div>',
          			)
          		);
          		?>

          		<!-- Footer -->
    					<footer class="entry-footer">
    						<?php mybooking_entry_footer(); ?>
    					</footer>
    				</div>

    			</div>
    		</div>
    		<!-- Posts navigation -->
    		<?php mybooking_post_nav(); ?>
    	</div>
    </article>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; ?>
</div>

<?php get_footer();
