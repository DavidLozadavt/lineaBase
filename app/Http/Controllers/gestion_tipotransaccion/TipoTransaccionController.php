<?php

namespace App\Http\Controllers\gestion_tipotransaccion;

use App\Http\Controllers\Controller;
use App\Models\TipoTransaccion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoTransaccionController extends Controller
{
  
  /**
   * Get all data tipo transaccion
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(): JsonResponse
  {
    $tipoTransacciones = TipoTransaccion::all();

    return response()->json($tipoTransacciones);
  }

  /**
   * Store data of tipo transaccion
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request): JsonResponse
  {
    $request->validate([
      'detalle' => 'required|string|max:50',
      'descripcion' => 'nullable'
    ]);

    $tipoTransaccion = TipoTransaccion::create($request->all());

    return response()->json($tipoTransaccion, 201);
  }

  /**
   * Get data tipo transaccion by id
   *
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function show(int $id): JsonResponse
  {
    try {
      $tipoTransaccion = TipoTransaccion::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Tipo transaccion not found'], 404);
    }

    return response()->json($tipoTransaccion);
  }

  /**
   * Update tipo transaccion by id
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, int $id): JsonResponse
  {
    try {
      $request->validate([
        'detalle' => 'required|string|max:50',
        'descripcion' => 'nullable'
      ]);

      $tipoTransaccion = TipoTransaccion::findOrFail($id);
      $tipoTransaccion->update($request->all());
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Tipo transaccion not found'], 404);
    }

    return response()->json($tipoTransaccion);
  }

  /**
   * Remove Tipo transaccion by id
   *
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(int $id): JsonResponse
  {
    try {
      $tipoTransaccion = TipoTransaccion::findOrFail($id);
      $tipoTransaccion->delete();
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Tipo transaccion not found'], 404);
    }

    return response()->json(null, 204);
  }

}
