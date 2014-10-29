<?php
use OAuth\Common\Http\Exception\TokenResponseException;

class OAuthController extends \BaseController {

    public function connectWithFacebook() {
        $code          = Input::get('code');
        $facebook      = OAuth::consumer('Facebook');
        $provider_name = 'facebook';

        try {
            if (empty($code) === true) {
                $error             = Input::get('error');
                $error_code        = Input::get('error_code');
                $error_description = Input::get('error_description');

                if ($error == "access_denied") {
                    return Redirect::route('auth.login')->withError(trans('controllers.oauth.access_denied'));
                }else{
                    return Redirect::to(rawurldecode($facebook->getAuthorizationUri()));
                }
            }else{
                $tokens  = $facebook->requestAccessToken($code);
                $profile = json_decode($facebook->request( '/me' ), true);

                $provider_uid = array_key_exists('id', $profile) === true ? $profile['id'] : "";
                $username     = array_key_exists('username', $profile) === true ? $profile['username'] : "";
                $email        = array_key_exists('email', $profile) === true ? $profile['email'] : "";
                $display_name = array_key_exists('name', $profile) === true ? $profile['name'] : "";
                $first_name   = array_key_exists('first_name', $profile) === true ? $profile['first_name'] : "";
                $last_name    = array_key_exists('last_name', $profile) === true ? $profile['last_name'] : "";
                $profile_url  = array_key_exists('link', $profile) === true ? $profile['link'] : "";
                $website_url  = array_key_exists('website', $profile) === true ? $profile['website'] : "";
                $photo_url    = "https://graph.facebook.com/".$provider_uid."/picture?width=150&height=150";

                $user_connection = UserConnection::whereProviderName($provider_name)->whereProviderUid($provider_uid)->first();

                // If connection exists, return the user object
                if (empty($user_connection) === false) {
                    $user = $user_connection->user;
                }else{
                    // Try to find user record by email first
                    $user = User::whereEmail($email)->first();

                    // If user not exists, create one
                    if (empty($user->email) === true) {
                        $password        = password_hash(str_random(16), PASSWORD_BCRYPT);
                        $auth_repository = new AuthRepository();
                        $user            = $auth_repository->signup([
                            'username'              => substr(md5(join('/', [$provider_name, $provider_uid, $email, uniqid(), time()])), 0, 12),
                            'email'                 => $email,
                            'password'              => $password,
                            'password_confirmation' => $password
                        ]);
                    }

                    // Link (exists user or new user) to connection
                    UserConnection::create([
                        'user_id'       => $user->id,
                        'provider_name' => $provider_name,
                        'provider_uid'  => $provider_uid,
                        'email'         => $email,
                        'display_name'  => $display_name,
                        'first_name'    => $first_name,
                        'last_name'     => $last_name,
                        'profile_url'   => $profile_url,
                        'website_url'   => $website_url,
                        'photo_url'     => $photo_url,
                        'tokens'        => $tokens->getAccessToken(),
                    ]);
                }

                // Make user login
                app()['auth']->login($user, true);

                return Redirect::route('home.index');
            }
        }catch(TokenResponseException $e) {
            return Redirect::route('auth.login')->withError(trans('controllers.oauth.token_response_exception'));
        }catch(Exception $e) {
            return Redirect::route('auth.login')->withError(trans('controllers.oauth.unknown_exception'));
        }
    }

}
