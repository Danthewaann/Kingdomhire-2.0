var vehicles = window.vehicles === undefined ? [] : window.vehicles;
var site_name = window.site_name;
var vehicle_types = [];
var gear_types = [];
var fuel_types = [];
var seats = [];

var type_selection = "All";
var gear_selection = "All";
var fuel_selection = "All";
var seats_selection = "Any";

function sortVehiclesDesc(a, b) {
    if (a.name > b.name) return -1;
    else if (a.name < b.name) return 1;
    else return 0;
}

function sortVehicleAsc(a, b) {
    if (a.name < b.name) return -1;
    else if (a.name > b.name) return 1;
    else return 0;
}

function parseVehicles() {
    for (var i = 0; i < vehicles.length; i++) {
        pushDistinct(vehicle_types, "type", vehicles[i]);
        pushDistinct(gear_types, "gear_type", vehicles[i]);
        pushDistinct(fuel_types, "fuel_type", vehicles[i]);
        pushDistinct(seats, "seats", vehicles[i]);
    }
    vehicle_types.sort();
    vehicle_types.unshift(type_selection);
    gear_types.sort();
    gear_types.unshift(gear_selection);
    fuel_types.sort();
    fuel_types.unshift(fuel_selection);
    seats.sort();
    seats.unshift(seats_selection);
}

function pushDistinct(arr, type, vehicle) {
    if (vehicle[type] === "") {
        vehicle[type] = "N/A";
    }
    if (!arr.includes(vehicle[type])) {
        arr.push(vehicle[type]);
    }
}

function drawImageThumbnail(vehicle) {
    var hasImages = vehicle.images.length > 0;
    var html = "";
    if (hasImages) {
        var image_uri = site_name + vehicle.images[0].image_uri;
        var image_name = vehicle.make + ' ' + vehicle.model + ' - ' + vehicle.images[0].name;
        html = '<div class="vehicle-img"> \
                    <img class="public" src="'+ image_uri + '" alt="' + image_name + '"> \
                    <button class="btn btn-info vehicle-img-button vehicle-open-modal" data-vehicle="' + vehicle.slug + '">View images</button> \
                </div>'
    }
    else {
        html = '<div class="vehicle-img"> \
                  <div class="vehicle-img-na"> \
                    <h2 class="public"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;No Image(s)</h2> \
                  </div> \
                </div>'
    }

    return html;
}

function drawVehicleSummary(vehicle) {
    var html = '<div class="col-lg-4 col-md-6 col-sm-12"> \
                    <div class="panel panel-default public-vehicle-panel"> \
                      <div class="panel-heading vehicle-panel-heading"> \
                        <h3>' + vehicle.make + ' ' + vehicle.model + '</h3> \
                      </div>'
                      + drawImageThumbnail(vehicle) +
                      '<table class="table table-condensed vehicle-table-public"> \
                        <tr> \
                          <th class="first">Vehicle Type</th> \
                          <td class="first">' + vehicle.type + '</td> \
                        </tr> \
                        <tr> \
                          <th>Fuel Type</th> \
                          <td>' + vehicle.fuel_type + '</td> \
                        </tr> \
                        <tr> \
                          <th>Gear Type</th> \
                          <td>' + vehicle.gear_type + '</td> \
                        </tr> \
                        <tr> \
                          <th class="last">Seats</th> \
                          <td class="last">' + vehicle.seats + '</td> \
                        </tr> \
                      </table> \
                    </div> \
                </div>';

    return html;
}

function drawAllRadioBtns() {
    drawRadioBtnsForAttribute("vehicle_type", "vehicle_types", vehicle_types);
    drawRadioBtnsForAttribute("fuel_type", "fuel_types", fuel_types);
    drawRadioBtnsForAttribute("gear_type", "gear_types", gear_types);
    drawRadioBtnsForAttribute("seats", "seats", seats);
}

function drawRadioBtnsForAttribute(attribute_id, container_id, attribute_arr) {
    var attribute_container = $("#" + container_id);
    var html = "";
    var active = "";
    var id = "";
    var plural = "";
    for (var i = 0; i < attribute_arr.length; i++) {
        active = i === 0 ? "active " : "";
        id = i === 0 ? attribute_id + "_all" : "";
        plural = (attribute_id === "vehicle_type" && i === 0) || attribute_id !== "vehicle_type" ? "" : "s";
        html += '<li class="' + active + id + '"> \
                    <a data-toggle="pill" class="btn">' + attribute_arr[i] + plural + '</a> \
                </li>'
    }

    attribute_container.append(html);
}

function drawVehicles(sort="Ascending") {
    var vehicleSearchResults = $('#vehicle-search-results');
    vehicleSearchResults.empty();
    if (sort === "Ascending") {
        vehicles.sort(sortVehicleAsc);
    } else {
        vehicles.sort(sortVehiclesDesc);
    }
    var html = '';
    for (var i = 0; i < vehicles.length; i++) {
        var type_matches = vehicles[i].type === type_selection || type_selection === "All";
        var fuel_matches = vehicles[i].fuel_type === fuel_selection || fuel_selection === "All";
        var gear_matches = vehicles[i].gear_type === gear_selection || gear_selection === "All";
        var seats_matches = vehicles[i].seats === seats_selection || seats_selection === "Any";
        var vehicle_matches = type_matches && fuel_matches && gear_matches && seats_matches;
        if (vehicle_matches) {
            html += drawVehicleSummary(vehicles[i]);
        }
    }
    var matchedVehicles = html.length > 0;
    if (!matchedVehicles) {
        html = '<div class="col-lg-12">' +
                    '<h1 style="text-align: center">No Vehicles Found</h1>' +
                    '<h3 style="text-align: center">Selected options didn\'t match any vehicles</h3>' +
                '</div>'
    }
    var tab_class = matchedVehicles ? 'tab-pane ' : 'tab-pane-no-vehicles ';
    var start = '<article class="' + tab_class + 'fade in" id="vehicle-search-results-tab">';
    var end = '</article>';
    html = start + html + end;
    vehicleSearchResults.append(html);
    vehicleSearchResults.tab('show');
}

$(document).ready(function () {
    parseVehicles();
    drawAllRadioBtns();
    drawVehicles();

    $('#vehicle_types').find('a').click(function (e) {
        type_selection = $(this).text();
        if (type_selection !== "All") {
            type_selection = type_selection.slice(0, type_selection.length - 1);
        }
        drawVehicles();
    });

    $('#fuel_types').find('a').click(function (e) {
        fuel_selection = $(this).text();
        drawVehicles();
    });

    $('#gear_types').find('a').click(function (e) {
        gear_selection = $(this).text();
        drawVehicles();
    });

    $('#seats').find('a').click(function (e) {
        seats_selection = $(this).text();
        drawVehicles();
    });

    $('#vehicle-sort-ascending').click(function (e) {
        $('#vehicle-sort-descending').removeClass('active');
        drawVehicles("Ascending");
        $(this).addClass('active');
    });

    $('#vehicle-sort-descending').click(function (e) {
        $('#vehicle-sort-ascending').removeClass('active');
        drawVehicles("Descending");
        $(this).addClass('active');
    });

    $('#vehicle-search-reset').click(function () {
        console.log("Resetting vehicle search results");
        type_selection = vehicle_types[0];
        fuel_selection = fuel_types[0];
        gear_selection = gear_types[0];
        seats_selection = seats[0];
        drawVehicles();

        $('#vehicle_types').find('li.active').removeClass('active');
        $('#vehicle_types').find('li.vehicle_type_all').addClass('active');

        $('#fuel_types').find('li.active').removeClass('active');
        $('#fuel_types').find('li.fuel_type_all').addClass('active');

        $('#gear_types').find('li.active').removeClass('active');
        $('#gear_types').find('li.gear_type_all').addClass('active');

        $('#seats').find('li.active').removeClass('active');
        $('#seats').find('li.seats_all').addClass('active');

    });
});