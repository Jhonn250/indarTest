<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use Validator;

class StatusController extends Controller
{
    public function index()
    {
        $status = Status::all();
        $data = [
            'tasks' => $status,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }
}
