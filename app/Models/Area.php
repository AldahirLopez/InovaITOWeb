<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;

class Area extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'area';

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'Id_categoria', 'Id_categoria');
    }
}