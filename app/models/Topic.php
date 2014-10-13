<?php
class Topic extends Eloquent {

    protected $table = 'topic';

    protected $fillable = [
        'user_id', 'subject', 'cover', 'description',
        'answer_a_text', 'answer_b_text', 'answer_a_image', 'answer_b_image'
    ];

}
