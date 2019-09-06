@extends('himik')
@section('title')

    <title>ОПТхимик - Реклама</title>

@endsection
@section('content')

<style>
    .button_rek{
        width: 309px;
        height: 34px;
        border: 1px solid darkgray;
        border-radius: 5px;
        margin-bottom: 16px;
    }

</style>

    <div class="content">
        <div class="content-full">

            <div class="content-advertisiing">

                <div class="content-left">
                    <div class="tsb">

                        <div class="advertisiing row" style="    box-shadow: 0 0 10px rgba(0, 0, 0, 1);">
                            <h2 class="header-b" style="color: black; text-align: center">Реклама в Интернет – портале «ОПТхимик»</h2>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="col-md-5 text-center" >
                                <div data-uk-scrollspy="{cls:'uk-animation-scale-down', delay:500}" class="col-9 mx-auto" style="margin-top: 30px;">
                                    <img class="img-responsive" src="/image/logo.png">
                                </div>

                                <p data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:500}" style="text-align: justify;margin: 0 auto;margin-top: 25px">Если Вы решили разместить рекламу в Интернет – портале «ОПТхимик», то заполните форму обратной связи. После получения заказа с Вами свяжется менеджер по рекламе.</p>
                            </div>
                            <div class="col-md-7">
                                <form class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded" action="myadvertising">
                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="name" class="col-md-3 control-label" style="height: 34px;padding-top: 8px;margin-right: -20px">ФИО:</label>

                                            <div class="col-md-9">
                                                <input id="name" type="text" class="form-control" name="fio" value="" required="" autofocus="">

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="name" class="col-md-3 control-label" style="height: 34px;padding-top: 8px;margin-right: -20px">Телефон:</label>

                                            <div class="col-md-9">
                                                <input id="name" type="number" class="form-control" name="number" value="" required="" autofocus="">

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="name" class="col-md-3 control-label" style="height: 34px;padding-top: 8px;margin-right: -20px">Email:</label>

                                            <div class="col-md-9">
                                                <input id="name" type="email" class="form-control" name="email" value="" required="" autofocus="">

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="name" class="col-md-3 control-label" style="height: 34px;padding-top: 8px;margin-right: -20px">Сообщение:</label>

                                            <div class="col-md-9">
                                                <textarea style="height: 34px;" id="name" class="form-control" name="description" value="" required="" autofocus=""></textarea>
                                                <input type="submit" value="Заказать размещение рекламы">
                                            </div>
                                        </div>
                                        {{csrf_field()}}
                                        <div class="form-group">


                                            <div class="col-md-12">


                                            </div>
                                        </div>

                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








@endsection
