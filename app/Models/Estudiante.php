<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table ='estudiantes';
    protected $hidden=['created_at', 'updated_at'];
    protected $fillable=['nombres','apellidos',
    'correo', 'usuario','edad','id_facultad'];
}
