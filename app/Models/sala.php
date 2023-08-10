<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\horario;

class sala extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'sala';


    public function horario()
    {
        return $this->belongsTo(horario::class, 'Id_horario', 'Id_horario');
    }
}