<?php

namespace App\Http\Controllers\gestion_pago;

use App\Http\Controllers\Controller;
use App\Models\MedioPago;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MedioPagoController extends Controller
{

  

  /**
   * Get data of medios pay
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(): JsonResponse
  {
    $medioPagos = MedioPago::all();

    return response()->json($medioPagos);
  }

  /**
   * Store data of medios pay
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request): JsonResponse
  {
    $data = $request->all();
    $medioPago = new MedioPago($data);
    $medioPago->save();

    return response()->json($medioPago, 201);
  }

  /**
   * Get medios pay by id
   *
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function show(int $id): JsonResponse
  {

    $medioPago = MedioPago::find($id);

    if (!$medioPago) {
      return response()->json(['error' => 'Medio pago not found']);
    }

    return response()->json($medioPago, 200);
  }

  /**
   * Update data by id of medios pay
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, int $id): JsonResponse
  {

    try {
      $data = $request->all();
      $medioPago = MedioPago::findOrFail($id);
      $medioPago->fill($data);
      $medioPago->save();
    } catch (\Exception $e) {
      return response()->json(['error' => 'Medio pago not found or ' . $e]);
    }

    return response()->json($medioPago, 200);
  }

  /**
   * Remove the specified resource by id medios pay
   *
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(int $id): JsonResponse
  {

    try {
      $medioPago = MedioPago::findOrFail($id);
      $medioPago->delete();
    } catch (\Exception $e) {
      return response()->json(['error' => 'Medio pago not found or ' . $e]);
    }

    return response()->json(['message' => 'Medio pago delete successfully!!!'], 200);
  }
}
