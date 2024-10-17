<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">


        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
                @if (Auth::check())
                    @php
                        // Ambil data guru terkait dengan user yang login
                        $guru = Auth::user()->guru;
                    @endphp

                    @if ($guru && $guru->foto)
                        <img src="{{ asset('storage/foto-pegawai/' . $guru->foto) }}" alt="Foto Pegawai"
                            class="img-thumbnail rounded-circle" width="30px">
                    @else
                        <img src="{{ asset('image/default.png') }}" alt="Default Avatar"
                            class="img-thumbnail rounded-circle" width="50px">
                    @endif
                @else
                    <p>Guest</p>
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" id="logoutLink" href="#">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </li>

    </ul>

</nav>
