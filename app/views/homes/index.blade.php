@extends('layouts.frontend')

@section('container')
    {{ trans("controllers.home.welcome_message", ['username' => Auth::user() ? ucfirst(Auth::user()->username) : 'Guest']) }}
@stop
