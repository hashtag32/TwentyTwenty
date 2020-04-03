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
				<p> Testhtml</p>
			<?php



			
			if ( is_user_logged_in()) {
				$user_id=get_current_user_id();
				foreach (getVotings($user_id) as $voting_array)
				{
					// echo $voting_array["symbol"];
					// // printing result in days format 
					echo $voting_array["date"];
					echo "<br>";
					echo getDaysLeft($voting_array["date"]); 
					echo "<br>";
					echo getStockDiff($voting_array["symbol"],(int)$voting_array["voting"]);
					echo "<br>";
					
				}
			} else {
				echo 'You not voted yet, see Votings to get your votes!';
				echo(getAllVotings($user_id));
				echo 'Welcome, visitor!';
			}


			// go through all votings
			// while(have_votings)
				// 

			if (is_search() || !is_singular() && 'summary' === get_theme_mod('blog_content', 'full')) {
				the_excerpt();
			} else {
				the_content(__('Continue reading', 'twentytwenty'));
			}
			?>

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