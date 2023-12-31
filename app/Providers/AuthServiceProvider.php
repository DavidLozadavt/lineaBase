<?php

namespace App\Providers;

use App\Http\Controllers\gestion_rol\AsignacionRolPermiso;
use App\Models\AsignacionProcesoTipoDocumento;
use App\Models\Jornada;
use App\Models\MedioPago;
use App\Models\Pago;
use App\Models\Proceso;
use App\Models\Rol;
use App\Models\TipoDocumento;
use App\Models\TipoPago;
use App\Models\TipoTransaccion;
use App\Models\Transaccion;
use App\Models\User;
use App\Policies\AsignacionProcesoTipoDocumentoPolicy;
use App\Policies\AsignacionRolPermisoPolicy;
use App\Policies\JornadaPolicy;
use App\Policies\MedioPagoPolicy;
use App\Policies\PagoPolicy;
use App\Policies\PermisoPolicy;
use App\Policies\ProcesoPolicy;
use App\Policies\RolPolicy;
use App\Policies\TipoDocumentoPolicy;
use App\Policies\TipoPagoPolicy;
use App\Policies\TipoTransaccionPolicy;
use App\Policies\TransaccionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        TipoDocumento::class        => TipoDocumentoPolicy::class,
        MedioPago::class            => MedioPagoPolicy::class,
        Pago::class                 => PagoPolicy::class,
        TipoPago::class             => TipoPagoPolicy::class,
        TipoTransaccion::class      => TipoTransaccionPolicy::class,
        Transaccion::class          => TransaccionPolicy::class,
        Proceso::class              => ProcesoPolicy::class,
        Rol::class                  => RolPolicy::class,
        Permission::class           => PermisoPolicy::class,
        User::class                 => UserPolicy::class,
        Jornada::class              => JornadaPolicy::class,
        AsignacionRolPermiso::class => AsignacionRolPermisoPolicy::class,
        AsignacionProcesoTipoDocumento::class => AsignacionProcesoTipoDocumentoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
