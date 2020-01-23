function send_vote(stockName, voting_number) {
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    data: {
      action: "send_votingToServer",
      title: ajax_unique.title,
      stockName: stockName,
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
      changeVotingValues(stockName, data);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert(errorThrown);
    }
  });
}
