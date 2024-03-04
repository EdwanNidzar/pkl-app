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
        <th>Jumlah Pelanggaran</th>
      </tr>
    </thead>
    <tbody>
      @if ($jenis->count() > 0)
        @foreach ($jenis as $data)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->jenis_pelanggaran }}</td>
            <td>{{ $data->jumlah_pelanggaran }}</td>
            <td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="3" class="text-center">DATA NOT FOUND</td>
        </tr>
      @endif
    </tbody>
  </table>

</body>

</html>
