<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsignacionDiaJornada extends Model
{
  use HasFactory;

  protected $table = 'asignacionDiaJornada';

  protected $guarded = ['id'];

  public function dia(): BelongsTo
  {
    return $this->belongsTo(Dia::class, 'idDia');
  }

  public function jornada(): BelongsTo
  {
    return $this->belongsTo(Jornada::class, 'idJornada');
  }
}
