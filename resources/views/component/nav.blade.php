<header class="mb-auto">
    <div>
        <h3 class="float-md-start fw-bold mb-0 fs-4">LKP Diskominfo</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link fw-bold py-1 px-0 {{ Request::is('dashboard/home') ? 'active' : '' }}"
                href="/dashboard/home" aria-current="page">Home</a>
            <a class="nav-link fw-bold py-1 px-0 {{ Request::is('dashboard/kegiatan') ? 'active' : '' }}"
                href="/dashboard/kegiatan">Riwayat Kegiatan</a>
            <a class="nav-link fw-bold py-1 px-0 {{ Request::is('dashboard/laporan') ? 'active' : '' }}"
                href="/dashboard/laporan">Laporan</a>

            <div class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/user*') ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse" data-bs-target="#navUser" aria-expanded="false" aria-controls="navUser">
                    user
                </a>

                <div id="navUser" class="collapse {{ Request::is('dashboard/user*') ? 'show' : '' }}"
                    data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/user/profile') ? 'active' : '' }}"
                                href="dashboard/user/profile">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow {{ Request::is('dashboard/user/settings') ? 'active' : '' }}"
                                href="dashboard/user/settings">
                                Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow" href="/logout">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="dropdown ms-3">
                <a class="nav-link fw-bold py-1 px-0 dropdown-toggle collapse {{ Request::is('dashboard/user*') ? 'show' : '' }}"
                    role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">user</a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item {{ Request::is('dashboard/user/profile') ? 'active' : '' }}"
                        href="/dashboard/user/profile">Profile</a>
                    <a class="dropdown-item {{ Request::is('dashboard/user/settings') ? 'active' : '' }}"
                        href="/dashboard/user/settings">Settings</a>
                    <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>

            <form action="/logout" method="post">
                @csrf
                <button class="dropdown-item">
                    <i class="fa-regular dropdown-item-icon fa-arrow-right-from-bracket me-1 fa-fw"></i>
                    Logout
                </button>
            </form>
        </nav>
    </div>
</header>
