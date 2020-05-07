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

<header class="archive-header has-text-align-center header-footer-group">
<div class="archive-header-inner section-inner medium">
	<?php if ( $archive_title ) { ?>
		<h2 class="category-title"><?php echo single_cat_title( '', false ); ?></h2>
	<?php } ?>
</div><!-- .archive-header-inner -->
</header><!-- .archive-header -->
<!-- Stocks are handled in subcategory.php -->

<?php
	if ( have_posts() ) {
		// Go to the analysis site
		get_template_part( 'own-template-parts/content-posts' );
	} 
?>
