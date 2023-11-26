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
    $data = $request->all();
    $transacciones = Transaccion::with($data['relations'] ?? $this->relations)
      ->where( function($query) {
        QueryUtil::whereCompany($query);
      });
    
    if(isset($data['numFacturaInicial'])) {
      $transacciones->where('numFacturaInicial', 'like', '%' . $data['numFacturaInicial'] . '%');
    }
    return response()->json($transacciones->get($data['columns'] ?? $this->columns), 200);
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
    try {
      request()->validate(Transaccion::$rules);
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
