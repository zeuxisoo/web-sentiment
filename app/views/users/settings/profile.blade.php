@extends('layouts.frontends.user_settings')

@section('container_user_settings')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('views.user.profile_heading') }}</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('user.settings.profile') }}" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">{{ trans('views.user.username') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="{{ trans('views.user.username') }}" value="{{ Input::old('username') ?: $user->username }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">{{ trans('views.user.email') }}</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('views.user.email') }}" value="{{ Input::old('email') ?: $user->email }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">{{ trans('views.user.update') }}</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
@stop
