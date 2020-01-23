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
  // Get the elements to modify/load the template

  var fruits = ["Apple", "Pfizer", "SAP", "Tesla"];
  fruits.forEach(function(item, index, array) {
    // Create the div section (see voting_template.html) for each stock
    create_inst_of_template(item);
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
  $(gauge_id).load(
    "https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/gauge.html"
  );

  return;
}
