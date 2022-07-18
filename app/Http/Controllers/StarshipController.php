<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Starship;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StarshipController extends Controller
{
    public function index()
    {
        try{
            $query = Starship::query();
            return $query = $query->orderBy('id', 'ASC')->paginate(10);
        } catch (\Exception $e) {
            Log::error('Erro ao exibir a dados dos Starshipsas. ' . $e->getMessage());
            return 'Erro ao exibir a dados dos Starshipsas.' . $e->getMessage();
        }
    }

    public function get($id)
    {
        try
        {
            $query = Starship::findOrFail($id)->first();
            if($query == null){
                return 'Registro não encontrado';
            }
            return $query;
        } catch (\Exception $e) {
            Log::error('Erro ao exibir o Starship. ' . $e->getMessage());
            return 'Erro ao exibir a Starship.' . $e->getMessage();
        }
    }

    public function store(Request $req)
    {
        
    }

    public function update(Request $req, $id)
    {
        try {
            $validate = [
               'name'=> 'required'
            ];
            $validator = Validator::make($req->all(), $validate);
            if ($validator->fails()) {
               return  response()->json([
                    'error' => true,
                    'message' => $validator->errors()->messages()
                ]);
            };
            $starships = Starship::where('id', $id)->first();
            $starships->update($req->all());    
        } catch (\Exception $e) {
            Log::error('Houve um erro efetuar a atualização: ' . $e->getMessage());
            return  response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
        return  
        response()->json([
            'error' => false,
            'Starships' => $starships->id
        ]);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $starships = Starship::findOrFail($id);
            $starships->delete();
            DB::commit();
            return 'Starship deletado com sucesso';
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar o Starship. ' . $e->getMessage());
            return 'Erro ao deletar o Starships.' . $e->getMessage();
        }
    }
}
