@extends('layouts.frontend')

@section('container')
    <div id="index">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.home.latest_topics') }}</div>
                <div class="panel-body">
                    @foreach($latest_topics as $topic)
                        <div class="topic">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="{{ $topic->coverImage() }}" alt="{{{ $topic->subject }}}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{{ $topic->subject }}}</h4>
                                    <div class="description">
                                        <small class="text-muted">
                                            {{{ $topic->description }}}
                                        </small>
                                    </div>
                                    <div class="status">
                                        <small class="text-muted">@{{{ $topic->user->username }}}</small>
                                        <small class="text">{{ trans('views.home.at') }}</small>
                                        <small class="text-muted">{{{ $topic->created_at->diffForHumans() }}}</small>
                                        ,
                                        <small class="text-muted">
                                            {{ trans('views.home.vote_message', ['vote_count' => $topic->vote_count]) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.home.hot_topics') }}</div>
                <div class="panel-body">
                    @foreach($hot_topics as $topic)
                        <div class="topic">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="{{ $topic->coverImage() }}" alt="{{{ $topic->subject }}}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{{ $topic->subject }}}</h4>
                                    <div class="description">
                                        <small class="text-muted">
                                            {{{ $topic->description }}}
                                        </small>
                                    </div>
                                    <div class="status">
                                        <small class="text-muted">@{{{ $topic->user->username }}}</small>
                                        <small class="text">{{ trans('views.home.at') }}</small>
                                        <small class="text-muted">{{{ $topic->created_at->diffForHumans() }}}</small>
                                        ,
                                        <small class="text-muted">
                                            {{ trans('views.home.vote_message', ['vote_count' => $topic->vote_count]) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <a href="{{ url('/topic/create') }}" class="btn btn-info btn-lg">{{ trans('views.home.create_topic') }}</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.home.random_users') }}</div>
                <div class="panel-body row">
                    @foreach($random_users as $user)
                        <div class="col-md-4">
                            <a href="#" class="thumb-random">
                                <img src="{{ $user->avatar(64) }}" class="img-rounded" alt="{{{ $user->username }}}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.home.advert') }}</div>
                <div class="panel-body">
                    <img src="http://placehold.it/225x225">
                </div>
            </div>
        </div>
    </div>
@stop
