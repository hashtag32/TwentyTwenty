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
  inst_template();
}

function inst_template() {
  var template = document.getElementById("voting_template");
  var second_col = document.getElementById("section-inner");
  var template_inst = template.content.cloneNode(true);
  second_col.append(template_inst);
}
