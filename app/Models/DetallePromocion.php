<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePromocion extends Model
{
    protected $table = 'DetallePromocion';
    protected $primaryKey = ['codServicios', 'codPromocion'];
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'codPromocion', 
        'codServicio',
    ];
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'codServicio', 'codServicio'); 
    }
    public function promocion()
    {
        return $this->belongsTo(Promocion::class, 'codPromocion', 'codPromocion'); 
    }
}
