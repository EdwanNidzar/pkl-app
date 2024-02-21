script
<script>
  $('#parpols').DataTable();
</script>

<script>
  $('#jenispelanggaran').DataTable();
</script>

<script>
  $('#pelanggaran').DataTable();
</script>

<script>
  $('#laporan').DataTable();
</script>

<script>
  var urlProvinsi = "https://ibnux.github.io/data-indonesia/provinsi.json";
  var urlKabupaten = "https://ibnux.github.io/data-indonesia/kabupaten/";
  var urlKecamatan = "https://ibnux.github.io/data-indonesia/kecamatan/";
  var urlKelurahan = "https://ibnux.github.io/data-indonesia/kelurahan/";

  function clearOptions(id) {
    console.log("on clearOptions :" + id);

    //$('#' + id).val(null);
    $('#' + id).empty().trigger('change');
  }

  console.log('Load Provinsi...'); //ini yg muncul
  $.getJSON(urlProvinsi, function(res) {

    res = $.map(res, function(obj) {
      obj.text = obj.nama
      return obj;
    });

    data = [{
      id: "",
      nama: "- Pilih Provinsi -",
      text: "- Pilih Provinsi -"
    }].concat(res);

    //implemen data ke select provinsi
    $("#select2-provinsi").select2({
      dropdownAutoWidth: true,
      width: '100%',
      data: data
    })
  });

  var selectProv = $('#select2-provinsi');
  $(selectProv).change(function() {
    var value = $(selectProv).val();
    clearOptions('select2-kabupaten');

    if (value) {
      console.log("on change selectProv");

      var text = $('#select2-provinsi :selected').text();
      console.log("value = " + value + " / " + "text = " + text);

      console.log('Load Kabupaten di ' + text + '...')
      $.getJSON(urlKabupaten + value + ".json", function(res) {

        res = $.map(res, function(obj) {
          obj.text = obj.nama
          return obj;
        });

        data = [{
          id: "",
          nama: "- Pilih Kabupaten -",
          text: "- Pilih Kabupaten -"
        }].concat(res);

        //implemen data ke select provinsi
        $("#select2-kabupaten").select2({
          dropdownAutoWidth: true,
          width: '100%',
          data: data
        })
      })
    }
  });

  var selectKab = $('#select2-kabupaten');
  $(selectKab).change(function() {
    var value = $(selectKab).val();
    clearOptions('select2-kecamatan');

    if (value) {
      console.log("on change selectKab");

      var text = $('#select2-kabupaten :selected').text();
      console.log("value = " + value + " / " + "text = " + text);

      console.log('Load Kecamatan di ' + text + '...')
      $.getJSON(urlKecamatan + value + ".json", function(res) {

        res = $.map(res, function(obj) {
          obj.text = obj.nama
          return obj;
        });

        data = [{
          id: "",
          nama: "- Pilih Kecamatan -",
          text: "- Pilih Kecamatan -"
        }].concat(res);

        //implemen data ke select provinsi
        $("#select2-kecamatan").select2({
          dropdownAutoWidth: true,
          width: '100%',
          data: data
        })
      })
    }
  });

  var selectKec = $('#select2-kecamatan');
  $(selectKec).change(function() {
    var value = $(selectKec).val();
    clearOptions('select2-kelurahan');

    if (value) {
      console.log("on change selectKec");

      var text = $('#select2-kecamatan :selected').text();
      console.log("value = " + value + " / " + "text = " + text);

      console.log('Load Kelurahan di ' + text + '...')
      $.getJSON(urlKelurahan + value + ".json", function(res) {

        res = $.map(res, function(obj) {
          obj.text = obj.nama
          return obj;
        });

        data = [{
          id: "",
          nama: "- Pilih Kelurahan -",
          text: "- Pilih Kelurahan -"
        }].concat(res);

        //implemen data ke select provinsi
        $("#select2-kelurahan").select2({
          dropdownAutoWidth: true,
          width: '100%',
          data: data
        })
      })
    }
  });

  var selectKel = $('#select2-kelurahan');
  $(selectKel).change(function() {
    var value = $(selectKel).val();

    if (value) {
      console.log("on change selectKel");

      var text = $('#select2-kelurahan :selected').text();
      console.log("value = " + value + " / " + "text = " + text);
    }
  });
</script>
<script>
  $(document).ready(function() {
    $('#pelanggaran_id').change(function() {
      var pelanggaran_id = $(this).val();
      $('.item').hide();
      $('#item_' + pelanggaran_id + ', #status_item_' + pelanggaran_id + ', #nama_bacaleg_item_' +
          pelanggaran_id + ', #bukti_item_' + pelanggaran_id)
        .show();
    });
  });
</script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  var map = L.map('mapid').setView([-3.316694, 114.590111], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
  }).addTo(map);

  var marker;

  function updateLatLng(lat, lng) {
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
  }

  map.on('click', function(e) {
    if (marker) {
      map.removeLayer(marker);
    }
    marker = L.marker(e.latlng).addTo(map);
    updateLatLng(e.latlng.lat, e.latlng.lng);
  });
</script>
