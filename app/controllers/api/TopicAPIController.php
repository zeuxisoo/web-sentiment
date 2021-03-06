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

            // Make topic ids list
            $topic_ids = array_map(function($topic) {
                return $topic->id;
            }, $topics->getItems());

            // Find votes by topic ids
            $vote_counts = TopicVote::selectRaw("
                SUM(answer='A') AS answer_a_count,
                SUM(answer='B') AS answer_b_count
            ")->whereIn('topic_id', $topic_ids)->where(function($query) {
                $query->where('answer', 'A')->orWhere('answer', 'B');
            })->groupBy('topic_id')->get(['answer_a_count', 'answer_b_count']);

            $temp_vote_counts = [];
            foreach($vote_counts as $vote_count) {
                $temp_vote_counts[$vote_count->topic_id] = $vote_count;
            }
            $vote_counts = &$temp_vote_counts;

            // Add vote_counts property to topic object
            foreach($topics as $topic) {
                if (empty($vote_counts[$topic->id]->answer_a_count) === false) {
                    $topic->vote_counts = $vote_counts[$topic->id];
                }else{
                    $topic->vote_counts = (object) [
                        'answer_a_count' => 0,
                        'answer_b_count' => 0,
                    ];
                }
            }

            // Response
            return $this->response->paginator($topics, new TopicsTransformer($vote_counts));
        }
    }

    public function show($id) {
        try {
            $topic      = Topic::findOrFail($id);
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

            return $this->response->item($topic, new TopicTransformer($my_vote, $vote_count, $is_bookarmked));
        }catch(ModelNotFoundException $e) {
            throw new ResourceException('Can not found related topic');
        }
    }

}
