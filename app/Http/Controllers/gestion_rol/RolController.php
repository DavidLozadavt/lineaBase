<?php

namespace App\Http\Controllers\gestion_rol;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Util\KeyUtil;
use App\Util\QueryUtil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RolController extends Controller
{
  public function __construct()
  {
  }

  /**
   * Display a listing of the resource.
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $nombre = $request->input('name');
    $idCompany = KeyUtil::idCompany(); //$request->input('idCompany');

    $roles = Rol::with("company");

    if ($nombre) {
      $roles->where('name', '=', $nombre);
    }

    if ($idCompany) {
      $roles->whereHas('company', function ($q) use ($idCompany) {
        $q->where('id', '=', $idCompany);
      });
    }

    return response()->json($roles->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      $data = $request->all();

      $rol = Rol::create([
        'name' => $data['name'],
        'idCompany' => KeyUtil::idCompany(),

      ]);

      return response()->json($rol, 201);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show(int $id)
  {
    $rol = Rol::find($id);

    return response()->json($rol);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, int $id)
  {
    try {
      $data = $request->all();

      $rol = Rol::findOrFail($id);

      $rol->update([
        'name' => $data['name'],
        'idCompany' => KeyUtil::idCompany(),
      ]);
      return response()->json($rol, 200);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
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
      $rol = Rol::findOrFail($id);
      $rol->delete();

      return response()->json(null, 204);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }
}
