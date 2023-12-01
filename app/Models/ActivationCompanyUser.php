<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class ActivationCompanyUser extends Model
{
    use HasFactory, HasRoles;

    protected $guard_name = "api";

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idEstado');
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
        return $query->where('idUser', $idUser);
    }
}
