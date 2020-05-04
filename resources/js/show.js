const $ = require('jquery');

$(document).ready(function () {

	var flatId =$('#flatId').val();

	$.ajax({
		url: window.location.protocol + '//' + window.location.host + '/api/map',
		method: "GET",
		data: {
				id: flatId
			},
		success: function(data, state) {

      var address = [data.long, data.lat];

      tt.setProductInfo('<test>', '<beta>');
      var map= tt.map({
          key: 'RtqGWkFeMT3SHtv3t8oHCVrLAsAtxPLP',
          container: 'map',
          style: 'tomtom://vector/1/basic-main',
          center: address,
          zoom: 15
      });
      var marker = new tt.Marker().setLngLat(address).addTo(map);
      var popupOffsets = {
        top: [0, 0],
        bottom: [0, -70],
        'bottom-right': [0, -70],
        'bottom-left': [0, -70],
        left: [25, -35],
        right: [-25, -35]
      }

		  // var addressFull = data.results[0].address.freeformAddress;

      var popup = new tt.Popup({offset: popupOffsets}).setHTML("<b>" + data.fullAddress + "</b>");
      marker.setPopup(popup).togglePopup();

		},
		error: function(request, state, error) {
			console.log(error);
		}
	});
	
});
