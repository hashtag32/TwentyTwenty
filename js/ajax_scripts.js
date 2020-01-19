function test() {
  alert("test");
}
function buttonfire(voting_number) {
  alert("buttonfire");
  draw_gauges();
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    data: {
      action: "serversidefunction",
      title: ajax_unique.title,
      voting_number: voting_number
    },
    success: function(data, textStatus, XMLHttpRequest) {
      alert(data);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown);
    }
  });
}

function draw_gauges() {
  alert("draw_gauges");
  var template = document.getElementById("radial-gauge-template");
  alert(template);

  var second_col = document.getElementById("second-column");
  var template_inst = template.content.cloneNode(true);

  second_col.append(template_inst);
}
