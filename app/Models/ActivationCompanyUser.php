<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ActivationCompanyUser extends Model
{
    use HasFactory, HasRoles;

    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
