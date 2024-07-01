<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::all();
        return response()->json([
            'data' => $pets,
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'especie' => 'required|string|max:20',
            'raza' => 'nullable|string|max:20',
            'sexo' => 'required|in:M,F',
            'fechaNacimiento' => 'required|date',
            'numeroAtenciones' => 'required|integer',
            'enTratamiento' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'code' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        $pet = Pet::create($request->all());

        return response()->json([
            'data' => $pet,
            'code' => 201,
            'message' => 'Mascota creada'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json([
                'data' => [],
                'code' => 404,
                'message' => 'Mascota no encontrada'
            ], 404);
        }
        return response()->json([
            'data' => $pet,
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json([
                'data' => [],
                'code' => 404,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'especie' => 'required|string|max:20',
            'raza' => 'nullable|string|max:20',
            'sexo' => 'required|in:M,F',
            'fechaNacimiento' => 'required|date',
            'numeroAtenciones' => 'required|integer',
            'enTratamiento' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'code' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        $pet->update($request->all());

        return response()->json([
            'data' => $pet,
            'code' => 200,
            'message' => 'Mascota actualizada'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json([
                'data' => [],
                'code' => 404,
                'message' => 'Mascota no encontrada'
            ], 404);
        }

        $pet->delete();

        return response()->json([
            'data' => [],
            'code' => 200,
            'message' => 'Mascota eliminada'
        ], 200);
    }
    
    public function filtrarPorEspecie($especie)
    {
        $pets = Pet::where('especie', $especie)->get();

        return response()->json([
            'data' => $pets,
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }
}
