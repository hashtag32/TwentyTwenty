class ContractData_SB {
  constructor(underlying, emissionDate, votingEndDate, dueDate) {
    this.underlying = underlying;
    this.emissionDate = emissionDate;
    this.votingEndDate = votingEndDate;
    this.dueDate = dueDate;
  }
  setContractAddress(contract_address) {
    this.contract_address = contract_address;
  }
}

async function createSBContract(element, underlying, votingEndDate, dueDate) {
  $("#loadingContractDiv").fadeIn("slow");
  var firstAccount = web3.eth.accounts[0];
  var StockBettingContract = eth.contract(sb_abi);

  var date_due_date = new Date(dueDate);
  var date_now = Date.now();
  var runTime = Math.floor(date_due_date - date_now) / 1000;

  var date_voting_end = new Date(votingEndDate);
  var bidTime = Math.floor(date_voting_end - date_now) / 1000;

  var emissionDate = getDateStr(date_now);

  var contractData = new ContractData_SB(
    underlying,
    emissionDate,
    votingEndDate,
    dueDate
  );

  // Contract creation
  var chairPersonAccount = "0x281609b6005d3e3235230d9b88e5dd46f9078e76";

  txHashContract = await StockBettingContract.new(
    chairPersonAccount,
    runTime,
    bidTime,
    {
      data: sb_byteCode,
      from: firstAccount,
      gas: gas_estimate,
      gasPrice: gas_price,
    }
  );
  await waitForMinedContractBAF(web3, txHashContract, contractData);
  //todo: gasprice calculation
  //todo: add date
}

function registerContractSB(contractData) {
  php_function_call("AddContractDataSB", [
    contractData.contract_address,
    contractData.underlying,
    contractData.emissionDate,
    contractData.votingEndDate,
    contractData.dueDate,
  ]);
}

function waitForMinedContractBAF(web3, contract_address, contractData) {
  function innerWaitBlock() {
    web3.eth.getTransactionReceipt(contract_address, function (err, receipt) {
      if (receipt && receipt.contractAddress) {
        console.log("Your contract has been deployed");
        contractData.setContractAddress(receipt.contractAddress);
        registerContractSB(contractData);
        loadContract(receipt.contractAddress, sb_abi);
      } else {
        console.log("Waiting for mining of contract ");
        setTimeout(innerWaitBlock, 4000);
      }
    });
  }
  innerWaitBlock();
}


async function sendBet(element, contract_address, bet_stock_price, bet_amount) {
  var firstAccount = web3.eth.accounts[0];

  var newContract = eth.contract(sb_abi);
  contractInstance = await newContract.at(contract_address);

  var txHash = contractInstance.bid(bet_stock_price, {
    from: firstAccount,
    value: bet_amount,
    gas: gas_estimate,
    gasPrice: gas_price,
  });

  php_function_call("AddContractDataSB_bet", [
    contract_address,
    firstAccount,
    bet_stock_price,
    bet_amount,
    ajax_unique.user_id,
  ]);
}

async function getchairPerson(miniToken) {
  chairPerson = await miniToken.chairperson.call();
  console.log(chairPerson);
  return chairPerson;
}
