<?php

namespace App\Http\Controllers\gestion_documento;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use App\Util\QueryUtil;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
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
        $data = $request->all();
        $tipoDocumentos = TipoDocumento::with($data['relations'] ?? $this->relations)
        ->where(function($query){
            QueryUtil::whereCompany($query);
        });
        if (isset($data['tituloDocumento'])) {
            $tipoDocumentos->where('tituloDocumento', 'like', '%' . $data['tituloDocumento'] . '%');
        }
        return response()->json($tipoDocumentos->get($data['columns'] ?? $this->columns));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',TipoDocumento::class);
        $data = $request->all();
        $tipoDocumentoData = QueryUtil::createWithCompany($data['tipoDocumento']);
        $tipoDocumento = TipoDocumento::create($tipoDocumentoData);
        $tipoDocumento->save();
        $idTipoDocumento = $tipoDocumento->id;
        $tipoDocumento = TipoDocumento::with($data['relations'] ?? $this->relations);
        return response()->json($tipoDocumento -> find($idTipoDocumento,$data['columns'] ?? $this->columns), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $tipoDocumento = TipoDocumento::find($id);

        return response()->json($tipoDocumento);
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
        $data = $request->all();
        $tipoDocumento = TipoDocumento::findOrFail($id);
        $tipoDocumento->fill($data);
        $tipoDocumento->save();

        return response()->json($tipoDocumento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $tipoDocumento = TipoDocumento::findOrFail($id);
        $tipoDocumento->delete();

        return response()->json([], 204);
    }
}
