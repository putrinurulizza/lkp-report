<header class="mb-auto">
    <div>
        <h3 class="float-md-start mb-0">Cover</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="#">Home</a>
            <a class="nav-link fw-bold py-1 px-0" href="#">Kegiatan</a>
            <a class="nav-link fw-bold py-1 px-0" href="#">Laporan</a>

            <div class="dropdown ms-4">
                <a class="nav-link fw-bold py-1 px-0 dropdown-toggle" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">user</a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </div>
        </nav>
    </div>
</header>

{{-- <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
    <!-- List -->
    <li class="dropdown ms-2">
        <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <div class="p-1 text-black fw-semibold p-2">
                <i class="fa-solid fa-user mx-1"></i>
                {{ auth()->user()->nama }}
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
            <ul class="list-unstyled">
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="dropdown-item">
                            <i class="fa-regular dropdown-item-icon fa-arrow-right-from-bracket me-1 fa-fw"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </li>
</ul> --}}
