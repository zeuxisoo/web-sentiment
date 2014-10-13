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

    public function answerAImage() {
        return asset('/attachments/answer_image/a/'.$this->answer_a_image);
    }

    public function answerBImage() {
        return asset('/attachments/answer_image/b/'.$this->answer_b_image);
    }

}
