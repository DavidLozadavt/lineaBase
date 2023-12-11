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

  private $relations;

  public function __construct()
  {
    $this->relations = [];
  }

  /**
   * Get all people
   *
   * @return JsonResponse
   */
  public function index(): JsonResponse
  {
    $people = Persona::all();
    return response()->json($people, 200);
  }

  /**
   * Get person by id
   *
   * @param int $id
   * @return JsonResponse
   */
  public function show($id): JsonResponse
  {
    $person = Persona::findOrFail($id);

    return response()->json($person, 200);
  }

  /**
   * Storage person
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function store(Request $request): JsonResponse
  {
    $data = $request->all();
    $person = new Persona($data);
    $person->rutaFoto = Persona::RUTA_FOTO_DEFAULT;
    $person->identificacion = $data['identificacion'];
    $person->save();
    return response()->json($person, 201);
  }

  /**
   * Update person by id
   *
   * @param Request $request
   * @param int $id
   * @return JsonResponse
   */
  public function update(Request $request, $id): JsonResponse
  {
    $person = Persona::findOrFail($id);

    $data = $request->all();

    // Asegúrate de que la fecha esté en formato ISO 8601 antes de actualizar
    if (isset($data['fechaNac']) && !empty($data['fechaNac'])) {
      // Convierte la fecha a un objeto DateTime en caso de que sea una cadena
      $data['fechaNac'] = is_string($data['fechaNac']) ? new \DateTime($data['fechaNac']) : $data['fechaNac'];
    }

    $person->update($data);

    if ($user = $person->usuario) {
      $user->update(['email' => $data['email']]);
    }

    return response()->json($person, 200);
  }

  /**
   * Delete person by id
   *
   * @param int $id
   * @return JsonResponse
   */
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
