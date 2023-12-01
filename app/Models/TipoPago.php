<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoPago extends Model
{
  use HasFactory;
  public static $snakeAttributes = false;
  protected $table = "tipoPago";
  protected $fillable = [
    "detalleTipoPago"
  ];

  protected $hidden = [
    'created_at',
    'updated_at'
  ];

  public $timestamps = false;

  public function transacciones(): HasMany
  {
    return $this->hasMany(Transaccion::class, 'idTipoPago', 'id');
  }

}
