<?php

namespace App\Http\Controllers\gestion_usuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Util\QueryUtil;
use Exception;
use Illuminate\Http\JsonResponse;

class PersonaController extends Controller
{

  public function index(): JsonResponse
  {
    $people = Persona::all();
    return response()->json($people, 200);
  }

  public function show($id): JsonResponse
  {
    $person = Persona::findOrFail($id);

    return response()->json($person, 200);
  }

  public function store(Request $request): JsonResponse
  {
    $person = Persona::create($request->all());
    return response()->json($person, 201);
  }

  public function update(Request $request, $id): JsonResponse
  {
    $person = Persona::findOrFail($id);

    $person->update($request->all());

    return response()->json($person, 200);
  }

  public function destroy($id): JsonResponse
  {
    try {
      $personId = Persona::findOrFail($id);
      $personId->delete();
      return response()->json(null, 204);
    } catch (Exception $e) {
      return QueryUtil::showExceptions($e);
    }
  }
}
