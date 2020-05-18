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

//  todo:create id and save title/id in db
// $heading=ucfirst(str_replace( '_',' ', $smart_contract));
?> 

<!-- todo move to separate file -->
<header class="entry-header-green has-text-align-center header-footer-group">
	<div class="entry-header-inner section-inner medium">
		<h1 class="entry-title">Betting against a friend</h1>
	</div><!-- .entry-header-inner -->
</header>

<div class="post-inner">
	<div class="entry-content entry-smart-contract" >

		<div id="LoadCreateContractDiv" >
			<form>
				<button type="button" class="btn btn-secondary btn-lg smart-contract-button" data-toggle="modal" data-target="#loadContractModal" id="loadContractButton">Load contract</button>
				<button type="button" class="btn btn-secondary float-right smart-contract-button" id="createContractButton">Create contract</button>
			</form>
		</div >
		

		<div id="createContractDiv" style="display: none;" >
			<h2 class="own-h2 has-text-align-center" >Loading/Creating contract...</h2>
			<div class="text-center">
			<div class="spinner-grow" role="status">
				<span class="sr-only text-primary">Loading...</span>
			</div>
			</div>
		</div>

		<div id="BettingDiv" style="display: none;" >
			<h2 class="own-h2 has-text-align-center has-accent-color" style="font-size:35px" >Your contract</h2>

			<a href="https://ropsten.etherscan.io/address/" target="_blank" id="contractMinedHashLink">
				<h2 class="own-h2 has-text-align-center has-accent-color" id="contractMinedHash"></h2>
			</a>

			<form>
				<div class="form-group">
					<label for="stockPickSelect" >Stock</label>
					<select multiple class="form-control" style="font-size:large;" id="stockPickSelect">
					<!-- todo: StockName, but get it later in ajax?-> bad, better in save as key TSLA -->
						<?php foreach (getAllSymbols() as $symbol){	?>
							<option><?php echo $symbol?></option>
						<?php } ?>
					</select>

					<label for="bet_stock_price">Stock price</label>
					<input type="email" class="form-control" id="bet_stock_price" aria-describedby="emailHelp" placeholder="Place your predicted stock Price">
					<!-- todo: Let select wei/ether -->

					<label for="bet_due_date">Due Date</label>
					<input class="form-control" type="date" value="2020-08-19" id="bet_due_date">

					<label for="bet_amount">Amount (wei)</label>
					<input type="email" class="form-control" id="bet_amount" aria-describedby="emailHelp" placeholder="Put money where your mouth is ;)">

				</div>
				<div class="form-group text-center">
					<button type="button" class="btn btn-primary smart-contract-button btn-lg" onclick="sendBet(this,stockPickSelect.value, bet_stock_price.value, bet_due_date.value, bet_amount.value);ShareableLink(true);" data-toggle="modal" data-target="#sharingModal"  id="SendBetButton"  >Send bet</button>
				</div>
			</form>
		</div>


		<!-- Modal/Popup for load contract -->
		<div class="modal fade" id="loadContractModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				
					<!-- Header -->
					<div class="modal-header">
						<h5 class="modal-title text-left" id="exampleModalLabel">Load existing contract</h5>
					</div>

					<!-- Body -->
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Enter your contract address:</label>
								<input type="email" class="form-control" id="contractAddress" aria-describedby="emailHelp" placeholder="0xce7f64728e998ad96bd82e8b0603b9a3e32cf8f7">
							</div>
						</form>
					</div>

					<!-- Footer group -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" onclick="loadContract(contractAddress.value)"  data-dismiss="modal" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>


		<!-- Modal/Popup for sharing -->
		<div class="modal fade" id="sharingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered"  role="document">
				<div class="modal-content">
					
					<!-- Header -->
					<div class="modal-header">
						<h5 class="modal-title text-left" id="exampleModalLabel">Sharing is caring</h5>
					</div>

					<!-- Body -->
					<div class="modal-body">
						<p class="modal-body-p" id="shareableLinkBody"></p>
						<!-- todo: Improve, see https://ropsten.etherscan.io/address/0xce7f64728e998ad96bd82e8b0603b9a3e32cf8f7 Copy button -->
						<button type="button" class="btn btn-primary popover-test" onclick="ShareableLink(true)" title="Copy the link to your clipboard" data-content="Popover body content is set in this attribute.">Copy</button>
					</div>

					<!-- Footer group -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal/Popup for installMetaMaskModal -->
		<div class="modal fade" id="installMetaMaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered"  role="document">
				<div class="modal-content">
					
					<!-- Header -->
					<div class="modal-header">
					
						<h5 class="modal-title text-left" id="exampleModalLabel">Please install MetaMask</h5>
					</div>

					<!-- Body -->
					<div class="modal-body">
						<p class="modal-body-p" id="installMetaMaskModalBody">For the following actions is a blockchain plugin required: MetaMask</p>
						<a href="https://metamask.io/download.html" target="_blank" >
							<img class="img-centered" src="https://stockvoting.net/wp-content/uploads/2020/05/download-metamask.png" width="150" height="120" alt="Italian Trulli">
						</a>
					</div>

					<!-- Footer group -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

	</div><!-- .entry-content -->
</div><!-- .post-inner -->
	<script src="https://rawgit.com/ethereum/web3.js/0.16.0/dist/web3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/ethjs@0.3.0/dist/ethjs.min.js"></script>
	<script>
		// Front End functions
		$(document).ready(function () {
			if (typeof web3 == 'undefined') {
				// Please install MetaMask first
				$('#installMetaMaskModal').modal('show');
			}
			$('#createContractButton').click(function () {
				$('#createContractDiv').fadeIn('slow');
			});
		});

		// Logic for Web3 API
		window.addEventListener('load', function() {
		// Check if Web3 has been injected by the browser:
		if (typeof web3 !== 'undefined') {
			// You have a web3 browser! Continue below!
			initialization(web3, "betting-against");
		} 
	})

	

	</script>

