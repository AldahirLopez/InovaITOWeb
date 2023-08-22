
@php
use App\Models\Proyecto;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Usuario;
use App\Models\ProyectoParticipante;

$ficha_tecnica_registrada=False;
$requerimientos_especiales_registrada=False;
$mostrar_participantes=False;
$memoria_tecnica_registrada=False;
$modelo_negocios_registrada=False;

$usuario = session('usuario');
$idpersona = $usuario->Id_persona;
$usuarioLogueado=Usuario::where('Id_persona',$idpersona)->first();


@endphp







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
        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg">
            <i class="fas fa-bell"></i>
            @if ($usuarioLogueado->rol->Id_rol=="ROL03")
                <span class="badge badge-danger">{{$numero_proyectos_pendientes_asesor}}</span>
           
            
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                 <p>Tienes {{$numero_proyectos_pendientes_asesor}} proyectos pendientes</p>
            </div>
            @endif


            @if ($usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
                <span class="badge badge-danger">{{$numero_proyectos_pendientes_coordinador}}</span>
           
            
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                 <p>Tienes {{$numero_proyectos_pendientes_coordinador}} proyectos pendientes</p>
            </div>
            @endif



        </li>
        <li class="nav-item">
            <span class="nav-link">{{ $nombreUsuario }}</span>
        </li>
    </ul>
</form>
