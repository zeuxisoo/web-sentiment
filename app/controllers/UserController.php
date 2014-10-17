<?php
class UserController extends \BaseController {

	public function __construct() {
		$this->beforeFilter('auth', ['except' => 'profile']);
	}

	public function profile($username) {
		$user        = User::whereUsername($username)->firstOrFail();
		$topic_count = $user->topics()->count();
		$vote_count  = $user->topicVotes()->count();

		$topics = $votes = $comments = [];

		$tab_name = Input::get('tab', 'topics');
		switch($tab_name) {
			case "topics":
				$topics = $user->topics()->latest()->take(20)->get();
				break;
			case "votes":
				$votes = $user->topicVotes()->latest()->take(20)->with('topic')->get();
				break;
			case "comments":
				$comments = $user->topicComments()->latest()->take(20)->with('topic')->get();
				break;
		}

		return View::make('users.show', compact('user', 'topic_count', 'vote_count', 'tab_name', 'topics', 'votes', 'comments'));
	}

	public function settingsProfile() {
		$user = Auth::user();

		if (Request::isMethod('post') === true) {
			$validator = Validator::make(Input::all(), [
				'username' => 'alpha_dash|min:4|unique:user,username',
				'email'    => 'email|unique:user,email',
			]);

			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput();
			}else{
				$input_data = Input::only(['username', 'email']);

				foreach($input_data as $key => $input) {
					if (empty($input) === true) {
						unset($input_data[$key]);
					}
				}

				$user->update($input_data);

				return Redirect::back()->withNotice(trans('controllers.user.update_profile_success'));
			}
		}else{
			return View::make('users.settings.profile', compact('user'));
		}
	}

	public function settingsPassword() {
		$user = Auth::user();

		if (Request::isMethod('post') === true) {
			Validator::extend('password_match', function($attribute, $value, $parameters) {
				return Hash::check($value, Auth::user()->password);
			});

			$validator = Validator::make(Input::all(), [
				'old_password'     => 'required|password_match:old_password',
				'new_password'     => 'required|min:8|different:old_password',
				'confirm_password' => 'required|same:new_password',
			], [
				'password_match' => trans('controllers.user.password_not_match')
			]);

			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput();
			}else{
				// By pass package: Zizaco\Confide\UserValidator->validatePassword
				$user->password              = Input::get('new_password');
				$user->password_confirmation = Input::get('new_password');
				$user->save();

				return Redirect::back()->withNotice(trans('controllers.user.update_password_success'));
			}
		}else{
			return View::make('users.settings.password', compact('user'));
		}
	}

}
