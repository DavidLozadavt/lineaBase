<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;

class Rol extends Role
{
    use HasFactory;

    protected $guarded = ['id'];

    static $rules = [
        'name' => 'required|min:3|max:20|alpha',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
