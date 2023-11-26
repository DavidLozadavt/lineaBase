<?php

namespace App\Http\Controllers\gestion_pago;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Util\QueryUtil;

class PagoController extends Controller
{
  /**
   * Get all pays
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(): JsonResponse
  {
    $pagos = Pago::all();
    return response()->json($pagos, 200);
  }

  /**
   * Store data of pago
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request): JsonResponse
  {
    try
    {
      $pago = Pago::create($request->all());
      return response()->json($pago);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Get pago by id
   *
   * @param  \App\Models\Pago  $pago
   * @return \Illuminate\Http\JsonResponse
   */
  public function show($id): JsonResponse
  {
    try
    {
      $pago = Pago::findOrFail($id);
      return response()->json($pago, 200);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Update data of pago.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Pago  $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, $id): JsonResponse
  {
    try {
      // $request->validate([
      //   'detalleTipoPago' => 'required|string|max:50',
      // ]);
      $pago = Pago::findOrFail($id);
      $pago->update($request->all());
      return response()->json($pago, 200);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Delete pay by id
   *
   * @param  \App\Models\Pago  $pago
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy($id): JsonResponse
  {
    try {
      $pago = Pago::findOrFail($id);
      $pago->delete();
      return response()->json(null, 204);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }
}
