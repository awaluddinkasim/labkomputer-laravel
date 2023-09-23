<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <ul class="navbar-nav mr-auto">
        <li><a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('f/avatar/'.auth()->user()->foto) }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->nama }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Selamat datang</div>
                <a href="{{ route('admin.profil') }}" class="dropdown-item has-icon">
                    <ion-icon name="person-outline"></ion-icon>
                    Edit Profile
                </a>
                <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger">
                    <ion-icon name="exit-outline"></ion-icon>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
