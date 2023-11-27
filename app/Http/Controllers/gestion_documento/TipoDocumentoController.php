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
            ->where(function ($query) {
                QueryUtil::whereCompany($query);
            });
        $tipoDocumentos = QueryUtil::whereLike($tipoDocumentos, $data, 'tituloDocumento');
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
        $this->authorize('create', TipoDocumento::class);
        $data = $request->all();
        $tipoDocumentoData = QueryUtil::createWithCompany($data["tipoDocumento"]);
        $tipoDocumento = TipoDocumento::create($tipoDocumentoData);
        $idTipoDocumento = $tipoDocumento->id;
        $tipoDocumento = TipoDocumento::with($data['relations'] ?? $this->relations);
        return response()->json($tipoDocumento->find($idTipoDocumento, $data['columns'] ?? $this->columns), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,int $id)
    {
        $data = $request->all();

        $tipoDocumento = TipoDocumento::with($data['relations'] ?? $this->relations)
            ->where(function ($query) {
                QueryUtil::whereCompany($query);
            })->findOrFail($id,$data['columns'] ?? $this->columns);

        if (!$tipoDocumento) {
            return response()->json(['Tipo documento no encontrado'], 404);
        }
        return response()->json($tipoDocumento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {
        // $this->authorize('update', TipoDocumento::class);
        $data = $request->all();

        return response() -> json($id);
        // $tipoDocumento = TipoDocumento::with($data['relations'] ?? $this->relations)
        //     ->where(function ($query) {
        //         QueryUtil::whereCompany($query);
        //     })->find($id, $data['columns'] ?? $this->columns);

        // $tipoDocumentoData = QueryUtil::createWithCompany($data['tipoDocumento']);
        // $tipoDocumento->fill($tipoDocumentoData);
        // $tipoDocumento->save();

        // return response()->json($tipoDocumento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', TipoDocumento::class);
        $tipoDocumento = TipoDocumento::query()
            ->where(function ($query) {
                QueryUtil::whereCompany($query);
            })->findOrFail($id);
        $tipoDocumento->delete();

        return response()->json([], 204);
    }
}
