<?php

namespace App\Http\Controllers\Api\News;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function lists()
    {
        return response()->json(News::paginate(10));
    }
}
