<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;

class proyectoAsesor extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'proyectoAsesor';


    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'Folio', 'Folio');
    }

    protected $fillable = [
        'Folio',
        'Id_asesorpersona',
    ];
}
