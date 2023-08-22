<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\tecnologico;

class coordinador extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'coordinador';
    

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'Id_persona', 'Id_persona');
    }

    public function tecnologico()
    {
        return $this->belongsTo(tecnologico::class, 'Clave_tecnologico', 'Clave_tecnologico');
    }

}
