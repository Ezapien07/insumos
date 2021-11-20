<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prestamos extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'fechaSolicitud',
        'observaciones',
        'fechaEntrega',
        'id_empleado',
        'id_insumo'
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
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'id_empleado');
    }
    public function insumo()
    {
        return $this->belongsTo(Insumos::class, 'id_empleado');
    }
}
