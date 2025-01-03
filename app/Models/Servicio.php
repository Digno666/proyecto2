<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;


    protected $table = 'Servicio';

    protected $primaryKey = 'codServicio';


    public $incrementing = true;


    protected $keyType = 'int';

  
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
    ];
    public function promociones()
    {
        return $this->belongsToMany(Promocion::class, 'DetallePromocion', 'codServicio', 'codPromocion');
    }


    public $timestamps = false;
}
