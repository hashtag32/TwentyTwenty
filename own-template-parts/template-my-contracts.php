<?php

/**
 * Template Name: My Contracts 
 * Template Post Type: post, page
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

	get_template_part('own-template-parts/content-my-contracts', get_post_type());

	?>

</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>