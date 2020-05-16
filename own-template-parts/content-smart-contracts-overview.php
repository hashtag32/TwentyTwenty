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

<div style="position: fixed; top: 0; width: 100%; height: 100%; z-index: -1;">
    <video autoplay muted loop id="myVideo">
		<source src="https://www.videvo.net/videvo_files/converted/2013_05/preview/BinaryNumbers1AlphaMatteVidevo.mov37560.webm" type="video/mp4">
	</video>
</div>
	

	<div class="post-inner">
		<div class="entry-content">
			<div class="wp-block-columns"><!-- ggf. alignwide? -->
				<div class="wp-block-column">

					<!-- Bet against a friend -->
					<div class="bordered-area">
						<a href="https://stockvoting.net/smart-contracts/betting-against-a-friend">
							<span class="fill-div-with-link"></span>
						</a> 
						<h2 class="has-accent-color has-text-align-center ">Bet against a friend</h2>
						<p class="has-large-font-size">
							Bet against your friend through a modern blockchain technology service.
							Using MetaMask, you can chose to either bet on the Testnetwork or bet for real money.
						</p>
					</div><!-- bordered-area -->
					<hr class="post-separator styled-separator   has-accent-color is-style-wide section-inner" aria-hidden="true" />

					<!-- Knock Out Certificate -->
					<div class="bordered-area">
						<a href="https://stockvoting.net/smart-contracts/knock-out">
							<span class="fill-div-with-link"></span>
						</a> 
					
						<h2 class="has-accent-color has-text-align-center ">Knock Out</h2>
						<p class="has-large-font-size">
							This contract is equivalent to an ordinary knock out certificate from your emittent bank. 
							For only a small transaction fee, you can use it the same way you could bet on the stock market.
							There are no invisible fees like in usual certificates. 
						</p>
					</div><!-- bordered-area -->
					<hr class="post-separator styled-separator   has-accent-color is-style-wide section-inner" aria-hidden="true" />
					<div class="form-group text-center">
						<button type="button" class="btn btn-primary smart-contract-button btn-lg" onclick="openLink('https://stockvoting.net/contract-proposal')" data-toggle="modal" data-target="#sharingModal"  id="SendBetButton"  ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add your Contract</button>
					</div>
				</div><!-- /wp:column -->
			</div><!-- /wp:column -->
			
		</div><!-- /wp:entry-content -->
	</div><!-- /wp:post-inner -->

</article><!-- .post --> 

