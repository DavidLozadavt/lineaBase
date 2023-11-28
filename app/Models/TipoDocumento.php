<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $timestamps = true;
    protected $table = "tipoDocumento";
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }

    public function procesos()
    {
        return $this->belongsToMany(
            Proceso::class,
            AsignacionProcesoTipoDocumento::class,
            'idProceso',
            'idTipoDocumento'
        )->withPivot('id');
    }
}
