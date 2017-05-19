@extends('admin.index')

@section('admin.content')
    <h3>Создание новости</h3>

    <create-news id="news-image" inline-template>
        <form @submit.prevent="save('{{ route('api.news.create') }}')">
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
                <mde v-model="form.content"></mde>
            </div>
            <button type="submit" class="btn btn-success">Добавить новость</button>
        </form>
    </create-news>
@endsection('admin.content')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection