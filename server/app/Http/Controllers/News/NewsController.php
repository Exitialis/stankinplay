<?php

namespace App\Http\Controllers\News;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);

        return view('news.show', compact('news'));
    }
}
