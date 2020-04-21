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

<script type="text/javascript" src="https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/third-party/canvas-gauges/gauge.min.js"></script>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">


<div class="section-inner">

<?php $symbol=getSymbolName(single_cat_title( '', false ));
if($symbol!="")
{
?>

	
	<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
		<div class="tradingview-widget-container__widget"></div>
		<div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/<?php echo $symbol;  ?>" rel="noopener" target="_blank"><span class="blue-text">Symbol Info</span></a> by TradingView</div>
		<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
		{
		"symbol": "<?php echo $symbol;  ?>",
		"width": "80%",
		"locale": "en",
		"colorTheme": "light",
		"isTransparent": true
		}
		</script>
	</div>
	<!-- TradingView Widget END -->


	<!-- TradingView Widget BEGIN -->
	<div class="tradingview-widget-container">
		<div id="tradingview_<?php echo $symbol;  ?>"></div>
		<div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/<?php echo $symbol;  ?>" rel="noopener" target="_blank"><span class="blue-text">Chart</span></a> by TradingView</div>
		<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
		<script type="text/javascript">
		new TradingView.widget(
		{
		"width": "80%",
		"height": 400,
		"symbol": "<?php echo $symbol;  ?>",
		"timezone": "Etc/UTC",
		"theme": "dark",
		"style": "2",
		"locale": "en",
		"toolbar_bg": "#f1f3f6",
		"enable_publishing": false,
		"hide_top_toolbar": true,
		"withdateranges": true,
		"range": "1m",
		"allow_symbol_change": true,
		"container_id": "tradingview_<?php echo $symbol;  ?>"
		}
		);
		</script>
	</div>
			<!-- TradingView Widget END -->


	<!-- <div class="tradingview-widget-container-technical"  >
	<div class="tradingview-widget-container__widget"></div>
	<div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-AAPL/technicals/" rel="noopener" target="_blank"><span class="blue-text">Technical Analysis for AAPL</span></a> by TradingView</div>
	<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
	{
	"interval": "1W",
	"width": 425,
	"isTransparent": false,
	"height": 450,
	"symbol": "NASDAQ:AAPL",
	"showIntervalTabs": true,
	"locale": "en",
	"colorTheme": "dark"
	} 
	</script>
	</div> -->

	<!-- Prediction scale -->



<?php  
}

$symbol_key_mectrics=fetch_fmpcloud_feed($symbol, "key-metrics")[0];

?>

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide has-background has-text-color has-background-background-color has-secondary-color"><!-- wp:top-columns -->
	<div class="wp-block-column"><!--top-column -->
		<h2>Risk</h2>
		<figure class="wp-block-table is-style-stripes">
			<table>
				<tbody>
					<tr>
						<td>GrahamNumber</td>
						<td><?php echo display_eval_nr($symbol_key_mectrics['grahamNumber'])?></td>
						<td><?php echo display_eval_nr(getStockValue($symbol))?></td>
					</tr>
					<tr>
						<td>RD Expense Growth</td>
						<td><?php echo display_eval_nr(getPercentage(RDExpenseGrowth($symbol)))  ?>%</td> 
						<td><30%</td>
					</tr>
					<tr>
						<td>Debt/Equity</td>
						<td><?php echo display_eval_nr($symbol_key_mectrics['debtToEquity'])?></td>
						<td><3</td>
					</tr>
				</tbody>
			</table>
		</figure>

		<h2>Growth</h2>
		<figure class="wp-block-table is-style-stripes">
			<table>
				<tbody>
					<tr>
						<td>Revenue Growth mean (3y)</td>
						<td><?php echo display_eval_nr(getPercentage(RevenueGrowth($symbol)))?>%</td>
						<td> >10% </td>
					</tr>
					<tr>
						<td>Gross Profit Growth mean (3y)</td>
						<td><?php echo display_eval_nr(getPercentage(GrossProfitgrowth($symbol)))?>%</td>
						<td> >10% </td>
					</tr>
					<tr>
						<td>EPS Growth mean (3y)</td>
						<td><?php echo display_eval_nr(getPercentage(EPSGrowth($symbol)))?>%</td>
						<td> >10% </td>
					</tr>
					<tr>
						<td>Operating CF Growth (3y)</td>
						<td><?php echo display_eval_nr(getPercentage(OpCFGrowth($symbol)))?>%</td>
						<td> >10% </td>
					</tr>
				</tbody>
			</table>
		</figure>

		<h2>Prospects</h2>
		<figure class="wp-block-table is-style-stripes">
			<table>
				<tbody>
					<tr>
						<td>EPS mean (3y)</td>
						<td><?php echo display_eval_nr(EPS_Mean($symbol))?></td>
						<td> >10 </td>
					</tr>
					<tr>
						<td>ROE</td>
						<td><?php echo display_eval_nr(getPercentage(fmp_key_first($symbol, 'key-metrics', 'roe')))?>%</td>
						<td>>20%</td>
					</tr>
					<tr>
						<td>PE</td>
						<td><?php echo display_eval_nr(fmp_key_first($symbol, 'ratios', 'priceEarningsRatio'))?></td>
						<td><12</td>
					</tr>
					<tr>
						<td>PEG</td>
						<td><?php echo display_eval_nr(fmp_key_first($symbol, 'ratios', 'priceEarningsToGrowthRatio'))?></td>
						<td> <1.5, ideal 1 </td>
					</tr>
				</tbody>
			</table>
		</figure>

		<h2>Rating</h2>
		<figure class="wp-block-table is-style-stripes">
			<table>
				<tbody>
					<tr>
						<td>Rating Score</td>
						<td><?php echo fetch_fmpcloud_feed($symbol, "rating")[0]['ratingScore']?></td>
						<td>=5</td>
					</tr>
				</tbody>
			</table>
		</figure>
		
	</div><!-- /wp:top-column -->


	 <div class="wp-block-column"> <!-- /wp:top-column -->
		<h2 class="has-text-align-center" >StockVoter's opinion (30 days prognosis)</h2> 
		<?php 
			set_query_var('symbol', $symbol);
			set_query_var('gauge_div_class', "radial-gauge-class-stock");
			get_template_part('own-template-parts/part', 'gauge');
		?>

		<hr class="wp-block-separator has-text-color has-background has-accent-background-color has-accent-color is-style-dots"/>
		
		<div class=" has-text-align-center ">
			<!-- Third column = Your vote -->
			<!-- todo: Change to int type and value to default value -->
			<!-- <span class="vote-span " >Your vote</span> -->
			<!-- wp:heading {"align":"center"} -->
			<h2 class="has-text-align-center">Your vote</h2>
			<!-- /wp:heading -->

			<br/></br>
			<form name="vote_form" method="post" >
				<input type="number"  id="voting_input_<?php echo $symbol;  ?>" class="voting_input" />
				<input 
					type="button" 
					class="button-voting"
					onclick="send_vote(this,'<?php echo $symbol;  ?>',voting_input_<?php echo $symbol;  ?>.value)"
					value="Vote" 
					alt="Thank you!"/>
					<input 
					type="button" 
					class="button-voting"
					onclick="send_vote(this,'<?php echo $symbol;  ?>',voting_input_<?php echo $symbol;  ?>.value)"
					value="Bet" 
					alt="Thank you!"/>
			</form>
		</div> <!-- Button section --> 
	</div><!-- /wp:top-column -->
</div><!-- /wp:top-columns -->



















 

</div><!-- .section-inner -->

<?php

if (is_single()) {

	get_template_part('template-parts/navigation');
}

?>

</article><!-- .post -->
 