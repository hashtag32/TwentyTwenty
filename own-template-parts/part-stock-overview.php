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

// get variable from upper context 
$symbol= get_query_var('symbol');
set_query_var('gauge_div_class', "radial-gauge-class-voting");
  
?>


<div class="voting-table"> <!-- Stock Overview -->
    <a href="<?php echo get_symbol_link($symbol)?>/">
        <h2 class="has-text-align-center"><?php echo getStockName($symbol)?></h2>
    </a>
    <!-- Stock Overview Table -->
    <div class="wp-block-columns alignwide has-background has-text-color has-secondary-color" >
        <div class="wp-block-column"> <!-- Prognosis -->
            <h2 class="vote-span has-text-align-center">In 30 days (Prognosis)</h2> 
            <h2 class="has-accent-color has-text-color has-text-align-center prognosis-text" id="prognosis_<?php echo $symbol?>">
                <?php echo getVoting($symbol) ?> $
            </h2>
        </div>
        <div class="wp-block-column"> <!-- Opinion Block -->
            <h2 class="vote-span has-text-align-center" >StockVoter's opinion</h2> 
            <?php get_template_part('own-template-parts/part', 'gauge')?>
        </div>  <!-- Opinion Block-->
    </div> <!-- Stock Overview Table-->
    <form name="vote_form" method="post" >
        <input type="number" value="<?php echo round(getStockValue($symbol),2)?>" id="voting_input_<?php echo $symbol ?>" class="voting_input" />
        <input 
            type="button" 
            class="button-voting"
            onclick="send_vote(this,'<?php echo $symbol ?>',voting_input_<?php echo $symbol ?>.value)"
            value="Vote" 
            alt="Thank you!"/>
    </form>
    <br/></br>
</div> <!-- Stock Overview -->

					<!-- todo: insert button Vote here -> just link to  -->
