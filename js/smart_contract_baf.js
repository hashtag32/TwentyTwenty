
	async function createNewContract_betting_against() {
		$('#loadingContractDiv').fadeIn('slow'); 
		var firstAccount = web3.eth.accounts[0];
		var SampleContract = eth.contract(baf_abi); 
		// To end betting
		var chairPersonAccount="0x281609b6005d3e3235230d9b88e5dd46f9078e76";
		var runTime=86400*30;
		txHashContract = await SampleContract.new(chairPersonAccount,runTime,runTime, {data: baf_byteCode, from: firstAccount, gas: gas_estimate, gasPrice: gas_price});
		await waitForMinedContractBAF(web3,txHashContract, "BAF");
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


	async function getBidOfAccount(web3, account )
	{
		var returnArray=await contractInstance.getBidofAccount(account); //returns array
		var bidValue=returnArray[0]["words"][0];
	}



	async function sendBet( element,selectedStock, bet_stock_price, bet_due_date, bet_amount) {
		var firstAccount = web3.eth.accounts[0];

		var txHash= contractInstance.bid(bet_stock_price,{ from: firstAccount, value: bet_amount, gas: gas_estimate, gasPrice: gas_price });
		//todo: save to sql (contractaddress + selectedStock)
	}

	async function getchairPerson (miniToken) {
		chairPerson= await miniToken.chairperson.call();
		console.log(chairPerson);
		return chairPerson;
	}