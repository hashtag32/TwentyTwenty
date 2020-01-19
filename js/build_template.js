// Listen to page loading
// todo: doesn't this fire on every site?
document.addEventListener("DOMContentLoaded", theDomHasLoaded, false);
window.addEventListener("load", pageFullyLoaded, false);

function theDomHasLoaded(e) {
  // do something
}

function pageFullyLoaded(e) {
  buildtemplates();
}

function buildtemplates() {
  // Get the elements to modify/load the template

  var fruits = ["Apple", "Tesla", "Pfizer"];
  fruits.forEach(function(item, index, array) {
    create_inst_of_template(item);
  });
}

function create_inst_of_template(stockName) {
  // Get headElement
  var headElement = document.getElementById("section-inner");

  // Create a copy of the template
  var template_clone = document
    .getElementById("voting-template")
    .cloneNode(true);

  // Search and replace the template_company with the stockName
  template_clone.innerHTML = template_clone.innerHTML.replace(
    new RegExp("template_company", "g"),
    stockName
  );

  // Append the new template inst in DOM
  headElement.appendChild(template_clone.content);

  // test
  var id_str = "#gaugeID_" + stockName;
  //todo: optimize path
  $(id_str).load(
    "https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/gauge.html"
  );

  return;
}
