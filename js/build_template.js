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
  var section_inner_element = document.getElementById("section-inner");
  var template_element = document.getElementById("voting_template");

  var template_element2 = template_element.cloneNode(true);

  // var elementToAppend = append_template_inst(section_inner_element, "pfizer");
  // var elementToAppend = append_template_inst(elementToAppend, "pfizer");

  section_inner_element.appendChild(template_element.content);
  section_inner_element.lastElementChild.appendChild(template_element2.content);
  // section_inner_element.appendChild(template_element.content);
  // section_inner_element.append(template_element.content);
  // Replace all occurences of company with the given name
  // var template_content = document.querySelector(".voting-table").innerHTML;
  // var newInnerHTML = template_content.replace(
  //   new RegExp("template_company", "g"),
  //   stockName
  // );
  // document.querySelector(".voting-table").innerHTML = newInnerHTML;
  // return elementToAppend;
}

function append_template_inst(elementToAppend, stockName) {
  var template_element = document.getElementById("voting_template");
  section_inner_element.appendChild(template_element.content);

  // Instantiate the template
  // section_inner_element.parentNode.insertBefore(
  //   template_element,
  //   section_inner_element.nextSibling
  // );

  elementToAppend = elementToAppend.appendChild(template_element.content);
  // Replace all occurences of company with the given name
  var template_content = document.querySelector(".voting-table").innerHTML;
  var newInnerHTML = template_content.replace(
    new RegExp("template_company", "g"),
    stockName
  );
  document.querySelector(".voting-table").innerHTML = newInnerHTML;
  return elementToAppend;
}
