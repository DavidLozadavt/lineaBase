<?php

namespace App\Http\Controllers\gestion_pago;

use App\Http\Controllers\Controller;
use App\Models\TipoPago;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
  /**
   * Get data all of tipo pago
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(): JsonResponse
  {
    $tipoPagos = TipoPago::all();

    return response()->json($tipoPagos);
  }

  /**
   * Store data of tipo pago
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request): JsonResponse
  {
    $data = $request->all();
    $tipoPago = new TipoPago($data);
    $tipoPago->save();

    return response()->json($tipoPago, 201);
  }

  /**
   * Get data by id of tipo pago
   *
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function show(int $id): JsonResponse
  {
    $tipoPago = TipoPago::find($id);

    if (!$tipoPago) {
      return response()->json(['error' => 'Tipo pago not found'], 404);
    }

    return response()->json($tipoPago, 200);
  }

  /**
   * Update data tipo pago by id
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, int $id): JsonResponse
  {

    try {
      $data = $request->all();
      $tipoPago = TipoPago::findOrFail($id);
      $tipoPago->fill($data);
      $tipoPago->save();
    } catch (\Exception $e) {
      return response()->json(['Tipo pago not found or ' . $e]);
    }

    return response()->json($tipoPago);
  }

  /**
   * Remove data of tipo pago by id
   *
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(int $id): JsonResponse
  {
    try {
      $tipoPago = TipoPago::findOrFail($id);
      $tipoPago->delete();
    } catch (\Exception $e) {
      return response()->json(['Tipo pago not found or ' . $e]);
    }

    return response()->json(['message' => 'Tipo pago delete successfully!!!'], 200);

  }
}
