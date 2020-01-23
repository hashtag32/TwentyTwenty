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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



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
			if (is_search() || !is_singular() && 'summary' === get_theme_mod('blog_content', 'full')) {
				the_excerpt();
			} else {
				the_content(__('Continue reading', 'twentytwenty'));
			}
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner" id="section-inner">
		<!-- Main part, is modified in buildtemplates// -->
		<!-- Will be automatically loaded in build_template.js -->
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


<script>
	if (!Array.prototype.forEach) {
		Array.prototype.forEach = function(cb) {
			var i = 0,
				s = this.length;
			for (; i < s; i++) {
				cb && cb(this[i], i, this);
			}
		}
	}

	document.fonts && document.fonts.forEach(function(font) {
		font.loaded.then(function() {
			if (font.family.match(/Led/)) {
				document.gauges.forEach(function(gauge) {
					gauge.update();
				});
			}
		});
	});

	var timers = [];

	function animateGauges() {
		document.gauges.forEach(function(gauge) {
			timers.push(setInterval(function() {
				gauge.value = Math.random() *
					(gauge.options.maxValue - gauge.options.minValue) / 4 +
					gauge.options.minValue / 4;
			}, gauge.animation.duration + 50));
		});
	}

	function stopGaugesAnimation() {
		timers.forEach(function(timer) {
			clearInterval(timer);
		});
	}
</script>