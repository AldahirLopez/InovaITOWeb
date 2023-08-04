<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;
class validacionProyectoC extends Model
{
    use HasFactory;
 
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'validacionProyectoC';

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'Folio', 'Folio');
    }

}
