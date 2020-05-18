const baf_abi=
[ { "inputs": [ { "internalType": "address payable", "name": "_chairperson", "type": "address" }, { "internalType": "uint256", "name": "_runTime", "type": "uint256" }, { "internalType": "uint256", "name": "_bidTime", "type": "uint256" } ], "payable": false, "stateMutability": "nonpayable", "type": "constructor" }, { "anonymous": false, "inputs": [ { "indexed": false, "internalType": "uint256", "name": "value", "type": "uint256" } ], "name": "Debug", "type": "event" }, { "anonymous": false, "inputs": [ { "indexed": false, "internalType": "address payable", "name": "winner", "type": "address" }, { "indexed": false, "internalType": "uint256", "name": "payout", "type": "uint256" } ], "name": "Payout", "type": "event" }, { "constant": false, "inputs": [ { "internalType": "uint256", "name": "stockValue", "type": "uint256" } ], "name": "bettingEnd", "outputs": [], "payable": true, "stateMutability": "payable", "type": "function" }, { "constant": false, "inputs": [ { "internalType": "uint256", "name": "bidValue", "type": "uint256" } ], "name": "bid", "outputs": [], "payable": true, "stateMutability": "payable", "type": "function" }, { "constant": true, "inputs": [], "name": "bidEndTime", "outputs": [ { "internalType": "uint256", "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [ { "internalType": "uint256", "name": "", "type": "uint256" } ], "name": "bids", "outputs": [ { "internalType": "address payable", "name": "account", "type": "address" }, { "internalType": "uint256", "name": "bid", "type": "uint256" }, { "internalType": "uint256", "name": "amount", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "chairperson", "outputs": [ { "internalType": "address payable", "name": "", "type": "address" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [ { "internalType": "address payable", "name": "addr", "type": "address" } ], "name": "getBalance", "outputs": [ { "internalType": "uint256", "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [ { "internalType": "address payable", "name": "bider", "type": "address" } ], "name": "getBidofAccount", "outputs": [ { "internalType": "uint256", "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": true, "inputs": [], "name": "runEndTime", "outputs": [ { "internalType": "uint256", "name": "", "type": "uint256" } ], "payable": false, "stateMutability": "view", "type": "function" }, { "constant": false, "inputs": [ { "internalType": "uint256", "name": "_newbidEndTime", "type": "uint256" } ], "name": "setbidEndTime", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" }, { "constant": false, "inputs": [ { "internalType": "uint256", "name": "_newrunEndTime", "type": "uint256" } ], "name": "setrunEndTime", "outputs": [], "payable": false, "stateMutability": "nonpayable", "type": "function" } ]
	const baf_byteCode="0x608060405234801561001057600080fd5b50604051610dc4380380610dc48339818101604052606081101561003357600080fd5b8101908080519060200190929190805190602001909291908051906020019092919050505082600360006101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff160217905550814201600181905550804201600281905550505050610d07806100bd6000396000f3fe6080604052600436106100915760003560e01c80634ba9a927116100595780634ba9a927146102445780636cf151f01461026f578063900181971461029d578063d5cc85da146102c8578063f8b2cb4f1461030357610091565b80630cd8b5ad146100965780632e4176cf146100d15780634262a0db146101285780634423c5f11461018d578063454a2ab314610216575b600080fd5b3480156100a257600080fd5b506100cf600480360360208110156100b957600080fd5b8101908080359060200190929190505050610368565b005b3480156100dd57600080fd5b506100e6610418565b604051808273ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200191505060405180910390f35b34801561013457600080fd5b506101776004803603602081101561014b57600080fd5b81019080803573ffffffffffffffffffffffffffffffffffffffff16906020019092919050505061043e565b6040518082815260200191505060405180910390f35b34801561019957600080fd5b506101c6600480360360208110156101b057600080fd5b8101908080359060200190929190505050610500565b604051808473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001838152602001828152602001935050505060405180910390f35b6102426004803603602081101561022c57600080fd5b8101908080359060200190929190505050610557565b005b34801561025057600080fd5b506102596106cc565b6040518082815260200191505060405180910390f35b61029b6004803603602081101561028557600080fd5b81019080803590602001909291905050506106d2565b005b3480156102a957600080fd5b506102b2610b31565b6040518082815260200191505060405180910390f35b3480156102d457600080fd5b50610301600480360360208110156102eb57600080fd5b8101908080359060200190929190505050610b37565b005b34801561030f57600080fd5b506103526004803603602081101561032657600080fd5b81019080803573ffffffffffffffffffffffffffffffffffffffff169060200190929190505050610be7565b6040518082815260200191505060405180910390f35b600360009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff161461040e576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526023815260200180610cb06023913960400191505060405180910390fd5b8060018190555050565b600360009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1681565b600080600090505b6000805490508110156104f9578273ffffffffffffffffffffffffffffffffffffffff166000828154811061047757fe5b906000526020600020906003020160000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1614156104ec57600081815481106104d257fe5b9060005260206000209060030201600101549150506104fb565b8080600101915050610446565b505b919050565b6000818154811061050d57fe5b90600052602060002090600302016000915090508060000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff16908060010154908060020154905083565b6001544211156105b2576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252602f815260200180610c4f602f913960400191505060405180910390fd5b60025442111561060d576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526032815260200180610c7e6032913960400191505060405180910390fd5b600060405180606001604052803373ffffffffffffffffffffffffffffffffffffffff168152602001838152602001348152509080600181540180825580915050906001820390600052602060002090600302016000909192909190915060008201518160000160006101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff160217905550602082015181600101556040820151816002015550505050565b60025481565b600360009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff1614610778576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526023815260200180610c2c6023913960400191505060405180910390fd5b6001544210156107d3576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526023815260200180610c096023913960400191505060405180910390fd5b600360149054906101000a900460ff1615610856576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252601a8152602001807f436f6e74726163742068617320616c726561647920656e64656400000000000081525060200191505060405180910390fd5b600080549050600114156109835760008060008154811061087357fe5b906000526020600020906003020160000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1690506000806000815481106108b657fe5b90600052602060002090600302016002015490507f5afeca38b2064c23a692c4cf353015d80ab3ecc417b4f893f372690c11fbd9a68282604051808373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020018281526020019250505060405180910390a18173ffffffffffffffffffffffffffffffffffffffff166108fc829081150290604051600060405180830381858888f1935050505015801561097b573d6000803e3d6000fd5b505050610b2e565b6001600360146101000a81548160ff021916908315150217905550600080905060006127109050600080600090505b600080549050811015610a7757600081815481106109cc57fe5b9060005260206000209060030201600201548401935060008082815481106109f057fe5b90600052602060002090600302016001015490506000818711610a1557868203610a19565b8187035b905080851115610a685780945060008381548110610a3357fe5b906000526020600020906003020160000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1693505b505080806001019150506109b2565b507f5afeca38b2064c23a692c4cf353015d80ab3ecc417b4f893f372690c11fbd9a68184604051808373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020018281526020019250505060405180910390a18073ffffffffffffffffffffffffffffffffffffffff166108fc849081150290604051600060405180830381858888f19350505050158015610b29573d6000803e3d6000fd5b505050505b50565b60015481565b600360009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff1614610bdd576040517f08c379a0000000000000000000000000000000000000000000000000000000008152600401808060200182810382526023815260200180610cb06023913960400191505060405180910390fd5b8060028190555050565b60008173ffffffffffffffffffffffffffffffffffffffff1631905091905056fe52756e74696d65206f6620636f6e7472616374206973206e6f74206f766572207965744e6f74207468652072696768747320746f20656e64207468697320636f6e74726163744e6f2062696420706f737369626c6520616e796d6f72652c207468652072756e2074696d652068617320656e6465644e6f2062696420706f737369626c6520616e796d6f72652c207468652074696d6520746f206269642068617320656e6465644e6f74207468652072696768747320746f206368616e676520746869732076616c7565a265627a7a7231582005985fc3cd6536dc70774f66377d8024467d7e388975f6bd1d84fd742ac10ea764736f6c63430005100032";
	const gas_estimate=2000000;
	const gas_price=web3.toWei(25, 'gwei');
	// const etherValue = web3.toWei(1, 'ether');
	function initialization(web3, type)
	{
		ethereum.enable();
		eth = new Eth(web3.currentProvider);

		ShareActions(window.location.href);
		listenForClicks(web3,type);
	}

	function listenForClicks (web3,type) {
		// var createContractButton = document.querySelector('#createContractButton');

		// createContractButton.addEventListener('click', function() {
		// 	if(type=="betting-against")
		// 	{
		// 		createNewContract_betting_against(web3);
		// 	}
		// 	else if(type=="knock-out")
		// 	{
		// 		createNewContract_knock_out(web3);
		// 	}
		// 	else
		// 	{
		// 		return;
		// 	}
		// })
	}

	shareBase="https://stockvoting.net/category/smart_contracts/bet_against_a_friend#share:";

	function ShareableLink( copyLink=false)
	{
		console.log("called");
		console.log(contract_address);
		// get link
		var shareableLink=shareBase+"contract_address="+contract_address;

		// Set ShareableLink in textfield
		document.getElementById('shareableLinkBody').innerText=shareableLink;

		// copy
		if(true==copyLink)
		{
			copyToClipboard("#shareableLinkBody");
		}

		return shareableLink;
	}

	// Don't know how this works, but it works...
	function copyToClipboard(element) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}


	// Actions that are triggered through the #share of the link URL
	function ShareActions(link)
	{
		if(link.includes(shareBase))
		{
			// minor todo: dynamically read contract_address -> independent of the position (search)
			// minor todo: convert strings to variables (if even possible)
			// link is shareable
			console.log("got linkData:"+link);
			var linkData=link.substr(shareBase.length);
			console.log("got linkData:"+linkData);

			option_contract_address="contract_address=";
			var contract_address=linkData.substr(option_contract_address.length);
			console.log("got address:"+contract_address);
			loadContract(contract_address);
		}
	}

	async function createNewContract_betting_against(web3) {
		$('#createContractDiv').fadeIn('slow'); 
		var firstAccount = web3.eth.accounts[0];
		var SampleContract = eth.contract(baf_abi);
		// To end betting
		var chairPersonAccount="0x281609b6005d3e3235230d9b88e5dd46f9078e76";

		txHashContract = await SampleContract.new(chairPersonAccount,30,3, {data: baf_byteCode, from: firstAccount, gas: gas_estimate});
		await waitForMinedContract(web3,txHashContract, "BAF");


		// // $.getJSON('https://ethgasstation.info/json/ethgasAPI.json', async function(data) {
		// // 	gasPrice=data["average"];
		// // 	gasPrice=web3.toWei(gasPrice, 'gwei');
		// 	// todo: gasPrice/gas/ gas limit?
		// // contractInstance = new SampleContract.new(30, {data: byteCode, from: firstAccount, gas: estimate, gasPrice: estimate});

		//todo: add date
	}
 
	function registerContractDB(contract_address, contract_class)
	{
		if(contract_class=="BAF")
		{
			php_function_call("AddContractDataBAF",[contract_address , "Sawyer", "John" ]  );
		}
		if(contract_class=="KO")
		{
			php_function_call("AddContractDataKO",[contract_address , "Sawyer", "John" ]  );
		}
	}
	
	function waitForMinedContract(web3,contract_address,contract_class) {   
		function innerWaitBlock() {
			web3.eth.getTransactionReceipt(contract_address, function(err, receipt){
				if (receipt && receipt.contractAddress) {
					console.log("Your contract has been deployed");
					registerContractDB(receipt.contractAddress, contract_class);
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


	// Knock Out
	const ko_abi= [	{		"constant": false,		"inputs": [],		"name": "buyShare",		"outputs": [],		"payable": true,		"stateMutability": "payable",		"type": "function"	},	{		"inputs": [			{				"internalType": "address payable",				"name": "_chairperson",				"type": "address"			},			{				"internalType": "uint256",				"name": "_knock_out_threshold",				"type": "uint256"			},			{				"internalType": "uint256",				"name": "_leverage",				"type": "uint256"			},			{				"internalType": "uint256",				"name": "_startPrice",				"type": "uint256"			},			{				"internalType": "uint256",				"name": "_runTime",				"type": "uint256"			},			{				"internalType": "bool",				"name": "_isPut",				"type": "bool"			}		],		"payable": true,		"stateMutability": "payable",		"type": "constructor"	},	{		"anonymous": false,		"inputs": [			{				"indexed": false,				"internalType": "address",				"name": "terminatorAddress",				"type": "address"			}		],		"name": "ContractEnded_ev",		"type": "event"	},	{		"constant": false,		"inputs": [],		"name": "endContract",		"outputs": [],		"payable": false,		"stateMutability": "nonpayable",		"type": "function"	},	{		"anonymous": false,		"inputs": [			{				"indexed": false,				"internalType": "uint256",				"name": "stockValue",				"type": "uint256"			}		],		"name": "KnockOut_ev",		"type": "event"	},	{		"constant": false,		"inputs": [],		"name": "retractContract",		"outputs": [],		"payable": false,		"stateMutability": "nonpayable",		"type": "function"	},	{		"constant": false,		"inputs": [],		"name": "sellShare",		"outputs": [],		"payable": true,		"stateMutability": "payable",		"type": "function"	},	{		"constant": false,		"inputs": [			{				"internalType": "uint256",				"name": "_newrunEndTime",				"type": "uint256"			}		],		"name": "setrunEndTime",		"outputs": [],		"payable": false,		"stateMutability": "nonpayable",		"type": "function"	},	{		"anonymous": false,		"inputs": [			{				"indexed": false,				"internalType": "address payable",				"name": "shareHolderAddress",				"type": "address"			},			{				"indexed": false,				"internalType": "uint256",				"name": "amount",				"type": "uint256"			}		],		"name": "ShareBought_ev",		"type": "event"	},	{		"anonymous": false,		"inputs": [			{				"indexed": false,				"internalType": "address payable",				"name": "shareHolderAddress",				"type": "address"			},			{				"indexed": false,				"internalType": "uint256",				"name": "amount",				"type": "uint256"			}		],		"name": "ShareSold_ev",		"type": "event"	},	{		"constant": false,		"inputs": [			{				"internalType": "uint256",				"name": "_minimum",				"type": "uint256"			},			{				"internalType": "uint256",				"name": "_closing_price",				"type": "uint256"			}		],		"name": "update",		"outputs": [],		"payable": true,		"stateMutability": "payable",		"type": "function"	},	{		"constant": false,		"inputs": [],		"name": "withdraw",		"outputs": [			{				"internalType": "bool",				"name": "",				"type": "bool"			}		],		"payable": false,		"stateMutability": "nonpayable",		"type": "function"	},	{		"constant": true,		"inputs": [			{				"internalType": "uint256",				"name": "",				"type": "uint256"			}		],		"name": "activeShareHolder",		"outputs": [			{				"internalType": "address payable",				"name": "account",				"type": "address"			},			{				"internalType": "uint256",				"name": "amount",				"type": "uint256"			},			{				"internalType": "uint256",				"name": "buying_closing_price",				"type": "uint256"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "chairperson",		"outputs": [			{				"internalType": "address payable",				"name": "",				"type": "address"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "contractCreator",		"outputs": [			{				"internalType": "address payable",				"name": "",				"type": "address"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "ended",		"outputs": [			{				"internalType": "bool",				"name": "",				"type": "bool"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "isPut",		"outputs": [			{				"internalType": "bool",				"name": "",				"type": "bool"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "knock_out_threshold",		"outputs": [			{				"internalType": "uint256",				"name": "",				"type": "uint256"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "last_closing_price",		"outputs": [			{				"internalType": "uint256",				"name": "",				"type": "uint256"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "leverage",		"outputs": [			{				"internalType": "uint256",				"name": "",				"type": "uint256"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [			{				"internalType": "address",				"name": "",				"type": "address"			}		],		"name": "pendingReturns",		"outputs": [			{				"internalType": "uint256",				"name": "",				"type": "uint256"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "pot",		"outputs": [			{				"internalType": "uint256",				"name": "",				"type": "uint256"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	},	{		"constant": true,		"inputs": [],		"name": "runEndTime",		"outputs": [			{				"internalType": "uint256",				"name": "",				"type": "uint256"			}		],		"payable": false,		"stateMutability": "view",		"type": "function"	}];
	const ko_byteCode="0x6080604052604051611788380380611788833981810160405260c081101561002657600080fd5b81019080805190602001909291908051906020019092919080519060200190929190805190602001909291908051906020019092919080519060200190929190505050856000806101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff160217905550846004819055508360058190555081420160078190555082600a819055503460028190555080600660006101000a81548160ff02191690831515021790555033600160006101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff16021790555050505050505061164a8061013e6000396000f3fe6080604052600436106101095760003560e01c806345216cee11610095578063708c73ea11610064578063708c73ea14610410578063900181971461043b578063aabf0eb614610466578063bb6e7de91461047d578063f3c274a61461049457610109565b806345216cee146103a65780634ba2363a146103b05780634da13c2e146103db5780636fcda95e146103e557610109565b806326b387bb116100dc57806326b387bb146102585780632c86d98e146102bd5780632e4176cf146102e85780632fb565e81461033f5780633ccfd60b1461037757610109565b806302c229d51461010e5780630cd8b5ad1461019757806312fa6feb146101d25780631e2f73b114610201575b600080fd5b34801561011a57600080fd5b506101476004803603602081101561013157600080fd5b81019080803590602001909291905050506104c3565b604051808473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001838152602001828152602001935050505060405180910390f35b3480156101a357600080fd5b506101d0600480360360208110156101ba57600080fd5b810190808035906020019092919050505061051a565b005b3480156101de57600080fd5b506101e76105c9565b604051808215151515815260200191505060405180910390f35b34801561020d57600080fd5b506102166105dc565b604051808273ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200191505060405180910390f35b34801561026457600080fd5b506102a76004803603602081101561027b57600080fd5b81019080803573ffffffffffffffffffffffffffffffffffffffff169060200190929190505050610602565b6040518082815260200191505060405180910390f35b3480156102c957600080fd5b506102d261061a565b6040518082815260200191505060405180910390f35b3480156102f457600080fd5b506102fd610620565b604051808273ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200191505060405180910390f35b6103756004803603604081101561035557600080fd5b810190808035906020019092919080359060200190929190505050610645565b005b34801561038357600080fd5b5061038c610831565b604051808215151515815260200191505060405180910390f35b6103ae610914565b005b3480156103bc57600080fd5b506103c5610c9e565b6040518082815260200191505060405180910390f35b6103e3610ca4565b005b3480156103f157600080fd5b506103fa610eca565b6040518082815260200191505060405180910390f35b34801561041c57600080fd5b50610425610ed0565b6040518082815260200191505060405180910390f35b34801561044757600080fd5b50610450610ed6565b6040518082815260200191505060405180910390f35b34801561047257600080fd5b5061047b610edc565b005b34801561048957600080fd5b506104926110ce565b005b3480156104a057600080fd5b506104a961124b565b604051808215151515815260200191505060405180910390f35b600881815481106104d057fe5b90600052602060002090600302016000915090508060000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff16908060010154908060020154905083565b6000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff16146105bf576040517f08c379a00000000000000000000000000000000000000000000000000000000081526004018080602001828103825260238152602001806115f36023913960400191505060405180910390fd5b8060078190555050565b600360009054906101000a900460ff1681565b600160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1681565b60096020528060005260406000206000915090505481565b60055481565b6000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1681565b6000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff16146106ea576040517f08c379a00000000000000000000000000000000000000000000000000000000081526004018080602001828103825260258152602001806115ce6025913960400191505060405180910390fd5b80821115610760576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252600e8152602001807f496e7075742069732077726f6e6700000000000000000000000000000000000081525060200191505060405180910390fd5b600360009054906101000a900460ff16156107e3576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252601a8152602001807f436f6e74726163742068617320616c726561647920656e64656400000000000081525060200191505060405180910390fd5b80600a81905550600660009054906101000a900460ff161561081857600454821115610813576108128261125e565b5b61082d565b60045482101561082c5761082b8261125e565b5b5b5050565b600080600960003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020549050600081111561090c576000600960003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff168152602001908152602001600020819055503373ffffffffffffffffffffffffffffffffffffffff166108fc829081150290604051600060405180830381858888f1935050505015801561090a573d6000803e3d6000fd5b505b600191505090565b600360009054906101000a900460ff1615610997576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252601a8152602001807f436f6e74726163742068617320616c726561647920656e64656400000000000081525060200191505060405180910390fd5b600754421115610a0f576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252601c8152602001807f436f6e7472616374206973206f766572207468652072756e74696d650000000081525060200191505060405180910390fd5b60008090505b600880549050811015610bf1573373ffffffffffffffffffffffffffffffffffffffff1660088281548110610a4657fe5b906000526020600020906003020160000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff161415610be457600060088281548110610aa357fe5b906000526020600020906003020160020154905060008182600a54036127100281610aca57fe5b059050610af58160088581548110610ade57fe5b90600052602060002090600302016001015461146c565b6009600060088681548110610b0657fe5b906000526020600020906003020160000160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000208190555060088381548110610b8357fe5b9060005260206000209060030201600080820160006101000a81549073ffffffffffffffffffffffffffffffffffffffff02191690556001820160009055600282016000905550506008805480919060019003610be09190611545565b5050505b8080600101915050610a15565b507f5d369d21d8f78fe3a2cd8842ba33a2974d141ab458c1b1e0e54c2332ac7f412733600960003373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200190815260200160002054604051808373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020018281526020019250505060405180910390a1565b60025481565b600360009054906101000a900460ff1615610d27576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252601a8152602001807f436f6e74726163742068617320616c726561647920656e64656400000000000081525060200191505060405180910390fd5b600754421115610d9f576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252601c8152602001807f436f6e7472616374206973206f766572207468652072756e74696d650000000081525060200191505060405180910390fd5b600860405180606001604052803373ffffffffffffffffffffffffffffffffffffffff168152602001348152602001600a548152509080600181540180825580915050906001820390600052602060002090600302016000909192909190915060008201518160000160006101000a81548173ffffffffffffffffffffffffffffffffffffffff021916908373ffffffffffffffffffffffffffffffffffffffff16021790555060208201518160010155604082015181600201555050507f9d9c9db34618dfe81661a31fe3051678b0807375b4665343550d9b8480a947293334604051808373ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020018281526020019250505060405180910390a1565b600a5481565b60045481565b60075481565b600160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff161480610f8457506000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff16145b610fd9576040517f08c379a00000000000000000000000000000000000000000000000000000000081526004018080602001828103825260258152602001806115ce6025913960400191505060405180910390fd5b600060088054905014611054576040517f08c379a000000000000000000000000000000000000000000000000000000000815260040180806020018281038252601b8152602001807f5765206861766520616374697665207368617265486f6c64657273000000000081525060200191505060405180910390fd5b60025460096000600160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000208190555060006002819055506110cc6110ce565b565b600160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff16148061117657506000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff16145b6111cb576040517f08c379a00000000000000000000000000000000000000000000000000000000081526004018080602001828103825260258152602001806115ce6025913960400191505060405180910390fd5b7f71a9748e87ebb0fd0ebf59d801148b7c6017fa6a40d36dff6504d5e5cfeee05433604051808273ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff16815260200191505060405180910390a16001600360006101000a81548160ff021916908315150217905550565b600660009054906101000a900460ff1681565b6000809054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff163373ffffffffffffffffffffffffffffffffffffffff1614611303576040517f08c379a00000000000000000000000000000000000000000000000000000000081526004018080602001828103825260258152602001806115ce6025913960400191505060405180910390fd5b600080905060008090505b6008805490508110156113b6576008818154811061132857fe5b906000526020600020906003020160010154820191506008818154811061134b57fe5b9060005260206000209060030201600080820160006101000a81549073ffffffffffffffffffffffffffffffffffffffff021916905560018201600090556002820160009055505060088054809190600190036113a89190611545565b50808060010191505061130e565b50600254810160096000600160009054906101000a900473ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1673ffffffffffffffffffffffffffffffffffffffff1681526020019081526020016000208190555060006002819055507fdd5009e40c1bb242c332ec184d4f71bbe65eceff47a8c83584b16c6a590745e8826040518082815260200191505060405180910390a16114686110ce565b5050565b600080600660009054906101000a900460ff16156114aa577fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff840293505b600061271060055486860202816114bd57fe5b05905060008113156114e4576000819050808501925080600254036002819055505061153a565b60007fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff82029050848110156115285780850392508060025401600281905550611538565b6000925084600254016002819055505b505b819250505092915050565b815481835581811115611572576003028160030283600052602060002091820191016115719190611577565b5b505050565b6115ca91905b808211156115c657600080820160006101000a81549073ffffffffffffffffffffffffffffffffffffffff0219169055600182016000905560028201600090555060030161157d565b5090565b9056fe4e6f74207468652072696768747320746f20706572666f726d207468697320616374696f6e4e6f74207468652072696768747320746f206368616e676520746869732076616c7565a265627a7a72315820873885a45f2f5dcd56f44832107db75e8b7a0108c50a9a51ad3384812c9245f664736f6c63430005100032";

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