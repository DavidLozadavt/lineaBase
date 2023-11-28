<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    use HasFactory;
    public static $snakeAttributes = false;
    public $timestamps = true;
    protected $table = "proceso";
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }

    public function tipoDocumentos()
    {
        return $this->belongsToMany(
            TipoDocumento::class,
            AsignacionProcesoTipoDocumento::class,
            'idProceso',
            'idTipoDocumento'
        )->withPivot('id');
    }
}
