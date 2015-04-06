<?php
use League\Fractal\TransformerAbstract;

class TopicCategoryTransformer extends TransformerAbstract {

    public function transform(TopicCategory $topic_category) {
        return [
            'id'   => $topic_category->id,
            'name' => $topic_category->name,
            'code' => $topic_category->code,
        ];
    }

}
