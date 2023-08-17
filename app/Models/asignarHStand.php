<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignarHStand extends Model
{
    protected $primaryKey = 'Id_sala';
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'mysql';
    protected $table = 'asignarHStand';
}