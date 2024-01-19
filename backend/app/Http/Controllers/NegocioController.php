<?php

namespace App\Http\Controllers;

use App\Http\Requests\NegocioPostRequest;
use App\Models\Negocio;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;



class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Negocios = Negocio::with('industria')->get();
        return response()->json($Negocios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NegocioPostRequest $request)
    {
        $Negocio = Negocio::create($request->validated());
        return response()->json($Negocio, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Negocio $negocio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Negocio $negocio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Negocio $negocio)
    {
        //
    }
}
