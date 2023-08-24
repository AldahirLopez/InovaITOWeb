<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamentos;
use App\Models\Persona;
class Asesor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'asesor';
    protected $primaryKey = 'Id_asesor';

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'Id_departamento', 'Id_departamento');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'Id_persona', 'Id_persona');
    }


}