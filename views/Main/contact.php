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
        <form class="col-md-9 m-auto" method="post" role="form">
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Tu nombre completo" required>
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Correo electrónico" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="subject">Asunto</label>
                <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="¿Sobre qué quieres hablar?" required>
            </div>
            <div class="mb-3">
                <label for="message">Mensaje</label>
                <textarea class="form-control mt-1" id="message" name="message" rows="8" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Enviar mensaje</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->
