<?php

/**
 * Template Name: Subcategory template
 * Template Post Type:  page
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0 
 */

get_header();

?>

<main id="site-content" role="main">

<?php

get_template_part( 'own-template-parts/content-category' );

if ( have_posts() ) {
	// Go to the analysis site
	get_template_part( 'own-template-parts/content-posts' );
} 

?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
