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
                    <label class="label label-default">{{{ $topic->category->name }}}</label>
                    &nbsp;•&nbsp;
                    <a href="{{ route('user.profile', ['username' => $topic->user->username]) }}">
                        {{{ $topic->user->username }}}
                    </a>
                    &nbsp;•&nbsp;
                    {{{ $topic->created_at->diffForHumans() }}}
                    &nbsp;•&nbsp;
                    {{ trans('views.home.view_message', ['view_count' => $topic->view_count]) }}
                    &nbsp;•&nbsp;
                    {{ trans('views.home.vote_message', ['vote_count' => $topic->vote_count]) }}
                </small>
            </div>
        </div>
    </div>
</div>
