<!DOCTYPE html>
<html>

<head>
  <title>{{ $judul }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
    body {
      padding: 20px;
      font-size: 12px;
      /* Adjust the font size as needed */
    }

    h1 {
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      padding: 5px;
    }

    th,
    td {
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
      text-align: center;
      /* Add this line to center align the text */
    }

    img {
      max-width: 100px;
      max-height: 100px;
    }
  </style>
</head>

<body>
  <h1 align="center">{{ $judul }}</h1>
  <p align="center">Tanggal Cetak : {{ $tanggal }}</p>
  <hr>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>NO</th>
        <th>Jenis Pelanggaran</th>
        <th>Nama Partai</th>
        <th>Status Peserta Pemilu</th>
        <th>Nama Peserta Pemilu</th>
        <th>Dapil</th>
        <th>Bukti Pendukung</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @if ($pelanggaran->count() > 0)
        @foreach ($pelanggaran as $data)
          <tr align="center">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->jenis_pelanggaran }}</td>
            <td>{{ $data->nama_partai }}</td>
            <td>{{ $data->status_peserta_pemilu }}</td>
            <td>{{ $data->nama_bacaleg }}</td>
            <td>{{ $data->dapil }}</td>
            <td>
              <img src="{{ $data->bukti }}" alt="Bukti Pendukung" width="25%" height="25%">
            </td>
            <td>{{ $data->tanggal_input }}</td>
            <td>{{ $data->keterangan }}</td>

          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="4" class="text-center">DATA NOT FOUND</td>
        </tr>
      @endif
    </tbody>
  </table>

</body>

</html>
