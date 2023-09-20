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
$persona = Estudiante::where('Id_persona', $idpersona)->first();
if($usuarioLogueado->Id_rol=="ROL02"){
$proyectoParticipante = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
if($proyectoParticipante!=null){
$folioproyecto = $proyectoParticipante->Folio;

$proyecto=Proyecto::where('Folio',$folioproyecto)->first();

if($proyecto->Id_fichaTecnica!=null){
$ficha_tecnica_registrada=True;

}
}


}

@endphp


<li class="side-menus">

    @if ($usuarioLogueado->rol->Id_rol=="ROL02")
    <a class="nav-link {{ Request::is('proyectos') ? 'active' : '' }}" href="/proyectos">
        <i class="fas fa-file-invoice"></i></i><span>Proyectos</span>
    </a>
    @endif

    @if ($usuarioLogueado->rol->Id_rol=="ROL010" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('lider') ? 'active' : '' }}" href="/lider">
        <i class="fas fa-user"></i><span>Líder de Proyecto</span>
    </a>
    @endif

    @if ($ficha_tecnica_registrada)
    <a class="nav-link {{ Request::is('participante') ? 'active' : '' }}" href="/tabla_part">
        <i class="fas fa-users"></i><span>Participantes</span>
    </a>
    @endif


    @if ($usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('asesor') ? 'active' : '' }}" href="/asesores">
        <i class="fas fa-user-tie"></i><span>Asesores</span>
    </a>
    @endif

    @if ($usuarioLogueado->rol->Id_rol=="ROL03" || $usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('constancia') ? 'active' : '' }}" href="/constancia">
        <i class="fas fa-notes-medical"></i><span>Constancias</span>
    </a>
    @endif

    @if ($usuarioLogueado->rol->Id_rol=="ROL07" || $usuarioLogueado->rol->Id_rol=="ROL01")
    <a class="nav-link {{ Request::is('jurado') ? 'active' : '' }}" href="/jurado">
        <i class=" fas fa-gavel"></i><span>Jurado</span>
    </a>
    @endif

    @if ($usuarioLogueado->rol->Id_rol=="ROL010")
    <a class="nav-link {{ Request::is('roles') ? 'active' : '' }} " href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    @endif
    @if ($usuarioLogueado->rol->Id_rol=="ROL03")
    <a class="nav-link {{ Request::is('proyectosA') ? 'active' : '' }} " href="/proyectosA">
        <i class=" fas fa-folder"></i><span>Proyectos Asesor</span>
    </a>
    @endif


    @if ($usuarioLogueado->rol->Id_rol=="ROL01")
    <a class="nav-link {{ Request::is('proyectosC') ? 'active' : '' }} " href="/proyectosC">
        <i class=" fas fa-folder"></i><span>Proyectos Coordinador</span>
    </a>
    @endif
    @if ($usuarioLogueado->rol->Id_rol=="ROL03" || $usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('horario') ? 'active' : '' }} " href="/horariosala">
        <i class=" fas fa-solid fa-calendar-day"></i><span>Sala Horarios</span>
    </a>
    @endif
    @if ($usuarioLogueado->rol->Id_rol=="ROL03" || $usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('horario') ? 'active' : '' }} " href="/horariostand">
        <i class=" fas fa-calendar"></i><span>Stand Horarios</span>
    </a>
    @endif
    @if ($usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('t_pos') ? 'active' : '' }} " href="/t_pos">
        <i class=" fas fa-table"></i><span>Tabla de Posiciones</span>
    </a>
    @endif

    @if ($usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('sala') ? 'active' : '' }} " href="/sala">
        <i class=" fas fa-solid fa-people-roof"></i><span>Sala</span>
    </a>
    @endif

    @if ($usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('stand') ? 'active' : '' }} " href="/stand">
        <i class=" fas fa-store"></i><span>Stand</span>
    </a>
    @endif

    @if ($usuarioLogueado->rol->Id_rol=="ROL010" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('coordinador') ? 'active' : '' }} " href="/coordinador">
        <i class=" fas fa-table"></i><span>Coordinadores</span>
    </a>
    @endif
    @if ($usuarioLogueado->rol->Id_rol=="ROL01" || $usuarioLogueado->rol->Id_rol=="ROL07")
    <a class="nav-link {{ Request::is('importarMenu') ? 'active' : '' }} " href="/importarMenu">
        <i class=" fas fa-file-excel"></i><span>Importar Datos</span>
    </a>
    @endif
</li>