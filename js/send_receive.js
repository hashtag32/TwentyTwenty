function request_voting(symbolName) {
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    data: {
      action: "request_votingfromServer",
      title: ajax_unique.title,
      symbolName: symbolName,
    },
    success: function (data, textStatus, XMLHttpRequest) {
      updateVotingValues(data);
      return data;
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Data couldn't load.");
      location.reload();
    },
  });
}
function send_vote(element, symbolName, voting_number) {
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    dataType: "json",
    data: {
      action: "send_votingToServer",
      title: ajax_unique.title,
      symbolName: symbolName,
      voting_number: voting_number,
      user_id: ajax_unique.user_id,
    },
    success: function (data, textStatus, XMLHttpRequest) {
      request_voting(symbolName);
      changeVotingButtonAfterSend(element);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      alert("Sending didn't work. Try again.");
    },
  });
}

function php_function_call(functionName, argumentArray) {
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    dataType: "json",
    data: {
      action: "php_function_call",
      title: ajax_unique.title,
      functionname: functionName,
      arguments: argumentArray,
    },

    success: function (obj, textstatus) {
      if (!("error" in obj)) {
        yourVariable = obj.result;
      } else {
        console.log(obj.error);
      }
    },
  });
}
