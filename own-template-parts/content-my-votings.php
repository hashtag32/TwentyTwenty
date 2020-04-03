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
							<th class="has-text-align-center" data-align="center">Your Vote</th>
							<th class="has-text-align-center" data-align="center">Difference to now</th>
							<th class="has-text-align-center" data-align="center">Days Left</th>
						</tr>
					</thead>
			
			<!-- Iterate over all votings -->
			<?php
				$user_id=get_current_user_id();
				foreach (getVotings($user_id) as $voting_array)
				{ 
					$stock_diff=round(getStockDiff($voting_array["symbol"],(int)$voting_array["voting"]), 2);
					// $score_array[] = $stock_diff;
			?> 
					<tbody> 
						<tr>
							<td class="has-text-align-center" data-align="center"><?php echo $voting_array["symbol"] ?></td>
							<td class="has-text-align-center" data-align="center"><?php echo $voting_array["voting"] ?> $</td>
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
				<h3 class="has-accent-color has-text-color has-text-align-center">4.2</h3>
		</div> <!-- .scoring-area -->

		<form name="delete_my_votes_button" method="post">
        <input 
          type="button" 
          style="border-radius:50px"
          value="Delete my Votes" 
        />
	  </form>
	  <input style="border-radius:50px" type="button" value="Click Me" style="float: right;">


		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		$tags = get_tags();

		$html = '<div class="post_tags">';
		foreach ($tags as $tag) {
			$tag_link = get_tag_link($tag->term_id);

			$html .= "<li> <a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
			$html .= "{$tag->name}</a> </li>";
		}
		$html .= '</div>';
		echo $html;
		// edit_post_link();

		// echo '<ul>';
		// foreach ($tags as $tag) {
		//   echo '<li>' . $tag->name . '</li>';
		// }
		// echo '</ul>';

		// Single bottom post meta.


		?>

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