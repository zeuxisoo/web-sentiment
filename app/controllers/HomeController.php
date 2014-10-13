<?php
class HomeController extends BaseController {

	public function index() {
        $latest_topics = Topic::with('User')->latest()->take(5)->get();
        $hot_topics    = Topic::with('User')->hot()->take(5)->get();
        $random_users  = User::random(6);

		return View::make('homes.index', compact('latest_topics', 'hot_topics', 'random_users'));
	}

}
