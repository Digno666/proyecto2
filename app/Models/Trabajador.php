<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{

    protected $table = 'Trabajador';

    protected $primaryKey = 'carnetIdentidad';


    public $incrementing = false;


    protected $keyType = 'integer';


    protected $fillable = [
        'carnetIdentidad',
        'nombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'sexo',
        'edad',
        'telefono',
        'codUsuarioF',  
    ];

  
    protected $casts = [
        'carnetIdentidad' => 'integer',
        'nombre' => 'string',
        'apellidoPaterno' => 'string',
        'apellidoMaterno' => 'string',
        'sexo' => 'string',
        'edad' => 'integer',
        'telefono' => 'integer',
        'codUsuarioF' => 'integer', 
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'codUsuarioF', 'codUsuario');
    }


    public $timestamps = false;
}