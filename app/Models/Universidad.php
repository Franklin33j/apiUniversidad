<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universidad extends Model
{
    protected $table='universidades';
    protected $fillable = ['nombre_universidad', 'rector'];
    protected $hidden=['created_at','updated_at'];
}
