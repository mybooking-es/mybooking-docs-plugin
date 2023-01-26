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
    			<div class="mb-row row">

    				<div class="mb-col-md-10 col-md-12 mb-col-center">

							<?php echo mybooking_breadcrumbs(); ?>

							<!-- Header -->
							<?php if ( empty( get_the_title() ) ) { ?>
								<h1 class="mybooking-docs_post-header untitled">
									<?php echo esc_html_x('Untitled', 'content_blog', 'mybooking'); ?>
								</h1>

							<?php } else { ?>
								<h1 class="mybooking-docs_post-header"><?php the_title(); ?></h1>
							<?php } ?>

							<div class="mybooking-docs_post-info">

								<!-- Categories -->
								<div class="mybooking-docs_card-category">
									<?php if ( get_post_type( get_the_ID() ) == 'help' ) {
										$help_taxonomy = get_the_terms( get_the_ID(), 'help-center' );
										foreach ( $help_taxonomy as $help_tax ) { ?>
											<span class="mybooking-docs_card-category-item"><?php echo esc_html( $help_tax->name ); ?></span>
										<?php }

									} elseif ( get_post_type( get_the_ID() ) == 'docs' ) {
										$docs_taxonomy = get_the_terms( get_the_ID(), 'developer-docs' );
										foreach ( $docs_taxonomy as $docs_tax ) { ?>
											<span class="mybooking-docs_card-category-item"><?php echo esc_html( $docs_tax->name ); ?></span>
										<?php }
									} ?>
								</div>

								<!-- Post meta -->
								<p class="post_meta"><?php echo wp_kses_post( mybooking_posted_on() ); ?></p>
							</div>

							<!-- Content -->
    					<div class="entry-content">
    					  <?php the_content(); ?>
    				  </div>

							<!-- Post pages numbers -->
          		<?php
          		wp_link_pages(
          			array(
									'next_or_number'	=> 'next',
									'nextpagelink'		=> __( 'Página siguiente &raquo', 'mybooking-docs' ),
									'previouspagelink'	=> __( '&laquo Página anterior', 'mybooking-docs' ),
          			)
          		);
          		?>

							<!-- Categories navigation -->

							<div class="mybooking-docs_footer-nav mb-row row">
								<div class="mb-col-md-6 col-md-6">

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

								<div class="mb-col-md-6 col-md-6">

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
