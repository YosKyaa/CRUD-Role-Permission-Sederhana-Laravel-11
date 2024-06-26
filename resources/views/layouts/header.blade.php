<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme no-print"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="">
                    <span class="text-muted">@yield('breadcrumb-items')@yield('title')</span>
                </a>
            </div>
        </div>
        <!-- /Search -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="/assets/img/profile.png" alt class="w-40 h-40 rounded-circle"
                            style="object-fit: cover;">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                    <a class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="/assets/img/profile.png"  class="w-40 h-40 rounded-circle"
                                            style="object-fit: cover;">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="">
                        <a class="dropdown-item " href="">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Profil Saya</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="dropdown-item ">
                            <i class="bx bx-cog  me-2"></i>
                            <span class="align-middle">Edit Profil</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" target="_blank" href="http://s.jgu.ac.id/m/itic">
                            <i class="bx bx-support me-2"></i>
                            <span class="align-middle">Bantuan</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li class="dropdown-item">
                        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link">
                        <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Keluar</span>
                            <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
            </a>
        </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->