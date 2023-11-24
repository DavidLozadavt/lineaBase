<?php

namespace App\Http\Controllers\gestion_pago;

use App\Http\Controllers\Controller;
use App\Models\TipoPago;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    $request->validate([
      'detalleTipoPago' => 'required|string|max:50',
    ]);

    $tipoPago = TipoPago::create($request->all());

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
    try {
      $tipoPago = TipoPago::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Tipo pago not found'], 404);
    }

    return response()->json($tipoPago);
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
      $request->validate([
        'detalleTipoPago' => 'required|string|max:50',
      ]);

      $tipoPago = TipoPago::findOrFail($id);
      $tipoPago->update($request->all());
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Tipo pago not found'], 404);
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
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Tipo pago not found'], 404);
    }

    return response()->json(null, 204);
  }

}
