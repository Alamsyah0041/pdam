<!DOCTYPE html>
<html>
<head>
    <title>Test Peta</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>#map { height: 500px; }</style>
</head>
<body>

<h3>Test Peta Samarinda</h3>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-0.5048, 117.1537], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a>'
    }).addTo(map);
</script>

</body>
</html>
