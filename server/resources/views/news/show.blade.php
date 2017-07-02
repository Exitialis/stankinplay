@extends('vendor.index')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3>{{ $news->name }}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <img src="{{ $news->image }}" alt="{{ $news->name }}" class="img-responsive">
                </div>
            </div>

            @php
                $parser = new cebe\markdown\Markdown;
                echo $parser->parse($news->content);
            @endphp
        </div>
    </div>
@endsection