<div class="topic">
    <div class="media">
        <a class="pull-left" href="{{ route('topic.show', ['id' => $topic->id]) }}">
            <img class="media-object" src="{{ $topic->coverImage() }}" alt="{{{ $topic->subject }}}">
        </a>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="{{ route('topic.show', ['id' => $topic->id]) }}">{{{ $topic->subject }}}</a>
            </h4>
            <div class="description">
                <small class="text-muted">
                    {{{ $topic->description }}}
                </small>
            </div>
            <div class="status">
                <small class="text-muted">
                    <a href="{{ route('user.profile', ['username' => $topic->user->username]) }}">
                        {{{ $topic->user->username }}}
                    </a>
                </small>
                <small class="text">{{ trans('views.home.at') }}</small>
                <small class="text-muted">{{{ $topic->created_at->diffForHumans() }}}</small>
                ,
                <small class="text-muted">
                    {{ trans('views.home.vote_message', ['vote_count' => $topic->vote_count]) }}
                </small>
            </div>
        </div>
    </div>
</div>
