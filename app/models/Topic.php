<?php
use Conner\Tagging\TaggableTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Topic extends Eloquent {

    const STATUS_PUBLIC    = 'public';
    const STATUS_PROTECTED = 'protected';

    use SoftDeletingTrait;
    use TaggableTrait;
    use TopicStatusTrait;

    protected $table = 'topic';

    protected $fillable = [
        'user_id', 'topic_category_id', 'subject', 'cover', 'description',
        'answer_a_text', 'answer_b_text', 'answer_a_image', 'answer_b_image'
    ];

    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('User');
    }

    public function category() {
        return $this->belongsTo('TopicCategory', 'topic_category_id');
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

    public function scopeWithCategoryCache($query, $minutes = 10) {
        return $query->with(['category' => function($query) {
            $query->remember(10);
        }]);
    }

    public function ensureACover() {
        if (File::exists($this->coverAImagePath()) === true && File::isFile($this->coverAImagePath()) === true) {
            return $this->coverAImage();
        }else{
            return asset('/assets/client/img/no-cover.png');
        }
    }

    public function ensureBCover() {
        if (File::exists($this->coverBImagePath()) === true && File::isFile($this->coverBImagePath()) === true) {
            return $this->coverBImage();
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

    public function coverAImage() {
        return asset('/attachments/cover_image/a/'.$this->answer_a_image);
    }

    public function coverBImage() {
        return asset('/attachments/cover_image/b/'.$this->answer_b_image);
    }

    public function answerAImagePath() {
        return public_path().'/attachments/answer_image/a/'.$this->answer_a_image;
    }

    public function answerBImagePath() {
        return public_path().'/attachments/answer_image/b/'.$this->answer_b_image;
    }

    public function coverAImagePath() {
        return public_path().'/attachments/cover_image/a/'.$this->answer_a_image;
    }

    public function coverBImagePath() {
        return public_path().'/attachments/cover_image/b/'.$this->answer_b_image;
    }

}
