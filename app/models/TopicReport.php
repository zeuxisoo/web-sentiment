<?php
class TopicReport extends Eloquent {

    protected $table = 'topic_report';

    protected $fillable = ['user_id', 'topic_id'];

    public function user() {
        return $this->belongsTo('User');
    }

    public function topic() {
        return $this->belongsTo('Topic');
    }

    public function scopeTopicAndUser($query, $topic, $user) {
        $query = $query->whereTopicId($topic->id);

        if ($user === null) {
            $query = $query->whereUserId(null);
        }else{
            $uqery = $query->whereUserId($user->id);
        }

        return $query;
    }

}
