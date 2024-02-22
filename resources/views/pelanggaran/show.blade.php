@extends('pages.main')

<!-- isi bagian judul halaman -->
@section('judul_halaman', 'BAWASLU | SHOW DATA PELANGGARAN')

@section('content')
  <section class="content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('judul_halaman')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">HOME</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('pelanggaran.index') }}">Pelanggaran</a></li>
              <li class="breadcrumb-item">Show Pelanggaran</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">@yield('judul_halaman')</h3>
            </div>

            <form method="POST" action="{{ route('pelanggaran.update', $data->id) }}" enctype="multipart/form-data">
              @csrf
              @foreach ($view_pelanggarans as $i)
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="jenis_pelanggaran">Jenis pelanggaran</label>
                        <input type="text" class="form-control" value="{{ $i->jenis_pelanggaran }}" readonly>

                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="nama_partai">Partai</label>
                        <input type="text" class="form-control" value="{{ $i->nama_partai }}" readonly>

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="status">Status Peserta Pemilu</label>
                        <input type="text" class="form-control" value="{{ $data->status_peserta_pemilu }}" readonly>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="nama_bacaleg">Nama Bacaleg</label>
                        <input type="text" class="form-control" name="nama_bacaleg" id="nama_bacaleg"
                          placeholder="Masukan Nama Bacaleg" autocomplete="off"
                          value="{{ old('nama_bacaleg', $data->nama_bacaleg) }}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="nama_bacaleg">Keterangan</label>
                    <textarea readonly id="keterangan" name="keterangan" class="form-control">{{ old('keterangan', $data->keterangan) }}</textarea>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="tgl">Tanggal Input</label>
                        <input readonly type="date" class="form-control" name="tgl" id="tgl"
                          value="{{ $data->tanggal_input }}">
                        @error('tgl')
                          <div class="alert alert-danger mt-2">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label for="bukti">Bukti Pendukung</label><br>
                        @if ($data->bukti)
                          <img src="{{ $data->bukti }}" alt="Photo Partai" width="100" height="100">
                        @endif
                      </div>
                    </div>
                  </div>

                </div>
              @endforeach




              <div class="card-footer">
                <a href="{{ route('pelanggaran.index') }}" type="button" class="btn btn-secondary">Kembali</a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
