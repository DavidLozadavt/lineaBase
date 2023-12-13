<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionDiaJornada extends Model
{
  use HasFactory;

  protected $table = 'asignacionDiaJornada';

  protected $guarded = ['id'];

}
