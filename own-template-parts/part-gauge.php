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

 // todo: is this required on each hiearchy?
$symbol= get_query_var('symbol');
// todo: clean this shit up
$gauge_div_class=get_query_var('gauge_div_class');

?>

<div class="<?php echo $gauge_div_class?>" id="gaugeID_<?php echo $symbol?>" >
    <canvas 
        class="radial-gauge-canvas"
        data-type="radial-gauge" 
        data-title="false"
        data-value="<?php echo display_stock_diff(getStockDiff($symbol, getVoting($symbol)))  ?>"
        data-min-value="-30"
        data-max-value="30"
        data-major-ticks="-30,-25,-20,-15,-10,-5,5,10,15,20,25,30"
        data-minor-ticks="2"
        data-stroke-ticks="false"
        data-highlights='[
        { "from": -30, "to": -15, "color": "rgba(255, 0, 0,0.25)" },
        { "from": -15, "to": -5, "color": "rgba(255,0,0,.75)" },
        { "from": -5, "to": 5, "color": "rgba(255,255,0,.75)" },
        { "from": 5, "to": 15, "color": "rgba(0,255,0,0.75)" },
        { "from": 15, "to": 30, "color": "rgba(0,255,0,0.25)" }
            ]'
        data-color-plate="#222"
        data-color-major-ticks="#f5f5f5"
        data-color-minor-ticks="#ddd"
        data-color-title="#fff"
        data-color-units="#ccc"
        data-color-numbers="#eee"
        data-color-needle-start="rgba(240, 128, 128, 1)"
        data-color-needle-end="rgba(255, 160, 122, .9)"
        data-value-box="true"
        data-animation-rule="elastic"
        data-animation-duration="1500"
        data-font-value="Led"
        data-animated-value="true"
        data-units="%"
        animateOnInit="false"
        animatedValue="150"
        style="position:relative;width: 100%;height:100%;box-sizing: border-box;  ">
    </canvas>
</div> <!-- Gauge -->

