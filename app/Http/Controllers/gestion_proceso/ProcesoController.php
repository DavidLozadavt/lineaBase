<?php

namespace App\Http\Controllers\gestion_proceso;

use App\Http\Controllers\Controller;
use App\Models\Proceso;
use App\Util\QueryUtil;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;

class ProcesoController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // var_dump(Session::get('idCompany'));
        try {

            $dataEncoded = $request->input('data_encoded');
            $data = $dataEncoded ? json_decode($dataEncoded, true) : null;
            $procesos = Proceso::with($data['relations'] ?? $this->relations)
                ->where(function ($query) {
                    QueryUtil::whereCompany($query);
                });

            $procesos = QueryUtil::whereLike($procesos, $data, 'nombreProceso');
            return response()->json($procesos->get($data['columns'] ?? $this->columns));
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
        // $this->authorize('create', Proceso::class);
        $data = $request->all();
        // var_dump($data);
        try {
            $procesos_id = [];
            foreach ($data['procesos'] as $key => $proceso) {
                $procesoData = QueryUtil::createWithCompany($proceso);
                $new_proceso = Proceso::create($procesoData);
                $procesos_id[] = $new_proceso->id;
            }
            $procesos = Proceso::with($data['relations'] ?? $this->relations)
                ->whereIn('id', $procesos_id)
                ->get($data['columns'] ?? $this->columns);
            return response()->json($procesos, 201);
        } catch (QueryException $th) {
            QueryUtil::handleQueryException($th);
        } catch (Exception $th) {
            QueryUtil::showExceptions($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {

        try {

            $dataEncoded = $request->input('data_encoded');
            $data = $dataEncoded ? json_decode($dataEncoded, true) : null;
            $proceso = Proceso::with($data['relations'] ?? $this->relations)
                ->where(function ($query) {
                    QueryUtil::whereCompany($query);
                })->findOrFail($id, $data['columns'] ?? $this->columns);
            return response()->json($proceso);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // $this->authorize('update', Proceso::class);
        $data = $request->all();

        try {
            $proceso = Proceso::with($data['relations'] ?? $this->relations)
                ->where(function ($query) {
                    QueryUtil::whereCompany($query);
                })->findOrFail($id, $data['columns'] ?? $this->columns);

            $procesoData = QueryUtil::createWithCompany($data['proceso']);
            $proceso->fill($procesoData);
            $proceso->save();

            return response()->json($proceso);
        } catch (QueryException $th) {
            QueryUtil::handleQueryException($th);
        } catch (Exception $th) {
            QueryUtil::showExceptions($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        // $this->authorize('delete', Proceso::class);

        try {
            $proceso = Proceso::query()
                ->where(function ($query) {
                    QueryUtil::whereCompany($query);
                })->findOrFail($id);
            $proceso->delete();
            return response()->json(['message' => 'Eliminado correctamente'], 204);
        } catch (QueryException $th) {
            QueryUtil::handleQueryException($th);
        } catch (Exception $th) {
            QueryUtil::showExceptions($th);
        }
    }
}
