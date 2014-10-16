<h1>{{ trans('confide::confide.email.account_confirmation.subject') }}</h1>

<p>{{ trans('confide::confide.email.account_confirmation.greetings', ['name' => $user['username']]) }},</p>

<p>{{ trans('confide::confide.email.account_confirmation.body') }}</p>
<a href="{{ url('/auth/confirm/'.$user['confirmation_code']) }}">
    {{ url('/auth/confirm/'.$user['confirmation_code']) }}
</a>

<p>{{ trans('confide::confide.email.account_confirmation.farewell') }}</p>
