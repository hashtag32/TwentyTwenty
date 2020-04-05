document.addEventListener("DOMContentLoaded", theDomHasLoaded, false);
window.addEventListener("load", pageFullyLoaded, false);

var VotingURL="https://stockvoting.net/voting";
var $ = jQuery;


function theDomHasLoaded(e) {
  if(window.location.href==VotingURL)
  {
    loadIncludes();
  }
}

// Will fire after theDomHasLoaded
function pageFullyLoaded(e) {
  if(window.location.href==VotingURL)
  {
    buildtemplates();
  }
}

function loadIncludes() {
  var script = document.createElement("script");

  script.src =
    "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js";
  document.getElementsByTagName("head")[0].appendChild(script);
}


function buildtemplates() {
  const listofStockNames = Object.keys(SymbolToStockName);

  listofStockNames.forEach(function(item, index, array) {
    // Create the div section (see voting_template.html) for each stock
    create_inst_of_template(item);
    request_voting(item); // will trigger a request to update the value of the voting_input boxes
  });
}

function create_inst_of_template(symbolName) {
  // Get parentElement
  var parentElement = document.getElementById("section-inner");

  // Create a copy of the template for creating an instance
  var template_clone = document
    .getElementById("voting-template")
    .cloneNode(true);

    // Search and replace the template_company with the stockName
    stockName = SymbolToStockName[symbolName];

  template_clone.innerHTML = template_clone.innerHTML.replace(
    new RegExp("template_company_stockName", "g"),
    stockName
  );

  template_clone.innerHTML = template_clone.innerHTML.replace(
    new RegExp("template_company_symbol", "g"),
    symbolName
  );

  // Append the new template inst in DOM
  parentElement.appendChild(template_clone.content);

  var gauge_id = "#gaugeID_" + symbolName;
  //todo: optimize path
  // https://api.jquery.com/load/
  $(gauge_id).load(
    "https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/gauge.html"
  );
}


function updateVotingValues(request_votingArray) {
  var request_votingArray_parsed = jQuery.parseJSON(request_votingArray);
  adjustGaugeToWindow(request_votingArray_parsed.symbolName); 
  changeVotingValues(
    request_votingArray_parsed.symbolName,
    request_votingArray_parsed.voting_number,
    request_votingArray_parsed.actual_value
  );
  changePrognosis(
    request_votingArray_parsed.symbolName,
    request_votingArray_parsed.voting_number
  );
}

function adjustGaugeToWindow(symbolName)
{
  var gauge_id = "gaugeID_" + symbolName;
  var gaugeElement = document.getElementById(gauge_id);

  // Setting the voting_number
  gaugeElement.children[0].dataset.width=window.innerWidth*0.2;
  gaugeElement.children[0].dataset.height=window.innerHeight*0.3;
}

// is callback, triggered from the request_voting
// request_voting(js) => request_votingfromServer (php) => MySQL
// MySQL => (return) request_votingfromServer(php) => (echo) request_voting(js)
// request_voting => changeVotingValues()
function changeVotingValues(symbolName, voting_number, actual_value) {
  if (voting_number == "") {
    voting_number = 0;
  }
  var votingInputIDStr = "voting_input_" + symbolName;
  var votingInputElement = document.getElementById(votingInputIDStr);

  // Set the voting number, received from the server

  votingInputElement.value = Math.round(actual_value);
  changeGauge(symbolName, voting_number, actual_value);
}

function changeGauge(symbolName, voting_number, actual_value) {
  var gauge_id = "gaugeID_" + symbolName;
  var gaugeElement = document.getElementById(gauge_id);

  // Setting the voting_number
  gaugeElement.children[0].dataset.value = getPercentage(
    actual_value,
    voting_number
  );

  // Set the voting number, received from the server
  gaugeElement.value = actual_value;
}

function changePrognosis(symbolName, voting_number) {
  var elementPrognosis = document.getElementById("prognosis_" + symbolName);

  elementPrognosis.innerHTML = voting_number + " $";
}

/*********************onLoad/onClick Functions******************/

/*********************Helper******************/
function getPercentage(actual_value, voting_number) {
  return (voting_number / actual_value - 1) * 100;
}



// Frontendfunctions.js
/*********************Style functions******************/

function changeVotingButtonAfterSend(element) {
     // Prohibit double voting
     element.disabled = true;
     // Change text to alternative value
     element.value = element.alt;
     // Change background to default
     element.style.background="#1d4e9e";
  }
  
// To ReadFile Function
function SymbolToStockNameDict(allText) {
  var endLineSeparation='\n';
  var splitLineSeparation=',';
  var allTextLines = allText.split(endLineSeparation);
  var headers = allTextLines[0].split(splitLineSeparation);

  // Iterate through all lines
  dict={};

  for (var i=1; i<allTextLines.length; i++) {
    
      var data = allTextLines[i].split(splitLineSeparation);
      // Check if header matches the data
      if (data.length == headers.length) {
        // Key is TSLA, value is Tesla 
        alert(data[0]);
        dict[data[0]]=data[1];
        }
      }
  return dict;
}

function delete_all_votes(element)
{
  $.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    dataType: "json",
    data: {
        action: "delete_votesServer",
        title: ajax_unique.title,
        user_id: ajax_unique.user_id
    },
    success: function(data, textStatus, XMLHttpRequest) {
      location.reload();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("Deleting didn't work. Try again.");
    }
});
}

// function push_SymbolToStockName_to_SQL()
// {
//   $.ajax({
//     type: "POST",
//     url: ajax_unique.ajaxurl,
//     dataType: "json",
//     data: {
//         action: "push_SymbolToStockName_to_SQL",
//         title: ajax_unique.title,
//         SymbolToStockName: SymbolToStockName
//     },
//     success: function(data, textStatus, XMLHttpRequest) {
//       location.reload();
//     },
//     error: function(XMLHttpRequest, textStatus, errorThrown) {
//         alert("Pushing didn't work. Try again.");
//     }
//   });
// }


// construct.js
/*	-----------------------------------------------------------------------------------------------
	Fade out entry-headers -> is automatically executed on every page
--------------------------------------------------------------------------------------------------- */
$(window).on('scroll', function () {
  $("#entry-header-inner-cover").css(
    {"opacity": 1 -( window.pageYOffset * 0.002)
  });
});




// Taken with formatting from csv
// csv -> Javascript here
// csv -> SQL Import manual
// csv is original file
var SymbolToStockName = {
  DJI:"Dow Jones Industrial Average",
  SPX:"S&P 500 Index",
  HSI:"Hang Seng Index",
  TSLA:"Tesla",
  AAPL:"Apple",
  AMZN:"Amazon.com",
  MSFT:"Microsoft",
  BCO:"Boeing",
  NVDA:"NVIDIA",
  FB:"Facebook",
  AMD:"AMD",
  GOOGL:"Alphabet A",
  V:"Visa Inc.",
  CMC:"JPMorgan", 
  BABA:"Alibaba",
  NFLX:"Netflix",
  ZM:"Zoom Video",
  GIS:"Gilead",
  T:"AT&T",
  DIS:"Walt Disney",
  NCB:"Bank of America",
  HD:"Home Depot",
  INTC:"Intel",
  ADBE:"Adobe",
  CVX:"Chevron",
  DAL:"Delta Air Lines",
  UNH:"UnitedHealth",
  CCL:"Carnival Corp",
  PFE:"Pfizer",
  MA:"Mastercard",
  BAC:"Verizon",
  C:"Citigroup",
  SHOP:"Shopify Inc",
  UBER:"Uber Tech",
  SBUX:"Starbucks",
  PG:"Procter&Gamble",
  WFC:"Wells Fargo&Co",
  CSCO:"Cisco",
  SQ:"Square Inc",
  AAL:"American Airlines",
  MCD:"McDonald’s",
  CRM:"Salesforce.com",
  COST:"Costco Wholesale",
  LMT:"Lockheed Martin",
  AXP:"American Express"
};



