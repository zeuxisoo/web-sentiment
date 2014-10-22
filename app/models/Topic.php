<?php
class Topic extends Eloquent {

    protected $table = 'topic';

    protected $fillable = [
        'user_id', 'category_id', 'subject', 'cover', 'description',
        'answer_a_text', 'answer_b_text', 'answer_a_image', 'answer_b_image'
    ];

    public function user() {
        return $this->belongsTo('User');
    }

    public function category() {
        return $this->belongsTo('TopicCategory');
    }

    public function comments() {
        return $this->hasMany('TopicComment');
    }

    public function votes() {
        return $this->hasMany('TopicVote');
    }

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeHot($query) {
        return $query->orderBy('view_count', 'desc');
    }

    public function coverImage() {
        if (File::exists($this->coverImagePath()) === true) {
            return asset('/attachments/cover/'.$this->cover);
        }else{
            return asset('/assets/client/img/no-cover.png');
        }
    }

    public function answerAImage() {
        return asset('/attachments/answer_image/a/'.$this->answer_a_image);
    }

    public function answerBImage() {
        return asset('/attachments/answer_image/b/'.$this->answer_b_image);
    }

    public function coverImagePath() {
        return public_path().'/attachments/cover/'.$this->cover;
    }

    public function answerAImagePath() {
        return public_path().'/attachments/answer_image/a/'.$this->answer_a_image;
    }

    public function answerBImagePath() {
        return public_path().'/attachments/answer_image/b/'.$this->answer_b_image;
    }

}
