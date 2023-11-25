<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;

class Rol extends Role
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
