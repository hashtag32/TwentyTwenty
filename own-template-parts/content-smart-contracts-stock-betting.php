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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/f2103e8f69.js"></script>

<?php get_template_part('template-parts/entry-header'); ?>


<div class="post-inner">

	<a href="https://stockvoting.net/faq/#smart-contracts">
		<img data-toggle="tooltip" data-placement="top" title="Ask me" class="helping-ape font-tooltip" src="https://stockvoting.net/wp-content/uploads/2020/05/helping_ape.png">
	</a>
	
	<div class="entry-content entry-smart-contract">

		<!-- Overview existing bettings table -->
		<figure class="wp-block-table alignwide is-style-stripes">
			<table class="table table-striped has-subtle-pale-blue-background-color has-background sv-table table-hover">

				<thead class="thead-dark">
					<tr>
						<th class="has-text-align-center" data-align="center">Underlying</th>
						<th class="has-text-align-center" data-align="center">Emission Date</th>
						<th class="has-text-align-center" data-align="center">Voting End</th>
						<th class="has-text-align-center" data-align="center">Due <Date/th> 
						<th class="has-text-align-center" data-align="center">Details</th>
					</tr>
				</thead>
				<!-- Iterate over all votings -->
				<?php
				foreach (getAllSB() as $SB_contract) {
				?>
					<tr class="table-row" data-target="#actionContractUser" data-val="<?php echo $SB_contract["contract_address"] ?>" data-toggle="modal">
						<td class="has-text-align-center" data-align="center">
							<a href="<?php echo get_symbol_link($SB_contract["underlying"]) ?>" target="_blank">
								<?php echo getStockName($SB_contract["underlying"]) ?>
							</a>
						</td>
						<td class="has-text-align-center" data-align="center"><?php echo $SB_contract["emissionDate"] ?></td>
						<td class="has-text-align-center" data-align="center"><?php echo $SB_contract["votingEndDate"] ?></td>
						<td class="has-text-align-center" data-align="center"><?php echo $SB_contract["dueDate"] ?></td>
						<td class="has-text-align-center has-accent-color" data-align="center">
							<a href="<?php echo get_ropsten_link($SB_contract["contract_address"]) ?>" target="_blank">
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
			<button type="button" class="btn btn-primary smart-contract-button btn-lg" id="createNewContractButton"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create new betting</button>
		</div>


		<!-- Input contract data div -->
		<div id="InputContractDataDiv" style="display: none;">
			<h2 class="own-h2 has-text-align-center has-accent-color" style="font-size:35px">New contract creation</h2>

			<form>
				<div class="form-group">
					<label for="stockPickSelect">Underlying (use Ctrl+F to search)</label>
					<select multiple class="form-control" style="font-size:large;" id="stockPickSelect">
						<!-- todo: StockName, but get it later in ajax?-> bad, better in save as key TSLA -->
						<?php foreach (getAllSymbols(true) as $symbolArray) {	?>
							<option value="<?php echo $symbolArray["SymbolName"] ?>"><?php echo $symbolArray["StockName"] ?></option>
						<?php } ?>
					</select>

					<label>Voting End Date</label>
					<input class="form-control" type="date" value="2020-08-19" id="votingEnd" placeholder="After this date, voting is closed">

					<label>Due Date</label>
					<input class="form-control" type="date" value="2020-10-19" id="dueDate" placeholder="Date to resolve betting">
				</div>
				<!-- Create it! button -->
				<div class="form-group text-center">
					<button type="button" class="btn btn-primary smart-contract-button btn-lg" onclick="createSBContract(this, stockPickSelect.value, votingEnd.value, dueDate.value);" id="CreatItButton">Create it!</button>
				</div>
			</form>
		</div>


		<!-- ProgressDiv (...creation in progress...) -->
		<!-- todo: rename to progressingContractDiv -->
		<div id="loadingContractDiv" style="display: none;">
			<h2 class="own-h2 has-text-align-center">Loading/Creating contract...</h2>
			<div class="text-center">
				<div class="spinner-grow" role="status">
					<span class="sr-only text-primary">Loading...</span>
				</div>
			</div>
		</div>

		<!-- Successfully loaded -->
		<div id="ContractLoadingResultDiv" style="display: none;">
			<h2 class="own-h2 has-text-align-center has-accent-color" style="font-size:35px">Contract successfully created:</h2>

			<a href="" target="_blank" id="contractMinedHashLink">
				<h2 class="own-h2 has-text-align-center has-accent-color" id="contractMinedHash"></h2>
			</a>
		</div>


		<!-- Modal/Popup for Sending Bet Shares -->
		<div class="modal fade" id="actionContractUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

					<!-- Header -->
					<div class="modal-header">
						<h5 class="modal-title text-left" id="exampleModalLabel">Send Bet</h5>
					</div>

					<!-- Body -->
					<div class="modal-body">
						<h2 class="own-h2 has-text-align-center" id="contractAddress">Contract address</h2>
						<a href="https://ropsten.etherscan.io/address/" target="_blank" id="modal_contractAddressLink">
							<h2 class="own-h2 has-text-align-center has-accent-color" id="modal_contractAddress">0x123</h2>
						</a>

						<form>
							<label for="bet_stock_price">Stock price</label>
							<input type="email" class="form-control" id="bet_stock_price" aria-describedby="emailHelp" placeholder="Place your predicted stock Price">
							<!-- todo: Let select wei/ether -->

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
						<button type="submit" onclick="sendBet(this,modal_contractAddress.textContent,bet_stock_price.value,buyingAmount.value)" data-dismiss="modal" class="btn btn-primary">Send</button>
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

		<?php get_template_part('own-parts/install-cryptoWallet'); ?>

	</div><!-- .entry-content -->
</div><!-- .post-inner -->
<script src="https://rawgit.com/ethereum/web3.js/0.16.0/dist/web3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ethjs@0.3.0/dist/ethjs.min.js"></script>
<script>
	// Front End functions
	// $(document).ready(function() {
	// 	$('#createContractButton').click(function() {
	// 		$('#createContractDiv').fadeIn('slow');
	// 	});
	// });

	// Logic for Web3 API
	window.addEventListener('load', function() {
		// Check if Web3 has been injected by the browser:
		if (typeof web3 !== 'undefined') {
			// You have a web3 browser! Continue below!
			initialization(web3);
		}
	})

	// var createContractButton = document.querySelector('#createContractButton');
	// createContractButton.addEventListener('click', function() {
	// 	createNewContract_sb();
	// });
</script>