// Listen to page loading
document.addEventListener("DOMContentLoaded", theDomHasLoaded, false);
window.addEventListener("load", pageFullyLoaded, false);

function theDomHasLoaded(e) {
  // do something
}

function pageFullyLoaded(e) {
  buildtemplates();
}

function buildtemplates() {
  // instantiate template
  inst_template("tesla");
  inst_template("pfizer");
}

function inst_template($stockName) {
  // Get the elements to modify/load the template
  var section_inner_element = document.getElementById("section-inner");
  var template_element = document.getElementById("voting_template");

  // Instantiate the template
  section_inner_element.append(template_element.content);

  // Replace all occurences of company with the given name
  var template_content = document.querySelector(".voting-table").innerHTML;
  var newInnerHTML = template_content.replace(
    new RegExp("template_company", "g"),
    $stockName
  );
  document.querySelector(".voting-table").innerHTML = newInnerHTML;
}
