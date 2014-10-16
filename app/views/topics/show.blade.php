@extends('layouts.frontend')

@section('container')
    <div id="topic-show">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="lead topic-subject">{{{ $topic->subject }}}</div>
                    <div class="topic-meta">
                        <i class="fa fa-user"></i>&nbsp;
                        <a href="{{ route('user.show', ['username' => $topic->user->username]) }}">
                            {{{ $topic->user->username }}}
                        </a>&nbsp;

                        <i class="fa fa-clock-o"></i>&nbsp;
                        {{{ $topic->created_at->diffForHumans() }}}&nbsp;

                        @if (Auth::user() && Auth::user()->id === $topic->user->id)
                            <i class="fa fa-pencil-square-o"></i>&nbsp;
                            <a href="{{ route('topic.edit', ['id' => $topic->id]) }}">{{ trans('views.topic.edit') }}</a>
                        @endif
                    </div>
                    <div class="topic-description text-muted">
                        {{{ $topic->description }}}
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <span class="btn btn-primary">{{ trans('views.topic.current_vote_stat') }}</span>
                    <span class="btn btn-info">
                        {{ trans('views.topic.voted') }} <span class="badge">{{{ $topic->vote_count }}}</span>
                    </span>
                    <span class="btn btn-success">
                        {{ trans('views.topic.answer_a') }} <span class="badge">{{{ $vote_count->answer_a_count ?: 0 }}}</span>
                    </span>
                    <span class="btn btn-danger">
                        {{ trans('views.topic.answer_b') }} <span class="badge">{{{ $vote_count->answer_b_count ?: 0 }}}</span>
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="{{ route('topic.vote', ['id' => $topic->id, 'choice' => 'a']) }}" class="btn btn-success">
                                {{{ $topic->answer_a_text }}}
                            </a>

                            @if ($my_vote && strtoupper($my_vote->choice) == 'A')
                                <span class="label label-default">{{ trans('views.topic.voted') }}</span>
                            @endif

                            <hr>
                            <a href="#" class="thumbnail">
                                <img src="{{{ $topic->answerAImage() }}}" class="img-rounded">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="{{ route('topic.vote', ['id' => $topic->id, 'choice' => 'b']) }}" class="btn btn-danger">
                                {{{ $topic->answer_b_text }}}
                            </a>

                            @if ($my_vote && strtoupper($my_vote->choice) == 'B')
                                <span class="label label-default">{{ trans('views.topic.voted') }}</span>
                            @endif

                            <hr>
                            <a href="#" class="thumbnail">
                                <img src="{{{ $topic->answerBImage() }}}" class="img-rounded">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('views.topic.comments_header', ['total' => $topic->comments->count()]) }}
                </div>
                <div class="panel-body">
                    @if ($comments->count() <= 0)
                        <div class="alert alert-info alert-comment">{{{ trans('views.topic.no_comments') }}}</div>
                    @else
                        {{-- */$counter = 1;/* --}}
                        @foreach($comments as $comment)
                            @if ($counter > 1)
                                <hr>
                            @endif

                            <div class="media" id="topic-show-comment-id-{{ $comment->id }}">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-rounded" src="{{ $comment->user->avatar(32) }}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="{{ route('user.show', ['username' => $comment->user->username]) }}">
                                            {{{ $comment->user->username }}}
                                        </a>
                                        <small>
                                            <time datetime="{{{ $comment->created_at->toDateTimeString() }}}" pubdate>
                                                {{{ $comment->created_at->diffForHumans() }}}
                                            </time>
                                        </small>
                                    </h4>
                                    {{ nl2br(e($comment->content)) }}
                                </div>
                            </div>

                            {{-- */$counter++;/* --}}
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                @if (Auth::user())
                    <form class="form panel-body" action="{{ route('topic.comment', ['id' => $topic->id]) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="content" required="required">{{ Input::old('content') }}</textarea>
                        </div>
                        <div class="form-submit text-right">
                            <button class="btn btn-success">{{ trans('views.topic.leave_comment') }}</button>
                        </div>
                    </form>
                @else
                    <div class="panel-body">
                        <div class="alert alert-info">{{ trans('views.topic.login_required') }}</div>
                        <a href="{{ route('auth.login') }}" class="btn btn-success">{{ trans('views.topic.signin') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
