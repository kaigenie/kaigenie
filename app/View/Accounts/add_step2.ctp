<?php
$this->extend('/Accounts/add_nav');
?>

<h2>Add Step 2</h2>



<style>
  #map-canvas{
    height: 300px;
    width: 600px;
    border: 1px solid seagreen;
    margin 0 auto;
  }
</style>

<div id="map-canvas"></div>

<label></label>


<script>
  function initialize() {

    var lat = getURLParameter('lat');
    var lng = getURLParameter('lng');

    var mapOptions = {
      zoom: 8,
      center: new google.maps.LatLng(lat, lng),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapCanvas = document.getElementById('map-canvas');

    var map = new google.maps.Map(mapCanvas,mapOptions);
  }

  function getURLParameter(name) {
    return decodeURI(
      (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
  }

  function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
    document.body.appendChild(script);
  }

  window.onload = loadScript;


</script>