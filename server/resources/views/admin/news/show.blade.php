@extends('admin.index')

@section('admin.content')
    <h3>Редактирование новости</h3>

    <show-news :ajax-url="'{{ route('api.news.get', $id) }}'" id="news-image" inline-template>
        <div>
            <div class="text-center">
                <img :src="form.image" class="img-responsive news-img">
            </div>

            <form @submit.prevent="save('{{ route('api.news.update', $id) }}')">
                <div class="form-group">
                    <label>Название</label>
                    <input type="text" class="form-control" v-model="form.name">
                </div>
                <div class="form-group">
                    <label class="control-label">Изображение</label>
                    <input type="file" @change="uploadImage" id="news-image">
                    <input type="text" readonly class="form-control" placeholder="Выберите файл">
                </div>
                <div class="form-group">
                    <label>Содержимое</label>
                    <mde :fetched="fetched"  v-model="form.content"></mde>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </show-news>
@endsection('admin.content')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection