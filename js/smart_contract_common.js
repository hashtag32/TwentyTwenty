const gas_estimate = 2000000;
const gas_price = web3.toWei(1, "gwei");

// Don't know how this works, but it works...
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}  

// Actions that are triggered through the #share of the link URL
function ShareActions(link) {
  if (link.includes(shareBase)) {
    // minor todo: dynamically read contract_address -> independent of the position (search)
    // minor todo: convert strings to variables (if even possible)
    // link is shareable
    console.log("got linkData:" + link);
    var linkData = link.substr(shareBase.length);
    console.log("got linkData:" + linkData);

    option_contract_address = "contract_address=";
    var contract_address = linkData.substr(option_contract_address.length);
    console.log("got address:" + contract_address);
    loadContract(contract_address);
  }
}

shareBase =
  "https://stockvoting.net/category/smart_contracts/bet_against_a_friend#share:";

function ShareableLink(copyLink = false) {
  console.log("called");
  console.log(contract_address);
  // get link
  var shareableLink = shareBase + "contract_address=" + contract_address;

  // Set ShareableLink in textfield
  document.getElementById("shareableLinkBody").innerText = shareableLink;

  // copy
  if (true == copyLink) {
    copyToClipboard("#shareableLinkBody");
  }

  return shareableLink;
}

// const etherValue = web3.toWei(1, 'ether');
function initialization(web3, type) {
  ethereum.enable();
  eth = new Eth(web3.currentProvider);

  ShareActions(window.location.href);
  listenForClicks(web3, type);
}

function listenForClicks(web3, type) {
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

function changeCurrency(value, unit_from, unit_to) {
  // console.log("input:" + value);
  var wei_value = web3.toWei(value, unit_from);
  // console.log("wei:"+wei_value);
  var unit_to_value=web3.fromWei(wei_value, unit_to);
  // console.log("unit_to:"+unit_to_value);

  return unit_to_value;
}


async function loadContract(contract_address)
{
  $('#loadingContractDiv').fadeIn('slow');

  var newContract = eth.contract(baf_abi);
  contractInstance = await newContract.at(contract_address);

  console.log(contractInstance);

  postContractloading( contractInstance);
}


function postContractloading(contractInstance)
{
  $('#loadingContractDiv').fadeOut('slow');

  contract_address=contractInstance.address;

  document.getElementById('contractMinedHash').innerText=contract_address;
  document.getElementById('contractMinedHashLink').href="https://ropsten.etherscan.io/address/"+ contract_address;

  // $('#LoadCreateContractDiv').fadeOut('slow');
  // $('#BettingDiv').fadeIn('slow');
  $('#ContractLoadingResultDiv').fadeIn('slow');
}

function getDateStr(date)
{
	const dateTimeFormat = new Intl.DateTimeFormat('en', { year: 'numeric', month: '2-digit', day: '2-digit' }) 
	const [{ value: month },,{ value: day },,{ value: year }] = dateTimeFormat .formatToParts(date ) ;
	var dateStr=`${year}-${month}-${day }`;

	return dateStr;

}
