<?php
class TopicComment extends Eloquent {

    protected $table = 'topic_comment';

    protected $fillable = ['user_id', 'topic_id', 'content'];

    public function user() {
        return $this->belongsTo('User');
    }

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'desc');
    }

}
