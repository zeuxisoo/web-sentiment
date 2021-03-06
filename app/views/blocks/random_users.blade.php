<div class="panel panel-default">
    <div class="panel-heading">{{ trans('views.home.random_users') }}</div>
    <div class="panel-body row">
        @foreach($random_users as $user)
            <div class="col-lg-4 col-md-6 col-sm-3 col-xs-4">
                <a href="{{ route('user.profile', ['username' => $user->username]) }}" class="thumb-random">
                    <img src="{{ $user->avatar(64) }}" class="img-rounded" alt="{{{ $user->username }}}">
                </a>
            </div>
        @endforeach
    </div>
</div>
