<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horario extends Model
{
   
    
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'horario';
}
