<!-- Start Map -->
<div id="mapid" style="width: 100%; height: 300px;"></div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script>
    var mymap = L.map('mapid').setView([12.1321793, -86.3454252], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'Mapa por <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
    }).addTo(mymap);

    L.marker([12.1321793, -86.3454252]).addTo(mymap)
        .bindPopup("<b>La 57 Cap</b><br>Estamos aquí.").openPopup();

    mymap.scrollWheelZoom.disable();
    mymap.touchZoom.disable();
</script>
<!-- End Map -->

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        
    </div>
</div>
<!-- End Contact -->
