<!DOCTYPE html>
<html>

<head>
  <title>{{ $judul }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    body {
      padding: 20px;
      font-size: 14px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      padding: 10px;
    }

    strong {
      font-weight: bold;
    }

    img {
      max-width: 150px;
      max-height: 150px;
      display: block;
      margin: auto;
    }

    .separator {
      border-top: 2px solid #000;
      margin: 20px 0;
    }
  </style>
</head>

<body>
  <h1>{{ $judul }}</h1>
  <p align="center">Tanggal Cetak: {{ $tanggal }}</p>
  <div class="separator"></div>

  @if ($laporan->count() > 0)
    @foreach ($laporan as $data)
      <table>
        <tr>
          <td><strong>Jenis Pelanggaran:</strong> {{ $data->jenis_pelanggaran }}</td>
        </tr>
        <tr>
          <td><strong>Nama Partai:</strong> {{ $data->nama_partai }}</td>
        </tr>
        <tr>
          <td><strong>Status Peserta Pemilu:</strong> {{ $data->status_peserta_pemilu }}</td>
        </tr>
        <tr>
          <td><strong>Nama Peserta Pemilu:</strong> {{ $data->nama_bacaleg }}</td>
        </tr>
        <tr>
          <td><strong>Dapil:</strong> {{ $data->dapil }}</td>
        </tr>
        <tr>
          <td><strong>Provinsi:</strong> {{ $data->provinsi_nama }}</td>
        </tr>
        <tr>
          <td><strong>Kota / Kabupaten:</strong> {{ $data->kota_nama }}</td>
        </tr>
        <tr>
          <td><strong>Kecamatan:</strong> {{ $data->kecamatan_nama }}</td>
        </tr>
        <tr>
          <td><strong>Kelurahan:</strong> {{ $data->kelurahan_nama }}</td>
        </tr>
        <tr>
          <td><strong>Bukti Pendukung:</strong><br><img src="{{ $data->bukti }}" alt="Bukti Pendukung"></td>
        </tr>
        <tr>
          <td><strong>Tanggal:</strong> {{ $data->tanggal_input }}</td>
        </tr>
        <tr>
          <td><strong>Keterangan:</strong> {{ $data->keterangan }}</td>
        </tr>
        <tr>
          <td>
            <strong>Status:</strong>
            @if ($data->status == 0)
              Belum Verif
            @elseif ($data->status == 1)
              Verif
            @elseif ($data->status == 2)
              Reject
            @endif
          </td>
        </tr>
      </table>
      <div class="separator"></div>
    @endforeach
  @else
    <p class="text-center">DATA NOT FOUND</p>
  @endif
</body>

</html>
