<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoTransaccion extends Model
{
  use HasFactory;
  public static $snakeAttributes = false;
  protected $table = "tipoTransaccion";
  protected $fillable = [
    "detalle",
    "descripcion"
  ];

  public $timestamps = false;

  public function transacciones(): HasMany
  {
    return $this->hasMany(Transaccion::class, 'idTipoTransaccion', 'id');
  }

}
