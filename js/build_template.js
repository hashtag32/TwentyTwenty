// Listen to page loading
// todo: doesn't this fire on every site?
document.addEventListener("DOMContentLoaded", theDomHasLoaded, false);
window.addEventListener("load", pageFullyLoaded, false);

function theDomHasLoaded(e) {
  // do something
}

// Will fire after theDomHasLoaded
function pageFullyLoaded(e) {
  buildtemplates();
}

function buildtemplates() {
  // todo: Get the list of stocks from the server
  var listofStocks = ["AAPL", "Pfizer", "SAP", "Tesla", "Chen"];
  listofStocks.forEach(function(item, index, array) {
    // Create the div section (see voting_template.html) for each stock
    create_inst_of_template(item);
    request_voting(item); // will trigger a request to update the value of the voting_input boxes
    request_actual_value(item);
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
    new RegExp("template_company", "g"),
    stockName
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

function updateVotingValues(stockName, voting_number) {
  changeVotingValues(stockName, voting_number);
}

// is callback, triggered from the request_voting
// request_voting(js) => request_votingfromServer (php) => MySQL
// MySQL => (return) request_votingfromServer(php) => (echo) request_voting(js)
// request_voting => changeVotingValues()
function changeVotingValues(stockName, voting_number) {
  if (voting_number == "") {
    voting_number = 0;
  }
  var votingInputIDStr = "voting_input_" + stockName;
  var votingInputElement = document.getElementById(votingInputIDStr);

  // Set the voting number, received from the server

  votingInputElement.value = voting_number;
  // changeGauge(stockName, voting_number);
}

function changeGauge(stockName, voting_number) {
  var gauge_id = "gaugeID_" + stockName;
  var gaugeElement = document.getElementById(gauge_id);

  // Setting the voting_number
  gaugeElement.children[0].dataset.value = voting_number;

  // Set the voting number, received from the server
  gaugeElement.value = voting_number;
}
