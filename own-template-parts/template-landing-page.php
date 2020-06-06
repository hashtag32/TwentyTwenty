<?php

/**
 * Template Name: Landing Page
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

ob_start();
get_header();
$header = ob_get_clean();
$header = preg_replace('#<title>(.*?)<\/title>#', '<title>' . "StockVoting" . '</title>', $header);
echo $header;
?>

<main id="site-content"  class="landing-page" role="main">

	<div class="has-text-align-center zoom-1">
		<div class="site-logo faux-heading"><a href="https://stockvoting.net/" class="custom-logo-link" rel="home"><img width="86" height="71" style="height: 71px;" src="https://stockvoting.net/wp-content/uploads/2020/05/cropped-stockvoting_logo.png" class="custom-logo" alt="StockVoting"></a><span class="screen-reader-text">StockVoting</span></div>
		<div class="site-description" style="color:black">Independent stock research</div><!-- .site-description -->
	</div>

	<h3 class="has-text-align-center has-accent-color zoom-1">Receive the most recent analyst reports</h3>
	<div class="tnp tnp-subscription">
		<form method="post" action="https://stockvoting.net/?na=s" onsubmit="return newsletter_check(this)">

			<input style="border-radius:10px;background-color:white;" placeholder="enter email" class="input-form zoom-1" type="email" name="ne" required>
			<div class="tnp-field tnp-field-button button-wrap">
				<button class="smart-button" type="submit" value="Subscribe">
					Get them for free
				</button>
			</div>
		</form>
	</div>

</main><!-- #site-content -->

<a class="skip-lp" href="https://stockvoting.net/front-page">
			<span class="to-the-top-long">
				<?php
				/* translators: %s: HTML character for up arrow. */
				printf(__('Skip %s', 'twentytwenty'), '<span class="arrow" aria-hidden="true">&rarr;</span>');
				?>
			</span><!-- .to-the-top-long -->
			<span class="to-the-top-short">
				<?php
				/* translators: %s: HTML character for up arrow. */
				printf(__('Skip %s', 'twentytwenty'), '<span class="arrow" aria-hidden="true">&rarr;</span>');
				?>
			</span><!-- .to-the-top-short -->
		</a><!-- .to-the-top -->