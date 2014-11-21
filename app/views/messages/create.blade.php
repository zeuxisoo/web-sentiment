@extends('layouts.frontends.message')

@section('container_message')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('views.message.compose') }}</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action="{{ route('message.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="username">{{ trans('views.message.username') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="username" value="{{{ $username ?: Input::old('username') }}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="subject">{{ trans('views.message.subject') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject" id="subject" value="{{{ $subject ?: Input::old('subject') }}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="content">{{ trans('views.message.content') }}</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="content">{{{ Input::old('content') }}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">{{ trans('views.message.submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
