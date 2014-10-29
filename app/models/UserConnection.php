<?php
class UserConnection extends Eloquent {

    protected $table = 'user_connection';

    protected $fillable = ['user_id', 'provider_name', 'provider_uid', 'email', 'display_name', 'first_name', 'last_name', 'profile_url', 'website_url', 'photo_url', 'tokens'];

    public function user() {
        return $this->belongsTo('User');
    }
}
