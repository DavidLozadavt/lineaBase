<?php

namespace App\Http\Controllers\gestion_pago;

use App\Http\Controllers\Controller;
use App\Models\Transaccion;
use App\Util\QueryUtil;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransaccionController extends Controller
{

  private array $relations;
  private array $columns;

  function __construct()
  {
    $this->relations = [];
    $this->columns = ['*'];
  }

  /**
   * Get data of transacciones
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index(Request $request): JsonResponse
  {

    $jsonData = $request->input('data');

    $data = json_decode($jsonData, true);

    if (isset($data['numFacturaInicial']) && !empty($data['numFacturaInicial'])) {
      $transacciones = Transaccion::where('numFacturaInicial', 'like', '%' . $data['numFacturaInicial'] . '%');
    } else {
      $transacciones = Transaccion::query();
    }

    $transacciones->with($data['relations'] ?? $this->relations);

    $result = $transacciones->get($data['columns'] ?? $this->columns);

    return response()->json($result, 200);
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
      request()->validate(Transaccion::$rules);
      $transaccion = Transaccion::create($request->all());
      $idTransaccion = $transaccion->id;
      $transaccion = Transaccion::with($request['relations'] ?? $this->relations);
      return response()->json($transaccion->find($idTransaccion, $request['columns'] ?? $this->columns), 201);
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
  public function show(Request $request, int $id): JsonResponse
  {
    try {
      $data = json_decode($request->input('data'), true);

      $columns = $data['columns'] ?? $this->columns;
      $relations = $data['relations'] ?? $this->relations;

      $transaccion = Transaccion::with($relations)
        ->findOrFail($id, $columns);

      return response()->json($transaccion);
    } catch (QueryException $th) {
      QueryUtil::handleQueryException($th);
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
    try {
      $request->validate(Transaccion::$rules);

      $transaccion = Transaccion::findOrFail($id);
      $transaccion->update($request->all());

      $updatedTransaccion = Transaccion::with($request['relations'] ?? $this->relations)
        ->find($id, $request['columns'] ?? $this->columns);

      return response()->json($updatedTransaccion, 200);
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
  public function destroy($id): JsonResponse
  {
    try {
      $transaccion = Transaccion::findOrFail($id);
      $transaccion->delete();
      return response()->json(null, 204);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }
}
