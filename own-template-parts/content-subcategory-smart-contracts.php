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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part('template-parts/entry-header');

	if (!is_search()) {
		get_template_part('template-parts/featured-image');
	}

	?>

<!-- todo: Heading -->
	<div class="post-inner">
		<div class="entry-content" style="font-size: 30px; font-weight:bold;">
		<form>
			<div class="form-group">
				<label for="exampleFormControlSelect2" >Stock</label>
				<select multiple class="form-control" style="font-size:large;" id="exampleFormControlSelect2">
					<?php foreach (getAllSymbols() as $symbol){	?> 
						<option><?php echo getStockName($symbol)?></option>
					<?php } ?>
				</select>
			</div>
			<button type="button" class="btn btn-primary btn-lg smart-contract-button" data-toggle="modal" data-target="#exampleModal">Load contract</button>
			<button type="button" class="btn btn-primary btn-lg float-right smart-contract-button" id="createContractButton">Create contract</button>
		</form>

		<div id="welcomeDiv"  style="display:none;" class="answer_list" > WELCOME</div>
<input id="ShowButton" type="button" name="answer" value="Show Div" />





		<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left style="font-size: 20px; font-weight:bold; text-align:left;" id="exampleModalLabel">Load existing contract</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
		<form>
			<div class="form-group">
				<label for="exampleInputEmail1">Enter your contract address:</label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="0xcE7f64728e998aD96bD82e8b0603B9a3E32Cf8f7">
			</div>
		</form>
      </div>
      <div class="modal-footer">
		<button type="submit" class="btn btn-secondary">Submit</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
		


		<!-- <form name="vote_form" method="post" >

				<input 
				type="button" 
				class="button-voting"
				onclick="symbol_chosen(this,symbol_chose.value)"
				value="Bet" 
				alt="Thank you!"/>
			</form> -->
<!-- 
			<button class="createContract">Create contract</button>
			<button class="setbid">Bid!</button>
			<button class="changeVotingTime">Change Voting Time!</button>
			<button class="displayChairPerson">Show ChairPerson!</button> -->

		</div><!-- /wp:entry-content -->
	</div><!-- /wp:post-inner -->

	<script src="https://rawgit.com/ethereum/web3.js/0.16.0/dist/web3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/ethjs@0.3.0/dist/ethjs.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#ShowButton').click(function () {
			// $('#red-box').hide();
				$('#welcomeDiv').fadeIn('slow');
			});
		});



//    document.getElementById('welcomeDiv').style.display = "block";
		window.addEventListener('load', function() {
		// Check if Web3 has been injected by the browser:
		if (typeof web3 !== 'undefined') {
			// You have a web3 browser! Continue below!
			startApp(web3);
			//alert("Web3");
		} else {
			//alert("No hay web3");
			// Warn the user that they need to get a web3 browser
			// Or install MetaMask, maybe with a nice graphic.
		}
	})
	const abi=
		[{"inputs":[{"internalType":"uint256","name":"_runTime","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Debug","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address payable","name":"winner","type":"address"},{"indexed":false,"internalType":"uint256","name":"payout","type":"uint256"}],"name":"Payout","type":"event"},{"constant":false,"inputs":[{"internalType":"uint256","name":"stockValue","type":"uint256"}],"name":"bettingEnd","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"bidValue","type":"uint256"}],"name":"bid","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":true,"inputs":[],"name":"bidEndTime","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"bids","outputs":[{"internalType":"address payable","name":"account","type":"address"},{"internalType":"uint256","name":"bid","type":"uint256"},{"internalType":"uint256","name":"amount","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"chairperson","outputs":[{"internalType":"address payable","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address payable","name":"addr","type":"address"}],"name":"getBalance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address payable","name":"bider","type":"address"}],"name":"getBidofAccount","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"runEndTime","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"_newbidEndTime","type":"uint256"}],"name":"setbidEndTime","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"_newrunEndTime","type":"uint256"}],"name":"setrunEndTime","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]



	const contract_address = '0xcE7f64728e998aD96bD82e8b0603B9a3E32Cf8f7'
	const etherValue = web3.toWei(1, 'ether');
	var address = '0x0F60841dFDD78535E11f71192e1dDeCE598fE541'
	function startApp(web3) {
		ethereum.enable();

		console.log("entro");
		const eth = new Eth(web3.currentProvider)
		const token = eth.contract(abi).at(contract_address);
		listenForClicks(token,web3);

		console.log("llego");
		// const web3 = new Web3(Web3.givenProvider);
		// const accounts = await web3.eth.getAccounts();
		// console.log(accounts);
		// const sign = await web3.eth.personal.sign('dataToSign', accounts[0]);
	}
	function listenForClicks (miniToken, web3) {
		console.log("now listening");
		console.log(miniToken);
		var createContractbutton = document.querySelector('#createContractButton');
		var Contractbutton = document.querySelector('#createContractButton');
		web3.eth.getAccounts(function(err, accounts) { console.log(accounts); address = accounts.toString(); })
		createContractbutton.addEventListener('click', function() {
			console.log("trying to transfer");
			getchairPerson(miniToken);

			// miniToken.transfer(contract_address, etherValue, { from: address });
		})
	}

	async function createContract (miniToken) {
		chairPerson= await miniToken.chairperson.call();
		console.log(chairPerson);
		return chairPerson;
	}

	async function getchairPerson (miniToken) {
		chairPerson= await miniToken.chairperson.call();
		console.log(chairPerson);
		return chairPerson;
	}

	// async function waitForTxToBeMined (txHash) {
	// 	let txReceipt
	// 	while (!txReceipt) {
	// 		try {
	// 			txReceipt = await eth.getTransactionReceipt(txHash)
	// 		} catch (err) {
	// 			return indicateFailure(err)
	// 		}
	// 	}
	// 	indicateSuccess()
	// }
	</script>


</article><!-- .post -->