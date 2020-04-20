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
				
				<?php foreach (getMostVotedStocks(10) as $symbol){ ?> 
					<div class="voting-table"> <!-- Stock Overview -->
						<a href="https://stockvoting.net/category/stocks/<?php echo $symbol?>/">
							<h2 class="has-text-align-center"><?php echo getStockName($symbol)?></h2>
						</a>
						<!-- Stock Overview Table -->
						<div class="wp-block-columns alignwide has-background has-text-color has-background-background-color has-secondary-color" >
							<div class="wp-block-column"> <!-- Prognosis -->
								<h2 class="vote-span has-text-align-center">In 30 days (Prognosis)</h2> 
								<h2 class="has-accent-color has-text-color has-text-align-center prognosis-text" id="prognosis_<?php echo $symbol?>">
									<?php echo getVoting($symbol) ?> $
								</h2>
							</div>
							<div class="wp-block-column"> <!-- Opinion Block -->
								<h2 class="vote-span has-text-align-center" >StockVoter's opinion</h2> 
								<div class="radial-gauge-class" id="gaugeID_<?php echo $symbol?>" >
									<canvas 
										class="radial-gauge-canvas"
										data-type="radial-gauge" 
										data-title="false"
										data-value="<?php echo getStockDiff($symbol, getVoting($symbol))  ?>"
										data-min-value="-30"
										data-max-value="30"
										data-major-ticks="-30,-25,-20,-15,-10,-5,5,10,15,20,25,30"
										data-minor-ticks="2"
										data-stroke-ticks="false"
										data-highlights='[
										{ "from": -30, "to": -15, "color": "rgba(255, 0, 0,0.25)" },
										{ "from": -15, "to": -5, "color": "rgba(255,0,0,.75)" },
										{ "from": -5, "to": 5, "color": "rgba(255,255,0,.75)" },
										{ "from": 5, "to": 15, "color": "rgba(0,255,0,0.75)" },
										{ "from": 15, "to": 30, "color": "rgba(0,255,0,0.25)" }
											]'
										data-color-plate="#222"
										data-color-major-ticks="#f5f5f5"
										data-color-minor-ticks="#ddd"
										data-color-title="#fff"
										data-color-units="#ccc"
										data-color-numbers="#eee"
										data-color-needle-start="rgba(240, 128, 128, 1)"
										data-color-needle-end="rgba(255, 160, 122, .9)"
										data-value-box="true"
										data-animation-rule="elastic"
										data-animation-duration="1500"
										data-font-value="Led"
										data-animated-value="true"
										data-units="%"
										animateOnInit="false"
										animatedValue="150"
										style="position:relative;width: 100%;height:100%;box-sizing: border-box;  ">
									</canvas>
								</div> <!-- Gauge -->
							</div>  <!-- Opinion Block-->
						</div> <!-- Stock Overview Table-->
						<form name="vote_form" method="post" >
							<input type="number" value="<?php echo getStockValue($symbol)?>" id="voting_input_<?php echo $symbol ?>" class="voting_input" />
							<input 
								type="button" 
								class="button-voting"
								onclick="send_vote(this,'<?php echo $symbol ?>',voting_input_<?php echo $symbol ?>.value)"
								value="Vote" 
								alt="Thank you!"/>
						</form>
						<br/></br>
					</div> <!-- Stock Overview -->
					<!-- todo: insert button Vote here -> just link to  -->
				<?php }?>

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