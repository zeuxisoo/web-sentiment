@extends('layouts.frontend')

@section('container')
    <div class="user-settings">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{ $user->avatar() }}">&nbsp;&nbsp;
                    <strong>{{ $user->username }}</strong>
                </div>
                <div class="list-group">
                    <a href="{{ route('user.settings.profile') }}" class="list-group-item">
                        {{ trans('views.user.profile_heading') }}
                    </a>
                    <a href="{{ route('user.settings.password') }}" class="list-group-item">
                        {{ trans('views.user.password_heading') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @yield('container_user_settings')
        </div>
    </div>
@stop
