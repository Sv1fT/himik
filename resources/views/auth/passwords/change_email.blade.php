@extends('himik')
@section('title')

    <title>ОПТхимик - Смена Email</title>

@stop
<!-- Main Content -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" style="margin-top: 40px;box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                    <div class="panel-heading">Изменить email</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if (session('danger'))
                            <div class="alert alert-danger">
                                {{ session('danger') }}
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/change/email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('old_email') ? ' has-error' : '' }}">
                                <label for="old_email" class="col-md-4 control-label">Ваш E-Mail </label>

                                <div class="col-md-6">
                                    <input id="old_email" type="email" class="form-control" name="old_email" value="{{ old('old_email') }}" required>

                                    @if ($errors->has('old_email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('old_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Введите новый E-Mail </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-login w-100" style="    background-color: #ffa400;
    border-color: #ffffff;
    color: white;
    font-weight: bold;
    height: 45px;
    width: 320px;
    font-size: 14pt;">
                                        Изменить email
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
