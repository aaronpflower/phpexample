var loc = {}

// // First get lat&long for location then go to forecast.io for conditions
$("#form").on("submit", function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    return $.ajax({
        method: 'GET',
        url: "https://maps.googleapis.com/maps/api/geocode/json?" + data + "&key=AIzaSyBzaYojdccFaRHkouxZK8cYOijBMcYsi1E",
        success: function(res) {
            loc = {city: res.results[0].address_components[0].long_name, state: res.results[0].address_components[2].short_name, lat: res.results[0].geometry.location.lat, lng: res.results[0].geometry.location.lng}
            return addLocation(loc)
        },
        error: function(err) {
            return console.log(err)
        }
    })
});

function addLocation(loc) {
    $.ajax({
        type: 'POST',
        url: 'controller.php?func=addLocation',
        data: 'city='+loc.city+'&state='+loc.state+'&lat='+loc.lat+'&lng='+loc.lng,
        success: function(res) {
            location.reload();
            return getConditions(loc.lat, loc.lng);
        },
        error: function(err) {

        }
    })
}

// Call to forecast.io
function getConditions(lat, lng) {
    $.ajax({
        method: 'GET',
        url: "https://api.darksky.net/forecast/963c2a286c46883b606d0962897eeef7/" + lat + ',' + lng,
        dataType: "jsonp",
        success: function(res) {
            return $('#form').append("<p>Hi</p>")
        },
        error: function(err) {
            return console.log(err)
        }
    })
}

$('.locationStream').on('click', '.locationItem', function(e) {
    var val = $(this).find("input").val();

    if ($(e.target).hasClass("fa-times")) {
        deleteLocation(val)
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?func=getLocationWeather',
            data: 'id='+val,
            success: function(res) {
                console.log(res)
                res = JSON.parse(res)
                return getConditions(res.lat, res.lng);
            },
            error: function(err) {
                return console.log(err);
            } 
        })
    }
});


function deleteLocation(id) {
    $.ajax({
        type: 'POST',
        url: 'controller.php?func=deleteLocation',
        data: 'deleteId='+id,
        success: function(res) {
            return location.reload();
        },
        error: function(err) {

        }
    })
}