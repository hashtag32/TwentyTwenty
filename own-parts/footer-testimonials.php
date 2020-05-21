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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container testimonials">
  <div class="row">
    <div class="col-md-6 col-center m-auto">
      <h2 class="has-text-align-center has-accent-color">Testimonials</h2>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Carousel indicators -->
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">
          <div class="item carousel-item active">
            <div class="img-box zoom"><img src="https://stockvoting.net/wp-content/uploads/2020/04/max.jpg" alt=""></div>
            <p class="testimonial">Through the analysis and ratings I have increased my performance hugely. Thanks to the StockVoting Team for such great support.</p>
            <p class="overview"><b>Maximilian Feld</b>, Financial Analyst</p>
          </div>
          <div class="item carousel-item">
            <div class="img-box zoom"><img src="https://stockvoting.net/wp-content/uploads/2020/05/antony_matts.png" alt=""></div>
            <p class="testimonial">The idea of creating certificates and saving all the fees is disrupting.</p>
            <p class="overview"><b>Antony Matts</b>, Blockchain Expert</p>
          </div>
          <div class="item carousel-item">
            <div class="img-box zoom"><img src="https://stockvoting.net/wp-content/uploads/2020/05/silivia_miller.jpg" alt=""></div>
            <p class="testimonial">I was searching for such a platform for a long time. Please stay honest!</p>
            <p class="overview"><b>Silvia Miller</b>, Financial Journalist</p>
          </div>
        </div>
        <!-- Carousel controls -->
        <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
          <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
          <i class="fa fa-angle-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>