<?php

/**
 * Template Name: Special Offer Page
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<script src="https://use.fontawesome.com/f2103e8f69.js"></script>


<main id="site-content" role="main">

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php
		get_template_part('template-parts/entry-header');

		if (!is_search()) {
			get_template_part('template-parts/featured-image');
		}
		?>

		<div class="post-inner">
			<div class="entry-content">
				<div class="wp-block-columns">
					<!-- ggf. alignwide? -->
					<div class="wp-block-column">
						<!-- Stock Betting -->
						<div class="bordered-area" style="background-color:#d4e9fd">
							<a href="https://stockvoting.net/specials/get-10-for-your-first-certificate-emitted/">
								<span class="fill-div-with-link"></span>
							</a>
							<h2 class="has-accent-color has-text-align-center ">Obtain 10$ for your first emitted certificate</h2>
						</div><!-- bordered-area -->
						<hr class="post-separator styled-separator   has-accent-color is-style-wide section-inner" aria-hidden="true" />

					</div><!-- /wp:column -->
				</div><!-- /wp:column -->
				<div class="wp-block-columns">
					<div class="wp-block-column">
						<!-- Stock Betting -->
						<div class="bordered-area" style="background-color:#d4e9fd">
							<a href="https://stockvoting.net/specials/get-free-chromecast/">
								<span class="fill-div-with-link"></span>
							</a>
							<h2 class="has-accent-color has-text-align-center ">Get a chromecast for free</h2>
						</div><!-- bordered-area -->

					</div><!-- /wp:column -->
				</div><!-- /wp:column -->

			</div><!-- /wp:entry-content -->
		</div><!-- /wp:post-inner -->

	</article><!-- .post -->






</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php get_footer(); ?>