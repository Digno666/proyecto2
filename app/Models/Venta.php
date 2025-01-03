<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;


    protected $table = 'Venta';


    protected $primaryKey = 'codVenta';


    public $incrementing = true;


    protected $keyType = 'int';


    protected $fillable = [
        'fechaVenta',
        'montoTotal',
        'codTrabajadorF',
        'codClienteF',
        'codPagoF',
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
    
    public function detalleVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'codVenta', 'codVenta');
    }
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'codVenta');  // Asegúrate de que 'venta_id' sea la clave foránea correcta
    }

    public $timestamps = false;
}
