@extends('himik')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <div class="panel-heading">Добавить новость</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/addblog') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Название</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Содержание</label>

                                <div class="col-md-6">
                                    <textarea id="email" type="text" class="form-control" name="content" value="{{ old('content') }}" required></textarea>

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Источник</label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control" name="url" required>

                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Изображение</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="file" class="form-control" name="file" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">

                                <div class="form-group">
                                    <input id="password" type="hidden" class="form-control" name="status" required value="0">

                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Создать новость
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection