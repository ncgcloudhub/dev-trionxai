<?php
/**
 * The content part - thumb.
 *
 * This is a content template part.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package king
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if ( get_field( 'nsfw_post' ) && ! is_user_logged_in() ) : ?>
<div class="nsfw-post">
	<a href="<?php echo esc_url( site_url() . '/' . $GLOBALS['king_login'] ); ?>">
		<i class="fa fa-paw fa-3x"></i>
		<div><h1><?php echo esc_html_e( 'Not Safe For Work', 'king' ); ?></h1></div>
		<span><?php echo esc_html_e( 'Click to view this post.', 'king' ); ?></span>
	</a>	
</div>
<?php else : ?> 	
	<a href="<?php the_permalink(); ?>" class="entry-image-link">
		<?php
		if ( has_post_thumbnail() ) :
			$display_option = get_field( 'select_default_display_option', 'options' );
			$attachment_id  = get_post_thumbnail_id( get_the_ID() );
			if ( 'king-grid-03' === $display_option || 'king-grid-07' === $display_option ) {
				$img = wp_get_attachment_image_src( $attachment_id, 'medium' );
			} else {
				$img = wp_get_attachment_image_src( $attachment_id, 'medium_large' );
			}
			?>
			<div class="entry-image" style="height:<?php echo esc_attr( $img[2] . 'px;' ); ?>">
				<div class="king-box-bg" data-king-img-src="<?php echo esc_url( $img[0] ); ?>"></div>
			</div>
		<?php else : ?>
			<span class="entry-no-thumb"></span>
		<?php endif; ?>
		<?php if ( get_field( 'editors_choice' ) ) : ?>
			<div class="editors-badge">
				<?php
				if ( get_field( 'editors_choice_title', 'option' ) ) {
					the_field( 'editors_choice_title', 'option' );
				} else {
					echo esc_html_e( 'Editors\' Choice', 'king' );
				}
				?>
			</div>
		<?php endif; ?>			
	</a>
<?php endif; ?>
<?php get_template_part( 'template-parts/content-templates/content-parts/content-ft' ); ?>
