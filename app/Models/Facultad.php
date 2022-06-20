<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table= 'facultades';
    protected $hidden=['created_at','updated_at'];
    protected $fillable=['nombre_facultad','cant_carreras','id','id_universidad'];
}
