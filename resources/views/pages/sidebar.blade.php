<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">APS APK</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">EDWAN</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill me-2"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">TABLE</li>
        <li class="nav-item">
          <a href="{{ route('parpols.index') }}"
            class="nav-link {{ request()->routeIs('parpols.index') ? 'active' : '' }}">
            <i class="bi bi-list-ul me-2"></i>
            <p>
              Partai Politik
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('jenispelanggaran.index') }}"
            class="nav-link {{ request()->routeIs('jenispelanggaran.index') ? 'active' : '' }}">
            <i class="bi bi-list-ul me-2"></i>
            <p>
              Jenis Pelanggaran
            </p>
          </a>
        </li>

        @if (auth()->user()->hasRole('bawaslu-provinsi') ||
                auth()->user()->hasRole('bawaslu-kota'))
          <li class="nav-item">
            <a href="{{ route('pelanggaran.index') }}"
              class="nav-link {{ request()->routeIs('pelanggaran.index') ? 'active' : '' }}">
              <i class="bi bi-list-ul me-2"></i>
              <p>
                Pelanggaran
              </p>
            </a>
          </li>
        @endif

        @if (auth()->user()->hasRole('bawaslu-provinsi') ||
                auth()->user()->hasRole('bawaslu-kota') ||
                auth()->user()->hasRole('panwascam'))
          <li class="nav-item">
            <a href="{{ route('laporan.index') }}"
              class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
              <i class="bi bi-list-ul me-2"></i>
              <p>
                Laporan Pelanggaran
              </p>
            </a>
          </li>
        @endif

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
