<h1>{{ trans('confide::confide.email.password_reset.subject') }}</h1>

<p>{{ trans('confide::confide.email.password_reset.greetings', ['name' => $user['username']]) }},</p>

<p>{{ trans('confide::confide.email.password_reset.body') }}</p>
<a href="{{ url('user/reset_password/'.$token) }}">
    {{ url('user/reset_password/'.$token)  }}
</a>

<p>{{ trans('confide::confide.email.password_reset.farewell') }}</p>
