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

				<!-- Head of the Table -->
				<figure class="wp-block-table alignwide is-style-stripes">
					<table class="table table-striped has-subtle-pale-blue-background-color has-background sv-table table-hover" data-toggle="table" data-pagination="true" >
						<thead class="thead-dark">
							<tr>
								<th class="has-text-align-center" data-align="center">Symbols</th>
								<th class="has-text-align-center" data-align="center">Vote</th>
								<th class="has-text-align-center" data-align="center">Current price</th>
								<th class="has-text-align-center" data-align="center">Difference price/vote</th>
								<th class="has-text-align-center" data-align="center">Days Left</th>
							</tr>
						</thead>

						<!-- Iterate over all votings -->
						<tbody>
						<?php
						foreach (getVotings(get_current_user_id()) as $voting_array) {
							$stock_diff = round(getStockDiff($voting_array["symbol"], (int) $voting_array["voting"]), 2);
						?>
								<tr>
									<!-- todo: Maybe add average Vote -->
									<!-- todo: Derive Symbol Names -->
									<td class="has-text-align-center" data-align="center">
										<a href="<?php echo get_symbol_link($voting_array["symbol"]) ?>">
											<div style="font-weight:bold">
												<?php echo getStockName($voting_array["symbol"]) ?>
											</div>
										</a>
									</td>
									<td class="has-text-align-center" data-align="center"><?php echo $voting_array["voting"] ?> $</td>
									<td class="has-text-align-center" data-align="center"><?php echo round(getStockValue($voting_array["symbol"]), 2) ?> $</td>
									<td class="has-text-align-center" data-align="center"><?php echo $stock_diff ?> %</td>
									<td class="has-text-align-center" data-align="center"><?php echo getDaysLeft($voting_array["date"], "+30 days") ?></td>
								</tr>
								<?php
						}
						?>
						</tbody>
					
					</table>
					
				</figure>

				<div class="scoring-area">
				<h2 class="has-text-align-center">Score</h2>
				<h2 class="has-accent-color has-text-color has-text-align-center score-value">
					<?php echo getScore(get_current_user_id()) ?>
					<span class="score-tooltip">
						Score is a value between 0 and 5.

						It shows you how good your predictions are.
					</span>
				</h2>

				<form name="delete_my_votes_button_form" method="post">
					<input class="delete_my_votes_button" type="button" value="Delete my Votes" style="border-radius:50px" onclick="delete_all_votes(this)" />
				</form>
			</div> <!-- .scoring-area -->


			<?php
			}

			// User not logged in  
			else {
				get_template_part('own-parts/login-for-feature');
			}

			if (is_search() || !is_singular() && 'summary' === get_theme_mod('blog_content', 'full')) {
				the_excerpt();
			} else {
				the_content(__('Continue reading', 'twentytwenty'));
			}
			?>

	

			<!-- <div class="wp-block-button"><a class="wp-block-button__link" style="border-radius:50px">Delete my b</a></div> -->
			<!-- <input style="border-radius:50px" type="button" value="Click Me" style="float: right;"> -->

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
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
