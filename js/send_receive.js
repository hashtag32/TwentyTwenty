function request_voting(symbolName) {
    jQuery.ajax({
        type: "POST",
        url: ajax_unique.ajaxurl,
        data: {
            action: "request_votingfromServer",
            title: ajax_unique.title,
            symbolName: symbolName
        },
        success: function(data, textStatus, XMLHttpRequest) {
            updateVotingValues(data);
            return data;
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
function send_vote(element, symbolName, voting_number) {
    changeVotingButtonAfterSend(element);

    jQuery.ajax({
        type: "POST",
        url: ajax_unique.ajaxurl,
        dataType: "json",
        data: {
            action: "send_votingToServer",
            title: ajax_unique.title,
            symbolName: symbolName,
            voting_number: voting_number
        },
        success: function(data, textStatus, XMLHttpRequest) {
            request_voting(symbolName);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
