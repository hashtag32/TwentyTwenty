document.addEventListener("DOMContentLoaded", theDomHasLoaded, false);
window.addEventListener("load", pageFullyLoaded, false);

var StockNameToSymbol = {
  Apple: "AAPL",
  SAP: "SAP",
  Tesla: "TSLA",
  Pfizer: "PFE"
};

function theDomHasLoaded(e) {
  loadIncludes();
}

// Will fire after theDomHasLoaded
function pageFullyLoaded(e) {
  buildtemplates();
}

function loadIncludes() {
  var script = document.createElement("script");

  script.src =
    "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js";
  document.getElementsByTagName("head")[0].appendChild(script);
}

function buildtemplates() {
  // todo: Get list of symbols from stockList.csv (common stocks - S&P, DAX, + indices)
  var listofStockNames = ["Apple", "Pfizer", "SAP", "Tesla"];

  listofStockNames.forEach(function(item, index, array) {
    // Create the div section (see voting_template.html) for each stock
    create_inst_of_template(item);
    request_voting(item); // will trigger a request to update the value of the voting_input boxes
  });
}

function create_inst_of_template(stockName) {
  // Get parentElement
  var parentElement = document.getElementById("section-inner");

  // Create a copy of the template for creating an instance
  var template_clone = document
    .getElementById("voting-template")
    .cloneNode(true);

  // Search and replace the template_company with the stockName
  template_clone.innerHTML = template_clone.innerHTML.replace(
    new RegExp("template_company_stockName", "g"),
    stockName
  );

  symbolName = StockNameToSymbol[stockName];
  template_clone.innerHTML = template_clone.innerHTML.replace(
    new RegExp("template_company_symbol", "g"),
    symbolName
  );

  // Append the new template inst in DOM
  parentElement.appendChild(template_clone.content);

  var gauge_id = "#gaugeID_" + stockName;
  //todo: optimize path
  // https://api.jquery.com/load/
  $(gauge_id).load(
    "https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/gauge.html"
  );
}

function updateVotingValues(request_votingArray) {
  var request_votingArray_parsed = jQuery.parseJSON(request_votingArray);
  changeVotingValues(
    request_votingArray_parsed.stockName,
    request_votingArray_parsed.voting_number,
    request_votingArray_parsed.actual_value
  );
  changePrognosis(
    request_votingArray_parsed.stockName,
    request_votingArray_parsed.voting_number
  );
}

// is callback, triggered from the request_voting
// request_voting(js) => request_votingfromServer (php) => MySQL
// MySQL => (return) request_votingfromServer(php) => (echo) request_voting(js)
// request_voting => changeVotingValues()
function changeVotingValues(stockName, voting_number, actual_value) {
  if (voting_number == "") {
    voting_number = 0;
  }
  var votingInputIDStr = "voting_input_" + stockName;
  var votingInputElement = document.getElementById(votingInputIDStr);

  // Set the voting number, received from the server

  votingInputElement.value = Math.round(actual_value);
  changeGauge(stockName, voting_number, actual_value);
}

function changeGauge(stockName, voting_number, actual_value) {
  var gauge_id = "gaugeID_" + stockName;
  var gaugeElement = document.getElementById(gauge_id);

  // Setting the voting_number
  gaugeElement.children[0].dataset.value = getPercentage(
    actual_value,
    voting_number
  );

  // Set the voting number, received from the server
  gaugeElement.value = actual_value;
}

function changePrognosis(stockName, voting_number) {
  var elementPrognosis = document.getElementById("prognosis_" + stockName);

  elementPrognosis.innerHTML = voting_number + " $";
}

/*********************onLoad/onClick Functions******************/

/*********************Helper******************/
function getPercentage(actual_value, voting_number) {
  return (voting_number / actual_value - 1) * 100;
}




/*********************Style functions******************/

function changeVotingButtonAfterSend(element) {
     // Prohibit double voting
     element.disabled = true;
     // Change text to alternative value
     element.value = element.alt;
     // Change background to default
     element.style.background="#1d4e9e";
  }
  