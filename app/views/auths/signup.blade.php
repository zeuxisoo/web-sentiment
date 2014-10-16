@extends('layouts.frontend')

@section('container')
    <div id="signup">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.auth.signup') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.store') }}" accept-charset="UTF-8">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">{{ trans('views.auth.username') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" placeholder="{{ trans('views.auth.username') }}" value="{{ Input::old('username') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">{{ trans('views.auth.email') }}</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('views.auth.email') }}" value="{{ Input::old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">{{ trans('views.auth.password') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ trans('views.auth.password') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-2 control-label">{{ trans('views.auth.confirm_password') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ trans('views.auth.confirm_password') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">{{ trans('views.auth.signup') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
