var map;
var dot = new google.maps.LatLng(55.755584, 37.621910);
function initialize() {

  var roadAtlasStyles = [ { "featureType": "road", "stylers": [ { "saturation": -100 }, { "lightness": 45 } ] },{ "featureType": "water", "stylers": [ { "hue": "#00b2ff" }, { "saturation": -86 }, { "lightness": -55 } ] },{ "featureType": "administrative", "elementType": "labels", "stylers": [ { "saturation": -79 }, { "visibility": "on" }, { "hue": "#3c00ff" }, { "color": "#7d8080" }, { "weight": 0.1 }, { "lightness": -42 } ] },{ "featureType": "poi", "stylers": [ { "hue": "#00ccff" }, { "saturation": -81 }, { "lightness": 70 } ] },{ "featureType": "landscape", "stylers": [ { "hue": "#0091ff" }, { "saturation": -86 }, { "lightness": 78 } ] },{ "featureType": "poi", "elementType": "labels.text", "stylers": [ { "hue": "#00ffee" }, { "weight": 0.1 }, { "visibility": "on" }, { "color": "#2e2e2e" } ] },{ "featureType": "road", "elementType": "labels.text", "stylers": [ { "hue": "#00ffcc" }, { "weight": 0.1 }, { "color": "#5f5f60" } ] },{ "featureType": "transit", "elementType": "labels.text", "stylers": [ { "weight": 0.1 }, { "color": "#171a1a" } ] },{ } ]

  var mapOptions = {
    zoom: 13,
    center: dot,
    disableDefaultUI: true,
    };

  map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
    var beachMarker = new google.maps.Marker({
      position: dot,
      map: map
    });
    var styledMapOptions = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#4f595d"},{"visibility":"on"}]}];
  map.setOptions({styles: styledMapOptions});

}
google.maps.event.addDomListener(window, 'load', initialize);
