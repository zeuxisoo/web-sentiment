@extends('layouts.frontend')

@section('container')
    <div class="search">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('views.search.heading') }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="{{ route('search.index') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="keyword" class="col-sm-2 control-label">{{ trans('views.search.keyword') }}</label>
                            <div class="col-sm-10">
                                <input type="keyword" class="form-control" name="keyword" id="keyword" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">{{ trans('views.search.submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
