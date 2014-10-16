@extends('layouts.frontend')

@section('container')
    <div id="user-show">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <img src="{{{ $user->avatar(230) }}}" class="img-rounded">
                    <div class="text-left username">{{{ $user->username }}}</div>
                    <hr>
                    <div class="col-md-6">
                        <div class="counter-number text-info">{{ $topic_count }}</div>
                        <div class="counter-name">
                            <small class="text-muted">{{ trans('views.user.topics_count') }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="counter-number text-info">{{ $vote_count }}</div>
                        <div class="counter-name">
                            <small class="text-muted">{{ trans('views.user.votes_count') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="nav nav-tabs" role="tablist">
                <li>
                    <a href="{{ route('user.show', ['username' => $user->username]) }}?tab=topics" data-tab='topics' data-tab-param='tab'>
                        <i class="fa fa-th-list"></i>&nbsp;{{ trans('views.user.topics_tab') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.show', ['username' => $user->username]) }}?tab=votes" data-tab='votes' data-tab-param='tab'>
                        <i class="fa fa-thumbs-up"></i>&nbsp;{{ trans('views.user.votes_tab') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.show', ['username' => $user->username]) }}?tab=comments" data-tab='comments' data-tab-param='tab'>
                        <i class="fa fa-comments"></i>&nbsp;{{ trans('views.user.comments_tab') }}
                    </a>
                </li>
            </ul>
            <hr>
            @if ($tab_name == 'topics')
                <ul class="list-group">
                    @if ($topics->isEmpty() === false)
                        @foreach($topics as $topic)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-9">
                                        <a href="{{ route('topic.show', ['id' => $topic->id]) }}">{{{ $topic->subject }}}</a>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <small>{{ $topic->vote_count }} votes</small>
                                        <span>•</span>
                                        <small class="text-muted">{{{ $topic->created_at->diffForHumans() }}}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <div class="alert alert-info">{{{ trans('views.user.no_topics') }}}</div>
                    @endif
                </ul>
            @endif

            @if ($tab_name == 'votes')
                <ul class="list-group">
                    @if ($votes->isEmpty() === false)
                        @foreach($votes as $vote)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-9">
                                        @if (strtoupper($vote->answer) == 'A')
                                            <span class="label label-success">{{{ $vote->answer }}}</span>
                                        @else
                                            <span class="label label-danger">{{{ $vote->answer }}}</span>
                                        @endif

                                        <a href="{{ route('topic.show', ['id' => $vote->topic->id]) }}">{{{ $vote->topic->subject }}}</a>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <small>{{ $vote->topic->vote_count }} votes</small>
                                        <span>•</span>
                                        <small class="text-muted">{{{ $vote->created_at->diffForHumans() }}}</small>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <div class="alert alert-info">{{{ trans('views.user.no_votes') }}}</div>
                    @endif
                </ul>
            @endif

            @if ($tab_name == 'comments')
                <ul class="list-group">
                    @if ($comments->isEmpty() === false)
                        @foreach($comments as $comment)
                            <li class="list-group-item">
                                <h5>
                                    <a href="{{ route('topic.show', ['id' => $comment->topic->id]) }}">
                                        {{{ $comment->topic->subject }}}
                                    </a>
                                    <small>{{{ $comment->topic->created_at->diffForHumans() }}}</small>
                                </h5>
                                <p class="text-muted">{{ nl2br(e($comment->content)) }}</p>
                            </li>
                        @endforeach
                    @else
                        <div class="alert alert-info">{{{ trans('views.user.no_comments') }}}</div>
                    @endif
                </ul>
            @endif
        </div>
    </div>
@stop
