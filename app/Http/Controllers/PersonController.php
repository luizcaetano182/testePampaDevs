<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use DB;

class PersonController extends Controller
{
        
    public function index()
    {
        try{
            $query = Person::with('planet','starships');
            return $query = $query->orderBy('id', 'ASC')->paginate(10);
        } catch (\Exception $e) {
            Log::error('Erro ao exibir a dados de pessoas. ' . $e->getMessage());
            return 'Erro ao exibir a dados de pessoas.' . $e->getMessage();
        }
    }

    public function get($id)
    {
        try
        {
            $retorno = Person::where('id',$id)->with('planet','starships')->first();
            if($retorno == null){
                return 'Registro não encontrado';
            }
            return $retorno;
          
        } catch (\Exception $e) {
            Log::error('Erro ao exibir a pessoa. ' . $e->getMessage());
            return 'Erro ao exibir a pessoa.' . $e->getMessage();
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
            $person = Person::where('id', $id)->first();
            $person->update($req->all());    
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
            'person' => $person->id
        ]);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $person = Person::findOrFail($id);
            $person->delete();
            DB::commit();
            return 'Pessoa deletada com sucesso';
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao deletar a pessoa. ' . $e->getMessage());
            return 'Erro ao deletar a pessoa.' . $e->getMessage();
        }
    }
}

