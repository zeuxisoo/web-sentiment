<?php
class TopicController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth', [
			'except' => ['show']
		]);

		$this->attachment_path = public_path().'/attachments';
	}

	public function create() {
		$categories = TopicCategory::all();

		return View::make('topics.create', compact('categories'));
	}

	public function store() {
		$validator = Validator::make(Input::all(), [
			'subject'           => 'required',
			'topic_category_id' => 'required|exists:topic_category,id',
			'description'       => 'required',
			'answer_a_text'     => 'required',
			'answer_b_text'     => 'required',
			'cover'             => 'image',
			'answer_a_image'    => 'image',
			'answer_b_image'    => 'image',
		]);

		if ($validator->fails()) {
			return Redirect::route('topic.create')->withErrors($validator)->withInput();
		}else{
			$attachment_path = $this->attachment_path;

			$cover          = Input::file('cover');
			$answer_a_image = Input::file('answer_a_image');
			$answer_b_image = Input::file('answer_b_image');

			if ($cover) {
				$extension = $cover->getClientOriginalExtension() ?: 'png';
				$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
				$filePath  = $attachment_path.'/cover/'.$fileName;

				$cover = Image::canvas(64, 64, '#FFFFFF')->insert(
					Image::make($cover)->resize(64, null, function ($constraint) {
	    				$constraint->aspectRatio();
	    				$constraint->upsize();
					}),
					'center'
				)->save($filePath, 100);
			}

			if ($answer_a_image) {
				$extension = $answer_a_image->getClientOriginalExtension() ?: 'png';
				$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
				$filePath  = $attachment_path.'/answer_image/a/'.$fileName;

				$answer_a_image = Image::canvas(530, 530, '#FFFFFF')->insert(
					Image::make($answer_a_image)->resize(530, null, function ($constraint) {
	    				$constraint->aspectRatio();
	    				$constraint->upsize();
					}),
					'center'
				)->save($filePath, 100);
			}

			if ($answer_b_image) {
				$extension = $answer_b_image->getClientOriginalExtension() ?: 'png';
				$fileName  = sprintf("%s_%s.%s", date("YmdHis"), str_random(12), $extension);
				$filePath  = $attachment_path.'/answer_image/b/'.$fileName;

				$answer_b_image = Image::canvas(530, 530, '#FFFFFF')->insert(
					Image::make($answer_b_image)->resize(530, null, function ($constraint) {
	    				$constraint->aspectRatio();
	    				$constraint->upsize();
					}),
					'center'
				)->save($filePath, 100);
			}

			$input_data = array_merge(
				Input::only('subject', 'topic_category_id', 'description', 'answer_a_text', 'answer_b_text'),
				[
					'user_id'        => Auth::user()->id,
					'cover'          => $cover ? $cover->basename : "",
					'answer_a_image' => $answer_a_image ? $answer_a_image->basename : "",
					'answer_b_image' => $answer_b_image ? $answer_b_image->basename : ""
				]
			);

			$topic = Topic::create($input_data);
			$topic->tag(Input::get('tags'));

			return Redirect::route('topic.create')->withNotice(trans('controllers.topic.create_success'));
		}
	}

	public function show($id) {
		$topic      = Topic::findOrFail($id);
		$comments   = $topic->comments()->orderBy('created_at', 'asc')->with('user')->get();
		$my_vote    = TopicVote::topicAndUser($topic, Auth::user())->first();
		$vote_count = TopicVote::selectRaw("
            SUM(answer='A') AS answer_a_count,
            SUM(answer='B') AS answer_b_count
        ")->whereTopicId($topic->id)->where(function($query) {
            $query->where('answer', 'A')->orWhere('answer', 'B');
        })->first(['answer_a_count', 'answer_b_count']);

        // View count
        $viewed_topic_ids = Session::get('viewed_topic_ids', []);

        if (empty($viewed_topic_ids) === true || in_array($topic->id, $viewed_topic_ids) === false) {
        	$topic->increment('view_count');

        	array_push($viewed_topic_ids, $topic->id);

        	Session::put('viewed_topic_ids', $viewed_topic_ids);
        }

		return View::make('topics.show', compact('topic', 'comments', 'my_vote', 'vote_count'));
	}

	public function edit($id) {
		$topic = Topic::with('User')->findOrFail($id);

		if ($topic->user_id !== Auth::user()->id) {
			return Redirect::route('topic.show', ['id' => $topic->id])->withError(trans('controllers.topic.not_topic_owner'));
		}else{
			$tags       = join(',', $topic->tagNames());
			$categories = TopicCategory::all();

			return View::make('topics.edit', compact('topic', 'tags', 'categories'));
		}
	}

	public function update($id) {
		$topic = Topic::with('User')->findOrFail($id);

		if ($topic->user_id !== Auth::user()->id) {
			return Redirect::route('topic.show', ['id' => $topic->id])->withError(trans('controllers.topic.not_topic_owner'));
		}else{
			$validator = Validator::make(Input::all(), [
				'subject'           => 'required',
				'topic_category_id' => 'required|exists:topic_category,id',
				'description'       => 'required',
				'answer_a_text'     => 'required',
				'answer_b_text'     => 'required',
				'cover'             => 'image',
				'answer_a_image'    => 'image',
				'answer_b_image'    => 'image',
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
					Input::only('subject', 'topic_category_id', 'description', 'answer_a_text', 'answer_b_text'),
					[
						'cover'          => $cover ? $cover->basename : $topic->cover,
						'answer_a_image' => $answer_a_image ? $answer_a_image->basename : $topic->answer_a_image,
						'answer_b_image' => $answer_b_image ? $answer_b_image->basename : $topic->answer_b_image
					]
				);

				$topic->update($input_data);
				$topic->retag(Input::get('tags'));

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

			$topic_comment = TopicComment::create($input_data);

			return Redirect::to(URL::previous().'#topic-comment-'.$topic_comment->id)->withNotice(trans('controllers.topic.comment_success'));
		}
	}

	public function vote($id, $answer) {
		$topic = Topic::with('User')->findOrFail($id);

		Validator::extend('only_vote_once', function($attribute, $value, $parameters) use ($topic) {
			return TopicVote::topicAndUser($topic, Auth::user())->count() <= 0;
		});

		$validator = Validator::make(Route::getCurrentRoute()->parameters(), [
			'answer' => 'in:a,b|only_vote_once',
		], [
			'only_vote_once' => trans('controllers.topic.only_vote_once')
		]);

		if ($validator->fails()) {
			return Redirect::route('topic.show', ['id' => $topic->id])->withErrors($validator)->withInput();
		}else{
			TopicVote::create([
				'topic_id' => $topic->id,
				'user_id'  => Auth::user()->id,
				'answer'   => strtoupper($answer)
			]);

			return Redirect::route('topic.show', ['id' => $topic->id])->withNotice(trans('controllers.topic.vote_success'));
		}
	}

	public function report($id) {
		$topic = Topic::with('User')->findOrFail($id);

		Validator::extend('only_report_once', function($attribute, $value, $parameters) use ($topic) {
			return TopicReport::topicAndUser($topic, Auth::user())->count() <= 0;
		});

		$validator = Validator::make(Route::getCurrentRoute()->parameters(), [
			'id' => 'only_report_once',
		], [
			'only_report_once' => trans('controllers.topic.only_report_once')
		]);

		if ($validator->fails()) {
			return Redirect::route('topic.show', ['id' => $topic->id])->withErrors($validator)->withInput();
		}else{
			$sentiment_report_configs = Config::get('sentiment.report');
			$total_report_number      = TopicReport::whereTopicId($topic->id)->count();

			if ($total_report_number < $sentiment_report_configs['max_limit']) {
				TopicReport::create([
					'user_id'  => Auth::user()->id,
					'topic_id' => $topic->id,
				]);
			}else{
				Mail::send('emails.topic.report', compact('topic'), function($message) use ($sentiment_report_configs, $topic) {
					$message->to($sentiment_report_configs['mail_to'], 'Webmaster')->subject('Topic report in '.$topic->id);
				});
			}

			return Redirect::route('topic.show', ['id' => $topic->id])->withNotice(trans('controllers.topic.report_success'));
		}
	}

}
