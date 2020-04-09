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

<header class="entry-header has-text-align-center header-footer-group">

<div class="entry-header-inner section-inner medium">

	<h1 class="entry-title">Analysis</h1>
</div><!-- .entry-header-inner -->

</header>
</article>


<!-- List all articles -->
<?php

$i = 0;
while ( have_posts() ) {
	?>
	<div class="wp-block-columns"><!-- wp:column {"className":"analysis-column"} -->
	
		<div class="wp-block-column analysis-column-left">

		<?php
		$i++;
		if ( $i > 1 ) {
			// echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
		}
		the_post();
		get_template_part( 'own-template-parts/content-analysis', get_post_type() );
		?>
		</div>


		<div class="wp-block-column analysis-column-right">

		<?php
		$i++;
		if ( $i > 1 ) {
			// echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
		}
		the_post();
		get_template_part( 'own-template-parts/content-analysis', get_post_type() );
		?>
		</div>
	</div>
	<hr class="post-separator styled-separator   has-accent-color is-style-wide section-inner" aria-hidden="true" />
<?php
}
?>