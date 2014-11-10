<?php
class HomeController extends BaseController {

	public function index() {
        $latest_topics = Topic::latest()->take(5)->with('user')->withCategoryCache(5)->get();
        $hot_topics    = Topic::hot()->take(5)->with('user')->withCategoryCache(5)->get();
        $random_users  = User::random(6);

		return View::make('homes.index', compact('categories', 'latest_topics', 'hot_topics', 'random_users'));
	}

    public function hot() {
        $hot_topics   = Topic::hot()->with('user', 'category')->simplePaginate(20);
        $random_users = User::random(6);

        return View::make('homes.hot', compact('hot_topics', 'random_users'));
    }

    public function latest() {
        $latest_topics = Topic::latest()->with('user', 'category')->simplePaginate(20);
        $random_users  = User::random(6);

        return View::make('homes.latest', compact('latest_topics', 'random_users'));
    }

}
