<?php

namespace App\Http\Controllers\gestion_usuario;

use App\Http\Controllers\Controller;
use App\Models\ActivationCompanyUser;
use App\Models\Persona;
use App\Models\User;
use App\Util\KeyUtil;
use App\Util\QueryUtil;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $id = KeyUtil::idCompany();
    $user = ActivationCompanyUser::with('company', 'user', 'user.persona', 'roles', 'estado')
      ->where('idCompany', $id)
      ->get();

    return response()->json($user, 200);
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
    $activacion->idEstado = 1;
    $activacion->idCompany = KeyUtil::idCompany();
    $activacion->fechaInicio = date('Y-m-d');
    $activacion->fechaFin = date('Y-m-d');
    $activacion->save();

    return response()->json($usuario, 201);
  }

  /**
   * Update user
   *
   * @param Request $request
   * @param int $id
   * @return void
   */
  public function update(Request $request, $id)
  {

    $person = Persona::findOrFail($id);

    $person->update($request->all());

    return response()->json($person, 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(int $id)
  {
    try {
      ActivationCompanyUser::where('idUser', $id)->delete();
      $user = User::findOrFail($id);
      $idPersona = $user->idPersona;
      User::where('id', $id)->delete();
      Persona::where('id', $idPersona)->delete();

      return response()->json([], 204);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }
}
