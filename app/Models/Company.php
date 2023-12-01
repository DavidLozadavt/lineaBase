<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = "company";

    const RUTA_LOGO_DEFAULT = "/default/logo.jpg";

    protected $appends = ['rutaLogoUrl'];

    public function getRutaLogoUrlAttribute()
    {
        if (
            isset($this->attributes['rutaLogo']) &&
            isset($this->attributes['rutaLogo'][0])
        ) {
            return url($this->attributes['rutaLogo']);
        }
        return url(self::RUTA_LOGO_DEFAULT);
    }

    public function principal(){
        return $this->belongsTo(Company::class,'idPrincipal');
    }

    public function sedes(){
        return $this->hasMany(Company::class,'idPrincipal');
    }
}
