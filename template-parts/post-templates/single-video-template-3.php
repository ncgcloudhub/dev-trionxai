<?php
/**
 * Sible video template-2 page.
 *
 * @package King
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="primary" class="content-area videotemplate-v3">
	<?php
	if ( get_field( 'media_lists' ) ) {
		get_template_part( 'template-parts/post-templates/single-parts/playlist' );
	} else {
		get_template_part( 'template-parts/post-templates/single-parts/video' );
	}
	?>
	<main id="main" class="site-main post-page single-video videotemplate">
		<?php if ( get_field( 'ads_above_content', 'option' ) && king_add_free_mode() ) : ?>
			<div class="ads-postpage"><?php $ad_above = get_field( 'ads_above_content','options' ); echo do_shortcode( $ad_above ); ?></div>
		<?php endif; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( get_field( 'add_sponsor' ) ) : ?>
					<div class="add-sponsor"><a href="<?php the_field( 'post_sponsor_link' ); ?>" target="_blank"><img src="<?php the_field( 'post_sponsor_logo' ); ?>" /></a><span class="sponsor-label"><?php the_field( 'post_sponsor_description' ); ?></span></div>
				<?php endif; ?>			
				<?php get_template_part( 'template-parts/post-templates/single-parts/posttitle' ); ?>
				<?php get_template_part( 'template-parts/post-templates/single-parts/badges' ); ?>
				<div class="entry-content">
					<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'king' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">',
						'after'  => '</div>',
					) );
					?>
				</div><!-- .entry-content -->
				<?php get_template_part( 'template-parts/post-templates/single-parts/nextprev' ); ?>
			</div><!-- #post-## -->
			<?php get_template_part( 'template-parts/post-templates/single-parts/single-boxes' ); ?>
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
		endif;

		endwhile; // End of the loop.
		?>
		<?php if ( get_field( 'display_related', 'options' ) ) : ?>
			<?php get_template_part( 'template-parts/related-posts' ); ?>
		<?php endif; ?>	
		<span class="remove-fixed"></span>
	</main><!-- #main -->
	<?php get_sidebar(); ?> 	

</div><!-- #primary -->
<?php get_footer(); ?>
