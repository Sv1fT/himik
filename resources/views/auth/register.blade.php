@extends('himik')
@section('title')

    <title>ОПТхимик - Регистрация</title>

@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="margin-top: 40px;box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                <div class="panel-heading">Регистрация</div>
                <div class="panel-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-12">Для полного доступа к услугам портала "ОПТхимик" необходимо авторизоваться или зарегистрироваться</label>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Подтверждение пароля</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group" style="    margin: 0 auto;padding-left:243px;">{!! Recaptcha::render() !!}
                            <div class="mt-4 mx-auto" style=""><div class="">
                                    <input style="width: 20px" type="checkbox" class="float-left form-control ml-2" required=""><p style="
    display: inline-block;
    width: 360px;
    " class="ml-3">Я соглашаюсь с <a href="" data-toggle="modal" data-target="#exampleModalLong">пользовательским соглашением и политикой конфиденциальности</a> портала ОПТхимик</p></div>

                                <button type="submit" class="btn btn-login" style="
    background-color: #ffa400;
    border-color: #ffffff;
    color: white;
    font-weight: bold;
    height: 45px;
    float:  left;
    width: 340px;
    font-size: 14pt;
    ">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </div>



                                <input id="password" type="hidden" class="form-control" name="status" required value="0">

                                <input id="password" type="hidden" class="form-control" name="showuser" required value="0">

                                <input id="password" type="hidden" class="form-control" name="token" required value="<?=str_random(60)?>">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" style="    margin: 0 auto;
    width: 100%;">

                            </div>
                        </div>


                        <div id="overlay"></div><!-- Пoдлoжкa -->
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="container">
    <div class="row">

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {!! setting('site.license_register') !!}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){ // вся мaгия пoсле зaгрузки стрaницы
            $('#confid').click(function (event) { // лoвим клик пo ссылки с id="go"
                event.preventDefault(); // выключaем стaндaртную рoль элементa
                $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
                    function () { // пoсле выпoлнения предъидущей aнимaции
                        $('.modal_form')
                            .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                            .animate({opacity: 1, top: '30%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
                    });
            });
            /* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
            $('#modal_close, #overlay').click(function () { // лoвим клик пo крестику или пoдлoжке
                $('.modal_form')
                    .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                        function () { // пoсле aнимaции
                            $(this).css('display', 'none'); // делaем ему display: none;
                            $('#overlay').fadeOut(400); // скрывaем пoдлoжку
                        }
                    );
            });
        });
    </script>
@endsection
