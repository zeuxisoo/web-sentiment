@extends('layouts.frontend')

@section('container')
    <div id="topic-show">
        <div class="col-md-12">
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
        </div>
    </div>
@stop
