@extends('layouts.frontend')

@section('container')
    <div id="forgot-password">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.user.forgot_password') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/forgot_password') }}" accept-charset="UTF-8">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">{{ trans('views.user.email') }}</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('views.user.email') }}" value="{{ Input::old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">{{ trans('views.user.submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
