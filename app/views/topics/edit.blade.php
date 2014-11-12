@extends('layouts.frontend')

@section('container')
    <div id="topic-edit">
        <div class="container">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('topic.update', ['id' => $topic->id]) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ trans('views.topic.edit_topic') }}</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="subject" class="col-sm-2 control-label">{{ trans('views.topic.subject') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="{{ trans('views.topic.subject') }}" value="{{{ Input::old('subject') ?: $topic->subject }}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category" class="col-sm-2 control-label">{{ trans('views.topic.category') }}</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="topic_category_id">
                                            @foreach($categories as $category)
                                                @if ($topic->topic_category_id === $category->id)
                                                    <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">{{ trans('views.topic.description') }}</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description" name="description" rows="5">{{{ Input::old('description') ?: $topic->description }}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="answer_a_text" class="col-sm-2 control-label">{{ trans('views.topic.answer_a_text') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="answer_a_text" name="answer_a_text" placeholder="{{ trans('views.topic.answer_a_text') }}" value="{{{ Input::old('answer_a_text') ?: $topic->answer_a_text }}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="answer_b_text" class="col-sm-2 control-label">{{ trans('views.topic.answer_b_text') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="answer_b_text" name="answer_b_text" placeholder="{{ trans('views.topic.answer_b_text') }}" value="{{{ Input::old('answer_b_text') ?: $topic->answer_b_text }}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tags" class="col-sm-2 control-label">{{ trans('views.topic.tags') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tags" name="tags" placeholder="{{ trans('views.topic.tags') }}" value="{{{ Input::old('tags') ?: $tags }}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ trans('views.topic.cover') }}
                                &nbsp;
                                <a href="#" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="panel-body text-center">
                                <input type="file" class="form-control file-input" id="cover" name="cover" placeholder="{{ trans('views.topic.cover') }}" value="{{ Input::old('cover') }}">
                                <br>
                                @if (File::exists($topic->coverImagePath()) === true && File::isFile($topic->coverImagePath()) === true )
                                    <a href="#" class="thumbnail">
                                        <img src="{{{ $topic->coverImage() }}}" class="img-rounded">
                                    </a>
                                @else
                                    <div class="alert alert-info">{{ trans('views.topic.no_images') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ trans('views.topic.answer_a_image') }}
                                &nbsp;
                                <a href="#" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="panel-body">
                                <input type="file" class="form-control file-input" id="answer_a_image" name="answer_a_image" placeholder="{{ trans('views.topic.answer_a_image') }}" value="{{ Input::old('answer_a_image') }}">
                                <br>
                                @if (File::exists($topic->answerAImagePath()) === true && File::isFile($topic->answerAImagePath()) === true)
                                    <a href="#" class="thumbnail">
                                        <img src="{{{ $topic->answerAImage() }}}" class="img-rounded">
                                    </a>
                                @else
                                    <div class="alert alert-info">{{ trans('views.topic.no_images') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ trans('views.topic.answer_b_image') }}
                                &nbsp;
                                <a href="#" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="panel-body">
                                <input type="file" class="form-control file-input" id="answer_b_image" name="answer_b_image" placeholder="{{ trans('views.topic.answer_b_image') }}" value="{{ Input::old('answer_b_image') }}">
                                <br>
                                @if (File::exists($topic->answerBImagePath()) === true && File::isFile($topic->answerBImagePath()) === true)
                                    <a href="#" class="thumbnail">
                                        <img src="{{{ $topic->answerBImage() }}}" class="img-rounded">
                                    </a>
                                @else
                                    <div class="alert alert-info">{{ trans('views.topic.no_images') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <button type="submit" class="btn btn-success">{{ trans('views.topic.update') }}</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop
