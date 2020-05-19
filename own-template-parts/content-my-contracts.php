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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
	get_template_part('template-parts/entry-header');

	if (!is_search()) {
		get_template_part('template-parts/featured-image');
	}

	?>

	<div class="post-inner">
		<div class="entry-content">

			<?php
			if (is_user_logged_in()) {
			?>
				<!-- Stock Betting -->
				<h2 class="has-text-align-center">Stock Betting</h2>

				<!-- Head of the Table -->
				<figure class="wp-block-table alignwide is-style-stripes">
					<table class="has-subtle-pale-blue-background-color has-background">
						<thead>
							<tr>
								<th class="has-text-align-center" data-align="center">Contract</th>
								<!-- todo: Date? -->
								<th class="has-text-align-center" data-align="center">Underlying</th>
								<th class="has-text-align-center" data-align="center">Stock Price</th>
								<th class="has-text-align-center" data-align="center">Amount</th>
							</tr>
						</thead>

						<!-- Iterate over all votings -->
						<?php
						foreach (getSBContracts(get_current_user_id()) as $contract_array) {
						?>
							<tbody>
								<tr>
									<td class="has-text-align-center has-accent-color" data-align="center">
										<a href="<?php echo get_ropsten_link($contract_array["contract_address"]) ?>">
											Here
										</a>
									</td>
									<td class="has-text-align-center" data-align="center"><?php echo getUnderlying($contract_array["contract_address"],"SB") ?> </td>
									<td class="has-text-align-center" data-align="center"><?php echo $contract_array["stock_price"] ?> </td>
									<td class="has-text-align-center" data-align="center"><?php echo $contract_array["amount"] ?> </td>
								</tr>
							</tbody>
						<?php
						}
						?>
					</table>
				</figure>


				<!-- Knock Out -->
				<h2 class="has-text-align-center">Knock Out</h2>

				<!-- Head of the Table -->
				<figure class="wp-block-table alignwide is-style-stripes">
					<table class="has-subtle-pale-blue-background-color has-background">
						<thead>
							<tr>
								<th class="has-text-align-center" data-align="center">Contract</th>
								<th class="has-text-align-center" data-align="center">Underlying</th>
								<!-- todo: Date? -->
								<th class="has-text-align-center" data-align="center">Amount</th>
							</tr>
						</thead>

						<!-- Iterate over all votings -->
						<?php
						foreach (getKOContracts(get_current_user_id()) as $contract_array) {
						?>
							<tbody>
								<tr>
									<td class="has-text-align-center has-accent-color" data-align="center">
										<a href="<?php echo get_ropsten_link($contract_array["contract_address"]) ?>">
											Here
										</a>
									</td>
									<td class="has-text-align-center" data-align="center"><?php echo getUnderlying($contract_array["contract_address"],"KO") ?> </td>
									<td class="has-text-align-center" data-align="center"><?php echo $contract_array["amount"] ?> </td>
								</tr>
							</tbody>
						<?php
						}
						?>
					</table>
				</figure>

			<?php
			}

			// User not logged in  
			else {
				echo 'Welcome, visitor!';
				echo 'You not voted yet, see Votings to get your votes!';
			}

			if (is_search() || !is_singular() && 'summary' === get_theme_mod('blog_content', 'full')) {
				the_excerpt();
			} else {
				the_content(__('Continue reading', 'twentytwenty'));
			}
			?>


		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">

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