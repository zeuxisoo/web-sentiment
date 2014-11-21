<?php
use Conner\Tagging\TaggableTrait;

class Message extends Eloquent {

    use TaggableTrait;

    protected $table = 'message';

    protected $fillable = ['sender_id', 'receiver_id', 'category', 'subject', 'content', 'have_read'];

    public function sender() {
        return $this->belongsTo('User', 'sender_id');
    }

}
