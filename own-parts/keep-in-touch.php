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

<h3 class="has-text-align-center has-accent-color">Get a free report weekly</h3>
<div class="tnp tnp-subscription">
  <form method="post" action="https://stockvoting.net/?na=s" onsubmit="return newsletter_check(this)">

    <input style="border-radius:10px;background-color:white;" placeholder="enter email" class="input-form" type="email" name="ne" required>
    <div class="tnp-field tnp-field-button button-wrap">  
      <button class="smart-button" type="submit" value="Subscribe">
        Subscribe
      </button>
    </div>
  </form>
</div>
