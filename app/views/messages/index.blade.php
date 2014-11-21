@extends('layouts.frontends.message')

@section('container_message')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('views.message.inbox') }}</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ trans('views.message.subject') }}</th>
                            <th>{{ trans('views.message.sender') }}</th>
                            <th>{{ trans('views.message.time') }}</th>
                            <th>{{ trans('views.message.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>
                                    @if ($message->category == 'system')
                                        <span class="label label-danger">{{{ $message->category }}}</span>
                                    @else
                                        <span class="label label-primary">{{{ $message->category }}}</span>
                                    @endif
                                    <a href="{{ route('message.show', ['message_id' => $message->id ]) }}">
                                        @if ($message->have_read == 0)
                                            <strong>{{{ $message->subject }}}</strong>
                                        @else
                                            {{{ $message->subject }}}
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    @if ($message->category == 'system')
                                        <small class="text-danger">{{{ trans('views.message.system') }}}</small>
                                    @else
                                        <a href="{{ route('user.profile', ['username' => $message->sender->username ]) }}">
                                            {{{ $message->sender->username }}}
                                        </a>
                                    @endif
                                </td>
                                <td>{{{ $message->created_at->diffForHumans() }}}</td>
                                <td>
                                    <a href="{{ route('message.show', ['message_id' => $message->id]) }}" class="btn btn-info btn-xs">
                                        {{ trans('views.message.read') }}
                                    </a>
                                    <a href="{{ route('message.delete', ['message_id' => $message->id]) }}" class="btn btn-danger btn-xs" delete="delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $messages->links('paginations.back_next') }}
                </div>
            </div>
        </div>
    </div>
@stop
