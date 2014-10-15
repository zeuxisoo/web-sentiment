<?php
class TopicVote extends Eloquent {

    protected $table = 'topic_vote';

    protected $fillable = ['user_id', 'topic_id', 'choice'];

    public static function boot() {
        parent::boot();

        static::created(function($topic_vote) {
            $topic_vote->topic()->increment('vote_count');
        });
    }

    public function user() {
        return $this->belongsTo('User');
    }

    public function topic() {
        return $this->belongsTo('Topic');
    }

    public function scopeTopicAndUser($query, $topic, $user) {
        return $query->whereTopicId($topic->id)->whereUserId($user->id);
    }

}
