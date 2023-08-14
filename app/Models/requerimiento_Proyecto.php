<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requerimiento_Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'Folio',
        'Id_requerimientoEspecial',
    ];
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table ='requerimiento_Proyecto';
    
}