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

//  Templates
include("voting_template.html");

?>
<script type="text/javascript" src="https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/third-party/canvas-gauges/gauge.min.js"></script>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php

	get_template_part('template-parts/entry-header');

	if (!is_search()) {
		get_template_part('template-parts/featured-image');
	}
	?>

	<div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php
			// copy value from 
			if (is_search() || !is_singular() && 'summary' === get_theme_mod('blog_content', 'full')) {
				the_excerpt();
			} else {
				the_content(__('Continue reading', 'twentytwenty'));
			}
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner" id="section-inner">
		<!-- Table of columns -->
		<div class="wp-block-columns"><!-- ggf. alignwide? -->
			<!-- First block Most voted -->
			<div class="wp-block-column">
				<h2 class="has-text-color has-text-align-center">Most voted</h2>
				
				<?php
				foreach (getMostVotedStocks(10) as $symbol)
				{
					set_query_var('symbol', $symbol);
					get_template_part('own-template-parts/part', 'stock-overview');
					 
				}
				?>  

			</div><!-- /wp:column -->
			<div class="wp-block-column"> 
				<h2 class="has-text-color has-text-align-center">Highest confidence</h2> <!-- Second column -->
				<!-- Abstrahieren -> nicht zweimal gleiche Stock Overview -->


			</div><!-- /wp:column -->
		</div><!-- /wp:columns -->
	</div><!-- .section-inner -->
	
	
	<?php
	if (is_single()) {
		get_template_part('template-parts/navigation');
	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
	?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

	<?php
	}
	?>

</article><!-- .post -->

<style>
input[type=button] {
  transition: all 0.5s;
  position: relative;
  border-radius: 10px;
  background-color: #5179BB;
}
</style>