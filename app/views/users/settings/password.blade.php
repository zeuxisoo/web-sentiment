@extends('layouts.frontends.user_settings')

@section('container_user_settings')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('views.user.password_heading') }}</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('user.settings.password') }}" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="old_password" class="col-sm-3 control-label">{{ trans('views.user.old_password') }}</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="{{ trans('views.user.old_password') }}" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_password" class="col-sm-3 control-label">{{ trans('views.user.new_password') }}</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="{{ trans('views.user.new_password') }}" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="col-sm-3 control-label">{{ trans('views.user.confirm_password') }}</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="{{ trans('views.user.confirm_password') }}" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-default">{{ trans('views.user.update') }}</button>
                        &nbsp;
                        <a href="{{ route('auth.forgot_password') }}">{{ trans('views.user.forgot_password') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
