@extends('vendor.index')

@section('content')
    <news ajax-url="{{ route('api.news.lists') }}" inline-template>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>Новости</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div v-for="item in news" class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img :src="item.image" alt="item.name" class="news-img">
                            <div class="caption">
                                <h3>@{{ item.name }}</h3>
                                <p v-html="toHtml(item.content)"></p>
                                <p>
                                    <a :href="/news/ + item.id" class="btn btn-info" role="button">Читать продолжение</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <pagination
                        :current="currentPage"
                        :total-pages="totalPages"
                        :per-page="perPage"
                @page-changed="fetchNews"
                ></pagination>
            </div>
        </div>
    </news>
@endsection