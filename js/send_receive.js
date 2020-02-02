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
      updateVotingValues(data);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown);
    }
  });
}
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
