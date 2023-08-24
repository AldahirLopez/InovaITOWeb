<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ficha_Tecnica;
use App\Models\Memoria_t;

class Proyecto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'proyecto';
    protected $primaryKey = 'Folio'; // Indica que 'Folio' es la clave primaria
    public $incrementing = false; 


    public function ficha()
    {
        return $this->belongsTo(Ficha_Tecnica::class, 'Id_fichaTecnica', 'Id_fichaTecnica');
    }

    public function memoria()
    {
        return $this->belongsTo(Memoria_t::class, 'Id_memoriaTecnica', 'Id_memoriaTecnica');
    }



    protected $fillable = [
        // ... otras columnas permitidas en asignación en masa
        'Id_memoriaTecnica',
        'Modelo_negocio',
    ];

}