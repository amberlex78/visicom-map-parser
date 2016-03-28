<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Visicom Example</title>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css"/>
    <script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
</head>
<body>
<div id="map" style="width: 1024px; height: 768px; clear: both;"></div>
<script>
    var map = new L.Map('map', {

        // Golaya Pristan
        // Coordinates of Tiles
        // top  = 84726; bottom = 84705
        // left = 77368; right  = 77392

        center: new L.LatLng(46.5225204, 32.5313784),
        zoom: 14,
        layers: [
            new L.TileLayer('http://tms{s}.visicom.ua/2.0.0/planet3/base_ru/{z}/{x}/{y}.png', {
                maxZoom: 19,
                tms: true,
                attribution: 'Данные карт © 2013 ЧАО «<a href="http://visicom.ua/">Визиком</a>»',
                subdomains: '123'
            })
        ]
    });
</script>
</body>
</html>