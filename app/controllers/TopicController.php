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
		$topic = Topic::with('User')->findOrFail($id);

		return View::make('topics.show', compact('topic'));
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

}
