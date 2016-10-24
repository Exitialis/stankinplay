@extends('vendor.index')


@section('content')
    <test inline-template>
        <v-select :value.sync="form.user_id" :on-search="getOptions" :debounce="250" :options="options" label="Игрок"></v-select>
    </test>

@endsection