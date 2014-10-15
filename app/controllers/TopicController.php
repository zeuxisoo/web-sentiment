<?php
class TopicController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth', [
			'except' => ['show']
		]);

		$this->attachment_path = public_path().'/attachments';
	}

	public function create() {
		return View::make('topics.create');
	}

	public function store() {
		$validator = Validator::make(Input::all(), [
			'subject'        => 'required',
			'description'    => 'required',
			'answer_a_text'  => 'required',
			'answer_b_text'  => 'required',
			'cover'          => 'image',
			'answer_a_image' => 'image',
			'answer_b_image' => 'image',
		]);

		if ($validator->fails()) {
			return Redirect::to('topic/create')->withErrors($validator)->withInput();
		}else{
			$attachment_path = $this->attachment_path;

			$cover          = Input::file('cover');
			$answer_a_image = Input::file('answer_a_image');
			$answer_b_image = Input::file('answer_b_image');

			if ($cover) {
				$extension = $cover->getClientOriginalExtension() ?: 'png';
				$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
				$filePath  = $attachment_path.'/cover/'.$fileName;

				$cover = Image::make($cover)->resize(64, 64)->save($filePath, 100);
			}

			if ($answer_a_image) {
				$extension = $answer_a_image->getClientOriginalExtension() ?: 'png';
				$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
				$filePath  = $attachment_path.'/answer_image/a/'.$fileName;

				$answer_a_image = Image::make($answer_a_image)->resize(530, 530)->save($filePath, 100);
			}

			if ($answer_b_image) {
				$extension = $answer_b_image->getClientOriginalExtension() ?: 'png';
				$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
				$filePath  = $attachment_path.'/answer_image/b/'.$fileName;

				$answer_b_image = Image::make($answer_b_image)->resize(530, 530)->save($filePath, 100);
			}

			$input_data = array_merge(
				Input::only('subject', 'description', 'answer_a_text', 'answer_b_text'),
				[
					'user_id'        => Auth::user()->id,
					'cover'          => $cover ? $cover->basename : "",
					'answer_a_image' => $answer_a_image ? $answer_a_image->basename : "",
					'answer_b_image' => $answer_b_image ? $answer_b_image->basename : ""
				]
			);

			Topic::create($input_data);

			return Redirect::to('topic/create')->withNotice(trans('controllers.topic.create_success'));
		}
	}

	public function show($id) {
		$topic      = Topic::with('User')->findOrFail($id);
		$my_vote    = TopicVote::topicAndUser($topic, Auth::user())->first();
		$vote_count = TopicVote::selectRaw("
                SUM(choice='A') AS answer_a_count,
                SUM(choice='B') AS answer_b_count
            ")->topicAndUser($topic, Auth::user())->where(function($query) {
                $query->where('choice', 'A')->orWhere('choice', 'B');
            })->first(['answer_a_count', 'answer_b_count']);

		return View::make('topics.show', compact('topic', 'my_vote', 'vote_count'));
	}

	public function edit($id) {
		$topic = Topic::with('User')->findOrFail($id);

		if ($topic->user_id !== Auth::user()->id) {
			return Redirect::to('topic/show/'.$topic->id)->withError(trans('controllers.topic.not_topic_owner'));
		}else{
			return View::make('topics.edit', compact('topic'));
		}
	}

	public function update($id) {
		$topic = Topic::with('User')->findOrFail($id);

		if ($topic->user_id !== Auth::user()->id) {
			return Redirect::to('topic/show/'.$topic->id)->withError(trans('controllers.topic.not_topic_owner'));
		}else{
			$validator = Validator::make(Input::all(), [
				'subject'        => 'required',
				'description'    => 'required',
				'answer_a_text'  => 'required',
				'answer_b_text'  => 'required',
				'cover'          => 'image',
				'answer_a_image' => 'image',
				'answer_b_image' => 'image',
			]);

			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput();
			}else{
				$attachment_path = $this->attachment_path;

				$cover          = Input::file('cover');
				$answer_a_image = Input::file('answer_a_image');
				$answer_b_image = Input::file('answer_b_image');

				if ($cover) {
					$extension = $cover->getClientOriginalExtension() ?: 'png';
					$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
					$filePath  = $attachment_path.'/cover/'.$fileName;

					$cover = Image::make($cover)->resize(64, 64)->save($filePath, 100);

					if (File::exists($topic->coverImagePath()) === true) {
						File::delete($topic->coverImagePath());
					}
				}

				if ($answer_a_image) {
					$extension = $answer_a_image->getClientOriginalExtension() ?: 'png';
					$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
					$filePath  = $attachment_path.'/answer_image/a/'.$fileName;

					$answer_a_image = Image::make($answer_a_image)->resize(530, 530)->save($filePath, 100);

					if (File::exists($topic->answerAImagePath()) === true) {
						File::delete($topic->answerAImagePath());
					}
				}

				if ($answer_b_image) {
					$extension = $answer_b_image->getClientOriginalExtension() ?: 'png';
					$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
					$filePath  = $attachment_path.'/answer_image/b/'.$fileName;

					$answer_b_image = Image::make($answer_b_image)->resize(530, 530)->save($filePath, 100);

					if (File::exists($topic->answerBImagePath()) === true) {
						File::delete($topic->answerBImagePath());
					}
				}

				$input_data = array_merge(
					Input::only('subject', 'description', 'answer_a_text', 'answer_b_text'),
					[
						'cover'          => $cover ? $cover->basename : $topic->cover,
						'answer_a_image' => $answer_a_image ? $answer_a_image->basename : $topic->answer_a_image,
						'answer_b_image' => $answer_b_image ? $answer_b_image->basename : $topic->answer_b_image
					]
				);

				$topic->update($input_data);

				return Redirect::back()->withNotice(trans('controllers.topic.update_success'));
			}
		}
	}

	public function destroy($id) {

	}

	public function comment($id) {
		$topic = Topic::with('User')->findOrFail($id);

		$validator = Validator::make(Input::all(), [
			'content' => 'required',
		]);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$input_data = array_merge(
				Input::only(['content']),
				[
					'user_id'  => Auth::user()->id,
					'topic_id' => $topic->id,
				]
			);

			TopicComment::create($input_data);

			return Redirect::back()->withNotice(trans('controllers.topic.comment_success'));
		}
	}

	public function vote($id, $choice) {
		$topic = Topic::with('User')->findOrFail($id);

		Validator::extend('only_vote_once', function($attribute, $value, $parameters) use ($topic) {
			return TopicVote::topicAndUser($topic, Auth::user())->count() <= 0;
		});

		$validator = Validator::make(Route::getCurrentRoute()->parameters(), [
			'choice' => 'in:a,b|only_vote_once',
		], [
			'only_vote_once' => trans('controllers.topic.only_vote_once')
		]);

		if ($validator->fails()) {
			return Redirect::to('topic/show/'.$topic->id)->withErrors($validator)->withInput();
		}else{
			TopicVote::create([
				'topic_id' => $topic->id,
				'user_id'  => Auth::user()->id,
				'choice'   => strtoupper($choice)
			]);

			return Redirect::to('topic/show/'.$topic->id)->withNotice(trans('controllers.topic.vote_success'));
		}
	}

}
