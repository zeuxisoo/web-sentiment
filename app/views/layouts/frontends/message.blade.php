@extends('layouts.frontend')

@section('container')
    <div class="message">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.message.menu_heading') }}</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <i class="fa fa-list"></i>&nbsp;
                        <a href="{{ route('message.index') }}">{{ trans('views.message.inbox') }}</a>
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-pencil"></i>&nbsp;
                        <a href="{{ route('message.create') }}">{{ trans('views.message.compose') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            @yield('container_message')
        </div>
    </div>
@stop
