<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planet;
use App\Http\Controllers\PlanetController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use DB;

class PlanetController extends Controller
{
    public function index()
    {
        try{
            $query = Planet::query();
            return $query = $query->orderBy('id', 'ASC')->paginate(10);
        } catch (\Exception $e) {
            Log::error('Erro ao exibir a dados dos planetas. ' . $e->getMessage());
            return 'Erro ao exibir a dados dos planetas.' . $e->getMessage();
        }
    }

    public function get($id)
    {
        try
        {
            $query = Planet::findOrFail($id)->first();
            if($query == null){
                return 'Registro não encontrado';
            }
            return $query;
        } catch (\Exception $e) {
            Log::error('Erro ao exibir o planeta. ' . $e->getMessage());
            return 'Erro ao exibir a planeta.' . $e->getMessage();
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
            $planet = Planet::where('id', $id)->first();
            $planet->update($req->all());    
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
            'Planet' => $planet->id
        ]);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $planet = Planet::findOrFail($id);
            $planet->delete();
            DB::commit();
            return 'Planeta deletado com sucesso';
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar o planeta. ' . $e->getMessage());
            return 'Erro ao deletar o planeta.' . $e->getMessage();
        }
    }
}
