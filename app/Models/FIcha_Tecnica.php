<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
class Ficha_Tecnica extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'fichaTecnica';

    public function area()
    {
        return $this->belongsTo(Area::class, 'Id_area', 'Id_area');
    }
}