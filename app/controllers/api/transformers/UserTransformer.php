<?php
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {

    public function transform(User $user) {
        return [
            'id'        => $user->id,
            'username'  => $user->username,
            'email'     => $user->email,
            'confirmed' => $user->confirmed,
        ];
    }

}
