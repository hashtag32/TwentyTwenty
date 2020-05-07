<?php

/**
 * Template Name: Analysis Template
 * Template Post Type: post, page
 *
 * Currently not working, analysis page is displayed through the Posts Page under Reading
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<?php 
	// the query
	$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>

<main id="site-content" role="main">
 
	<?php
	if ( $wpb_all_query->have_posts() ) {

		$i = 0;

		while ( $wpb_all_query->have_posts() ) {
			$i++;

			if ( $i > 1 ) {
				echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
			}
			$wpb_all_query->the_post();
			// get_template_part( 'template-parts/content', get_post_type() );
			// echo get_post_type( the_ID() );

			set_query_var( 'user_id', get_the_ID());
			get_template_part( 'own-template-parts/content-analysis', get_post_type() );

		}
	}
	?> 


<?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
?>
