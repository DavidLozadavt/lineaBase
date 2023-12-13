<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jornada extends Model
{
  use HasFactory;

  protected $table = 'jornada';

  protected $guarded = ['id'];

  static $rules = [
    'nombreJornada' => 'required|string',
    'descripcion' => 'required|string',
    'horaInicial' => 'required|date_format:H:i:s',
    'horaFinal' => 'required|date_format:H:i:s',
    'numeroHoras' => 'required|integer',
    'dias' => 'required|array',
  ];

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class, 'idCompany');
  }

  public function dias(): BelongsToMany
  {
    return $this->belongsToMany(Dia::class, 'asignacionDiaJornada', 'idJornada', 'idDia');
  }
}
