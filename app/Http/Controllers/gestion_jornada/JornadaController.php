<?php

namespace App\Http\Controllers\gestion_jornada;

use App\Http\Controllers\Controller;
use App\Models\Jornada;
use App\Http\Requests\StoreJornadaRequest;
use App\Http\Requests\UpdateJornadaRequest;
use Illuminate\Http\Request;

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
  public function index(Request $request)
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
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreJornadaRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreJornadaRequest $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Jornada  $jornada
   * @return \Illuminate\Http\Response
   */
  public function show(Jornada $jornada)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateJornadaRequest  $request
   * @param  \App\Models\Jornada  $jornada
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateJornadaRequest $request, Jornada $jornada)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Jornada  $jornada
   * @return \Illuminate\Http\Response
   */
  public function destroy(Jornada $jornada)
  {
    
  }
}
