<?php
class TopicController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
	}

	public function create() {
		return View::make('topics.create');
	}

	public function store() {

	}

	public function show($id) {

	}

	public function edit($id) {

	}

	public function update($id) {

	}

	public function destroy($id) {

	}

}
