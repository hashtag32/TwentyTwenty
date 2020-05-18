	// Knock Out
	async function createKOContract(element,contractType, symbol, threshold, leverage, pot, ko_due_date) {
		$('#creatingContractDiv').fadeIn('slow'); 

		var isPut;
		if(contractType=="Put")
		{
			isPut=true;
		}
		else
		{
			isPut=false;
		}
		

		// php_function_call("AddContractDataKO",[contract_address , "Sawyer", "John" ]  );


		var firstAccount = web3.eth.accounts[0];
		var SampleContract = eth.contract(ko_abi);
		// To end betting
		var chairPersonAccount="0x281609b6005d3e3235230d9b88e5dd46f9078e76";
		var startPrice=10; // todo: get this one from db
		var runTime=30;
		var isPut=false;;


		txHashContract = await SampleContract.new(chairPersonAccount, threshold, leverage, startPrice, runTime, isPut, {data: ko_byteCode, from: firstAccount, value:pot, gas: gas_estimate, gasPrice: gas_price});
		await waitForMinedContract(web3,txHashContract, "KO");


		// // $.getJSON('https://ethgasstation.info/json/ethgasAPI.json', async function(data) {
		// // 	gasPrice=data["average"];
		// // 	gasPrice=web3.toWei(gasPrice, 'gwei');
		// 	// todo: gasPrice/gas/ gas limit?
		// // contractInstance = new SampleContract.new(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});

		//todo: add date
	}
	async function buyShares (contract_address, amount) {
		var newContract = eth.contract(ko_abi);
		contractInstance = await newContract.at(contract_address);
		
		var txHash= contractInstance.buyShares({ from: firstAccount, value: amount, gas: gas_estimate });

		console.log("Bought shares at");
		return;
	}