@extends('layouts.frontend')

@section('container')
    <div id="index">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.home.latest_topics') }}</div>
                <div class="panel-body">
                    @foreach($latest_topics as $topic)
                        @include('homes.partials.topic')
                    @endforeach
                </div>
                <div class="panel-footer">
                    {{ $latest_topics->links('paginations.back_next'); }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('homes.partials.sidebar')
        </div>
    </div>
@stop
