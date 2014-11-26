<?php
class BookmarkController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function index() {
        $user      = Auth::user();
        $bookmarks = Bookmark::whereUserId($user->id)->simplePaginate(20);
        $topics    = Topic::whereUserId($user->id)->whereIn('id', $bookmarks->lists('topic_id'))->with('user', 'category')->get();

        return View::make('bookmarks.index', compact('bookmarks', 'topics'));
    }

    public function create($topic_id) {
        $topic = Topic::with('User')->findOrFail($topic_id);

        Validator::extend('only_bookmark_once', function($attribute, $value, $parameters) use ($topic) {
            return Bookmark::topicAndUser($topic, Auth::user())->count() <= 0;
        });

        $validator = Validator::make(Route::getCurrentRoute()->parameters(), [
            'topic_id' => 'only_bookmark_once',
        ], [
            'only_bookmark_once' => trans('controllers.bookmark.only_bookmark_once')
        ]);

        if ($validator->fails()) {
            return Redirect::route('topic.show', ['id' => $topic->id])->withErrors($validator)->withInput();
        }else{
            Bookmark::create([
                'user_id'  => Auth::user()->id,
                'topic_id' => $topic->id,
            ]);

            return Redirect::route('topic.show', ['id' => $topic->id])->withNotice(trans('controllers.bookmark.bookmark_success'));
        }
    }

    public function destory($topic_id) {
        $bookmark = Bookmark::whereTopicId($topic_id)->firstOrFail();

        if ($bookmark->user_id !== Auth::user()->id) {
            return Redirect::route('topic.show', ['id' => $topic_id])->withError(trans('controllers.bookmark.not_bookmark_owner'));
        }else{
            $bookmark->delete();

            return Redirect::route('topic.show', ['id' => $topic_id])->withError(trans('controllers.bookmark.bookmark_deleted'));
        }
    }

}
