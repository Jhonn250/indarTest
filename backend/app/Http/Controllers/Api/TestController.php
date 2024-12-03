<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    //
    public function index(){
        $metas = Test::all();

        if ($metas -> isEmpty()) {
            $data = [
                'message' => 'No hay',
                'status' => 200,
            ];
            return response()->json($data);
        }

        $data = [
            'metas' => $metas,
            'status'=> 200,
        ];
        return response()->json($data, 200);
    }
}