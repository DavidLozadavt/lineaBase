<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    protected $table = 'transaccion';

    protected $guarded = ['id'];

    static $rules = [
        'fechaTransaccion'  => 'required|date',
        'hora'              => 'required|date',
        'numFacturaInicial' => 'required|integer',
        'valor'             => 'required|numeric',
        'idEstado'          => 'required|integer',
        'idTipoTransaccion' => 'required|integer',
        'idTipoPago'        => 'required|integer',
    ];
}
