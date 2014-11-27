<?php
use League\Fractal\TransformerAbstract;

class SingleObjectTransformer extends TransformerAbstract {

    public function transform(Eloquent $model) {
        return $model->toArray();
    }

}
