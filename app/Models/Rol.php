<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class Rol extends Role
{
  use HasFactory;

  protected $guarded = ['id'];

  static $rules = [
    'name' => 'required|min:3|max:20|regex:/^[A-Za-z\s]+$/',
  ];

  public function company()
  {
    return $this->belongsTo(Company::class, 'idCompany');
  }

  public static function create(array $attributes = [])
  {
    $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

    $params = ['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']];
    if (PermissionRegistrar::$teams) {
      if (array_key_exists(PermissionRegistrar::$teamsKey, $attributes)) {
        $params[PermissionRegistrar::$teamsKey] = $attributes[PermissionRegistrar::$teamsKey];
      } else {
        $attributes[PermissionRegistrar::$teamsKey] = getPermissionsTeamId();
      }
    }

    return static::query()->create($attributes);
  }
  
}
