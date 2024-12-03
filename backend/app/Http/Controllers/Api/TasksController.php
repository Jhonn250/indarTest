<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;
use Validator;


class TasksController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $metaID = $request->input('metaID', '');
        $perPage = $request->input('per_page', 10);
        
        $tasks = Tasks::with('status')  // Precargamos la relación con la tabla Status
            ->when($search, function ($query, $search) {
                return $query->where('TaskID', 'LIKE', "%{$search}%")
                             ->orWhere('TaskDetails', 'LIKE', "%{$search}%");
            })
            ->when($metaID, function ($query, $metaID) {
                return $query->where('Task_MetaID', $metaID);
            })
            ->paginate($perPage);
    
        $data = [
            'tasks' => $tasks->items(),
            'pagination' => [
                'current_page' => $tasks->currentPage(),
                'per_page' => $tasks->perPage(),
                'total' => $tasks->total(),
                'last_page' => $tasks->lastPage(),
            ],
            'status' => 200,
        ];
    
        return response()->json($data, 200);
    }
    

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'Task_MetaID' => 'required',
            'TaskDetails' => 'required|max:80',
            'Task_StatusID' => 'required',
        ]);

        if ($validator ->fails()){
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ];
            return response()->json($data, 400);
        }
        $tasks = Tasks::create([
            'TaskDetails' => $request->TaskDetails,
            'CreatedAt' => now(),
            'Task_StatusID' => $request->Task_StatusID,
            'Task_MetaID' => $request->Task_MetaID,
        ]);

        if(!$tasks){
            $data = [
                'message' => 'Error al crear task',
                'status' => 500,
            ];
        }
        $data = [
            'tasks' => $tasks,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function show($id){

    $tasks = Tasks::find($id);

        if(!$tasks){
            $data = [
                'message' => 'Task no encontrada',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }
        $data = [
            'tasks' => $tasks,
            'status' => 200,
        ];


        return response()->json($data, 200);
    }
    public function destroy($id){

        $tasks = Tasks::find($id);
    
            if(!$tasks){
                $data = [
                    'message' => 'Task no encontrada',
                    'status' => 404,
                ];
                return response()->json($data, 404);
            }
        $tasks->delete();
        $data = [
            'tasks'=> 'Task eliminada',
            'status' => 200,
        ];
    
            return response()->json($data, 200);
        }

        public function update($id, Request $request){
            $tasks = Tasks::find($id);
            if(!$tasks){
                $data = [
                    'message'=> 'Task no encontrada',
                    'status'=> 404,
                ];
                return response()->json($data, 404);
            }
            $validator = Validator::make($request->all(), [
                'TaskDetails' => 'required|max:80',
                'Task_StatusID' => 'required',
            ]);

            if($validator ->fails()){
                $data = [
                    'message' => 'Error en la validacion de los datos',
                    'errors' => $validator->errors(),
                    'status' => 400,
                ];
                return response()->json($data, 400);
            }
            $tasks->TaskDetails = $request->TaskDetails;
            $tasks->Task_StatusID = $request->Task_StatusID;
            $tasks->save();
            $data = [
                'message'=> 'Task actualizada',
                'meta' => $tasks,
                'status' => 200,
            ];
            return response()->json($data, 200);
        }
}
