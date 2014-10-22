<?php
class TopicCategory extends Eloquent {

    protected $table = 'topic_category';

    protected $fillable = ['name', 'code'];

    public function topics() {
        return $this->hasMany('Topic');
    }

}
