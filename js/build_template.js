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
  var template_element = document.getElementById("voting-template");

  var template1 = template_element.cloneNode(true);
  var template2 = template_element.cloneNode(true);

  template1.innerHTML = template1.innerHTML.replace(
    new RegExp("template_company", "g"),
    "stockName1"
  );

  template2.innerHTML = template2.innerHTML.replace(
    new RegExp("template_company", "g"),
    "stockName2"
  );

  section_inner_element.appendChild(template1.content);
  section_inner_element.appendChild(template2.content);

  $("#testGaugeID_stockName1").load(
    "https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/gauge.html"
  );

  $("#testGaugeID_stockName2").load(
    "https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/gauge.html"
  );

  // var returnElement = append_template_inst(
  //   section_inner_element,
  //   template_element,
  //   "test12"
  // );
  // append_template_inst(returnElement, template_element, "test123");

  // section_inner_element.appendChild(template_element.content);
  // var template_element_clone = template_element.cloneNode(true);
  // section_inner_element.appendChild(template_element.content);
  // section_inner_element.appendChild(template_element_clone.content);

  // var column_gauge_element = document.getElementById("testGaugeID");

  // column_gauge_element.insertAdjacentHTML(
  //   "afterend",
  // );
  // column_gauge_element.load("gauge.html");

  // var newInnerHTML = (template_content.template_element_loop.outerHTML = newInnerHTML);

  // var section_inner_element_clone = section_inner_element.cloneNode(true);

  // var loop_element = append_template_inst(
  //   section_inner_element,
  //   template_element,
  //   "test"
  // );

  // section_inner_element.appendChild(template_element.content);

  // var fruits = ["Apple", "Banana", "Foo"];
  // var loop_element = section_inner_element;
  // fruits.forEach(function(item, index, array) {
  //   var template_element_loop = template_element.cloneNode(true);

  //   append_template_inst(
  //     section_inner_element_clone,
  //     template_element_loop,
  //     item
  //   );
  // });

  // var elementToAppend = append_template_inst(section_inner_element, "pfizer");
  // var elementToAppend = append_template_inst(elementToAppend, "pfizer");

  // section_inner_element.appendChild(template_element.content);
  // section_inner_element.lastElementChild.appendChild(template_element2.content);
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

function append_template_inst(loop_element, template_element_loop, stockName) {
  // Replace all occurences of company with the given name
  var newInnerHTML = template_element_loop.innerHTML.replace(
    new RegExp("template_company", "g"),
    stockName
  );
  template_element_loop.innerHTML = newInnerHTML;

  loop_element.appendChild(template_element_loop.content);

  var id_str = "#testGaugeID_" + stockName;

  $(id_str).load(
    "https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/gauge.html"
  );

  return loop_element.lastElementChild;
}
