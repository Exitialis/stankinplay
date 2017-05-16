@extends('admin.index')

@section('admin.content')
    <admin-news inline-template>
        <div>
            <h3>Новости</h3>

            <div class="table-responsive">
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
                    <tr v-for="user in users">
                        <td></td>
                        <td>
                            <a :href="'{{ route('admin') }}' + '/users/' + user.id" >
                                <i class="fa fa-pencil text-success" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </admin-news>
@endsection('admin.content')