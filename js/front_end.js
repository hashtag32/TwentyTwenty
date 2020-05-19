// Globals
var baseStocksURL = "https://stockvoting.net/stocks/";

// functions
function openLink(url, newTab = false) {
  location.href = url;
}

function search(searchTerm) {
  var tableName = "SymbolNameToStockName";
  var columns_array = ["StockName", "SymbolName"];

  return new Promise((resolve, reject) => {
    var result = php_function_call("SearchTerm", [
      tableName,
      columns_array,
      searchTerm,
    ]);
    resolve(result);
  });
}

// Actived on every page
$(window).scroll(function (e) {
  // Top
  // Margin (windowHeight)
  // Begin Article
  // ...
  // ...
  // End Article
  // Margin (windowHeight)
  // Bottom

  var windowHeight = $(window).height();
  var progressBar = $(".progress-bar");
  var progressBarDiv = $("#progressBarDiv");
  var currentTopPosition = $(this).scrollTop();
  var currentDownPosition = $(this).scrollTop() + windowHeight;
  var totalDocLength = $(document).height() - 2 * windowHeight;

  var currentPercentage =
    (currentTopPosition - windowHeight) / (totalDocLength - windowHeight);

  // Activate only within the article
  if (
    currentTopPosition > windowHeight &&
    currentTopPosition < totalDocLength
  ) {
    progressBarDiv.slideDown("slow");
    progressBar.css({ width: currentPercentage * $(window).width() });
  } else {
    // Hide
    progressBarDiv.slideUp("slow");
  }
});

// Front End functions
$(document).ready(function () {
  $("#createNewContractButton").click(function () {
    $("#InputContractDataDiv").fadeIn("slow");
    $("#createNewContractButton").fadeOut("slow");
  });

  $("#actionContractUser").on("show.bs.modal", function (event) {
    var contract_address = $(event.relatedTarget).data("val");
    $(this).find("#modal_contractAddress").text(contract_address);
    $(this)
      .find("#modal_contractAddressLink")
      .attr("href", "https://ropsten.etherscan.io/address/" + contract_address); // Set herf value
  });
});

$(document).ready(function () {
  //On pressing a key on "Search box" in "search.php" file. This function will be called.
  $("#search-form-1").keyup(async function () {
    //Assigning search box value to javascript variable named as "name".
    var searchTerm = $("#search-form-1").val();
    // console.log(name);
    //Validating, if "name" is empty.
    if (searchTerm == "") {
      //Assigning empty value to "display" div in "search.php" file.
      $("#display").html("");
    }
    //If name is not empty.
    else {
      // Result of wp based search (see php)
      resultPromise = await search(searchTerm);
      // Contains basically all results in the form [["SymbolName"=>"AAPL","StockName" => "AAPL"]]
      var resultArray = resultPromise.result;

      for (var i = 0; i < resultArray.length && i < 5; i++) {
        // List group counts from 1-5
        var element = $("#myList a:nth-child(" + (i + 1) + ")");
        element.fadeIn("slow");

        var symbolName = resultArray[i]["SymbolName"];
        var stockName = resultArray[i]["StockName"];

        element[0].innerText = stockName;
        element[0].href = baseStocksURL + symbolName;
      }
    }
  });
});
