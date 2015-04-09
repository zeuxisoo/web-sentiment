<?php
use League\Fractal\TransformerAbstract;

class TopicsTransformer extends TransformerAbstract {

    protected $defaultIncludes = [
        'user',
        'category',
    ];

    public function transform(Topic $topic) {
        return [
            'id'            => $topic->id,
            'subject'       => $topic->subject,
            'description'   => $topic->description,
            'view_count'    => $topic->view_count,
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
                'answer_a' => $topic->vote_counts->answer_a_count ?: 0,
                'answer_b' => $topic->vote_counts->answer_b_count ?: 0,
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
