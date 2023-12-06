<?php

namespace App\Http\Controllers\gestion_proceso;

use App\Http\Controllers\Controller;
use App\Models\AsignacionProcesoTipoDocumento;
use App\Util\QueryUtil;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;

class AsignacionProcesoTipoDocumentoController extends Controller
{

    private array $relations;
    private array $columns;

    function __construct()
    {
        $this->relations = [];
        $this->columns = ['*'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        try {
            $dataEncoded = $request->input('data_encoded');
            $data = $dataEncoded ? json_decode($dataEncoded, true) : null;
            $procesoTipoDocumentos = AsignacionProcesoTipoDocumento::with($data['relations'] ?? $this->relations)
                ->whereHas('proceso', function ($query) {
                    QueryUtil::whereCompany($query);
                });
            $procesoTipoDocumentos = QueryUtil::where($procesoTipoDocumentos,$data,'idProceso');
            return response()->json($procesoTipoDocumentos->get($data['columns'] ?? $this->columns));
        } catch (QueryException $th) {
            QueryUtil::handleQueryException($th);
        } catch (Exception $th) {
            QueryUtil::showExceptions($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', AsignacionProcesoTipoDocumento::class);
        $data = $request->all();
        try {
            $tipoDocumentosId = [];
            foreach ($data['asignaciones'] as $key => $asignacion) {
                $new_asignacion = AsignacionProcesoTipoDocumento::create($asignacion);
                $tipoDocumentosId[] = $new_asignacion->id;
            }

            $asignaciones = AsignacionProcesoTipoDocumento::with($data['relations'] ?? $this->relations)
                ->whereIn('id', $tipoDocumentosId)
                ->get($data['columns'] ?? $this->columns);
            return response()->json($asignaciones, 201);
        } catch (QueryException $th) {
            QueryUtil::handleQueryException($th);
        } catch (Exception $th) {
            QueryUtil::showExceptions($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AsignacionProcesoTipoDocumento  $asignacionProcesoTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $data = $request->all();

        try {
            $procesoTipoDocumento = AsignacionProcesoTipoDocumento::with($data['relations'] ?? $this->relations)
                ->whereHas('proceso', function ($query) {
                    QueryUtil::whereCompany($query);
                })->findOrFail($id, $data['columns'] ?? $this->columns);
            return response()->json($procesoTipoDocumento);
        } catch (QueryException $th) {
            QueryUtil::handleQueryException($th);
        } catch (Exception $th) {
            QueryUtil::showExceptions($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AsignacionProcesoTipoDocumento  $asignacionProcesoTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $this->authorize('update', AsignacionProcesoTipoDocumento::class);
        $data = $request->all();

        try {
            $procesoTipoDocumento = AsignacionProcesoTipoDocumento::with($data['relations'] ?? $this->relations)
                ->whereHas('proceso', function ($query) {
                    QueryUtil::whereCompany($query);
                })->findOrFail($id, $data['columns'] ?? $this->columns);

            $procesoTipoDocumento->fill($data['asignacionProcesoTipoDocumento']);
            $procesoTipoDocumento->save();

            return response()->json($procesoTipoDocumento);
        } catch (QueryException $th) {
            QueryUtil::handleQueryException($th);
        } catch (Exception $th) {
            QueryUtil::showExceptions($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AsignacionProcesoTipoDocumento  $asignacionProcesoTipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', AsignacionProcesoTipoDocumento::class);

        try {
            $procesoTipoDocumento = AsignacionProcesoTipoDocumento::query()
                ->whereHas('proceso', function ($query) {
                    QueryUtil::whereCompany($query);
                })->findOrFail($id);
            $procesoTipoDocumento->delete();
            return response()->json(['message' => 'Eliminado correctamente'], 204);
        } catch (QueryException $th) {
            QueryUtil::handleQueryException($th);
        } catch (Exception $th) {
            QueryUtil::showExceptions($th);
        }
    }
}
