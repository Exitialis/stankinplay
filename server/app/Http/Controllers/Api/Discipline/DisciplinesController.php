<?php

namespace App\Http\Controllers\Api\Discipline;

use App\Models\Discipline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisciplinesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('fields')) {
            $fields = $request->input('fields');

            $disciplines = Discipline::select($fields)->get();

            return response()->json(compact('disciplines'));
        }

        return response()->json(Discipline::get());
    }

    public function lists(Request $request)
    {
        $groups = Discipline::where('name', 'LIKE', $request->input('name') . '%')
            ->limit(10)
            ->select('name as text', 'id')
            ->get()
            ->toArray();

        return response()->json($groups);
    }
}
