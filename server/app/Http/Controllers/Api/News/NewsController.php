<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Requests\Api\News\CreateRequest;
use App\Http\Requests\Api\News\UpdateRequest;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;

class NewsController extends Controller
{
    /**
     * Получить пагинированный список новостей.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists()
    {
        return response()->json(News::with('user')->paginate(10));
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
        $news = News::with('user')->find($id);

        if ( ! $news) {
            abort(404, 'Новость с данным идентификатором не найдена');
        }

        return response()->json($news);
    }

    /**
     * Создание новости.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = auth('api')->user()->id;

        $input['image'] = $this->saveImage($request->file('image'));

        News::create($input);

        $flash = flash('Новость успешно создана');

        return response()->json($flash);
    }

    /**
     * Обновить новость.
     *
     * @param $id
     * @param UpdateRequest $request
     */
    public function update($id, UpdateRequest $request)
    {
        $news = News::find($id);

        if ( ! $news) {
            abort(404, 'Новость не найдена');
        }

        if ($request->hasFile('image')) {
            $news->image = $this->saveImage($request->file('image'));
        }

        $news->name = $request->input('name');
        $news->content = $request->input('content');

        $news->save();
    }

    /**
     * Сохранить изображение к новости.
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function saveImage(UploadedFile $file)
    {
        $extension = '.' . explode('/', $file->getMimeType())[1];

        $fileName = str_random(16).$extension;
        $filePath = '/img/news/';
        $file->move(public_path($filePath), $fileName);

        return $filePath.$fileName;
    }
}
