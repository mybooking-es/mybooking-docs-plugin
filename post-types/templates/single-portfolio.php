<?php
/**
*		SINGLE PORTFOLIO POST
*  	---------------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking Docs Plugin
*   @since 1.0.6
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

    				<div class="mb-col-md-12 col-md-12">

							<!-- Header -->
							<?php if ( empty( get_the_title() ) ) { ?>
								<h1 class="mybooking-docs_post-header untitled">
									<?php echo esc_html_x('Untitled', 'content_blog', 'mybooking'); ?>
								</h1>

							<?php } else { ?>
								<h1 class="mybooking-docs_post-header"><?php the_title(); ?></h1>
							<?php } ?>

							<!-- Content -->
    					<div class="entry-content">
    					  <?php the_content(); ?>
    				  </div>

							<!-- Footer -->
							<div class="mybooking-docs_footer-nav">

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
