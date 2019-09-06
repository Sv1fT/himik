@extends('himik')
@section('title')

    <title>ОПТхимик - Каталог компаний</title>

@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div id="modal_form" style="width: 780px;
    border-radius: 5px;
    border: 3px solid rgb(0, 0, 0);
    background: rgb(243, 243, 243);
    position: fixed;
    top: 50%;
    left: 38%;
    margin-top: -150px;
    margin-left: -150px;
    display: none;
    opacity: 1;
    z-index: 5;
    padding: 20px 10px;
    height: auto;"><!-- Сaмo oкнo -->
                <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
                <h2 style="color: black;">Добавить компанию в каталог "Нас рекомендуют"</h2>


                <span style="display: inline-block;vertical-align: top">
                                <form class="form-horizontal" method="post" enctype="application/x-www-form-urlencoded"
                                      style="display:block;width: 1120px" action="myadvertising">
                                    <div class="col-md-6" style="margin-top: 30px;">

                                        <div class="form-group">

                                            <label for="name" class="col-md-4 control-label"
                                                   style="height: 34px;padding-top: 8px;margin-right: -20px">ФИО:</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="fio" value=""
                                                       required="" autofocus="">

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="name" class="col-md-4 control-label"
                                                   style="height: 34px;padding-top: 8px;margin-right: -20px">Телефон:</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="number" value=""
                                                       required="" autofocus="">

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="name" class="col-md-4 control-label"
                                                   style="height: 34px;padding-top: 8px;margin-right: -20px">Email:</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="email" value=""
                                                       required="" autofocus="">

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="name" class="col-md-4 control-label"
                                                   style="height: 34px;padding-top: 8px;margin-right: -20px">Сообщение:</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="description"
                                                       value="" required="" autofocus="">

                                            </div>
                                        </div>
                                        {{csrf_field()}}
                                        <button style="width: 349px;height: 35px;background-color: #ffc20c;border-width: 1px;color: black;border-radius: 2px;margin-right: 75px;margin-bottom: 20px;float: right;">Отправить запрос</button>
                                    </div>
                                </form>
                            </span>
            </div>
            <div id="overlay"></div><!-- Пoдлoжкa -->
            <div class="col-12 col-md-8">
                <h1 class="header-b" style="color: black;padding-left: 10px;font-weight: bold;">Каталог компаний</h1>
                <div class="col-10 col-md-12 m-auto">


                    @foreach($companys as $item)


                        <div class="row align-items-center" style="text-align: left;padding-top: 10px;">
                                    <span class="col-12 col-md-3">
                                        @if(Illuminate\Support\Facades\Storage::disk('public')->exists($item->filename))
                                            <img class="img-responsive" src="/storage/{{$item->filename}}" alt="{{$item->company}}"
                                                 title="{{$item->company}}"
                                                 style="display: block;margin: 0 auto;">
                                        @else

                                            <img class="img-responsive" src="/image/not_found.jpg" alt="{{$item->company}}"
                                                 title="{{$item->company}}"
                                                 {{--style="width:160px;height: 160px;display: block;margin: 0 auto;">--}}
                                                 style="display: block;margin: 0 auto;">
                                        @endif
                                    </span>
                            <span class="col-12 col-md-9">


                                        @if($blogget->user_id == $item->user_id)
                                    <a class="region_link pl-0" style="color:#00008b;font-weight: bold"
                                       href="/blog/company/{{$item->user_id}}">{{$item->company}}</a>
                                @else
                                    <a class="region_link pl-0" style="color:#00008b;font-weight: bold;text-decoration: none"
                                       href="/blog/company/{{$item->user_id}}">{{$item->company}}</a>
                                @endif
                                        <p style="margin: 0 0 5px;">Регион: {{$item->region_title}}</p>

                                        <p style="margin: 0 0 5px;">Город: {{$item->city_title}}</p>
                                        <p style="margin: 0 0 5px;">Адрес: {{$item->address}}</p>
                                        <p>Телефон: {{$item->number}}</p>
                                        <p>Количество объявлений: {{$item->count_sub}}</p>





                                    </span>
                            <img src="image/img0005.png" style="border-width: 0;height: 8px;width: 100%;">
                        </div>

                    @endforeach

                </div>


                {{$companys -> links()}}


            </div>


            <div class="col-12 col-md-4">



                    <b class="header-b2" style="display:block;">Топ компаний</b>
                    <div class="blog-company col-12 w-100 ml-0" >

                        @foreach($companyes as $company)

                            <div data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:500}" class="m-auto row">
                            <span style="display:inline-block;vertical-align: top;" class="col-3 p-0 pl-2 pt-1">
                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($company->filename))
                                    <img src="/storage/{{$company->filename}}" alt="{{$company->company}}"
                                         title="{{$company->company}}" class="img-responsive mx-auto"
                                         style="background-color: slategray;width: 86px;height: 84px;">
                                @else
                                    <img src="/image/not_found.jpg" alt="{{$company->company}}"
                                         title="{{$company->company}}" class="img-responsive mx-auto"
                                         style="background-color: slategray;width: 86px;height: 84px;">
                                @endif
                        </span>
                                <span style="display:inline-block;" class="col-9 pl-2">
                            <strong style="color:#00008B;font-family:Arial;font-size:16px;"><a
                                        style="color:#00008b;margin-left: 5px;"
                                        href="http://{{$company->site}}">{{$company->company}}</a></strong>
                            <!--<p style="padding: 0px;margin-left: 5px;">Город: {{$company->city_title}}</p>-->
                                    <p class="mb-0"
                                       style="padding: 0px;margin-left: 5px;font-size: 12px">Город: {{$company->city_title}}</p>
                            <p style="padding: 0px;margin-left: 5px;font-size: 12px">В ОПТхимик с {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($company->created_at)->formatLocalized('%d %f %Y')}}</p>
                            <p class="position-absolute"
                               style="padding: 0px;margin-left: 5px;margin-bottom: 2px;margin-bottom: -3px;bottom: 0">Количество объявлений: {{$company->count_sub}}</p>

                        </span>

                                @if($company->id == $companyes->last()->id)
                                    <img src="image/img0005.png"
                                         style="visibility: hidden;border-width: 0;height: 8px;width: 100%;">
                                @else
                                    <img src="image/img0005.png"
                                         style="    margin-top: 7px;border-width: 0;height: 8px;width: 100%;margin-bottom: 7px;">
                                @endif
                            </div>

                        @endforeach

                    </div>


            </div>


        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function () { // вся мaгия пoсле зaгрузки стрaницы
            $('#go').click(function (event) { // лoвим клик пo ссылки с id="go"
                event.preventDefault(); // выключaем стaндaртную рoль элементa
                $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
                    function () { // пoсле выпoлнения предъидущей aнимaции
                        $('#modal_form')
                            .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                            .animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
                    });
            });
            /* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
            $('#modal_close, #overlay').click(function () { // лoвим клик пo крестику или пoдлoжке
                $('#modal_form')
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
