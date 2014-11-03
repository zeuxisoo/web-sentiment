@extends('layouts.frontend')

@section('container')
    <div class="search-result">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.search.result_heading', ['keyword' => $keyword]) }}</div>
                <div class="panel-body">
                    @if ($topics->isEmpty())
                        <small class="text-muted">{{ trans('views.search.result_not_found') }}</small>
                    @else
                        @foreach($topics as $topic)
                            @include('homes.partials.topic')
                        @endforeach
                    @endif
                </div>
                <div class="panel-footer">
                    {{ $topics->links('paginations.back_next'); }}
                </div>
            </div>
        </div>
    </div>
@stop
