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
            return data;
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
function send_vote(element, stockName, voting_number) {
    changeVotingButtonAfterSend(element);

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
            //todo: https://stackoverflow.com/questions/28796650/how-does-this-popup-appear-and-disappear-after-a-while
            // make disappearing popup
            // alert("Your vote was successful send!");
            // update the values
            request_voting(stockName);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
