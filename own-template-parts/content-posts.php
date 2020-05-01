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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php $heading=is_search() ? 'Articles' : 'Analysis'; ?>

<header class="entry-header has-text-align-center header-footer-group">

<div class="entry-header-inner section-inner medium">
	<h1 class="entry-title"><?php echo $heading?></h1>
</div><!-- .entry-header-inner -->

</header>


<!-- List all articles -->
<?php
while ( have_posts() ) {
	?>
	<div class="wp-block-columns"><!-- wp:column {"className":"analysis-column"} -->
	
		<div class="wp-block-column analysis-column-left">
			<?php
			the_post();
			get_template_part( 'own-template-parts/content-analysis', get_post_type() );
			?>
		</div>

		<div class="wp-block-column analysis-column-right">
			<?php
			the_post();
			get_template_part( 'own-template-parts/content-analysis', get_post_type() );
			?>
		</div>
	</div>
	<hr class="post-separator styled-separator   has-accent-color is-style-wide section-inner" aria-hidden="true" />
<?php
}

// Add your Analysis
get_template_part('small-parts/add-button');
?>

</article>
