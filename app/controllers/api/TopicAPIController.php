<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dingo\Api\Exception\ResourceException;

class TopicAPIController extends BaseAPIController {

    public function index($type = 'all') {
        $validator = Validator::make(Route::getCurrentRoute()->parameters(), [
            'type' => 'in:hot,latest,all',
        ]);

        if ($validator->fails()) {
            throw new ResourceException('Could not get topic list', $validator->errors());
        }else{
            switch($type) {
                case 'hot':
                    $topics = Topic::hot()->with('user', 'category')->simplePaginate(20);
                    break;
                case 'latest':
                    $topics = Topic::latest()->with('user', 'category')->simplePaginate(20);
                    break;
                default:
                    $topics = Topic::with('user', 'category')->simplePaginate(20);
                    break;
            }

            return $topics;
        }
    }

    public function show($id) {
        try {
            $topic      = Topic::findOrFail($id);
            $comments   = $topic->comments()->orderBy('created_at', 'asc')->with('user')->get();
            $my_vote    = TopicVote::topicAndUser($topic, Auth::user())->first();
            $vote_count = TopicVote::selectRaw("
                SUM(answer='A') AS answer_a_count,
                SUM(answer='B') AS answer_b_count
            ")->whereTopicId($topic->id)->where(function($query) {
                $query->where('answer', 'A')->orWhere('answer', 'B');
            })->first(['answer_a_count', 'answer_b_count']);

            // View count
            $viewed_topic_ids = Session::get('viewed_topic_ids', []);

            if (empty($viewed_topic_ids) === true || in_array($topic->id, $viewed_topic_ids) === false) {
                $topic->increment('view_count');

                array_push($viewed_topic_ids, $topic->id);

                Session::put('viewed_topic_ids', $viewed_topic_ids);
            }

            // Is bookmarked
            $is_bookarmked = Bookmark::topicAndUser($topic, Auth::user())->count() > 0;

            // Merge all detail into topic object
            $topic->comments      = $comments;
            $topic->my_vote       = $my_vote;
            $topic->vote_count    = $vote_count;
            $topic->is_bookarmked = $is_bookarmked;

            return $this->response->item($topic, new SingleObjectTransformer);
        }catch(ModelNotFoundException $e) {
            throw new ResourceException('Can not found related topic');
        }
    }

}
