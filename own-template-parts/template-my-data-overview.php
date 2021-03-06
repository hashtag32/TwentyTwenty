<?php

/**
 * Template Name: My Data Overview
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0 
 */

get_header();
?>

<main id="site-content" role="main">

	<?php

	get_template_part('own-template-parts/content-my-data-overview', get_post_type());

	?>
	
</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>