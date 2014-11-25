@extends('layouts.frontend')

@section('title')
    {{{ $topic->subject }}}
@stop

@section('ogmeta')
<meta property="og:title" content="{{{ $topic->subject }}}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route('topic.show', ['id' => $topic->id]) }}" />
<meta property="og:image" content="{{ $topic->coverImage() }}" />
<meta property="og:description" content="{{ $topic->description }}" />
<meta property="og:site_name" content="Dummy" />
@stop

@section('container')
    <div id="topic-show">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="lead topic-subject">{{{ $topic->subject }}}</div>
                    <div class="topic-meta">
                        <i class="fa fa-gears"></i>&nbsp;
                        <a href="{{ route('topic.category.index_with_code', ['code' => $topic->category->code]) }}">
                            {{{ $topic->category->name }}}
                        </a>&nbsp;

                        <i class="fa fa-user"></i>&nbsp;
                        <a href="{{ route('user.profile', ['username' => $topic->user->username]) }}">
                            {{{ $topic->user->username }}}
                        </a>&nbsp;

                        <i class="fa fa-clock-o"></i>&nbsp;
                        {{{ $topic->created_at->diffForHumans() }}}&nbsp;

                        @if (Auth::user() && Auth::user()->id === $topic->user->id)
                            <i class="fa fa-ban"></i>&nbsp;
                            <a href="{{ route('topic.report', ['id' => $topic->id]) }}">{{ trans('views.topic.report') }}</a>

                            <i class="fa fa-pencil-square-o"></i>&nbsp;
                            <a href="{{ route('topic.edit', ['id' => $topic->id]) }}">{{ trans('views.topic.edit') }}</a>

                            <i class="fa fa-remove"></i>&nbsp;
                            <a href="{{ route('topic.destroy', ['id' => $topic->id]) }}">{{ trans('views.topic.destroy') }}</a>
                        @endif
                    </div>
                    <div class="topic-description text-muted">
                        {{{ $topic->description }}}
                    </div>
                    <div class="topic-tags text-muted">
                        <small>Tags: </small>
                        @foreach($topic->tagged as $tag)
                            <label class="label label-default">
                                <i class="fa fa-tag fa-fw"></i>&nbsp;
                                <a href="{{ route('topic.tags.index_with_slug', ['name' => rawurlencode($tag->tag_slug)]) }}" class="text-white">{{{ $tag->tag_name }}}</a>
                            </label>
                            &nbsp;
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.topic.current_vote_stat') }}</div>
                <div class="panel-body">
                    <div class="btn-group btn-group-justified">
                        <span class="btn btn-info btn-group">
                            {{ trans('views.topic.voted') }} <span class="badge">{{{ $topic->vote_count }}}</span>
                        </span>
                        <span class="btn btn-success btn-group">
                            {{ trans('views.topic.answer_a') }} <span class="badge">{{{ $vote_count->answer_a_count ?: 0 }}}</span>
                        </span>
                        <span class="btn btn-danger btn-group">
                            {{ trans('views.topic.answer_b') }} <span class="badge">{{{ $vote_count->answer_b_count ?: 0 }}}</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="{{ route('topic.vote', ['id' => $topic->id, 'answer' => 'a']) }}" class="btn btn-success" data-sweet-confirm="true">
                                {{{ $topic->answer_a_text }}}
                            </a>

                            @if ($my_vote !== null && strtoupper($my_vote->answer) == 'A')
                                <span class="label label-default">{{ trans('views.topic.voted') }}</span>
                            @endif

                            <hr>

                            @if (File::exists($topic->answerAImagePath()) === true && File::isFile($topic->answerAImagePath()) === true)
                                <a href="{{{ $topic->answerAImage() }}}" class="thumbnail swipebox" title="{{{ $topic->answer_a_text }}}">
                                    <img src="{{{ $topic->answerAImage() }}}" class="img-rounded">
                                </a>
                            @else
                                <div class="alert alert-default">
                                    {{ trans('views.topic.no_answer_image') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="{{ route('topic.vote', ['id' => $topic->id, 'answer' => 'b']) }}" class="btn btn-danger" data-sweet-confirm="true">
                                {{{ $topic->answer_b_text }}}
                            </a>

                            @if ($my_vote !== null && strtoupper($my_vote->answer) == 'B')
                                <span class="label label-default">{{ trans('views.topic.voted') }}</span>
                            @endif

                            <hr>
                            @if (File::exists($topic->answerBImagePath()) === true && File::isFile($topic->answerBImagePath()) === true)
                                <a href="{{{ $topic->answerBImage() }}}" class="thumbnail swipebox" title="{{{ $topic->answer_b_text }}}">
                                    <img src="{{{ $topic->answerBImage() }}}" class="img-rounded">
                                </a>
                            @else
                                <div class="alert alert-default">
                                    {{ trans('views.topic.no_answer_image') }}
                                </div>
                            @endif
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

                            <div class="media" id="topic-comment-{{ $comment->id }}">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-rounded" src="{{ $comment->user->avatar(32) }}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="{{ route('user.profile', ['username' => $comment->user->username]) }}">
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
