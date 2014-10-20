@extends('layouts.frontend')

@section('container')
    <div id="index">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.home.hot_topics') }}</div>
                <div class="panel-body">
                    @foreach($hot_topics as $topic)
                        @include('homes.partials.topic')
                    @endforeach
                </div>
                <div class="panel-footer">
                    {{ $hot_topics->links('paginations.back_next'); }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <a href="{{ route('topic.create') }}" class="btn btn-info btn-lg">{{ trans('views.home.create_topic') }}</a>
                </div>
            </div>

            @include('blocks.random_users')
            @include('blocks.advert')
        </div>
    </div>
@stop
