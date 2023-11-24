<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class ActivationCompanyUser extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = "web";

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'state_id');
    }

    public function scopeActive($query)
    {
        $now = Carbon::now();
        return $query
            ->where('state_id', Estado::ID_ACTIVE)
            ->whereDate('fechaInicio', '<=', $now)
            ->whereDate('fechaFin', '>=', $now);
    }

    public function scopeByUser($query, $idUser)
    {
        return $query->where('user_id', $idUser);
    }
}
