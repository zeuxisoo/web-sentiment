@extends('layouts.frontend')

@section('container')
    <div class="bookmark">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.bookmark.index_heading') }}</div>
                <div class="panel-body">
                    @foreach($topics as $topic)
                        @include('bookmarks.partials.topic')
                    @endforeach
                </div>
                <div class="panel-footer">
                    {{ $bookmarks->links('paginations.back_next'); }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('blocks.advert')
        </div>
    </div>
@stop
