<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\rol;

class Usuario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'usuario';
    protected $Contrasena;

    public function rol()
    {
        return $this->belongsTo(rol::class, 'Id_rol', 'Id_rol');
    }
    public function persona()
    {
        // Asegúrate de que esto esté configurado correctamente según tus modelos y relaciones
        return $this->belongsTo(Persona::class, 'Id_persona', 'Id_persona');  // 'id_persona' debe ser la clave foránea en la tabla 'usuarios'
    }


}