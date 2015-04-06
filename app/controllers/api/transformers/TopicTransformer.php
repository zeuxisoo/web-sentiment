<?php
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Item;

class TopicTransformer extends TransformerAbstract {

    private $vote_count;
    private $my_vote;
    private $is_bookarmked;

    protected $defaultIncludes = [
        'user',
        'category',
    ];

    public function __construct($my_vote, $vote_count, $is_bookarmked) {
        $this->my_vote       = $my_vote;
        $this->vote_count    = $vote_count;
        $this->is_bookarmked = $is_bookarmked;
    }

    public function transform(Topic $topic) {
        return [
            'id'            => $topic->id,
            'subject'       => $topic->subject,
            'description'   => $topic->description,
            'my_vote'       => $this->my_vote ?: 0,
            'view_count'    => $topic->view_count,
            'is_bookarmked' => $this->is_bookarmked,
            'answer_a'      => [
                'text'  => $topic->answer_a_text,
                'image' => $topic->ensureACover(),
            ],
            'answer_b'      => [
                'text'  => $topic->answer_b_text,
                'image' => $topic->ensureBCover(),
            ],
            'vote_count'    => [
                'total'    => $topic->vote_count,
                'answer_a' => $this->vote_count->answer_a_count ?: 0,
                'answer_b' => $this->vote_count->answer_b_count ?: 0,
            ],
            'created_at'    => $topic->created_at->diffForHumans(),
            'updated_at'    => $topic->updated_at->diffForHumans(),
        ];
    }

    public function includeUser(Topic $topic) {
        return $this->item($topic->user, new UserTransformer);
    }

    public function includeCategory(Topic $topic) {
        return $this->item($topic->category, new TopicCategoryTransformer);
    }

}
