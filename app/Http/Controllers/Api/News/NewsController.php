<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Requests\Api\News\CreateRequest;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Получить пагинированный список новостей.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists()
    {
        return response()->json(News::paginate(10));
    }

    /**
     * Получить определенную новость по id.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id, Request $request)
    {
        $news = News::find($id);

        if ( ! $news) {
            abort(404, 'Новость с данным идентификатором не найдена');
        }

        return response()->json($news);
    }

    public function create(CreateRequest $request)
    {
        dd($request);
    }
}
