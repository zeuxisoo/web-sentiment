<?php
class Topic extends Eloquent {

    protected $table = 'topic';

    protected $fillable = [
        'user_id', 'subject', 'cover', 'description',
        'answer_a_text', 'answer_b_text', 'answer_a_image', 'answer_b_image'
    ];

    public function user() {
        return $this->belongsTo('User');
    }

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeHot($query) {
        return $query->orderBy('view_count', 'desc');
    }

    public function coverImage() {
        return asset('/attachments/cover/'.$this->cover);
    }

}
