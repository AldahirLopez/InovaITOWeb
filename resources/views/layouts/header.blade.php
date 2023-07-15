<form class="form-inline mr-auto" action="#" style="background-color: #FA7A1E;">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg"><i class="fas fa-user"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesión</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link nav-link-lg"><i class="fas fa-bell"></i></a>
        </li>
        <li class="nav-item">
            <span class="nav-link">{{ $nombreUsuario }}</span>
        </li>
    </ul>
</form>
