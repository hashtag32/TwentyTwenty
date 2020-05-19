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

<script src="https://use.fontawesome.com/f2103e8f69.js"></script>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part('template-parts/entry-header');

	if (!is_search()) {
		get_template_part('template-parts/featured-image');
	}

	?>

<!-- todo: Improve on mobile -->
<div style="position: fixed; top: 0;width: 100%; height: 100%; z-index: -1;">
    <video autoplay muted loop id="myVideo">
		<source src="https://www.videvo.net/videvo_files/converted/2013_05/preview/BinaryNumbers1AlphaMatteVidevo.mov37560.webm" type="video/mp4">
	</video>
</div>
	

	<div class="post-inner">
		<div class="entry-content">
			<div class="wp-block-columns"><!-- ggf. alignwide? -->
				<div class="wp-block-column">

					<!-- My Votings -->
					<div class="bordered-area">
						<a href="https://stockvoting.net/my-data/my-votings">
							<span class="fill-div-with-link"></span>
						</a> 
						<h2 class="has-accent-color has-text-align-center ">My Votings</h2>
						<p class="has-large-font-size">
							Keep track of your votings and build your prediction score.
						</p>
					</div><!-- bordered-area -->

					<hr class="post-separator styled-separator   has-accent-color is-style-wide section-inner" aria-hidden="true" />

					<!--My Contracts -->
					<div class="bordered-area">
						<a href="https://stockvoting.net/my-data/my-contracts">
							<span class="fill-div-with-link"></span>
						</a> 
					
						<h2 class="has-accent-color has-text-align-center ">My Contracts</h2>
						<p class="has-large-font-size">
							Display your bought contracts to oversee your performance
						</p>
					</div><!-- bordered-area -->
				</div><!-- /wp:column -->
			</div><!-- /wp:column -->
			
		</div><!-- /wp:entry-content -->
	</div><!-- /wp:post-inner -->

</article><!-- .post --> 

