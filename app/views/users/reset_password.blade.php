@extends('layouts.frontend')

@section('container')
    <div id="reset-password">
        <div class="panel panel-default">
            <div class="panel-heading">Reset password</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/reset_password') }}" accept-charset="UTF-8">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
