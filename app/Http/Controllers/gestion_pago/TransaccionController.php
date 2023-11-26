<?php

namespace App\Http\Controllers\gestion_pago;

use App\Http\Controllers\Controller;
use App\Models\Transaccion;
use App\Util\QueryUtil;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransaccionController extends Controller
{
  /**
   * Get data of transacciones
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(): JsonResponse
  {
    $transacciones = Transaccion::all();
    return response()->json($transacciones, 200);
  }

  /**
   * Store transaccion of Transaccion
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request): JsonResponse
  {
    try {
      $transaccion = Transaccion::create($request->all());
      return response()->json($transaccion, 201);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Get transaccion by id
   *
   * @param  \App\Models\Transaccion  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function show($id): JsonResponse
  {
    try {
      $transaccion = Transaccion::findOrFail($id);
      return response()->json($transaccion, 200);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Update data transaccion by id
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Transaccion  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, $id): JsonResponse
  {
    try
    {
      $transaccion = Transaccion::findOrFail($id);
      $transaccion->update($request->all());
      return response()->json($transaccion, 200);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Delete transaccion by id
   *
   * @param  \App\Models\Transaccion  $transaccion
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(Transaccion $transaccion): JsonResponse
  {
    try {
      $transaccion->delete();
      return response()->json(null, 204);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }
}
