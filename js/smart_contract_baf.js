
	async function createNewContract_betting_against(web3) {
		$('#createContractDiv').fadeIn('slow'); 
		var firstAccount = web3.eth.accounts[0];
		var SampleContract = eth.contract(baf_abi); 
		// To end betting
		var chairPersonAccount="0x281609b6005d3e3235230d9b88e5dd46f9078e76";

		txHashContract = await SampleContract.new(chairPersonAccount,30,3, {data: baf_byteCode, from: firstAccount, gas: gas_estimate});
		await waitForMinedContract(web3,txHashContract, "BAF");
		//todo: gasprice calculation
		//todo: add date
	}
 
	function registerContractBAF(contract_address)
	{
		php_function_call("AddContractDataBAF",[contract_address , "Sawyer", "John" ]  );
	}
	
	function waitForMinedContractBAF(web3,contract_address) {   
		function innerWaitBlock() {
			web3.eth.getTransactionReceipt(contract_address, function(err, receipt){
				if (receipt && receipt.contractAddress) {
					console.log("Your contract has been deployed");
					registerContractBAF(receipt.contractAddress);
					loadContract(receipt.contractAddress);
				} else {
					console.log("Waiting for mining of contract " );
					setTimeout(innerWaitBlock, 4000);
				}
			});
		}
		innerWaitBlock();
	}

	async function loadContract(contract_address)
	{
		$('#createContractDiv').fadeIn('slow');

		var newContract = eth.contract(baf_abi);
		contractInstance = await newContract.at(contract_address);

		console.log(contractInstance);

		postContractloading( contractInstance);
	}

	async function getBidOfAccount(web3, account )
	{
		var returnArray=await contractInstance.getBidofAccount(account); //returns array
		var bidValue=returnArray[0]["words"][0];
	}

	function postContractloading(contractInstance)
	{
		$('#createContractDiv').fadeOut('slow');

		contract_address=contractInstance.address;

		document.getElementById('contractMinedHash').innerText=contract_address;
		document.getElementById('contractMinedHashLink').href="https://ropsten.etherscan.io/address/"+ contract_address;

		$('#LoadCreateContractDiv').fadeOut('slow');
		$('#BettingDiv').fadeIn('slow');
	}

	async function sendBet( element,selectedStock, bet_stock_price, bet_due_date, bet_amount) {
		ethereum.enable();

		eth = new Eth(web3.currentProvider);

		web3.eth.getAccounts(function(err, accounts)
		{
			firstAccount=accounts[0];
			console.log(bet_stock_price);
			console.log(bet_amount);
			var txHash= contractInstance.bid(bet_stock_price,{ from: firstAccount, value: bet_amount, gas: gas_estimate, gasPrice: gas_price });
		})
		//todo: save to sql (contractaddress + selectedStock)
	}

	async function getchairPerson (miniToken) {
		chairPerson= await miniToken.chairperson.call();
		console.log(chairPerson);
		return chairPerson;
	}