<?php

/**
 * Displays the content when the cover template is used.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
	// On the cover page template, output the cover header.
	$cover_header_style   = '';
	$cover_header_classes = '';

	$color_overlay_style   = '';
	$color_overlay_classes = '';

	$image_url = !post_password_required() ? get_the_post_thumbnail_url(get_the_ID(), 'twentytwenty-fullscreen') : '';

	if ($image_url) {
		$cover_header_style   = ' style="background-image: url( ' . esc_url($image_url) . ' );"';
		$cover_header_classes = ' bg-image';
	}

	// Get the color used for the color overlay.
	$color_overlay_color = get_theme_mod('cover_template_overlay_background_color');
	if ($color_overlay_color) {
		$color_overlay_style = ' style="color: ' . esc_attr($color_overlay_color) . ';"';
	} else {
		$color_overlay_style = '';
	}

	// Get the fixed background attachment option.
	if (get_theme_mod('cover_template_fixed_background', true)) {
		$cover_header_classes .= ' bg-attachment-fixed';
	}

	// Get the opacity of the color overlay.
	$color_overlay_opacity  = get_theme_mod('cover_template_overlay_opacity');
	$color_overlay_opacity  = (false === $color_overlay_opacity) ? 80 : $color_overlay_opacity;
	$color_overlay_classes .= ' opacity-' . $color_overlay_opacity;

	// Background cover
	get_template_part('small-parts/background-cover');
	
	?>

	<div class="post-inner" id="post-inner">

		<div class="entry-content">

			<?php
			the_content();
			?>

		</div><!-- .entry-content -->
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__('Page', 'twentytwenty') . '"><span class="label">' . __('Pages:', 'twentytwenty') . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();
		// Single bottom post meta.
		twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');

		if (is_single()) {

			get_template_part('template-parts/entry-author-bio');
		}
		?>

	</div><!-- .post-inner -->

	<?php

	if (is_single()) {

		get_template_part('template-parts/navigation');
	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
	?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

	<?php
	}
	?>

</article><!-- .post -->