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

	<div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?> ">
		<div class="entry-content">

			<?php
			if ( is_user_logged_in()) {
			?>

			<!-- Head of the Table -->
			<figure class="wp-block-table alignwide is-style-stripes">
				<table class="has-subtle-pale-blue-background-color has-background">
					<thead>
						<tr>
							<th class="has-text-align-center" data-align="center">Symbols</th>
							<th class="has-text-align-center" data-align="center">Vote</th>
							<th class="has-text-align-center" data-align="center">Current price</th>
							<th class="has-text-align-center" data-align="center">Difference price/vote</th>
							<th class="has-text-align-center" data-align="center">Days Left</th>
						</tr>
					</thead>
			
			<!-- Iterate over all votings -->
			<?php
				foreach (getVotings(get_current_user_id()) as $voting_array)
				{ 
					$stock_diff=round(getStockDiff($voting_array["symbol"],(int)$voting_array["voting"]), 2);
			?> 
					<tbody> 
						<tr>
							<!-- todo: Maybe add average Vote -->
							<!-- todo: Derive Symbol Names -->
							<td class="has-text-align-center" data-align="center"><?php echo getStockName($voting_array["symbol"]) ?></td>
							<td class="has-text-align-center" data-align="center"><?php echo $voting_array["voting"] ?> $</td>
							<td class="has-text-align-center" data-align="center"><?php echo getStockValue($voting_array["symbol"]) ?> $</td>
							<td class="has-text-align-center" data-align="center"><?php echo $stock_diff ?> %</td>
							<td class="has-text-align-center" data-align="center"><?php echo getDaysLeft($voting_array["date"]) ?></td>
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
			
			<div class="scoring-area">
				<h2 class="has-text-align-center">Score</h2>
				<h2 class="has-accent-color has-text-color has-text-align-center score-value">
					<?php echo getScore(get_current_user_id()) ?> 
					<span class="score-tooltip">
						Score is a value between 0 and 5.

						It shows you how good are your predictions.
					</span> 
				</h2>  
			</div> <!-- .scoring-area -->

		<form name="delete_my_votes_button_form" method="post">
			<input 
			class="delete_my_votes_button"
			type="button" 
			value="Delete my Votes" 
			style="border-radius:50px"
			onclick="delete_all_votes(this)"
			/>
	  </form>
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