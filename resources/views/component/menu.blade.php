<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SMP PGRI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU
    </div>

    @if (auth()->user()->role == 1)
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.admin') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>DASHBOARD</span></a>
        </li>

        <!-- Nav Item - Jabatan -->
        <li class="nav-item {{ request()->routeIs('jabatan.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('jabatan.index') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>DATA JABATAN</span>
            </a>
        </li>

        <!-- Nav Item - Pegawai -->
        <li class="nav-item {{ request()->routeIs('pegawai.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pegawai.index') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>DATA PEGAWAI</span>
            </a>
        </li>

        <!-- Nav Item - Tahun Ajaran -->
        <li class="nav-item {{ request()->routeIs('tahun-ajaran.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tahun-ajaran.index') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>DATA TAHUN AJARAN</span>
            </a>
        </li>

        {{-- <!-- Nav Item - Kelas -->
        <li class="nav-item {{ request()->routeIs('kelas.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kelas.index') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>DATA KELAS</span>
            </a>
        </li> --}}

        <!-- Nav Item - Kelas -->
        <li class="nav-item {{ request()->routeIs('wali-kelas.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('wali-kelas.index') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>DATA KELAS</span>
            </a>
        </li>

        <!-- Nav Item - Mapel -->
        <li class="nav-item {{ request()->routeIs('mapel.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mapel.index') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>DATA MATA PELAJARAN</span>
            </a>
        </li>

        <!-- Nav Item - Siswa -->
        <li class="nav-item {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('siswa.index') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>DATA SISWA</span>
            </a>
        </li>
    @endif

    @if (auth()->user()->role == 2)
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->routeIs('dashboard.pegawai') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.pegawai') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Nav Item - Nilai -->
        <li class="nav-item {{ request()->routeIs('tahun.ajaran') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tahun.ajaran') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>DATA NILAI</span>
            </a>
        </li>
    @endif

    @if (auth()->user()->role == 0)
        <!-- Nav Item - Nilai -->
        <li class="nav-item {{ request()->routeIs('data-nilai.siswa') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data-nilai.siswa') }}">
                <i class="fas fa-fw fa-file"></i>
                <span>NILAI</span>
            </a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
