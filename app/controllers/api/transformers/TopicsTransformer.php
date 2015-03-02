<?php
use League\Fractal\TransformerAbstract;

class TopicsTransformer extends TransformerAbstract {

    public function transform(Topic $topic) {
        return [
            'id'             => $topic->id,
            'subject'        => $topic->subject,
            'answer_a_image' => $topic->ensureACover(),
            'answer_b_image' => $topic->ensureBCover(),
        ];
    }

}
