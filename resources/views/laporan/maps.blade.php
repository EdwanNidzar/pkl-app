<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tagging Maps with Leaflet.js</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map {
      height: 500px;
    }
  </style>
</head>

<body>

  <h1>Daftar Pelanggaran Kampanye di Kalimantan Selatan</h1>

  <div id="map"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    // Initialize the map
    var map = L.map('map').setView([-3.324882, 114.590111], 13);

    // Add the base OpenStreetMap layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Define your tagged locations
    var taggedLocations = [];

    // Populate the taggedLocations array with the data from the database
    @foreach ($view_laporans as $data)
      taggedLocations.push({
        'name': '{{ $data->nama_bacaleg }}',
        'latlng': [{{ $data->latitude }}, {{ $data->longitude }}],
        'data': {!! json_encode($data) !!} // Include all data associated with the marker
      });
    @endforeach

    // Add markers for each tagged location
    taggedLocations.forEach(location => {
      var marker = L.marker(location.latlng).addTo(map);
      marker.bindPopup(location.name);

      // Add click event listener to the marker
      marker.on('click', function(e) {
        // Display data associated with the marker
        var popupContent = '<h3>' + location.data.nama_bacaleg + '</h3>' +
          '<p>Jenis Pelanggaran: ' + location.data.jenis_pelanggaran + '</p>' +
          '<p>Partai Politik: ' + location.data.nama_partai + '</p>' +
          '<p>Dapil: ' + location.data.dapil + '</p>' +
          '<p>Tanggal: ' + location.data.tanggal_input + '</p>' +
          '<p>Bukti: <img src="' + location.data.bukti +
          '" alt="Bukti Pelanggaran" width="100" height="100"></p>' +
          '<p>Keterangan: ' + location.data.keterangan + '</p>';

        L.popup()
          .setLatLng(e.latlng)
          .setContent(popupContent)
          .openOn(map);
      });
    });
  </script>

</body>

</html>
