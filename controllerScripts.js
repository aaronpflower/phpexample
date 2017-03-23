// Submit Form to get lat & lng for location
$("#form").on("submit", function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    return $.ajax({
        method: 'GET',
        url: "https://maps.googleapis.com/maps/api/geocode/json?" + data + "&key=AIzaSyBzaYojdccFaRHkouxZK8cYOijBMcYsi1E",
        success: function(res) {
            if(res.status !== "OK") {
                return $(".error").html('Errors happen, please try again.')
            }
            var location = {city: res.results[0].address_components[0].long_name, state: res.results[0].address_components[2].short_name, lat: res.results[0].geometry.location.lat, lng: res.results[0].geometry.location.lng}
            return addLocation(location)
        },
        error: function(err) {
            return $(".error").html('Errors happen, please try again.' + err)
        }
    })
});

// Add location to DB with lat & lng
function addLocation(loc) {
    $.ajax({
        method: 'POST',
        url: 'controller.php?func=addLocation',
        data: 'city='+loc.city+'&state='+loc.state+'&lat='+loc.lat+'&lng='+loc.lng,
        success: function(res) {
            res = JSON.parse(res)
            $(".locationStream").append(
                "<div class='locationItem'><i class='fa fa-times delete-item' aria-hidden='true'></i><p class='smallText'>" + loc.city + "," + loc.state + "</p><input type='hidden' name='id'' value="+res.id+"></div>"
            )
            return getConditions(loc.lat, loc.lng);
        },
        error: function(err) {
            return $(".error").html('Errors happen, please try again.' + err)
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
            $('.locationDetails').empty();
            return $('.locationDetails').append("<div class='conditons'><p class='mediumText'>Current Temp: " + res.currently.apparentTemperature + "</p><p class='mediumText'>Dew Point: " + res.currently.dewPoint + "</p><p class='mediumText'>Pressure: " + res.currently.pressure + "</p><p class='mediumText'>Wind Speed: " + res.currently.windSpeed + "</p></div>")
        },
        error: function(err) {
            return $(".error").html('Errors happen, please try again.' + err)
        }
    })
}

// Click event to handle removing location or getConditions
$('.locationStream').on('click', '.locationItem', function(e) {
    var val = $(this).find("input").val();

    if ($(e.target).hasClass("fa-times")) {
        deleteLocation(val)
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller.php?func=findById',
            data: 'id='+val,
            success: function(res) {
                res = JSON.parse(res)
                return getConditions(res.lat, res.lng);
            },
            error: function(err) {
                return $(".error").html('Errors happen, please try again.' + err)
            } 
        })
    }
});

// delete location from stream
function deleteLocation(id) {
    $.ajax({
        type: 'POST',
        url: 'controller.php?func=deleteLocation',
        data: 'deleteId='+id,
        success: function(res) {
            return location.reload();
        },
        error: function(err) {
            return $(".error").html('Errors happen, please try again.' + err)
        }
    })
}

var $loading = $('#loader').hide();
$(document) 
    .ajaxStart(function () {
        $loading.show();
    })
    .ajaxStop(function () {
        $loading.hide();
    });