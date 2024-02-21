@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | DATA JENIS PELANGGARAN')

@section('content')

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@yield('judul_halaman')</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">HOME</a></li>
            <li class="breadcrumb-item">Jenis Pelanggaran</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">@yield('judul_halaman')</h3>
      </div>

      <div class="card-body">
        <a href="{{ route('jenispelanggaran.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data</a>
        <table id="jenispelanggaran" class="table table-bordered  table-striped mb-3">
          <thead>
            <tr align="center">
              <th>NO</th>
              <th>Jenis Pelanggaran</th>
              <th>Jumlah Pelanggaran</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jenispelanggaran as $data)
              <tr align="center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->jenis_pelanggaran }}</td>
                <td>{{ $data->jumlah_pelanggaran }}</td>

                <td>
                  <a href="{{ route('jenispelanggaran.show', $data->id_jenis_pelanggaran) }}"> <button
                      class="btn btn-light m-2"><i class="bi bi-eye-fill"></i></button></a>
                  <a href="{{ route('jenispelanggaran.edit', $data->id_jenis_pelanggaran) }}"> <button
                      class="btn btn-secondary m-2"><i class="bi bi-pencil-square"></i></button></a>
                  <form action="{{ route('jenispelanggaran.destroy', $data->id_jenis_pelanggaran) }}" method="POST"
                    onsubmit="return confirm('Apakah yakin menghapus data ini?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger m-2"><i class="bi bi-trash-fill"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
