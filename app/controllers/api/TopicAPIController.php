<?php
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

}
