<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Dummy</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
<link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" media="screen">
<link href="{{ asset('assets/client/css/default.css') }}" rel="stylesheet" media="screen">
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/client/js/default.js') }}"></script>
</head>
<body>
<div class="navbar navbar-static-top navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Dummy</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/') }}">{{ trans('views.frontend.home') }}</a></li>
                <li><a href="#hot">{{ trans('views.frontend.hot') }}</a></li>
                <li><a href="#latest">{{ trans('views.frontend.latest') }}</a></li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                @if (Auth::user())
                    <li>
                        <a href="#">
                            <img src="{{ Auth::user()->avatar(20) }}">&nbsp;
                            <strong>{{ ucfirst(Auth::user()->username) }}</strong>
                        </a>
                    </li>
                    <li><a href="{{ url('user/logout') }}"><i class="fa fa-sign-out fa-lg"></i></a></li>
                @else
                    <li><a href="{{ url('user/login') }}">{{ trans('views.frontend.signin') }}</a></li>
                    <li>
                        <div class="navbar-form navbar-right">
                            <a href="{{ url('user/create') }}" class="btn btn-success">{{ trans('views.frontend.signup') }}</a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        @if (Session::get('error'))
            <div class="alert alert-error alert-danger">
                <strong>{{ trans('views.frontend.error') }}</strong>&nbsp;

                @if (is_array(Session::get('error')))
                    {{ head(Session::get('error')) }}
                @else
                    {{{ Session::get('error') }}}
                @endif
            </div>
        @endif

        @if (Session::get('notice'))
            <div class="alert alert-success">
                <strong>{{ trans('views.frontend.notice') }}</strong>&nbsp;{{{ Session::get('notice') }}}
            </div>
        @endif

        @yield('container')

        <div class="col-md-12 footer">
            <hr>
            <span class="pull-left">&copy; 2014</span>
            <span class="pull-right">&nbsp;</span>
        </div>
    </div>
</div>
</body>
</html>