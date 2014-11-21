<?php
class MessageController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function index() {
        $messages = Message::whereReceiverId(Auth::user()->id)->orderBy('created_at', 'desc')->with('sender')->simplePaginate(12);

        return View::make('messages/index', compact('messages'));
    }

    public function create() {
        $username   = Input::get('username');   // For global
        $message_id = Input::get('message_id'); // For inbox
        $subject    = "";

        if (empty($message_id) === false) {
            $message = Message::whereReceiverId(Auth::user()->id)->with('sender')->find($message_id);

            if (empty($message->subject) === false) {
                $username = $message->sender->username;
                $subject  = "Reply: " . e($message->subject);
            }
        }

        return View::make('messages/create', compact('username', 'subject'));
    }

    public function store() {
        $validator = Validator::make(Input::all(), [
            'username' => 'required|exists:user,username',
            'subject'  => 'required',
            'content'  => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::route('message.create')->withErrors($validator)->withInput();
        }else{
            $receiver_user = User::where('username', Input::get('username'))->first();

            $input_data = array_merge(
                Input::only('subject', 'content'),
                [
                    'sender_id'   => Auth::user()->id,
                    'receiver_id' => $receiver_user->id
                ]
            );

            $message = Message::create($input_data);

            return Redirect::route('message.create')->withNotice(trans('controllers.message.create_success'));
        }
    }

    public function show($message_id) {
        $message = Message::whereReceiverId(Auth::user()->id)->with('sender')->findOrFail($message_id);
        $message->have_read = 1;
        $message->save();

        return View::make('messages/show', compact('message'));
    }

    public function delete($message_id) {
        $message = Message::whereReceiverId(Auth::user()->id)->findOrFail($message_id);
        $message->delete();

        return Redirect::route('message.index')->withNotice(trans('controllers.message.delete_success'));
    }

    public function unread($message_id) {
        $message = Message::whereReceiverId(Auth::user()->id)->with('sender')->findOrFail($message_id);
        $message->have_read = 0;
        $message->save();

        return Redirect::route('message.index')->withNotice(trans('controllers.message.unread_success'));
    }


}
