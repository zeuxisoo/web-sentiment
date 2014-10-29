<?php
class TopicCategoryController extends BaseController {

    public function index($code = "") {
        if (empty($code) === true) {
            $category = TopicCategory::first(['code']);

            return Redirect::route('topic.category.index_with_code', ['code' => $category->code]);
        }else{
            $category   = TopicCategory::whereCode($code)->firstOrFail();
            $categories = TopicCategory::latest()->get();
            $topics     = Topic::whereTopicCategoryId($category->id)->with('user', 'category')->latest()->paginate(12);

            return View::make('topics.categories.index', compact('category', 'categories', 'topics'));
        }
    }

}
