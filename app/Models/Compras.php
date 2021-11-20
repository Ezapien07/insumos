<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Compras extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_empleado',
        'insumo',
        'link_op1',
        'precio_op1',
        'link_op2',
        'precio_op2',
        'fecha_compra',
        'id_admin',
        'id_directivo',
        'id_contador',
        'estatus'
    ];
}
