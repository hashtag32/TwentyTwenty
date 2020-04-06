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

<div class="post-inner ">
<?php $symbol=getSymbolName(single_cat_title( '', false ))  ?>
	<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/<?php echo $symbol;  ?>" rel="noopener" target="_blank"><span class="blue-text">Symbol Info</span></a> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
  {
  "symbol": "<?php echo $symbol;  ?>",
  "width": 800,
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
		"width": 980,
		"height": 610,
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


<div class="stock-voting has-text-align-center ">
      <!-- Third column = Your vote -->
      <!-- todo: Change to int type and value to default value -->
      <span class="vote-span" >Your vote</span>
      <br/></br>
      <form name="vote_form" method="post" >
        <input type="number"  id="voting_input_<?php echo $symbol;  ?>" class="voting_input" />
        <input 
          type="button" 
		  class="button-voting"
          onclick="send_vote(this,'<?php echo $symbol;  ?>',voting_input_<?php echo $symbol;  ?>.value)"
          value="Send Vote" 
          alt="Thank you!"
        />
      </form>
    </div>

</div><!-- .post-inner -->

<div class="section-inner">

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
