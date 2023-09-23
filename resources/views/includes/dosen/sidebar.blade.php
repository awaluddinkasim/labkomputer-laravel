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
            <li class="{{ Request::segment('2') == "dashboard" ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dosen.dashboard') }}">
                    <ion-icon name="grid"></ion-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::segment('2') == "praktikum" ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dosen.praktikum') }}">
                    <ion-icon name="newspaper"></ion-icon>
                    <span>Praktikum</span>
                </a>
            </li>
        </ul>

    </aside>
</div>
