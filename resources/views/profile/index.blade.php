@extends('vendor.index')

@section('content')
    <profile inline-template>
        <div class="row" v-cloak>
            <div class="col-md-3 col-xs-12">
                @include('profile.menu')
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="well">
                    <div v-if="currentTab === 'main'">
                        @include('profile.main')
                    </div>
                    <div v-if="currentTab === 'team'">
                        @include('profile.team')
                    </div>
                    {{--<div v-if="currentTab === 'gameProfile'">
                        @include('profile.gameProfile')
                    </div>--}}
                </div>
            </div>
        </div>
    </profile>
@endsection