function send_vote(stockName, voting_number) {
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    dataType: "json",
    data: {
      action: "send_votingToServer",
      title: ajax_unique.title,
      stockName: stockName,
      voting_number: voting_number
    },
    success: function(data, textStatus, XMLHttpRequest) {
      alert("Your vote was successful send!");
      // update the values
      request_voting(stockName);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown);
    }
  });
}

function request_voting(stockName) {
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    data: {
      action: "request_votingfromServer",
      title: ajax_unique.title,
      stockName: stockName
    },
    success: function(data, textStatus, XMLHttpRequest) {
      updateVotingValues(stockName, data);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown);
    }
  });
}

function request_actual_value(stockName) {
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    data: {
      action: "request_actual_valuefromServer",
      title: ajax_unique.title,
      stockName: stockName
    },
    success: function(data, textStatus, XMLHttpRequest) {
      // alert(data);
      changeGauge(stockName, data);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown);
    }
  });
}
