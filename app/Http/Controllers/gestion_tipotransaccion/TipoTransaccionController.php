<?php

namespace App\Http\Controllers\gestion_tipotransaccion;

use App\Http\Controllers\Controller;
use App\Models\TipoTransaccion;
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
    $data = $request->all();
    $tipoTransaccion = new TipoTransaccion($data);
    $tipoTransaccion->save();

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
    $tipoTransaccion = TipoTransaccion::find($id);

    if(!$tipoTransaccion)
    {
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
      $data = $request->all();
      $tipoTransaccion = TipoTransaccion::findOrFail($id);
      $tipoTransaccion->fill($data);
      $tipoTransaccion->save();
    } catch (\Exception $e) {
      return response()->json(['Tipo transaccion no found or ' . $e]);
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
    } catch (\Exception $e) {
      return response()->json(['Tipo transaccion no found or ' . $e]);
    }

    return response()->json(['message' => 'Tipo transaccion delete successfully!!!'], 200);
  }
}
