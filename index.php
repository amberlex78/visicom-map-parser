<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Visicom Example</title>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css"/>
    <script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
</head>
<body>
<div id="map" style="width: 1024px; height: 720px; clear: both;"></div>
<script>
    var map = new L.Map('map', {
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

// Golaya Pristan
// Coordinates of Tiles
$yFromTile = 84726; // top    84726
$yToTile   = 84703; // bottom 84705
$xFromTile = 77367; // left   77368
$xToTile   = 77392; // right  77392

$widthCanvas  = ($xToTile - $xFromTile) * 256;
$heightCanvas = ($yFromTile - $yToTile) * 256;

require 'vendor/autoload.php';
use Intervention\Image\ImageManager;

$dir = __DIR__ . '/tiles/';
$img = new ImageManager();
$img = $img->canvas($widthCanvas, $heightCanvas);

$n  = 1;
$yn = 0;
for ($y = $yFromTile; $y > $yToTile; $y--) {
    $xn = 0;
    for ($x = $xFromTile; $x < $xToTile; $x++) {

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