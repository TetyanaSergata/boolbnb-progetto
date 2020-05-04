const $ = require('jquery');
const Handlebars = require('handlebars');


$(document).ready(function () {
    var hiddenCity = $('#city').val();
    filter(hiddenCity);

    $(document).on('click', '.filter', function () {
        $('.empty h2').text('');
        $('.flats-standard-container').html('');
        $('.flats-promo-container').html('');
        var rooms = $('#rooms').val();
        var beds = $('#beds').val();
        var radius = $('#radius').val();

        var wifi = null
        if ($('#wifi').is(":checked")) {
            wifi = 'wifi';
        }

        var smoking = null
        if ($('#smoking').is(":checked")) {
            smoking = 'smoking';
        }

        var parking = null
        if ($('#parking').is(":checked")) {
            parking = 'parking';
        }

        var swimmingPool = null
        if ($('#swimming-pool').is(":checked")) {
            swimmingPool = 'swimming_pool';
        }

        var breakfast = null
        if ($('#breakfast').is(":checked")) {
            breakfast = 'breakfast';
        }

        var view = null
        if ($('#view').is(":checked")) {
            view = 'view';
        }

        $.ajax({
            url: "https://api.tomtom.com/search/2/search/" + hiddenCity + ".json?",
            method: "GET",
            data: {
                limit: 1,
                key: 'em63COYYAtRKh4NxqgeBdkGNHC8p1is8'
            },
            success: function (data) {
                if (data.results == 0) {
                    $('.empty h2').text('Nessun risulato trovato');
                } else {
                    var lat = data.results[0].position.lat;
                    var long = data.results[0].position.lon;
                    advanced(lat, long, beds, rooms, radius, wifi, smoking, parking, swimmingPool, breakfast, view);
                }

            },
            error: function (request, state, error) {
                console.log(error);
            }
        });
    });

});

// prendi citta lat e long
function filter(city) {
    // ricerca solo per citta' con 20 radius
    $.ajax({
        url: "https://api.tomtom.com/search/2/search/" + city + ".json?",
        method: "GET",
        data: {
            limit: 1,
            key: 'em63COYYAtRKh4NxqgeBdkGNHC8p1is8'
        },
        success: function (data) {
            if (data.results == 0) {
                $('.empty h2').text('Nessun risulato trovato');
            } else {
                var lat = data.results[0].position.lat;
                var long = data.results[0].position.lon;
                search(city, lat, long);
            }

        },
        error: function (request, state, error) {
            console.log(error);
        }
    });
}

// fai la ricerca nel db
function search(city, lat, long) {
    $.ajax({
        url: window.location.protocol + '//' + window.location.host + '/api/search',
        method: "GET",
        data: {
            city: city,
            lat: lat,
            long: long
        },
        success: function (data, state) {
            // aggiungi i flat con info
            $('#search-bar').val('');

            $('.empty h2').text('');
            $('.flats-standard-container').html('');
            $('.flats-promo-container').html('');
            var rooms = $('#rooms').val();
            var beds = $('#beds').val();
            var radius = $('#radius').val();

            var wifi = null
            if ($('#wifi').is(":checked")) {
                wifi = 'wifi';
            }

            var smoking = null
            if ($('#smoking').is(":checked")) {
                smoking = 'smoking';
            }

            var parking = null
            if ($('#parking').is(":checked")) {
                parking = 'parking';
            }

            var swimmingPool = null
            if ($('#swimming-pool').is(":checked")) {
                swimmingPool = 'swimming_pool';
            }

            var breakfast = null
            if ($('#breakfast').is(":checked")) {
                breakfast = 'breakfast';
            }

            var view = null
            if ($('#view').is(":checked")) {
                view = 'view';
            }

            $.ajax({
                url: "https://api.tomtom.com/search/2/search/" + city + ".json?",
                method: "GET",
                data: {
                    limit: 1,
                    key: 'em63COYYAtRKh4NxqgeBdkGNHC8p1is8'
                },
                success: function (data) {

                        if (data.results == 0) {
                            // $('.empty h2').text('Nessun risulato trovato');
                        } else {
                            var lat = data.results[0].position.lat;
                            var long = data.results[0].position.lon;
                            advanced(lat, long, beds, rooms, radius, wifi, smoking, parking, swimmingPool, breakfast, view);
                        }

                },
                error: function (request, state, error) {
                    console.log(error);
                }
            });
            // if (data.flats.length > 0 || data.flatsPromo.length > 0) {
            // if (data.flats <= 0) {
            // $('.empty h2').text('Nessun risulato trovato');
            // } else {
            // ordiare i data.flats per distance
            // data.flats.sort(function (a, b) {
            // return a.distance - b.distance;
            // })

            // for (var i = 0; i < data.flats.length; i++) {
            //     var source = $('#flat-template').html();
            //     var template = Handlebars.compile(source);
            //     var flat = data.flats[i];

            //     var context = {
            //         title: flat.title,
            //         city: flat.city,
            //         rooms: flat.rooms,
            //         bathrooms: flat.bathrooms,
            //         beds: flat.beds,
            //         description: flat.description,
            //         price: flat.price_day,
            //         cover: window.location.protocol + '//' + window.location.host + '/storage/' + flat.cover,
            //         slug: window.location.protocol + '//' + window.location.host + '/flats/' + flat.slug
            //     };
            //     var html = template(context);
            //     $('.flats-standard-container').append(html);
            // };
            // };
            // if (data.flatsPromo <= 0) {
            // $('.empty h2').text('Nessun risulato trovato');
            // } else {
            // ordiare i data.flats per distance
            // data.flatsPromo.sort(function (a, b) {
            //     return a.distance - b.distance;
            // })

            // for (var i = 0; i < data.flatsPromo.length; i++) {
            //     var source = $('#flatPromo-template').html();
            //     var template = Handlebars.compile(source);
            //     var flatPromo = data.flatsPromo[i];
            //     var context = {
            //         title: flatPromo.title,
            //         city: flatPromo.city,
            //         rooms: flatPromo.rooms,
            //         bathrooms: flatPromo.bathrooms,
            //         beds: flatPromo.beds,
            //         description: flatPromo.description,
            //         price: flatPromo.price_day,
            //         cover: window.location.protocol + '//' + window.location.host + '/storage/' + flatPromo.cover,
            //         slug: window.location.protocol + '//' + window.location.host + '/flats/' + flatPromo.slug
            //     };
            //     var html = template(context);
            //     $('.flats-promo-container').append(html);
            // };
            // };
            // } else {
            //     $('.empty h2').text('Nessun risultato trovato');
            // }
        },
        error: function (request, state, error) {
            console.log(error);
        }
    });
}

// ricerca avanzata
function advanced(lat, long, beds, rooms, radius, wifi, smoking, parking, swimmingPool, breakfast, view) {
    $.ajax({
        url: window.location.protocol + '//' + window.location.host + '/api/search/advanced',
        method: "GET",
        data: {
            lat: lat,
            long: long,
            beds: beds,
            rooms: rooms,
            radius: radius,
            wifi: wifi,
            smoking: smoking,
            parking: parking,
            swimmingPool: swimmingPool,
            breakfast: breakfast,
            view: view
        },
        success: function (data, state) {

            if (data.flats.length > 0 || data.flatsPromo.length > 0) {

                if (data.flats <= 0) {
                    // $('.empty h2').text('Nussun risulato trovato');
                } else {
                    // ordiare i data.flats per distance
                    data.flats.sort(function (a, b) {
                        return a.distance - b.distance;
                    })

                    for (var i = 0; i < data.flats.length; i++) {
                        var source = $('#flat-template').html();
                        var template = Handlebars.compile(source);
                        var flat = data.flats[i];

                        var distance = (Math.round(flat.distance * 100) / 100);

                        // gestire gli extra services
                        var arrayExtra = '';
                        if (flat.name != undefined) {
                            var flatService = flat.name.split(" ");
                            // controllo se il wifi e' presente nel flat
                            if (flatService.includes('wifi')) {
                                arrayExtra = arrayExtra + ' <i class="icone fas fa-wifi"></i>';
                            }
                            // controllo se lo smoking e' presente nel flat
                            if (flatService.includes('smoking')) {
                                arrayExtra = arrayExtra + ' <i class="icone fas fa-smoking"></i>';
                            }
                            // controllo se il parking e' presente nel flat
                            if (flatService.includes('parking')) {
                                arrayExtra = arrayExtra + ' <i class=" icone fas fa-parking"></i>';
                            }
                            // controllo se la swimmingPool e' presente nel flat
                            if (flatService.includes('swimming_pool')) {
                                arrayExtra = arrayExtra + ' <i class="icone fas fa-swimming-pool"></i>';
                            }
                            // controllo se il breakfast e' presente nel flat
                            if (flatService.includes('breakfast')) {
                                arrayExtra = arrayExtra + ' <i class="icone fas fa-coffee"></i>';
                            }
                            // controllo se la view e' presente nel flat
                            if (flatService.includes('view')) {
                                arrayExtra = arrayExtra + ' <i class="icone fas fa-mountain"></i>';
                            }
                        }

                        var context = {
                            title: flat.title,
                            city: flat.city,
                            rooms: flat.rooms,
                            bathrooms: flat.bathrooms,
                            beds: flat.beds,
                            description: flat.description,
                            price: flat.price_day,
                            extra: arrayExtra,
                            distance: distance,
                            cover: window.location.protocol + '//' + window.location.host + '/storage/' + flat.cover,
                            slug: window.location.protocol + '//' + window.location.host + '/flats/' + flat.slug
                        };
                        var html = template(context);
                        $('.flats-standard-container').append(html);
                    };
                };
                if (data.flatsPromo <= 0) {
                    // $('.empty h2').text('Nussun risulato trovato');
                } else {
                    // ordiare i data.flats per distance
                    data.flatsPromo.sort(function (a, b) {
                        return a.distance - b.distance;
                    })

                    for (var i = 0; i < data.flatsPromo.length; i++) {
                        var source = $('#flatPromo-template').html();
                        var template = Handlebars.compile(source);
                        var flatPromo = data.flatsPromo[i];

                        var distancePromo = (Math.round(flatPromo.distance * 100) / 100);
                        
                        // gestire gli extra services
                        var arrayExtraPromo = '';
                        if (flatPromo.name != undefined) {
                            var flatService = flatPromo.name.split(" ");
                            // controllo se il wifi e' presente nel flat
                            if (flatService.includes('wifi')) {
                                arrayExtraPromo = arrayExtraPromo + ' <i class="icone fas fa-wifi"></i>';
                            }
                            // controllo se lo smoking e' presente nel flat
                            if (flatService.includes('smoking')) {
                                arrayExtraPromo = arrayExtraPromo + ' <i class="icone fas fa-smoking"></i>';
                            }
                            // controllo se il parking e' presente nel flat
                            if (flatService.includes('parking')) {
                                arrayExtraPromo = arrayExtraPromo + ' <i class=" icone fas fa-parking"></i>';
                            }
                            // controllo se la swimmingPool e' presente nel flat
                            if (flatService.includes('swimming_pool')) {
                                arrayExtraPromo = arrayExtraPromo + ' <i class="icone fas fa-swimming-pool"></i>';
                            }
                            // controllo se il breakfast e' presente nel flat
                            if (flatService.includes('breakfast')) {
                                arrayExtraPromo = arrayExtraPromo + ' <i class="icone fas fa-coffee"></i>';
                            }
                            // controllo se la view e' presente nel flat
                            if (flatService.includes('view')) {
                                arrayExtraPromo = arrayExtraPromo + ' <i class="icone fas fa-mountain"></i>';
                            }
                        }

                        var context = {
                            title: flatPromo.title,
                            city: flatPromo.city,
                            rooms: flatPromo.rooms,
                            bathrooms: flatPromo.bathrooms,
                            beds: flatPromo.beds,
                            description: flatPromo.description,
                            price: flatPromo.price_day,
                            extra: arrayExtraPromo,
                            distance: distancePromo,
                            cover: window.location.protocol + '//' + window.location.host + '/storage/' + flatPromo.cover,
                            slug: window.location.protocol + '//' + window.location.host + '/flats/' + flatPromo.slug
                        };
                        var html = template(context);
                        $('.flats-promo-container').append(html);
                    };
                };
            } else {
                $('.empty h2').text('Nessun risultato trovato');
            }
            $('#search-bar').val('');
        },
        error: function (request, state, error) {
            console.log(error);
        }
    });
}