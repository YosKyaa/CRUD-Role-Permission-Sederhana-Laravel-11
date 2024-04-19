<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme no-print">
    <div class="app-brand demo ">
        <a href="{{ route('fakultas_index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo-sjgu.png') }}" height="44">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu</span>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Home</div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'fakultas_index' ? 'active' : (request()->route()->getPrefix() == '/fakultas' ? 'active' : '') }}">
            <a href="{{ route('fakultas_index') }}" class="menu-link" title="Data Fakultas">
                <i class="menu-icon tf-icons bx bx-link"></i>
                <div>Data Fakultas</div>
            </a>
        </li>
        <li
            class="menu-item {{ Route::currentRouteName() == 'prodi_index' ? 'active' : (request()->route()->getPrefix() == '/prodi' ? 'active' : '') }}">
            <a href="{{ route('prodi_index') }}" class="menu-link" title="Data Prodi">
                <i class="menu-icon tf-icons bx bx-sitemap"></i>
                <div>Data Program Studi</div>
            </a>
        </li>
        @can('lihat-data-user')
            <li class="menu-item  {{ Request::is('role', 'user') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon bx bxs-lock-alt'></i>
                    <div data-i18n="Dashboards">Konfigurasi</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item  {{ Request::is('role') ? 'active' : '' }}">
                        <a href="/role" class="menu-link">
                            <div>Role-Permission</div>
                        </a>
                    </li>
                    <li class="menu-item  {{ Request::is('user') ? 'active' : '' }}">
                        <a href="{{ url('user') }}" class="menu-link">
                            <div>User</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    @endcan





</aside>
<!-- / Menu -->
