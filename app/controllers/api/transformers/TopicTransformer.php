<?php
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract {

    public function transform(Topic $topic) {
        return $topic->toArray();
    }

}
