<?php

namespace App\Http\Controllers\gestion_usuario;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class UserController extends Controller
{
    public function getUsers()
    {
        $id = FacadesSession::get("idCompany");
        $user = ActivationCompanyUser::with('company', 'user', 'user.persona', 'roles', 'estado')
            ->where('idCompany', $id)
            ->get();

        return response()->json($user);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $Personaaa = new Persona($data);
        $Personaaa->rutaFoto = Persona::RUTA_FOTO_DEFAULT;
        $Personaaa->identificacion = rand(0, 99999);
        $Personaaa->save();

        $usuario = new User($data);
        $usuario->contrasena = bcrypt($request->input('contrasena'));
        $usuario->idPersonaaa = $Personaaa->id;
        $usuario->save();

        $activacion = new ActivationCompanyUser();
        $activacion->user_id = $usuario->id;
        $activacion->state_id = 1;
        $activacion->idCompany = FacadesSession::get("idCompany");
        $activacion->fechaInicio = date('Y-m-d');
        $activacion->fechaFin = date('Y-m-d');
        $activacion->save();

        return response()->json($usuario, 201);
    }

    public function asignation(Request $request)
    {

        DB::table('model_has_roles')
            ->where('model_id', $request->idActivation)
            ->delete();
        $user = ActivationCompanyUser::find($request->input('idActivation'));
        $user->assignRole($request->input('roles', []));
        return $user;
    }
    // public function update(Request $request, int $id)
    // {
    //     $data = $request->all();
    //     $tipoTransaccion = TipoTransaccion::findOrFail($id);
    //     $tipoTransaccion->fill($data);
    //     $tipoTransaccion->save();

    //     return response()->json($tipoTransaccion);
    // }
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy(int $id)
    {
        ActivationCompanyUser::where('user_id', $id)->delete();
        $user = User::findOrFail($id);
        $idPersona = $user->idPersona;
        User::where('id', $id)->delete();
        Persona::where('id', $idPersona)->delete();

        return response()->json([], 204);
    }
}
