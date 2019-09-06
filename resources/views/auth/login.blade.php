@extends('himik')
@section('title')

    <title>ОПТхимик - вход</title>

    @stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin-top: 40px;box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                <div class="panel-heading">Вход</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input style="width: 179px;
    display: inline-block;" id="password" type="password" class="form-control" name="password" required>
                                <span style="    display: inline-block;
    width: 160px;
    padding: 0px;
    vertical-align: top;
    border-left: none;
    margin-left: -10px;" class="form-control"><a class="btn btn-link" href="http://opt-himik.ru/password/reset">
                                    Забыли пароль?
                                </a><span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <button type="submit" class="button-login btn" style="    background-color: #ffa400;
    border-color: #ffffff;
    color: white;
    font-weight: bold;
    height: 45px;
    width: 190px;
    font-size: 14pt;">
                                        Вход
                                    </button>
                                    <label>
                                        <input type="checkbox" name="remember"> Запомнить меня
                                    </label>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
