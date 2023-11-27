<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionProcesoTipoDocumento extends Model
{
    use HasFactory;

    public static $snakeAttributes = false;
    public $timestamps = true;
    public $table = "asignacionProcesoTipoDocumento";
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function proceso(){
        return $this->belongsTo(Proceso::class,'idProceso');
    }

    public function tipoDocumento(){
        return $this->belongsTo(TipoDocumento::class,'idTipoDocumento');
    }

}
