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

<script src="https://use.fontawesome.com/f2103e8f69.js"></script>


<!-- todo move to separate file -->
<header class="entry-header-green has-text-align-center header-footer-group">
	<div class="entry-header-inner section-inner medium">
		<h1 class="entry-title">Knock Outs</h1>
	</div><!-- .entry-header-inner -->
</header>

<div class="post-inner">
	<div class="entry-content entry-smart-contract">

		<!-- Overview contracts table -->
		<figure class="wp-block-table alignwide is-style-stripes">
			<table class="table table-striped has-subtle-pale-blue-background-color has-background table-hover">

				<thead class="thead-dark">
					<tr>
						<th class="has-text-align-center" data-align="center">Type</th>
						<th class="has-text-align-center" data-align="center">Underlying</th>
						<th class="has-text-align-center" data-align="center">Threshold</th>
						<th class="has-text-align-center" data-align="center">Leverage</th>
						<th class="has-text-align-center" data-align="center">Pot</th>
						<th class="has-text-align-center" data-align="center">Emission date</th>
						<th class="has-text-align-center" data-align="center">Due Date</th>
						<th class="has-text-align-center" data-align="center">Details</th>
					</tr>
				</thead>

				<!-- Iterate over all votings -->
				<?php
				foreach (getAllKO() as $KO_contract) {
				?>
					<tr class="table-row" data-target="#buySharesModal" data-val="<?php echo $KO_contract["address"] ?>" data-toggle="modal">
						<td class="has-text-align-center" data-align="center"><?php echo display_string($KO_contract["typ"]) ?></td>
						<td class="has-text-align-center" data-align="center">
							<a href="<?php echo get_symbol_link($KO_contract["underlying"]) ?>">
								<?php echo getStockName($KO_contract["underlying"]) ?>
							</a>
						</td>
						<td class="has-text-align-center" data-align="center"><?php echo $KO_contract["threshold"] ?></td>
						<td class="has-text-align-center" data-align="center"><?php echo $KO_contract["leverage"] ?></td>
						<td class="has-text-align-center" data-align="center"><?php echo $KO_contract["pot"] ?> ETH</td>
						<td class="has-text-align-center" data-align="center"><?php echo $KO_contract["emissionDate"] ?></td>
						<td class="has-text-align-center" data-align="center"><?php echo $KO_contract["dueDate"] ?></td>
						<td class="has-text-align-center has-accent-color" data-align="center">
							<a href="<?php echo get_ropsten_link($KO_contract["address"]) ?>">
									Here
							</a>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
		</figure>

		<!-- Button to add new contract -->
		<div class="form-group text-center">
			<button type="button" class="btn btn-primary smart-contract-button btn-lg"  id="createNewContractButton"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create new Knock Out</button>
		</div>


		<!-- Input contract data div -->
		<div id="InputContractDataDiv" style="display: none;">
			<h2 class="own-h2 has-text-align-center has-accent-color" style="font-size:35px">Creating new contract</h2>

			<a href="" target="_blank" id="contractMinedHashLink">
				<h2 class="own-h2 has-text-align-center has-accent-color" id="contractMinedHash"></h2>
			</a>

			<form>
				<div class="form-group">
					<label for="stockPickSelect">Type</label>
					<select multiple class="form-control" style="font-size:large;" id="typeSelect">
						<option>Call</option>
						<option>Put</option>
					</select>

					<label for="stockPickSelect">Underlying</label>
					<select multiple class="form-control" style="font-size:large;" id="stockPickSelect">
						<!-- todo: StockName, but get it later in ajax?-> bad, better in save as key TSLA -->
						<?php foreach (getAllSymbols() as $symbol) {	?>
							<option><?php echo $symbol ?></option>
						<?php } ?>
					</select>

					<label for="bet_stock_price">Threshold</label>
					<input type="email" class="form-control" id="threshold" aria-describedby="emailHelp" placeholder="Place your threshold">

					<label for="bet_stock_price">Leverage</label>
					<input type="email" class="form-control" id="leverage" aria-describedby="emailHelp" placeholder="Place your leverage">

					<label for="bet_amount">Pot</label>
					<input type="email" class="form-control" id="pot" aria-describedby="emailHelp" placeholder="Put money where your mouth is ;)">

					<label for="bet_due_date">Due Date</label>
					<input class="form-control" type="date" value="2020-08-19" id="ko_due_date">
				</div>
				<!-- Create it! button -->
				<div class="form-group text-center">
					<button type="button" class="btn btn-primary smart-contract-button btn-lg" onclick="createKOContract(this,typeSelect.value, stockPickSelect.value, threshold.value, leverage.value, pot.value, ko_due_date.value);" data-toggle="modal" data-target="#sharingModal" id="SendBetButton">Create it!</button>
				</div>
			</form>
		</div>


		
		<!-- ProgressDiv (...creation in progress...) -->
		<!-- todo: rename to progressingContractDiv -->
		<div id="creatingContractDiv" style="display: none;">
			<h2 class="own-h2 has-text-align-center">Loading/Creating contract...</h2>
			<div class="text-center">
				<div class="spinner-grow" role="status">
					<span class="sr-only text-primary">Loading...</span>
				</div>
			</div>
		</div>

		
		<!-- Action div (contract data + input data for e.g. send bet)  -->


	
<!-- todo: rename -->
		<div id="BettingDiv" style="display: none;">
			<h2 class="own-h2 has-text-align-center has-accent-color" style="font-size:35px">Your contract</h2>

			<a href="" target="_blank" id="contractMinedHashLink">
				<h2 class="own-h2 has-text-align-center has-accent-color" id="contractMinedHash"></h2>
			</a>

			<form>
				<div class="form-group">
					<label for="stockPickSelect">Type</label>
					<select multiple class="form-control" style="font-size:large;" id="typeSelect">
						<option>Call</option>
						<option>Put</option>
					</select>

					<label for="stockPickSelect">Underlying</label>
					<select multiple class="form-control" style="font-size:large;" id="stockPickSelect">
						<!-- todo: StockName, but get it later in ajax?-> bad, better in save as key TSLA -->
						<?php foreach (getAllSymbols() as $symbol) {	?>
							<option><?php echo $symbol ?></option>
						<?php } ?>
					</select>

					<label for="bet_stock_price">Threshold</label>
					<input type="email" class="form-control" id="threshold" aria-describedby="emailHelp" placeholder="Place your threshold">

					<label for="bet_stock_price">Leverage</label>
					<input type="email" class="form-control" id="leverage" aria-describedby="emailHelp" placeholder="Place your leverage">

					<label for="bet_amount">Pot</label>
					<input type="email" class="form-control" id="pot" aria-describedby="emailHelp" placeholder="Put money where your mouth is ;)">

					<label for="bet_due_date">Due Date</label>
					<input class="form-control" type="date" value="2020-08-19" id="ko_due_date">
				</div>
				<div class="form-group text-center">
					<button type="button" class="btn btn-primary smart-contract-button btn-lg" onclick="createKOContract(this,typeSelect.value, stockPickSelect.value, threshold.value, leverage.value, pot.value, ko_due_date.value);ShareableLink(true);" data-toggle="modal" data-target="#sharingModal" id="SendBetButton">Create it!</button>
				</div>
			</form>
		</div>


		<!-- Modal/Popup for Buying Shares -->
		<div class="modal fade" id="buySharesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

					<!-- Header -->
					<div class="modal-header">
						<h5 class="modal-title text-left" id="exampleModalLabel">Buy Shares</h5>
					</div>

					<!-- Body -->
					<div class="modal-body">
						<h2 class="own-h2 has-text-align-center" id="contractAddress">Contract address</h2>
						<a href="https://ropsten.etherscan.io/address/" target="_blank" id="modal_contractAddressLink">
							<h2 class="own-h2 has-text-align-center has-accent-color" id="modal_contractAddress">0x123</h2>
						</a>
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Amount (wei):</label>
								<!-- todo: check for minmum  -->
								<input type="email" class="form-control" id="buyingAmount" aria-describedby="emailHelp" placeholder="100000">
							</div>
						</form>
					</div>

					<!-- Footer group -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" onclick="buyShares(modal_contractAddress.value,buyingAmount.value)" data-dismiss="modal" class="btn btn-primary">Buy</button>
					</div>
				</div>
			</div>
		</div>


		<!-- Modal/Popup for sharing -->
		<div class="modal fade" id="sharingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
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
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

					<!-- Header -->
					<div class="modal-header">

						<h5 class="modal-title text-left" id="exampleModalLabel">Please install MetaMask</h5>
					</div>

					<!-- Body -->
					<div class="modal-body">
						<p class="modal-body-p" id="installMetaMaskModalBody">For the following actions is a blockchain plugin required: MetaMask</p>
						<a href="https://metamask.io/download.html" target="_blank">
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
	// Substitute val/href with contract_address
	$('#buySharesModal').on('show.bs.modal', function(event) {
		var contract_address = $(event.relatedTarget).data('val');
		$(this).find("#modal_contractAddress").text(contract_address);
		$(this).find("#modal_contractAddressLink").attr("href", "https://ropsten.etherscan.io/address/" + contract_address); // Set herf value
	});


	// Front End functions
	$(document).ready(function() {
		if (typeof web3 == 'undefined') {
			// Please install MetaMask first
			$('#installMetaMaskModal').modal('show');
		}
		$('#createNewContractButton').click(function() {
			$('#InputContractDataDiv').fadeIn('slow');
			$('#createNewContractButton').fadeOut('slow');
		});
	});

	// Logic for Web3 API
	window.addEventListener('load', function() {
		// Check if Web3 has been injected by the browser:
		if (typeof web3 !== 'undefined') {
			// You have a web3 browser! Continue below!
			initialization(web3, "knock-out");
		}
	})
</script>