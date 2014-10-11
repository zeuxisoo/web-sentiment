<?php
class HomeController extends BaseController {

	public function index() {
		return View::make('homes.index', [
			'environment' => App::environment()
		]);
	}

}
