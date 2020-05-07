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

	<div class="post-inner">
		<div class="entry-content">
			<div class="wp-block-columns"><!-- ggf. alignwide? -->
				<div class="wp-block-column">

					<!-- Bet against a friend -->
					<div class="bordered-area">
						<a href="https://stockvoting.net/category/smart_contracts/bet_against_a_friend">
							<h2 class="has-accent-color has-text-align-center ">Bet against a friend</h2>
						</a>
						<p class="has-large-font-size">
							Bet against your friend through a modern blockchain technology service.
							Using MetaMask, you can chose to either bet on the Testnetwork or bet for real money.
						</p>
					</div><!-- bordered-area -->
					<hr class="post-separator styled-separator   has-accent-color is-style-wide section-inner" aria-hidden="true" />

					<!-- Knock Out Certificate -->
					<div class="bordered-area">
						<a href="https://stockvoting.net/category/smart_contracts/knock_out">
							<h2 class="has-accent-color has-text-align-center ">Knock Out</h2>
						</a>
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

