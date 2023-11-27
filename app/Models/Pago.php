<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
  use HasFactory;

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  protected $guarded = ['id'];

  static $rules = [
    "fechaPago"     => 'required|date',
    "fechaReg"      => 'required|date',
    "valor"         => 'required|numeric',
    "numeroFact"    => 'required|numeric',
    "excedente"     => 'required|numeric',
    "idEstado"      => 'required|integer',
    "idTransaccion" => 'required|integer',
    "idMedioPago"   => 'required|integer',
  ];

  public function transaccion(): BelongsTo
  {
    return $this->belongsTo(Transaccion::class, 'idTransaccion');
  }

  public function estado(): BelongsTo
  {
    return $this->belongsTo(Estado::class, 'idEstado');
  }
}
