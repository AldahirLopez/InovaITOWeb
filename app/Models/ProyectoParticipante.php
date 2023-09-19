<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estudiante;
class ProyectoParticipante extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'proyectoParticipante';

    protected $fillable = [
        'Idpersona',
        'Folio',
    ];
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'Matricula', 'Matricula');
    }
}