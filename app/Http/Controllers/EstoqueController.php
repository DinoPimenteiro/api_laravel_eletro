<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prod = Estoque::all();

        $count = $prod->count();

        if($count > 0){
            return response()->json([
                'success' => true,
                'message' => "Foram encontrados {$count} produtos",
                'data' => $prod,
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message' => "Falha ao encontrar dados.",
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'nomeprod' => 'required',
            'marcaprod' => 'required',
            'descprod' => 'required',
            'qtdprod' => 'required',
            'dtentradaprod' => 'required',
            'dtsaidaprod' => 'required',
        ]);

        if($data -> fails()){

            return response()->json([
                'success' => false,
                'message' => "Falha ao cadastrar dados.",
                'errors' => $data->errors()
            ], 400);

        }

        $createdProd = Estoque::create($request->all());

        if($createdProd){

            return response()->json([
                'success' => true,
                'message' => "Produto criado com sucesso.",
                'data' => $createdProd,
            ], 200);

        } else {
            return response()->json([
                'success' => false,
                'message' => "Falha ao cadastrar dados.",
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estoque $estoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estoque $estoque)
    {
        //
    }
}
