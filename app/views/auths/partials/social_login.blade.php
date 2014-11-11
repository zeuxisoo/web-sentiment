<div class="panel panel-default">
    <div class="panel-heading">{{ trans('views.auth.signin_with') }}</div>
    <div class="panel-body row">
        <div class="col-md-3">
            <a href="{{ route('oauth.connect.facebook') }}" class="btn btn-block btn-social btn-facebook">
                <i class="fa fa-facebook"></i>&nbsp;{{ trans('views.auth.signin_with_facebook') }}
            </a>
        </div>
    </div>
</div>
