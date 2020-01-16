alert("ajax_scripts funktioniert");


jQuery.ajax({
    type: 'POST',
    url: ajax_unique.ajaxurl,
    data: {
        action: 'serversidefunction',
        title: ajax_unique.title
    },
    success: function (data, textStatus, XMLHttpRequest) {
        alert(data);
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert(errorThrown);
    }
});

// console.log("test");

// alert(ajax_unique.ajaxurl);