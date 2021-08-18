<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ActivationCompanyUser extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = "web";

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function scopeActive($query, $idUser)
    {
        return $query->where('user_id', $idUser)
            ->where('state_id', Status::ID_ACTIVE);
    }
}
