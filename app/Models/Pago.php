<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'Pago';

    protected $primaryKey = 'codPago';

    protected $fillable = [
        'fechaPago',
        'monto',
        'estado', 
    ];


    protected $casts = [
        'fechaPago' => 'date',
        'monto' => 'float',
    ];

    public $timestamps = false;
}
