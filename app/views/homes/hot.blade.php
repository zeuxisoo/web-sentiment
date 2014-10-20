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
            @include('blocks.create_topic')
            @include('blocks.random_users')
            @include('blocks.advert')
        </div>
    </div>
@stop
