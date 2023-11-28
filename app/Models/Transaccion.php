<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaccion extends Model
{
  use HasFactory;

  protected $table = 'transaccion';

  protected $guarded = ['id'];

  static $rules = [
    'fechaTransaccion'  => 'required|date',
    'hora'              => 'required|date_format:H:i:s',
    'numFacturaInicial' => 'required|numeric',
    'valor'             => 'required|numeric',
    'idEstado'          => 'required|integer',
    'idTipoTransaccion' => 'required|integer',
    'idTipoPago'        => 'required|integer',
  ];

  public function pagos(): HasMany
  {
    return $this->hasMany(Pago::class, 'idTransaccion', 'id');
  }

  public function tipoTransaccion(): BelongsTo
  {
    return $this->belongsTo(TipoTransaccion::class, 'idTipoTransaccion');
  }

  public function tipoPago(): BelongsTo
  {
    return $this->belongsTo(TipoPago::class, 'idTipoPago');
  }

  public function estado(): BelongsTo
  {
    return $this->belongsTo(Estado::class, 'idEstado');
  }
}
