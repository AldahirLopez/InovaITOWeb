<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
class Jurado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'jurado';


    public function persona()
    {
        return $this->belongsTo(Persona::class, 'Id_persona', 'Id_persona');
    }
}