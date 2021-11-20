<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empleados extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'nombre',
        'apePaterno',
        'apeMaterno',
        'rol',
        'calle',
        'num',
        'colonia',
        'estado',
        'municipio',
        'curp',
        'rfc',
        'correo',
        'cp',
        'password',
        'estatus',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


}
