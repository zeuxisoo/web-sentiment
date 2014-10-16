<?php
class UserController extends \BaseController {

	public function show($username) {
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

}
