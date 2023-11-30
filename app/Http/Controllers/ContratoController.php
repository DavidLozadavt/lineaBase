<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::all();
        return response() -> json($ciudades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contrato  $Contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $Contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contrato  $Contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $Contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contrato  $Contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contrato $Contrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contrato  $Contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $Contrato)
    {
        //
    }
}
