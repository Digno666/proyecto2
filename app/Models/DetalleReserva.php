<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    protected $table = 'DetalleReserva';
    protected $primaryKey = ['codReserva', 'codServicio'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'codReserva',
        'codServicio',
    ];
    protected $casts = [
        'codReserva' => 'integer',
        'codServicio' => 'integer',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'codReserva', 'codReserva');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'codServicio', 'codServicio');
    }
}
