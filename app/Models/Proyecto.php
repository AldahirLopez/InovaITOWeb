<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ficha_Tecnica;

class Proyecto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'proyecto';


    public function ficha()
    {
        return $this->belongsTo(Ficha_Tecnica::class, 'Id_fichaTecnica', 'Id_fichaTecnica');
    }




}