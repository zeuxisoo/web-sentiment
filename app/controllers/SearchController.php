<?php
class SearchController extends BaseController {

    public function index() {
        if (Request::isMethod('post') === true) {
            $validator = Validator::make(Input::all(), [
                'keyword' => 'required',
            ]);

            if ($validator->fails() === true) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                return Redirect::route('search.result', [
                    'keyword' => rawurlencode(Input::get('keyword')),
                ]);
            }
        }else{
            return View::make('searches.index');
        }
    }

    public function result() {
        $validator = Validator::make(Input::all(), [
            'keyword' => 'required',
        ]);

        if ($validator->fails() === true) {
            return Redirect::route('search.index')->withErrors($validator)->withInput();
        }else{
            $keyword = rawurldecode(Input::get('keyword'));

            $topics = Topic::where('subject', 'like', '%'.$keyword.'%')->simplePaginate(20);

            return View::make('searches.result', compact('keyword', 'topics'));
        }
    }

}
