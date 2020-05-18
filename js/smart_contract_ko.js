// Knock Out
async function createKOContract(element,typ, underlying, threshold, leverage, pot, ko_due_date) {
	$('#creatingContractDiv').fadeIn('slow'); 

	var isPut;
	if(typ=="Put")
	{
		isPut=true;
	}
	else
	{
		isPut=false;
	}

	ethereum.enable();
	eth = new Eth(web3.currentProvider);

	var firstAccount = web3.eth.accounts[0];
	var SampleContract = eth.contract(ko_abi);
	var chairPersonAccount="0x281609b6005d3e3235230d9b88e5dd46f9078e76";

	// const result = await doSomething();
	


	const obj= await getUnderLyingValue(underlying);
	var startPrice=obj.result;
	console.log("continuing");
	console.log(startPrice);
	console.log(startPrice.result);

	testPrice=startPrice;

	var runTime=864000;
	var isPut=false;
	emissionDate="2020-08-10";
	dueDate="2020-08-10";

	var contractData = new ContractData (typ,underlying, threshold, leverage, pot, emissionDate, ko_due_date);

	txHashContract = await SampleContract.new(chairPersonAccount, threshold, leverage, startPrice, runTime, isPut, {data: ko_byteCode, from: firstAccount, value:pot, gas: gas_estimate, gasPrice: gas_price});
	await waitForMinedContractKO(web3,txHashContract, contractData);


	// // $.getJSON('https://ethgasstation.info/json/ethgasAPI.json', async function(data) {
	// // 	gasPrice=data["average"];
	// // 	gasPrice=web3.toWei(gasPrice, 'gwei');
	// 	// todo: gasPrice/gas/ gas limit?
	// // contractInstance = new SampleContract.new(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});

	//todo: add date
}

function sleep(milliseconds) {
	const date = Date.now();
	let currentDate = null;
	do {
	  currentDate = Date.now();
	} while (currentDate - date < milliseconds);
  }
  

function doSomething() {
	return new Promise((resolve, reject) => {
	  console.log("It is done.");
	  // Succeed half of the time.
		sleep(2000);

		resolve("SUCCESS")
	})
  }


function getUnderLyingValue(underlying)
{
	return new Promise((resolve, reject) => {
		console.log("waiting in getUnder");
		var stockValue=php_function_call("getStockValue",[underlying], "ajaxCallback");
		resolve(stockValue)
	  })
}

function ajaxCallback()
{
	console.log("ajaxCallbac calledk");
}

function waitForMinedContractKO(web3,txHash, contractData) {   
	function innerWaitBlock() {
		web3.eth.getTransactionReceipt(txHash, function(err, receipt){
			if (receipt && receipt.contractAddress) {
				console.log("Your contract has been deployed");
				contractData.setContractAddress(receipt.contractAddress);
				registerContractKO(contractData);
				loadContract(receipt.contractAddress);
			} else {
				console.log("Waiting for mining of contract " );
				setTimeout(innerWaitBlock, 4000);
			}
		});
	}
	innerWaitBlock();
}

class ContractData
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

	
function registerContractKO(contractData)
{
	console.log(contractData.threshold);
	console.log(contractData.contract_address);
	php_function_call("AddContractDataKO",[contractData.contract_address , contractData.typ, contractData.underlying, contractData.threshold, contractData.leverage, contractData.pot, contractData.emissionDate, contractData.dueDate ]  );
}


async function buyShares (contract_address, amount) {
	var firstAccount = web3.eth.accounts[0];

	var newContract = eth.contract(ko_abi);
	contractInstance = await newContract.at(contract_address);
	
	var txHash= contractInstance.buyShare({ from: firstAccount, value: amount, gas: gas_estimate, gasPrice: gas_price});

	return;
}