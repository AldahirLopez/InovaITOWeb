@php
use App\Models\Proyecto;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\ProyectoParticipante;

$ficha_tecnica_registrada=False;
        $requerimientos_especiales_registrada=False;
        $mostrar_participantes=False;
        $memoria_tecnica_registrada=False;
        $modelo_negocios_registrada=False;
        
        $usuario = session('usuario');
        $idpersona = $usuario->Id_persona;
        $persona = Estudiante::where('Id_persona', $idpersona)->first();
        $proyectoParticipante = ProyectoParticipante::where('Matricula', $persona->Matricula)->first();
        $folioproyecto = $proyectoParticipante->Folio;

        $proyecto=Proyecto::where('Folio',$folioproyecto)->first();
        
        if($proyecto->Id_fichaTecnica!=null){
            $ficha_tecnica_registrada=True;

        }




@endphp


<li class="side-menus">
    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">
    <i class="fas fa-house"></i><span>Dashboard</span>
    </a>
    
    <a class="nav-link {{ Request::is('proyectos') ? 'active' : '' }}" href="/proyectos">
    <i class="fas fa-file-invoice"></i></i><span>Proyectos</span>
    </a>

    <a class="nav-link {{ Request::is('lider') ? 'active' : '' }}" href="/lider">
        <i class="fas fa-user"></i><span>Lider de Proyecto</span>
    </a>
    @if ($ficha_tecnica_registrada)
        <a class="nav-link {{ Request::is('participante') ? 'active' : '' }}" href="/tabla_part">
        <i class="fas fa-users"></i><span>Participantes</span>
        </a>
    @endif


    <a class="nav-link {{ Request::is('asesor') ? 'active' : '' }}" href="/asesores">
    <i class="fas fa-user-tie"></i><span>Asesores</span>
    </a>

    <a class="nav-link {{ Request::is('registros') ? 'active' : '' }}" href="/registros">
        <i class="fas fa-notes-medical"></i><span>Registros</span>     
    </a>

    <a class="nav-link {{ Request::is('jurado') ? 'active' : '' }}" href="/jurado">
        <i class=" fas fa-gavel"></i><span>Jurado</span>
    </a>

    <a class="nav-link {{ Request::is('roles') ? 'active' : '' }} " href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a> 

    <a class="nav-link {{ Request::is('proyectosA') ? 'active' : '' }} " href="/proyectosA">
        <i class=" fas fa-folder"></i><span>Proyectos Aceptados y Pendientes Para Aprobar</span>
    </a> 
    
    <a class="nav-link {{ Request::is('horario') ? 'active' : '' }} " href="/horario">
        <i class=" fas fa-folder"></i><span>Horarios</span>
    </a> 




</li>
