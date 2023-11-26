<?php

namespace App\Http\Controllers\gestion_pago;

use App\Http\Controllers\Controller;
use App\Models\MedioPago;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    $this->authorize('create', MedioPago::class);
    $request->validate([
      'detalleMedioPago' => 'required|string|max:50',
    ]);

    $tipoPago = MedioPago::create($request->all());

    return response()->json($tipoPago, 201);
  }

  /**
   * Get medios pay by id
   *
   * @param  int $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function show(int $id): JsonResponse
  {
    try {
      $medioPago = MedioPago::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Medio pago not found'], 404);
    }

    return response()->json($medioPago);
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
      $request->validate([
        'detalleMedioPago' => 'required|string|max:50',
      ]);

      $medioPago = MedioPago::findOrFail($id);
      $medioPago->update($request->all());
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Tipo pago not found'], 404);
    }

    return response()->json($medioPago);
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
    } catch (ModelNotFoundException $e) {
      return response()->json(['error' => 'Medio pago not found'], 404);
    }

    return response()->json(null, 204);
  }
}
