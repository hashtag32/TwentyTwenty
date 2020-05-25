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

<h4 class="has-text-align-center has-accent-color">Just keep in touch</h4>
<div class="tnp tnp-subscription">
  <form method="post" action="https://stockvoting.net/?na=s" onsubmit="return newsletter_check(this)">

    <input placeholder="Enter your Email here" class="tnp-email" type="email" name="ne" required>
    <div class="tnp-field tnp-field-button button-wrap">
      <button class="smart-button" type="submit" value="Subscribe">
        Subscribe
      </button>
    </div>
  </form>
</div>
