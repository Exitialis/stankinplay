@extends('admin.index')

@section('admin.content')
    <admin-news :ajax-url="'{{ route('api.news.lists')  }}'" inline-template>
        <div>
            <h3>Новости</h3>
            <div class="text-right">
                <a href="{{ route('admin.news.create') }}" class="btn btn-success btn-raised">Создать новость</a>
            </div>

            <p v-if="news.length === 0">Нет ни одной новости.</p>
            <div v-else class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Автор</th>
                            <th>Дата создания</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in news">
                            <td>@{{ item.name }}</td>
                            <td>@{{ item.user.login }}</td>
                            <td>@{{ item.created_at }}</td>
                            <td>
                                <a :href="'{{ route('admin') }}' + '/news/' + item.id" >
                                    <i class="fa fa-pencil text-success" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <pagination
                    :current="currentPage"
                    :total-pages="totalPages"
                    :per-page="perPage"
            @page-changed="fetchNews"
            ></pagination>
        </div>
    </admin-news>
@endsection('admin.content')