<?php

/**
 * Template Name: Pricing Template
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
get_template_part('template-parts/entry-header');
if (!is_search()) {
	get_template_part('template-parts/featured-image');
}

get_template_part('own-template-parts/content-pricing', get_post_type());
get_template_part('template-parts/footer-menus-widgets'); 

get_footer();
