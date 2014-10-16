<h1>{{ trans('confide::confide.email.account_confirmation.subject') }}</h1>

<p>{{ trans('confide::confide.email.account_confirmation.greetings', ['name' => $user['username']]) }},</p>

<p>{{ trans('confide::confide.email.account_confirmation.body') }}</p>
<a href="{{ route('auth.confirm', ['code' => $user['confirmation_code']]) }}">
    {{ route('auth.confirm', ['code' => $user['confirmation_code']]) }}
</a>

<p>{{ trans('confide::confide.email.account_confirmation.farewell') }}</p>
