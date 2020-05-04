require('./bootstrap');
const $ = require('jquery');
var Chart = require('chart.js');

// chart.js
$(document).ready(function () {

    // id del flat
    var id = $('#id').val();

    // mese selezionato dall'utente
    var month;

    // chiamata per le visits appena carica la pagina
    $.ajax({
        url: window.location.protocol + '//' + window.location.host + '/api/stats',
        method: "GET",
        data: {
            id: id,
            month: ''
        },
        success: function (data, state) {
            $('.visitsTotal').text('Le visite totali di questo mese sono: ' + data.total);

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: data.days,
                    datasets: [{
                        label: "Visite",
                        data: data.stats,
                        backgroundColor: "#ff385c",
                        borderColor: "#ff385c",
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        },
        error: function (request, state, error) {
            console.log(error);
        }
    });

    // quando cambi mese parte la chiamata per le visits
    $(document).on('change', $('#month'), function () {
        month = $('#month').val();

        $.ajax({
            url: window.location.protocol + '//' + window.location.host + '/api/stats',
            method: "GET",
            data: {
                id: id,
                month: month
            },
            success: function (data, state) {
                $('.visitsTotal').text('Le visite totali di questo mese sono: ' + data.total);

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: data.days,
                        datasets: [{
                            label: "Visite",
                            data: data.stats,
                            backgroundColor: "#ff385c",
                            borderColor: "#ff385c",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
            error: function (request, state, error) {
                console.log(error);
            }
        });
    });

    // chiamata per i messaggi appena carica la pagina
    $.ajax({
        url: window.location.protocol + '//' + window.location.host + '/api/stats/messages',
        method: "GET",
        data: {
            id: id,
            month: ''
        },
        success: function (data, state) {
            $('.messagesTotal').text('I messaggi totali di questo mese sono: ' + data.total);

            var ctx = document.getElementById('myMessage').getContext('2d');
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: data.days,
                    datasets: [{
                        label: "Messaggi",
                        data: data.stats,
                        backgroundColor: "#ff385c",
                        borderColor: "#ff385c",
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        error: function (request, state, error) {
            console.log(error);
        }
    });

    // quando cambi mese parte la chiamata per i messaggi
    $(document).on('change', $('#monthMessages'), function () {
        month = $('#monthMessages').val();

        $.ajax({
            url: window.location.protocol + '//' + window.location.host + '/api/stats/messages',
            method: "GET",
            data: {
                id: id,
                month: month
            },
            success: function (data, state) {
                $('.messagesTotal').text('I messaggi totali di questo mese sono: ' + data.total);

                var ctx = document.getElementById('myMessage').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.days,
                        datasets: [{
                            label: "Messaggi",
                            data: data.stats,
                            backgroundColor: "#ff385c",
                            borderColor: "#ff385c",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
            error: function (request, state, error) {
                console.log(error);
            }
        });
    });

});