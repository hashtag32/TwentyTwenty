function openLink(url, newTab = false) {
  location.href = url;
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
