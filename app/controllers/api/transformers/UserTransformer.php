<?php
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {

    public function transform(User $user) {
        return [
            'username'   => $user->username,
            'created_at' => $user->created_at->diffForHumans(),
            'updated_at' => $user->updated_at->diffForHumans(),
        ];
    }

}
