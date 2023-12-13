<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jornada extends Model
{
  use HasFactory;

  protected $table = 'jornada';

  protected $guarded = ['id'];

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class, 'idCompany');
  }
  
}
