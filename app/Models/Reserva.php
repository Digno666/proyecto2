<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'Reserva';
    protected $primaryKey = 'codReserva';
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'fechaReserva',
        'horaReserva',
        'montoTotal',
        'codTrabajadorF',
        'codClienteF',
        'codPagoF',
        'estado',
    ];


    protected $casts = [
        'fechaVenta' => 'date',
        'montoTotal' => 'float',
        'codTrabajadorF' => 'integer',
        'codClienteF' => 'integer',
        'codPagoF' => 'integer',
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'codTrabajadorF', 'carnetIdentidad');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'codClienteF', 'carnetIdentidad');
    }
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'codPagoF', 'codPago');
    }
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'DetalleReserva', 'codReserva', 'codServicio');
    }
    public $timestamps = false;
}
