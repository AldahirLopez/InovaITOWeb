<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignarHSala extends Model
{
    protected $primaryKey = 'Id_stand';
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'asignarHSala';
}