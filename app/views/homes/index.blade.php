@extends('layouts.frontend')

@section('container')
    <div id="index">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Hot topics</div>
                <div class="panel-body">
                    @for ($i=0; $i<5; $i++)
                        <div class="topic">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="username">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Topic name</h4>
                                    <div class="description">
                                        <small class="text-muted">
                                            Some description Some description Some description Some description Some description Some description Some description Some description Some description Some description
                                        </small>
                                    </div>
                                    <div class="status">
                                        <small class="text-muted">@username</small>
                                        <small class="text">at</small>
                                        <small class="text-muted">5 secords ago</small>
                                        ,
                                        <small class="text-muted">10 peoples voted</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Latest topics</div>
                <div class="panel-body">
                    @for ($i=0; $i<5; $i++)
                        <div class="topic">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="username">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Topic name</h4>
                                    <div class="description">
                                        <small class="text-muted">
                                            Some description Some description Some description Some description Some description Some description Some description Some description Some description Some description
                                        </small>
                                    </div>
                                    <div class="status">
                                        <small class="text-muted">@username</small>
                                        <small class="text">at</small>
                                        <small class="text-muted">5 secords ago</small>
                                        ,
                                        <small class="text-muted">10 peoples voted</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <a href="{{ url('/topic/create') }}" class="btn btn-info btn-lg">Create your Topics</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Activiti users</div>
                <div class="panel-body list-group">
                    <a href="#" class="list-group-item">1. @usernameA</a>
                    <a href="#" class="list-group-item">2. @usernameB</a>
                    <a href="#" class="list-group-item">3. @usernameC</a>
                    <a href="#" class="list-group-item">4. @usernameD</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Random users</div>
                <div class="panel-body row">
                    @for ($i=0; $i<6; $i++)
                        <div class="col-md-4">
                            <a href="#" class="thumb-random"><img src="http://placehold.it/64x64" class="img-rounded"></a>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Advert</div>
                <div class="panel-body">
                    <img src="http://placehold.it/225x225">
                </div>
            </div>
        </div>
    </div>
@stop
