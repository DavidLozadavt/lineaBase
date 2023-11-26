<?php

namespace App\Providers;

use App\Models\MedioPago;
use App\Models\Pago;
use App\Models\TipoDocumento;
use App\Models\TipoPago;
use App\Models\TipoTransaccion;
use App\Models\Transaccion;
use App\Policies\MedioPagoPolicy;
use App\Policies\PagoPolicy;
use App\Policies\TipoDocumentoPolicy;
use App\Policies\TipoPagoPolicy;
use App\Policies\TipoTransaccionPolicy;
use App\Policies\TransaccionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        TipoDocumento::class   => TipoDocumentoPolicy::class,
        MedioPago::class       => MedioPagoPolicy::class,
        Pago::class            => PagoPolicy::class,
        TipoPago::class        => TipoPagoPolicy::class,
        TipoTransaccion::class => TipoTransaccionPolicy::class,
        Transaccion::class     => TransaccionPolicy::class
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
