<?php
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthAPIController extends BaseAPIController {

    public function login() {
        $repo  = App::make('AuthRepository');
        $input = Input::all();

        if ($repo->login($input)) {
            return $this->response->item(Auth::user(), new SingleObjectTransformer);
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            throw new AccessDeniedHttpException($err_msg);
        }
    }

    public function logout() {
        Confide::logout();

        return $this->sendOK("logout success");
    }

}
