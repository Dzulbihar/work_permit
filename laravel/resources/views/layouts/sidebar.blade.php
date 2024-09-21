<aside class="main-sidebar sidebar-light-dark elevation-4">
  <!-- Brand Logo -->
  <div class="brand-link">
    <img src="{{asset('logo/tpks1.png')}}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8; border-radius: 0;">
    <span class="brand-text font-weight-light"> TPKS </span>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        
      </div>
      <div class="info">
        <a href="#" class="d-block"> {{ Auth::user()->name }}  </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(auth()->user()->role == 'hsse' || auth()->user()->role == 'fungsional')
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link {{ ($title ?? '') === "home" ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p> Dashboard </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('job_desc')}}" class="nav-link {{ ($title ?? '') === "job_desc" ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p> Pengajuan Izin Kerja </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('monitoring')}}" class="nav-link {{ ($title ?? '') === "monitoring" ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p> Monitoring </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('email')}}" class="nav-link {{ ($title ?? '') === "email" ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p> Master Email </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('klasifikasi_kerja')}}" class="nav-link {{ ($title ?? '') === "klasifikasi_kerja" ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p> Master Klasifikasi Kerja </p>
          </a>
        </li>
        @endif

        @if(auth()->user()->role == 'user')
        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link {{ ($title ?? '') === "home" ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p> Dashboard </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('profile')}}" class="nav-link {{ ($title ?? '') === "profile" ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p> Profile </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('job')}}" class="nav-link {{ ($title ?? '') === "job" ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p> Pengajuan Izin Kerja </p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
