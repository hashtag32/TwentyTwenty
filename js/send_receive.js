function send_vote(stockName, voting_number) {
  jQuery.ajax({
    type: "POST",
    url: ajax_unique.ajaxurl,
    data: {
      action: "serversidefunction",
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
