@extends('layouts.frontend')

@section('container')
    <div class="topic-category">
        <div class="container">
            @if (empty($slug) === false)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('views.topic_tags.heading', ['slug' => e($slug)]) }}</div>
                    <div class="panel-body">
                        @if ($topics->isEmpty())
                            <small class="text-muted">{{ trans('views.topic_tags.no_related_topics') }}</small>
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
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.topic_tags.all_tags') }}</div>
                <div class="panel-body">
                    @foreach($tags as $tag)
                        <label class="label label-default">
                            <i class="fa fa-tag"></i>&nbsp;
                            <a href="{{ route('topic.tags.index_with_slug', ['slug' => rawurlencode($tag->slug)]) }}" class="text-white">{{{ $tag->name }}}</a>
                        </label>
                        &nbsp;
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
