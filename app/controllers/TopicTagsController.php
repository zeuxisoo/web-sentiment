<?php
use Conner\Tagging\Tag;

class TopicTagsController extends BaseController {

    public function index($slug = "") {
        $slug   = ucfirst(rawurldecode($slug));
        $tags   = Tag::orderBy('count', 'desc')->get();
        $topics = Topic::withAnyTag([$slug])->with('user', 'category')->latest()->paginate(12);

        return View::make('topics.tags.index', compact('slug', 'tags', 'topics'));
    }

}
