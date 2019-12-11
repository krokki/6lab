var token = "6bf7d14e2017ae8910d0b10601586a1cafe1fc93";

function iplocate(ip) {
    var serviceUrl = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address";
    if (ip) {
        serviceUrl += "?ip=" + ip;
    }
    var params = {
        type: "GET",
        contentType: "application/json",
        headers: {
            "Authorization": "Token " + token
        }
    };
    return $.ajax(serviceUrl, params);
}

function detect() {
    var ip = $("#ip").val();
    iplocate(ip).done(function(response) {
        //$("#suggestions").text(JSON.stringify(response, null, 4));
        let geo = response;

        $("#geo").val(geo['location']['value']);

        console.log(response);
    })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
            console.log(errorThrown);
        });
}

$("#ip").on("change", detect);

detect();