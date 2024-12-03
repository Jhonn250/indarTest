<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Metas;
use Validator;

class MetasController extends Controller
{
    public function index()
    {
        // Obtén todas las metas
        $metas = Metas::all();

        // Si no hay metas, devuelve un mensaje con el estado 200
        if ($metas->isEmpty()) {
            return response()->json([
                'message' => 'No hay',
                'status' => 200,
            ]);
        }

        // Construye la respuesta
        $data = [
            'metas' => $metas,
            'status' => 200,
        ];

        // Devuelve los datos en formato JSON
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'MetaDetails' => 'required',
        ]);

        if ($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            return response()->json($data, 400);
        }
        $metas = Metas::create([
            'MetaDetails' => $request->MetaDetails,
            'CreatedAt' => now(),
        ]);

        if(!$metas){
            $data = [
                'message' => 'Error al crear meta',
                'status' => 500,
            ];
        }
        $data = [
            'metas' => $metas,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function show($id){

    $meta = Metas::find($id);

        if(!$meta){
            $data = [
                'message' => 'Meta no encontrada',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }
        $data = [
            'metas' => $meta,
            'status' => 200,
        ];


        return response()->json($data, 200);
    }
    public function destroy($id){

        $meta = Metas::find($id);
    
            if(!$meta){
                $data = [
                    'message' => 'Meta no encontrada',
                    'status' => 404,
                ];
                return response()->json($data, 404);
            }
        $meta->delete();
        $data = [
            'message'=> 'Meta eliminada',
            'status' => 200,
        ];
    
            return response()->json($data, 200);
        }

        public function update($id, Request $request){
            $meta = Metas::find($id);
            if(!$meta){
                $data = [
                    'message'=> 'Meta no encontrada',
                    'status'=> 404,
                ];
                return response()->json($data, 404);
            }
            $validator = Validator::make($request->all(), [
                'MetaDetails' => 'required|max:80',
            ]);

            if($validator ->fails()){
                $data = [
                    'message' => 'Error en la validacion de los datos',
                    'errors' => $validator->errors(),
                    'status' => 400,
                ];
                return response()->json($data, 400);
            }
            $meta->MetaDetails = $request->MetaDetails;
            $meta->save();
            $data = [
                'message'=> 'Meta actualizada',
                'meta' => $meta,
                'status' => 200,
            ];
            return response()->json($data, 200);
        }

}