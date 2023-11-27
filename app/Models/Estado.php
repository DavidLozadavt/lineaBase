<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
  use HasFactory;

  protected $table = "estado";

  const ID_ACTIVE = 1;
  const ID_INACTIVO = 2;


  public function transacciones(): HasMany
  {
    return $this->hasMany(Transaccion::class, 'idEstado', 'id');
  }

  public function pagos(): HasMany
  {
    return $this->hasMany(Pago::class, 'idEstado', 'id');
  }
}
