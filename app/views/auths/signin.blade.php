@extends('layouts.frontend')

@section('container')
    <div id="signin">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.auth.signin') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.login') }}" accept-charset="UTF-8">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="remember" value="0">
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
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="remember" name="remember" value="1">&nbsp;
                                        {{ trans('views.auth.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">{{ trans('views.auth.signin') }}</button>
                                &nbsp;<span class="text-muted">{{ trans('views.auth.or') }}</span>&nbsp;
                                <small>
                                    <a href="{{ route('auth.forgot_password') }}">
                                        {{ trans('views.auth.forgot_password') }}
                                    </a>
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include('blocks.social_login')
        </div>
    </div>
@stop
