<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    protected $table = "tipoDocumento";
    protected $fillable = [
        "tituloDocumento",
        "descripcion",
        "idCompany"
    ];
    protected $hiden = [
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;
    // public function proceso()
    // {
    //     return $this->belongsTo(Proceso::class, 'idProceso');
    // }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idEstado');
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'idCompany');
    }
}
