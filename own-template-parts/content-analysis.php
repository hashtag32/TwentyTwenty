<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article style="background-color:white" <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="has-text-align-center voting-card-header">
		<a href="<?php echo esc_url(get_permalink(get_the_ID())) ?>/">
			<span class="fill-div-with-link"></span>
		</a>
		<span><?php the_title('<h2 style="font-size:30px">', '</h2>'); ?></span>
	</header>

	<?php get_template_part('template-parts/featured-image'); ?>

	<div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?> ">
		<div class="entry-content analysis-entry-content">
			<?php echo '<a href=' . esc_url(get_permalink(get_the_ID())) . '>';	?>
			<?php the_excerpt(); ?>
			</a>
		</div>
	</div>

	<div class="section-inner">
		<?php
		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');
		?>
	</div><!-- .section-inner -->

</article><!-- .post -->