function buttonfire(voting_number)
{
    alert(voting_number);

    jQuery.ajax({
    type: 'POST',
    url: ajax_unique.ajaxurl,
    data: {
        action: 'serversidefunction',
        title: ajax_unique.title,
        voting_number: voting_number
    },
    success: function (data, textStatus, XMLHttpRequest) {
        alert(data);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert(errorThrown);
    }
});
}