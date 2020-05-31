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
get_header();
?>

<?php $heading = is_search() ? 'Articles' : 'Analysis'; ?>

<!-- todo move to separate file -->
<header class="entry-header-white has-text-align-center header-footer-group">
	<div class="entry-header-inner section-inner medium">
		<h1 class="entry-title"><?php echo $heading ?></h1>
	</div><!-- .entry-header-inner -->
</header>

<?php get_template_part('own-parts/wave'); ?>


<!-- List all articles -->
<div class="section-inner" id="section-inner">
	<?php
	while (have_posts()) {
	?>
		<div class="wp-block-columns">
			<div class="wp-block-column">
				<?php
				the_post();
				get_template_part('own-template-parts/content-analysis', get_post_type());
				?>
			</div>
			<?php if (wpdocs_has_more_posts()) { ?>
				<div class="wp-block-column">
					<?php
					the_post();
					get_template_part('own-template-parts/content-analysis', get_post_type());
					?>
				</div>
		</div>
		<hr class="post-separator styled-separator has-accent-color is-style-wide section-inner" aria-hidden="true" />
<?php
			}
		}
?>
</div>

<?php
// Add your Analysis
get_template_part('small-parts/add-button');
?>