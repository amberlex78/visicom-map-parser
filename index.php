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


<?php

require 'vendor/autoload.php';
use Intervention\Image\ImageManager;

$dir = __DIR__ . '/tiles/';
$img = new ImageManager();
$img = $img->canvas(6144, 5376);  // 6144 x 5376 px

$n  = 1;
$yn = 0;
for ($y = 84726; $y > 84705; $y--) {      // 21 tiles
    $xn = 0;
    for ($x = 77368; $x < 77392; $x++) {  // 24 tiles

        $filename = "x$xn-y$yn.png";
        echo $n++ . " - $filename<br>";

        file_put_contents(
            $dir . $filename,
            fopen("http://tms1.visicom.ua/2.0.0/planet3/base_ru/17/$x/$y.png", 'r')
        );

        $img->insert($dir . $filename, 'top-left', $xn, $yn);
        $xn += 256;
    }
    $yn += 256;
}

$img->save(__DIR__ . '/map.png');

?>

</body>
</html>