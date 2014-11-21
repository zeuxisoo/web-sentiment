@extends('layouts.frontends.message')

@section('container_message')
    <div class="panel panel-default">
        <div class="panel-heading">{{{ $message->subject }}}</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action="{{ route('message.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ trans('views.message.from_user') }}</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{{ $message->sender->username }}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ trans('views.message.receive_at') }}</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{{ $message->created_at }}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="content">{{ trans('views.message.content') }}</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ nl2br(e($message->content)) }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a href="{{ route('message.unread', ['message_id' => $message->id]) }}" class="btn btn-info">
                            {{ trans('views.message.unread') }}
                        </a>
                        <a href="{{ route('message.create') }}?message_id={{{ $message->id }}}" class="btn btn-primary">
                            {{ trans('views.message.reply') }}
                        </a>
                        <a href="{{ route('message.delete', ['message_id' => $message->id]) }}" class="btn btn-danger" delete="delete">
                            {{ trans('views.message.delete') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
