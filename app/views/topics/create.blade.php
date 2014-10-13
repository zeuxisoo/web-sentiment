@extends('layouts.frontend')

@section('container')
    <div id="topic-create">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.topic.create') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/topic/store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="subject" class="col-sm-2 control-label">{{ trans('views.topic.subject') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="{{ trans('views.topic.subject') }}" value="{{ Input::old('subject') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cover" class="col-sm-2 control-label">{{ trans('views.topic.cover') }}</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control file-input" id="cover" name="cover" placeholder="{{ trans('views.topic.cover') }}" value="{{ Input::old('cover') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">{{ trans('views.topic.description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" rows="5">{{ Input::old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="answer_a_text" class="col-sm-2 control-label">{{ trans('views.topic.answer_a_text') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="answer_a_text" name="answer_a_text" placeholder="{{ trans('views.topic.answer_a_text') }}" value="{{ Input::old('answer_a_text') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="answer_b_text" class="col-sm-2 control-label">{{ trans('views.topic.answer_b_text') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="answer_b_text" name="answer_b_text" placeholder="{{ trans('views.topic.answer_b_text') }}" value="{{ Input::old('answer_b_text') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="answer_a_image" class="col-sm-2 control-label">{{ trans('views.topic.answer_a_image') }}</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control file-input" id="answer_a_image" name="answer_a_image" placeholder="{{ trans('views.topic.answer_a_image') }}" value="{{ Input::old('answer_a_image') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="answer_b_image" class="col-sm-2 control-label">{{ trans('views.topic.answer_b_image') }}</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control file-input" id="answer_b_image" name="answer_b_image" placeholder="{{ trans('views.topic.answer_b_image') }}" value="{{ Input::old('answer_b_image') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">{{ trans('views.topic.submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
