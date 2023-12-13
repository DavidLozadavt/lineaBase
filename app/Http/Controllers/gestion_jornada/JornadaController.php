<?php

namespace App\Http\Controllers\gestion_jornada;

use App\Http\Controllers\Controller;
use App\Models\Jornada;
use App\Models\AsignacionDiaJornada;
use App\Util\KeyUtil;
use App\Util\QueryUtil;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JornadaController extends Controller
{

  private array $relations;
  private array $columns;

  function __construct()
  {
    $this->relations = [];
    $this->columns = ["*"];
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request): JsonResponse
  {
    $jsonData = $request->input('data');

    $data = json_decode($jsonData, true);

    if (isset($data['nombreJornada']) && !empty($data['nombreJornada'])) {
      $jornadas = Jornada::where('nombreJornada', 'like', '%' . $data['nombreJornada'] . '%');
    } else {
      $jornadas = Jornada::query();
    }

    $jornadas->with($data['relations'] ?? $this->relations);

    $result = $jornadas->get($data['columns'] ?? $this->columns);

    return response()->json($result, 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Jornada  $jornada
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, Jornada $jornada): JsonResponse
  {
    try {
      $data = json_decode($request->input('data'), true);

      $columns = $data['columns'] ?? $this->columns;
      $relations = $data['relations'] ?? $this->relations;

      $transaccion = Jornada::with($relations)
        ->findOrFail($jornada->id, $columns);

      return response()->json($transaccion);
    } catch (QueryException $th) {
      QueryUtil::handleQueryException($th);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Create jornada
   *
   * @param  \App\Http\Requests\StoreJornadaRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request): JsonResponse
  {
    try {
      request()->validate(Jornada::$rules);

      $data = $request->all();

      DB::beginTransaction();

      $jornada = Jornada::create([
        'nombreJornada' => $data['nombreJornada'],
        'descripcion'   => $data['descripcion'],
        'horaInicial'   => $data['horaInicial'],
        'horaFinal'     => $data['horaFinal'],
        'numeroHoras'   => $data['numeroHoras'],
        'idCompany'     => KeyUtil::idCompany(),
      ]);

      $jornada->dias()->attach($data['dias']);

      DB::commit();

      return response()->json($jornada, 201);
    } catch (QueryException $e) {
      DB::rollBack();
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateJornadaRequest  $request
   * @param  \App\Models\Jornada  $jornada
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Jornada $jornada): JsonResponse
  {
    try {
      request()->validate(Jornada::$rules);

      $data = $request->all();

      DB::beginTransaction();

      $jornada = Jornada::findOrFail($jornada->id);

      $jornada->update([
        'nombreJornada' => $data['nombreJornada'],
        'descripcion' => $data['descripcion'],
        'horaInicial' => $data['horaInicial'],
        'horaFinal' => $data['horaFinal'],
        'numeroHoras' => $data['numeroHoras'],
        'idCompany' => KeyUtil::idCompany(),
      ]);

      $jornada->dias()->sync($data['dias']);

      DB::commit();

      return response()->json($jornada, 200);
    } catch (QueryException $e) {
      DB::rollBack();
      return QueryUtil::showExceptions($e);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Jornada  $jornada
   * @return \Illuminate\Http\Response
   */
  public function destroy(Jornada $jornada): JsonResponse
  {
    $newjornada = Jornada::findOrFail($jornada->id);
    $newjornada->delete();
    return response()->json(null, 204);
  }
}
