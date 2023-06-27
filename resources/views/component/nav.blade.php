<header class="mb-auto">
    <div class="justify-content-around d-flex">
        <h3 class="float-md-start fw-bold mb-0 fs-4">LKP Diskominfo</h3>
        <nav class="nav navbar-expand-lg nav-masthead d-flex m-auto w-70">
            <ul class="navbar-nav d-flex w-100 ">
                <li class="nav-item me-5">
                    <a class="nav-link fw-bold py-1 px-0 {{ Request::is('dashboard/home') ? 'active' : '' }}"
                        href="/dashboard/home" aria-current="page">Home</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link fw-bold py-1 px-0 {{ Request::is('dashboard/kegiatan') ? 'active' : '' }}"
                        href="/dashboard/kegiatan">Riwayat Kegiatan</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link fw-bold py-1 px-0 {{ Request::is('dashboard/laporan') ? 'active' : '' }}"
                        href="/dashboard/laporan">Laporan</a>
                </li>
                <li class="nav-item me-5">
                    <a class="nav-link fw-bold py-1 px-0 {{ Request::is('dashboard/laporan') ? 'active' : '' }}"
                        href="/dashboard/laporan">User</a>
                </li>
            </ul>

        </nav>
        <a class="nav-link dropdown-toggle p-1 fw-bold " href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            User
        </a>
        <ul class="dropdown-menu bg-transparent border-0 text-white">
            <li class="mb-2"><a class="nav-link {{ Request::is('dashboard/user/profile') ? 'active' : '' }}"
                    href="dashboard/user/profile">
                    Profile
                </a></li>
            <li class="mb-2"><a class="nav-link has-arrow {{ Request::is('dashboard/user/settings') ? 'active' : '' }}"
                    href="dashboard/user/settings">
                    Settings
                </a></li>
                <hr>
            <li class="mb-2">
                <form action="/logout" method="post">
                    @csrf
                    <button class="nav-link has-arrow">
                        <i class="fa-regular dropdown-item-icon fa-arrow-right-from-bracket me-1 fa-fw"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

</header>
