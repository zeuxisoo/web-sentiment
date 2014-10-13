@extends('layouts.frontend')

@section('container')
    <div id="signin">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.user.signin') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/login') }}" accept-charset="UTF-8">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="remember" value="0">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">{{ trans('views.user.email') }}</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('views.user.email') }}" value="{{ Input::old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">{{ trans('views.user.password') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ trans('views.user.password') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="remember" name="remember" value="1">&nbsp;
                                        {{ trans('views.user.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">{{ trans('views.user.signin') }}</button>
                                &nbsp;<span class="text-muted">{{ trans('views.user.or') }}</span>&nbsp;
                                <small>
                                    <a href="{{ url('/user/forgot_password') }}">
                                        {{ trans('views.user.forgot_password') }}
                                    </a>
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
