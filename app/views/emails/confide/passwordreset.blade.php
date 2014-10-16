<h1>{{ trans('confide::confide.email.password_reset.subject') }}</h1>

<p>{{ trans('confide::confide.email.password_reset.greetings', ['name' => $user['username']]) }},</p>

<p>{{ trans('confide::confide.email.password_reset.body') }}</p>
<a href="{{ route('auth.reset_password', ['token' => $token]) }}">
    {{ route('auth.reset_password', ['token' => $token])  }}
</a>

<p>{{ trans('confide::confide.email.password_reset.farewell') }}</p>
