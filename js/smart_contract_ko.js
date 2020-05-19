// Knock Out //

// Class for php insertion 
class ContractData_KO
{
	constructor (typ,underlying, threshold, leverage, pot, emissionDate, dueDate ) {
		this.typ=typ;
		this.underlying=underlying;
		this.threshold=threshold;
		this.leverage=leverage;
		this.pot=pot;
		this.emissionDate=emissionDate;
		this.dueDate=dueDate;
		}
		setContractAddress(contract_address) 
		{
			this.contract_address=contract_address;
		}
}

async function createKOContract(element,typ, underlying, threshold, leverage, pot,pot_currency, dueDate) {
	$('#loadingContractDiv').fadeIn('slow'); 

	ethereum.enable();
	eth = new Eth(web3.currentProvider);

	// Get input parameters straight
	var isPut;
	if(typ=="Put")
	{
		isPut=true;
	}
	else
	{
		isPut=false;
	}

	var pot_wei=changeCurrency(pot,pot_currency, "wei");

	const obj= await getUnderLyingValue(underlying);
	var startPrice=obj.result;

	var date_due_date = new Date(dueDate); 
	var date_now = Date.now();
	var runTime=Math.floor(date_due_date-date_now)/1000;
	
	emissionDate=getDateStr(date_now);

	// Contract creation 
	var firstAccount = web3.eth.accounts[0];
	var SampleContract = eth.contract(ko_abi);
	var chairPersonAccount="0x281609b6005d3e3235230d9b88e5dd46f9078e76";
	
	var contractData = new ContractData_KO (typ,underlying, threshold, leverage, pot_wei, emissionDate, dueDate);
	
	console.log("Creating contract with the following data:");
	console.log(chairPersonAccount, threshold, leverage, startPrice, runTime, isPut, {data: ko_byteCode, from: firstAccount, value:pot_wei, gas: gas_estimate, gasPrice: gas_price});
	txHashContract = await SampleContract.new(chairPersonAccount, threshold, leverage, startPrice, runTime, isPut, {data: ko_byteCode, from: firstAccount, value:pot_wei, gas: gas_estimate, gasPrice: gas_price});
	await waitForMinedContractKO(web3,txHashContract, contractData);


	// // $.getJSON('https://ethgasstation.info/json/ethgasAPI.json', async function(data) {
	// // 	gasPrice=data["average"];
	// // 	gasPrice=web3.toWei(gasPrice, 'gwei');
	// 	// todo: gasPrice/gas/ gas limit?
	// // contractInstance = new SampleContract.new(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});

	//todo: add date
}

function getUnderLyingValue(underlying)
{
	return new Promise((resolve, reject) => {
		console.log("Waiting to obtain underlying value");
		var stockValue=php_function_call("getStockValue",[underlying], "ajaxCallback");
		resolve(stockValue);
	  });
}

function waitForMinedContractKO(web3,txHash, contractData) {   
	function innerWaitBlock() {
		web3.eth.getTransactionReceipt(txHash, function(err, receipt){
			if (receipt && receipt.contractAddress) {
				console.log("Your contract has been deployed");
				contractData.setContractAddress(receipt.contractAddress);
				registerContractKO(contractData);
				loadContract(receipt.contractAddress, ko_abi);
			} else {
				console.log("Waiting for mining of contract " );
				setTimeout(innerWaitBlock, 4000);
			}
		});
	}
	innerWaitBlock();
}


function registerContractKO(contractData)
{
	php_function_call("AddContractDataKO",[contractData.contract_address , contractData.typ, contractData.underlying, contractData.threshold, contractData.leverage, contractData.pot, contractData.emissionDate, contractData.dueDate ]  );
}


async function buyShares (contract_address, amount) {
	var firstAccount = web3.eth.accounts[0];

	var newContract = eth.contract(ko_abi);
	contractInstance = await newContract.at(contract_address);
	
	var txHash= contractInstance.buyShare({ from: firstAccount, value: amount, gas: gas_estimate, gasPrice: gas_price});

	return;
}