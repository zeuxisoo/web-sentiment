<?php
class TopicVote extends Eloquent {

    protected $table = 'topic_vote';

    protected $fillable = ['user_id', 'topic_id', 'answer'];

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

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'desc');
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
