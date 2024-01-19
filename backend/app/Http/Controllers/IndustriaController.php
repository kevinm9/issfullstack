<?php

namespace App\Http\Controllers;

use App\Models\Industria;
use Illuminate\Http\Request;

class IndustriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Industrias = Industria::all();
        return response()->json($Industrias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Industria $industria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Industria $industria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Industria $industria)
    {
        //
    }
}
