<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'Promocion';
    protected $primaryKey = 'codPromocion';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'codPromocion', 
        'nombre',
        'descripcion',
        'imagen',
        'precioUnitario',
        'estActivo',
    ];
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'DetallePromocion', 'codPromocion', 'codServicio');
    }
}
