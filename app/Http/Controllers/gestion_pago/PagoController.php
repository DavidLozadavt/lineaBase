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

  private array $relations;
  private array $columns;

  function __construct()
  {
    $this->relations = [];
    $this->columns = ["*"];
  }

  /**
   * Get all pays
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(Request $request): JsonResponse
  {
    $jsonData = $request->input('data');

    $data = json_decode($jsonData, true);

    if (isset($data['numeroFact']) && !empty($data['numeroFact'])) {
      $pagos = Pago::where('numeroFact', 'like', '%' . $data['numeroFact'] . '%');
    } else {
      $pagos = Pago::query();
    }

    $pagos->with($data['relations'] ?? $this->relations);

    $result = $pagos->get($data['columns'] ?? $this->columns);

    return response()->json($result, 200);
  }

  /**
   * Store data of pago
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request): JsonResponse
  {
    try {
      request()->validate(Pago::$rules);
      $pago = Pago::create($request->all());
      $idPago = $pago->id;
      $pago = Pago::with($request['relations'] ?? $this->relations);
      return response()->json($pago->find($idPago, $request['columns'] ?? $this->columns), 201);
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
  public function show(Request $request, $id): JsonResponse
  {
    try {
      $pago = Pago::findOrFail($id);

      $jsonData = $request->input('data');

      $data = json_decode($jsonData, true);

      if (isset($data['numeroFact']) && !empty($data['numeroFact'])) {
        $pago = Pago::where('numeroFact', 'like', '%' . $data['numeroFact'] . '%');
      } else {
        $pago = Pago::query();
      }

      $pago->with($data['relations'] ?? $this->relations);

      $result = $pago->get($data['columns'] ?? $this->columns);

      return response()->json($result, 200);
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
      request()->validate(Pago::$rules);

      $pago = Pago::findOrFail($id);

      $pago->update($request->all());

      $pago = Pago::with($request['relations'] ?? $this->relations);
      return response()->json($pago->find($id, $request['columns'] ?? $this->columns), 200);

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
