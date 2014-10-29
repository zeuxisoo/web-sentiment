@extends('layouts.frontend')

@section('container')
    <div class="topic-category">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.topic_category.heading', ['name' => e($category->name)]) }}</div>
                <div class="panel-body">
                    @foreach($topics as $topic)
                        @include('homes.partials.topic')
                    @endforeach
                </div>
                <div class="panel-footer">
                    {{ $topics->links('paginations.back_next'); }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('blocks.topic_categories')
        </div>
    </div>
@stop
