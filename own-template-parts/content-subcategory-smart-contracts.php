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

<!-- todo move to separate file -->
<header class="entry-header-white has-text-align-center header-footer-group">
	<div class="entry-header-inner section-inner medium">
		<h1 class="entry-title">Bet against a friend</h1>
	</div><!-- .entry-header-inner -->
</header>


	<?php

	$special_title="Smart Con";
	set_query_var('special_title', $special_title);


	// get_template_part('template-parts/entry-header');

	if (!is_search()) {
		get_template_part('template-parts/featured-image');
	}

	?>

<!-- todo: Heading -->
	<div class="post-inner">
		<div class="entry-content" style="font-size: 30px; font-weight:bold;">
		<form>
			<div class="form-group">
				<label for="stockPickSelect" >Stock</label>
				<select multiple class="form-control" style="font-size:large;" id="stockPickSelect">
				<!-- todo: StockName, but get it later in ajax?-> bad, better in save as key TSLA -->
					<?php foreach (getAllSymbols() as $symbol){	?> 
						<option><?php echo $symbol?>, <?php echo getStockName($symbol)?></option>
					<?php } ?>
				</select>

			</div>
			<button type="button" class="btn btn-primary btn-lg smart-contract-button" data-toggle="modal" data-target="#exampleModal" id="loadContractButton">Load contract</button>
			<button type="button" class="btn btn-primary btn-lg float-right smart-contract-button" id="createContractButton">Create contract</button>
		</form>

		<div id="createContractDiv" style="display: none;" > 
			<h2 class="own-h2 has-text-align-center" >Creating new contract...</h2> 
			<div class="text-center">
			<div class="spinner-grow" role="status">
				<span class="sr-only text-primary">Loading...</span>
			</div>
			</div>
		</div>
			

		<div id="BettingDiv" style="display: none;" > 
			<h2 class="own-h2 has-text-align-center" >New contract created in Tx</h2> 
			
			<a href="https://ropsten.etherscan.io/address/" target="_blank" id="contractMinedHashLink">
				<h2 class="own-h2 has-text-align-center " id="contractMinedHash"></h2>
			</a>
		
			<form>
				<div class="form-group">
					<label for="exampleInputEmail1">Place your bet for stock price in 30 days</label>
					<input type="email" class="form-control" id="betstockPrice" aria-describedby="emailHelp" placeholder="Place your bet">
					<!-- todo: Let select wei/ether -->
					<label for="exampleInputEmail1">Amount (wei)</label>
					<input type="email" class="form-control" id="betamount" aria-describedby="emailHelp" placeholder="Place your bet">
				</div>
				<div class="form-group text-center"> 
				
 
					<button type="button" onclick="sendBet(this,betamount.value, stockPickSelect.value, betamount.value)" class="btn btn-primary smart-contract-button btn-lg" id="SendBetButton"  >Send bet</button>
				</div> 
			</form>

		</div>



		<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" style="font-size: 20px; font-weight:bold; text-align:left;" id="exampleModalLabel">Load existing contract</h5>
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
		// Front End functions
		$(document).ready(function () {
			$('#createContractButton').click(function () {
			// $('#red-box').hide();
				$('#createContractDiv').fadeIn('slow');
			});
		});

		// $(document).ready(function () {
		// 	// When the new contracted is created
		// 	$('#createContractButton').click(function () {
		// 	// $('#red-box').hide();
		// 		$('#BettingDiv').fadeIn('slow');
		// 	});
		// });  


		// Logic for Web3 API
		window.addEventListener('load', function() {
		// Check if Web3 has been injected by the browser:
		if (typeof web3 !== 'undefined') {
			// You have a web3 browser! Continue below!
			initializationweb3(web3);
		} else {
			//alert("No hay web3");
			// Warn the user that they need to get a web3 browser
			// Or install MetaMask, maybe with a nice graphic.
		}
	})

	const abi= 
		[{"inputs":[{"internalType":"uint256","name":"_runTime","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Debug","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address payable","name":"winner","type":"address"},{"indexed":false,"internalType":"uint256","name":"payout","type":"uint256"}],"name":"Payout","type":"event"},{"constant":false,"inputs":[{"internalType":"uint256","name":"stockValue","type":"uint256"}],"name":"bettingEnd","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"bidValue","type":"uint256"}],"name":"bid","outputs":[],"payable":true,"stateMutability":"payable","type":"function"},{"constant":true,"inputs":[],"name":"bidEndTime","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"bids","outputs":[{"internalType":"address payable","name":"account","type":"address"},{"internalType":"uint256","name":"bid","type":"uint256"},{"internalType":"uint256","name":"amount","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"chairperson","outputs":[{"internalType":"address payable","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address payable","name":"addr","type":"address"}],"name":"getBalance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address payable","name":"bider","type":"address"}],"name":"getBidofAccount","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"runEndTime","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"_newbidEndTime","type":"uint256"}],"name":"setbidEndTime","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"_newrunEndTime","type":"uint256"}],"name":"setrunEndTime","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]

	const byteCode="0x608060405234801561001057600080fd5b50604051610db1380380610db18339818101604052602081101561003357600080fd5b810190808051906020019092919050505033600360006101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff1602179055508042016001819055506203f480420160028190555050610d07806100aa6000396000f3fe6080604052600436106100915760003560e01c80634ba9a927116100595780634ba9a927146102445780636cf151f01461026f578063900181971461029d578063d5cc85da146102c8578063f8b2cb4f1461030357610091565b80630cd8b5ad146100965780632e4176cf146100d15780634262a0db146101285780634423c5f11461018d578063454a2ab314610216575b600080fd5b3480156100a257600080fd5b506100cf600480360360208110156100b957600080fd5b8101908080359060200190929190505050610368565b005b3480156100dd57600080fd5b506100e6610418565b604051808273ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200191505060405180910390f35b34801561013457600080fd5b506101776004803603602081101561014b57600080fd5b81019080803573ffffffffffffffffffffffffffffffffffffffff16906020019092919050505061043e565b6040518082815260200191505060405180910390f35b34801561019957600080fd5b506101c6600480360360208110156101b057600080fd5b8101908080359060200190929190505050610500565b604051808473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001838152602001828152602001935050505060405180910390f35b6102426004803603602081101561022c57600080fd5b8101908080359060200190929190505050610557565b005b34801561025057600080fd5b506102596106cc565b6040518082815260200191505060405180910390f35b61029b6004803603602081101561028557600080fd5b81019080803590602001909291905050506106d2565b005b3480156102a957600080fd5b506102b2610b31565b6040518082815260200191505060405180910390f35b3480156102d457600080fd5b50610301600480360360208110156102eb57600080fd5b8101908080359060200190929190505050610b37565b005b34801561030f57600080fd5b506103526004803603602081101561032657600080fd5b81019080803573ffffffffffffffffffffffffffffffffffffffff169060200190929190505050610be7565b6040518082815260200191505060405180910390f35b600360009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff161461040e576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526023815260200180610cb06023913960400191505060405180910390fd5b8060018190555050565b600360009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1681565b600080600090505b6000805490508110156104f9578273ffffffffffffffffffffffffffffffffffffffff166000828154811061047757fe5b906000526020600020906003020160000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1614156104ec57600081815481106104d257fe5b9060005260206000209060030201600101549150506104fb565b8080600101915050610446565b505b919050565b6000818154811061050d57fe5b90600052602060002090600302016000915090508060000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff16908060010154908060020154905083565b6001544211156105b2576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252602f815260200180610c4f602f913960400191505060405180910390fd5b60025442111561060d576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526032815260200180610c7e6032913960400191505060405180910390fd5b600060405180606001604052803373ffffffffffffffffffffffffffffffffffffffff168152602001838152602001348152509080600181540180825580915050906001820390600052602060002090600302016000909192909190915060008201518160000160006101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff160217905550602082015181600101556040820151816002015550505050565b60025481565b600360009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff1614610778576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526023815260200180610c2c6023913960400191505060405180910390fd5b6001544210156107d3576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526023815260200180610c096023913960400191505060405180910390fd5b600360149054906101000a900460ff1615610856576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252601a8152602001807f436f6e74726163742068617320616c726561647920656e64656400000000000081525060200191505060405180910390fd5b600080549050600114156109835760008060008154811061087357fe5b906000526020600020906003020160000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1690506000806000815481106108b657fe5b90600052602060002090600302016002015490507f5afeca38b2064c23a692c4cf353015d80ab3ecc417b4f893f372690c11fbd9a68282604051808373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020018281526020019250505060405180910390a18173ffffffffffffffffffffffffffffffffffffffff166108fc829081150290604051600060405180830381858888f1935050505015801561097b573d6000803e3d6000fd5b505050610b2e565b6001600360146101000a81548160ff021916908315150217905550600080905060006127109050600080600090505b600080549050811015610a7757600081815481106109cc57fe5b9060005260206000209060030201600201548401935060008082815481106109f057fe5b90600052602060002090600302016001015490506000818711610a1557868203610a19565b8187035b905080851115610a685780945060008381548110610a3357fe5b906000526020600020906003020160000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1693505b505080806001019150506109b2565b507f5afeca38b2064c23a692c4cf353015d80ab3ecc417b4f893f372690c11fbd9a68184604051808373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020018281526020019250505060405180910390a18073ffffffffffffffffffffffffffffffffffffffff166108fc849081150290604051600060405180830381858888f19350505050158015610b29573d6000803e3d6000fd5b505050505b50565b60015481565b600360009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff1614610bdd576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526023815260200180610cb06023913960400191505060405180910390fd5b8060028190555050565b60008173ffffffffffffffffffffffffffffffffffffffff1631905091905056fe52756e74696d65206f6620636f6e7472616374206973206e6f74206f766572207965744e6f74207468652072696768747320746f20656e64207468697320636f6e74726163744e6f2062696420706f737369626c6520616e796d6f72652c207468652072756e2074696d652068617320656e6465644e6f2062696420706f737369626c6520616e796d6f72652c207468652074696d6520746f206269642068617320656e6465644e6f74207468652072696768747320746f206368616e676520746869732076616c7565a265627a7a7231582036ebbda95652eb935295f0d512161fb7dbb73a49923176ae0541459ed0ea7f4464736f6c634300051000320000000000000000000000000000000000000000000000000000000000278d00"
	const etherValue = web3.toWei(1, 'ether');
	// var address = '0x0F60841dFDD78535E11f71192e1dDeCE598fE541'
	function initializationweb3(web3)
	{
		ethereum.enable();
		
		eth = new Eth(web3.currentProvider);
		
		listenForClicks(web3);
	}

	function listenForClicks (web3) {
		var createContractButton = document.querySelector('#createContractButton');
		var loadContractButton = document.querySelector('#loadContractButton');

		createContractButton.addEventListener('click', function() {
			createNewContract(web3);
			// document.getElementById('contractMinedHash').innerText="test"
		})
		loadContractButton.addEventListener('click', function() {
			loadContract(web3, '0x8429804AB459cB6E07045BB6C762a30bEe509823');
		})
		// sendBetButton.addEventListener('click', function() {
		// 	// var element=document.getElementById('stockPickSelect');
		// 	// element.selectedOptions[0].text;
		// 	// console.log()
		// 	// sendBet(web3);
		// })
	}


	function waitBlock(contract_address) {
		function innerWaitBlock() {
			var receipt = web3.eth.getTransactionReceipt(contract_address, function(err, myContract){
			if (myContract && myContract.contractAddress) {
				console.log("Your contract has been deployed at http://testnet.etherscan.io/address/" + myContract.contractAddress);
				// console.log("Note that it might take 30 - 90 sceonds for the block to propagate befor it's visible in etherscan.io");
			} else {
				console.log("Waiting a mined block to include your contract... currently in block " );
				setTimeout(innerWaitBlock, 4000);
			}


			} );
			
		}
		innerWaitBlock();
	}

	// waitBlock(function () {
	// 	console.log("waitBlock - contract has been deployed");
	// // do stuff here now that the contract has been deployed
	// });



	async function createNewContract(web3) { 		
		$('#createContractDiv').fadeIn('slow');



		// eth = new Eth(web3.currentProvider);


		var newContract = eth.contract(abi);
		var firstAccount = web3.eth.accounts[0];

		console.log( newContract);

		estimate=1000000;
		console.log( newContract);
		contractInstance = await newContract.new(30, {data: byteCode, from: firstAccount, gas: estimate});

		test=await waitBlock(contractInstance);




		console.log(contractInstance);
		// var receipt = await web3.eth.getTransactionReceipt(contractInstance, function(err,data)
		// {
		// 	console.log(data);
		// });

		// web3.eth.getAccounts(async function(err, accounts) 
		// {
		// console.log(receipt);

		// chairPerson= await contractInstance.chairperson.call();
		// console.log(chairPerson);



		var myContractReturned = newContract.new(30, {
			from:firstAccount,
			data:byteCode,
			gas:estimate}, function(err, myContract){
			if(!err) {
				// NOTE: The callback will fire twice!
				// Once the contract has the transactionHash property set and once its deployed on an address.
				// e.g. check tx hash on the first call (transaction send)
				if(!myContract.address) {
					console.log(myContract.transactionHash) // The hash of the transaction, which deploys the contract
				
				// check address on the second call (contract deployed)
				} else {
					console.log(myContract.address) // the contract address
				}
				// Note that the returned "myContractReturned" === "myContract",
				// so the returned "myContractReturned" object will also get the address set.
			}
		});


		// SampleContract = eth.contract(abi);

		// web3.eth.getAccounts(async function(err, accounts) 
		// {

		// 			// todo: gasPrice/gas/ gas limit?
		// 	firstAccount=accounts[0];

		// 	estimate=100000;

		// 	contractInstance = await new SampleContract.new(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});
		// 	console.log(contractInstance); 

		// 	// contractInstance = await SampleContract.new.getData(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});
		// 	// console.log(contractInstance); 

		// 	// console.log(firstAccount); 

		// 	// MyContract = new web3.eth.contract(abi);
		// 	// estimate=100000;
		// 	// ontractInstance = new SampleContract.new(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});
		// 	// // var contractInstance = new MyContract.eth.new(30, {data: byteCode, from: firstAccount, gas: 1000000});
		// 	// console.log(ontractInstance);




 
		// 	// var myContract = new web3.eth.contract(abi, '0xcE7f64728e998aD96bD82e8b0603B9a3E32Cf8f7', {
		// 	// from: firstAccount, // default from address
		// 	// gasPrice: '20000000000' // default gas price in wei, 20 gwei in this case
		// 	// });

		// 	// console.log(MyContract);


		// 	// estimate=1000000;
		// 	// console.log( SampleContract); 
		// 	// console.log( firstAccount);

		// 	// var SampleContract2=myContract.clone();

		// 	// console.log(SampleContract2);

		// 	// newContract=new web3.eth.Contract(abi);

		// 	// myContract.deploy({
		// 	// 	data: byteCode,
		// 	// 	arguments: [30]
		// 	// })
		// 	// .send({
		// 	// 	from: firstAccount,
		// 	// 	gas: 1500000,
		// 	// 	gasPrice: '30000000000000'
		// 	// }, function(error, transactionHash){  })
		// 	// .on('error', function(error){  })
		// 	// .on('transactionHash', function(transactionHash){  })
		// 	// .on('receipt', function(receipt){
		// 	// console.log(receipt.contractAddress) // contains the new contract address
		// 	// })
		// 	// .on('confirmation', function(confirmationNumber, receipt){  })
		// 	// .then(function(newContractInstance){
		// 	// 	console.log(newContractInstance.options.address) // instance with the new contract address
		// 	// });









		
		// // $.getJSON('https://ethgasstation.info/json/ethgasAPI.json', async function(data) {
		// // 	gasPrice=data["average"];
		// // 	gasPrice=web3.toWei(gasPrice, 'gwei');
		// 	// todo: gasPrice/gas/ gas limit?
		// // contractInstance = new SampleContract.new(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});


		// // console.log( "contractInstance");
		// // console.log( contractInstance);
		
		// 	// web3.eth.getTransactionReceipt(contractInstance, async function(data){



		// })
			 
			
			

 

		//todo: add date
	
			// })
		// })
		
		// contractInstance = await newContract.new(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});

		// loadContract(contractInstance);

		// //todo: wait for transaction to be confirmed: https://ethereum.stackexchange.com/questions/67232/how-to-wait-until-transaction-is-confirmed-web3-js
		//todo: estimate gas  
		// var contractData = contractObject.new.getData(someparam, another, {data: byteCode});
		// var estimate = web3.eth.estimateGas({data: contractData});

		
		// //todo: wait for transaction to be confirmed: https://ethereum.stackexchange.com/questions/67232/how-to-wait-until-transaction-is-confirmed-web3-js
		postContractloading(contractInstance);

	}


	async function loadContract(web3, contract_address)
	{
		$('#createContractDiv').fadeIn('slow'); 
 

		var newContract = eth.contract(abi);
		contractInstance = await newContract.at(contract_address);

		console.log("loadContract:");

		console.log(contractInstance);


		postContractloading( contractInstance);

	}

	function postContractloading(contractInstance)
	{
		$('#createContractDiv').fadeOut('slow');

		document.getElementById('contractMinedHash').innerText=contractInstance; 
		document.getElementById('contractMinedHashLink').href="https://ropsten.etherscan.io/tx/"+ contractInstance; 
		
		//todo: wait for transaction to be confirmed: https://ethereum.stackexchange.com/questions/67232/how-to-wait-until-transaction-is-confirmed-web3-js
		$('#BettingDiv').fadeIn('slow');
	}

	async function sendBet( element,selectedStock, bidamount, bidvalue) {

		ethereum.enable();

		eth = new Eth(web3.currentProvider);

		web3.eth.getAccounts(function(err, accounts) 
		{
			firstAccount=accounts[0];


			console.log(firstAccount);


			// chairPerson= await contractInstance.chairperson.call();
			// console.log(chairPerson);

			console.log(bidvalue);
			console.log("sendBet contractInstance");
			console.log(contractInstance);
			// var bidvalue_val=bidvalue.val();
			// console.log(bidvalue_val);

			var txHash= contractInstance.bid(bidvalue,{ from: firstAccount, value: bidamount, gasPrice:100000, gas:100000 });
			console.log(txHash);

		})


		//todo: save to sql (contractaddress + selectedStock)
 
		 
		// eth = new Eth(web3.currentProvider);

	}

	
	// async function createContract (miniToken) {
	// 	chairPerson= await miniToken.chairperson.call();
	// 	console.log(chairPerson);
	// 	return chairPerson;
	// }

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

