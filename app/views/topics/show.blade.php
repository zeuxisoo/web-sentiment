@extends('layouts.frontend')

@section('container')
    <div id="topic-show">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="lead topic-subject">{{{ $topic->subject }}}</div>
                    <div class="topic-meta">
                        <i class="fa fa-user"></i> {{{ $topic->user->username }}}&nbsp;
                        <i class="fa fa-clock-o"></i> {{{ $topic->created_at->diffForHumans() }}}
                    </div>
                    <div class="topic-description text-muted">
                        {{{ $topic->description }}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="" class="btn btn-info">{{{ $topic->answer_a_text }}}</a>
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
                            <a href="" class="btn btn-info">{{{ $topic->answer_b_text }}}</a>
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
                    @if ($topic->comments->count() <= 0)
                        <div class="alert alert-info alert-comment">{{{ trans('views.topic.no_comments') }}}</div>
                    @else
                        {{-- */$counter = 1;/* --}}
                        @foreach($topic->comments as $comment)
                            @if ($counter > 1)
                                <hr>
                            @endif

                            <div class="media" id="topic-show-comment-id-{{ $comment->id }}">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-rounded" src="{{ $comment->user->avatar(32) }}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="#">
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
                    <form class="form panel-body" action="{{ url('/topic/comment/'.$topic->id) }}" method="post">
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
                        <a href="{{ url('/user/login') }}" class="btn btn-success">{{ trans('views.topic.signin') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
