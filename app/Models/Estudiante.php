<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Semestre;
use App\Models\Carrera;
class Estudiante extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'estudiante';

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'Id_persona', 'Id_persona');
    }



    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'Id_carrera', 'Id_carrera');
    }

  

}