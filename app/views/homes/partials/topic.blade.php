<div class="topic">
    <div class="media">
        <a class="pull-left" href="{{ route('topic.show', ['id' => $topic->id]) }}">
            <div class="media-object">
                <img src="{{ $topic->ensureACover() }}" alt="{{{ $topic->subject }}}">
                <img src="{{ $topic->ensureBCover() }}" alt="{{{ $topic->subject }}}">
            </div>
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
                    <label class="label label-default">
                        <a href="{{ route('topic.category.index_with_code', ['code' => $topic->category->code]) }}" class="text-white">{{{ $topic->category->name }}}</a>
                    </label>
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
