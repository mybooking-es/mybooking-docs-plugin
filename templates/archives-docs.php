<?php
/**
*		MAIN INDEX PAGE
*  	---------------
*
* 	@version 0.0.8
*   @package WordPress
*   @subpackage Mybooking WordPress Theme
*   @since Mybooking WordPress Theme 0.1.2
*
*   CHANGELOG
*   Version 0.0.5
*   - Deleted deprecated Understrap's hero section
*		Version 0.0.6
*		- Deleted .wrapper #wrapper-index and #content
*		- Deleted old hook calling Understrap's no-content partial
*		- Added right sidebar
*		- Added pagination hook
*		- Added no-content message
*		Version 0.0.7
*		- Template part route updated
*		V3rsion 0.0.8
*		- Moved sidebar to sidebar.php
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="page_content mybooking-docs">
	<div class="container" id="content" tabindex="-1">

		<div class="row">
			<!-- Page Header -->
			<div class="col-md-12">
				<div class="entry-header">
					<h1 class="mybooking-docs_page-title"><?php echo __('Mybooking Help Center', 'mybooking-docs') ?></h1>
					<hr>
					<div class="col-md-8 offset-md-2">
						<form role="search" method="get" id="searchform" action="#">
							<div class="mybooking-docs_search">
								<input class="mybooking-docs_search-field" type="text" value="" name="s" id="s" placeholder="Buscar" />
								<input type="hidden" value="1" name="sentence" />
								<input type="hidden" value="help" name="post_type" />
								<input type="hidden" value="docs" name="post_type" />
								<input class="mybooking-docs_search-button" type="submit" id="searchsubmit" value="Buscar" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>	


		<div class="row">

			<!-- Navigation -->
			<div class="col-md-3">

				<!-- Widgets top -->
				<?php if ( is_active_sidebar( 'sidebar-top' ) ) { ?>
					<div class="mybooking-docs_widget-area">
						 <?php dynamic_sidebar('sidebar-top'); ?>
					</div>
				<?php } ?>

				<div class="mybooking-docs_categories">
					<div class="col-lg-12">

						<!-- Help categories -->
						<h3 class="mybooking-docs_categories-title">
							<span class="dashicons dashicons-editor-help"></span>
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
					<div class="col-lg-12">

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

				<!-- Widgets bottom -->
				<?php if ( is_active_sidebar( 'sidebar-bottom' ) ) { ?>
					<div class="mybooking-docs_widget-area">
						 <?php dynamic_sidebar('sidebar-bottom'); ?>
					</div>
				<?php } ?>
			</div>


			<!-- Articles -->
			<div class="col-md-9">

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
							<?php $mybooking_permalink = get_permalink(); ?>

							<!-- Card header -->
							<div class="mb-card">
								<div class="mb-card_body">

									<!-- Categories -->
									<div class="mybooking-docs_post-category">
										<?php if ( get_post_type( get_the_ID() ) == 'help' ) {
											$help_taxonomy = get_the_terms( get_the_ID(), 'help-center' );
											foreach ( $help_taxonomy as $help_tax ) { ?>
												<span class="mybooking-docs_post-category-item"><?php echo esc_html( $help_tax->name ); ?></span>
											<?php }

										} elseif ( get_post_type( get_the_ID() ) == 'docs' ) {
											$docs_taxonomy = get_the_terms( get_the_ID(), 'developer-docs' );
											foreach ( $docs_taxonomy as $docs_tax ) { ?>
												<span class="mybooking-docs_post-category-item"><?php echo esc_html( $docs_tax->name ); ?></span>
											<?php }
										} ?>
									</div>

									<?php if ( !empty( get_the_title() ) ) { ?>
										<?php the_title( sprintf( '<h2 class="mybooking-docs_post-title"><a href="%s" rel="bookmark" class="mybooking-docs_post-title-link">', esc_url( $mybooking_permalink ) ), '</a></h2>' ); ?>

									<?php } else { ?>
										<?php $mybooking_allowed_html = array(
											'a' => array(
												'href' => array(),
												'rel' => array(),
												'class' => array()
											) ) ?>

										<h2 class="mybooking-docs_post-title">
											<?php echo wp_kses( sprintf( _x('<a href="%s" rel="bookmark" class="mybooking-docs_post-title-link untitled">Untitled</a>', 'content_blog', 'mybooking'), esc_url( $mybooking_permalink ) ), $mybooking_allowed_html ); ?>
										</h2>
									<?php } ?>

									<?php the_excerpt() ?>

									<br>

									<!-- Read more -->
									<a class="mybooking-docs_post-link" href="<?php the_permalink(); ?>"><?php echo __( 'Read More','mybooking-docs' ); ?> <span class="dashicons dashicons-arrow-right-alt"></span></a>

								</div>
							</div>
						</article>

					<?php endwhile; ?>

				<!-- No content -->
				<?php else : ?>
					<h3><?php echo esc_html_x( 'No content found. Please publish at least one post to show something at here', 'blog_message', 'mybooking' ); ?></h3>
				<?php endif; ?>

				<!-- Pagination -->
				<div class="mb-col-md-12">
					<?php get_template_part( 'mybooking-parts/blog/mybooking-pagination' ); ?>
				</div>
			</div>

		</div>
	</div>
</div>

<?php get_footer();
