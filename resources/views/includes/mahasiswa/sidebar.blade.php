<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ config('app.name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Lab</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <ion-icon name="grid"></ion-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->level == 'asisten')
                <li class="nav-item dropdown {{ Request::segment(1) == 'asisten' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown">
                        <ion-icon name="briefcase"></ion-icon>
                        <span>Asisten Lab</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::segment(2) == 'mahasiswa' ? 'active' : '' }}">
                            <a class="nav-link daftar-mhs" href="{{ route('asisten.daftar-mahasiswa') }}">Daftar
                                Mahasiswa
                                {!! $unverifiedUser
                                    ? '<span id="unverified" class="badge badge-danger ml-auto">' . $unverifiedUser . '</span>'
                                    : '' !!}</a>
                        </li>
                        <li class="{{ Request::segment(2) == 'slip' ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('asisten.slip') }}">Slip Pembayaran</a></li>
                    </ul>
                </li>
            @endif
            <li class="{{ Request::is('informasi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('informasi') }}">
                    <ion-icon name="newspaper"></ion-icon>
                    <span>Informasi</span>
                </a>
            </li>
            <li class="{{ Request::is('slip') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('slip') }}">
                    <ion-icon name="receipt"></ion-icon>
                    <span>Slip Pembayaran</span>
                </a>
            </li>
            {{-- <li class="{{ Request::segment(1) == "bebas-lab" ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('bebas-lab') }}">
                    <ion-icon name="document"></ion-icon>
                    <span>Bebas Lab</span>
                </a>
            </li> --}}
        </ul>

    </aside>
</div>
