<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<title>Dummy</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
<link href="{{ asset('assets/client/css/default.css') }}" rel="stylesheet" media="screen">
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/client/js/default.js') }}"></script>
</head>
<body>
<div class="navbar navbar-default navbar-hand" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">On/Off Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">Dummy</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="">Home</a></li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li><a href="#">Sign up</a></li>
                <li><a href="#">Sign in</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    @yield('container')
</div>
<div class="footer">
    <div class="container">
        <hr>
        <p>
            <span class="pull-left">&copy; Dummy 2014</span>
            <span class="pull-right">&nbsp;</span>
        </p>
    </div>
</div>
</body>
</html>
