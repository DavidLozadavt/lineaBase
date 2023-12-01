<?php

namespace App\Http\Controllers\gestion_usuario;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getUsers()
    {
        $id = Session::get("idCompany");
        $user = ActivationCompanyUser::with('company', 'user', 'user.persona', 'roles', 'estado')
            ->where('idCompany', $id)
            ->get();

        return response()->json($user);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $person = new Persona($data);
        $person->rutaFoto = Persona::RUTA_FOTO_DEFAULT;
        $person->identificacion = $data['identificacion'];
        $person->save();

        $usuario = new User($data);
        $usuario->contrasena = bcrypt($request->input('contrasena'));
        $usuario->idPersona = $person->id;
        $usuario->save();

        $activacion = new ActivationCompanyUser();
        $activacion->idUser = $usuario->id;
        $activacion->state_id = 1;
        $activacion->idCompany = Session::get("idCompany");
        $activacion->fechaInicio = date('Y-m-d');
        $activacion->fechaFin = date('Y-m-d');
        $activacion->save();

        return response()->json($usuario, 201);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        ActivationCompanyUser::where('idUser', $id)->delete();
        $user = User::findOrFail($id);
        $idPersona = $user->idPersona;
        User::where('id', $id)->delete();
        Persona::where('id', $idPersona)->delete();

        return response()->json([], 204);
    }
}
