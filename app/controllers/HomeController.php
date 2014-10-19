<?php
class HomeController extends BaseController {

	public function index() {
        $latest_topics = Topic::latest()->take(5)->with('user')->get();
        $hot_topics    = Topic::hot()->take(5)->with('user')->get();
        $random_users  = User::random(6);

		return View::make('homes.index', compact('latest_topics', 'hot_topics', 'random_users'));
	}

    public function hot() {
        return "TODO: hot";
    }

    public function latest() {
        return "TODO: latest";
    }

}
