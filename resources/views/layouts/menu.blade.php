<li class="side-menus">
    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">
    <i class="fas fa-house"></i><span>Dashboard</span>
    </a>

    <a class="nav-link {{ Request::is('productos') ? 'active' : '' }}" href="/productos">
        <i class="fas fa-user"></i><span>Lider de Proyecto</span>
    </a>

    <a class="nav-link {{ Request::is('categorias') ? 'active' : '' }}" href="/categorias">
    <i class="fas fa-users"></i><span>Participantes</span>
    </a>

    <a class="nav-link {{ Request::is('entradas') ? 'active' : '' }}" href="/entradas">
    <i class="fas fa-user-tie"></i><span>Asesores</span>
    </a>

    <a class="nav-link {{ Request::is('salidas') ? 'active' : '' }}" href="/salidas">
    <i class="fas fa-file-invoice"></i></i><span>Proyectos</span>
    </a>

    <a class="nav-link {{ Request::is('obras') ? 'active' : '' }}" href="/obras">
        <i class="fas fa-building"></i><span>Registros</span>     
    </a>

    <a class="nav-link {{ Request::is('usuarios') ? 'active' : '' }}" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>

    <a class="nav-link {{ Request::is('roles') ? 'active' : '' }} " href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a> 
</li>
