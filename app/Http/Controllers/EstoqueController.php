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
        $prod = Estoque::find($id);
        
        if($prod){

            return response()->json([
                'success' => true,
                'message' => "Produto achado com sucesso.",
                'data' => $prod,
            ], 200);

        } else {
            return response()->json([
                'success' => false,
                'message' => "Produto não encontrado.",
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        $prod = Estoque::find($id);

        if(!$prod){
            return response()->json([
                'success' => false,
                'message' => "Produto não encontrado.",
            ], 404);
        }

        $prod-> nomeprod = $request->nomeprod;
        $prod-> marcaprod = $request->marcaprod;
        $prod-> descprod = $request->descprod;
        $prod-> qtdprod = $request->qtdprod;
        $prod-> dtentradaprod = $request->dtentradaprod;
        $prod-> dtsaidaprod = $request->dtsaidaprod;

        if($prod->save()){
            return response()->json([
                'success' => true,
                'message' => "Produto editado.",
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Produto não editado.",
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $prod = Estoque::find($id);
        
        if(!$prod){

            return response()->json([
                'success' => false,
                'message' => "Produto não encontrado.",
            ], 404);

        }

        if($prod -> delete()){

            return response()->json([
                'success' => true,
                'message' => "Produto deletado.",
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message' => "Não foipossível deletar o produto.",
            ], 500);
        }
    }
}
