<?php

namespace App\Http\Controllers\Api\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::paginate(10);

        return response()->json($groups);
    }

    public function lists(Request $request)
    {
        $groups = Group::where('name', 'LIKE', $request->input('q') . '%')
            ->limit(10)
            ->select('name as text', 'id')
            ->get()
            ->toArray();

        return response()->json($groups);
    }

}
