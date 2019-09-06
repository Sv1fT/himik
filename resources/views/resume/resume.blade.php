@extends('himik')

@section('title')
    @foreach($jobs as $adverts)
        <title>ОПТхимик - {{$adverts->dolzhnost}}</title>
    @endforeach
@endsection

@section('meta')
    @foreach($jobs as $adverts)

        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <link rel="canonical" href="{{URL::current()}}"/>
        <meta property="og:site_name" content="ОПТхимик - {{$adverts->dolzhnost}}"/>
        <meta property="og:title" content="{{$adverts->dolzhnost}}"/>
        <meta property="og:description" content="{{$adverts->description}}"/>
        <meta property="og:url" content="{{URL::current()}}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:locale" content="ru_RU"/>
        <meta property="og:locale:alternate" content="en-us"/>
        <meta property="og:image" content="http://opt-himik.ru/image/logo_ogg.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Портал химической промышленности России №1 «ОПТхимик»! Это одна из крупнейших в России специализированных торговых площадок по продаже продуктов химической промышленности."/>
    @endforeach

@endsection

@section('content')


    <div class="container">
        <div class="col-md-7">
            <div class="col-md-12 content-adverts-show">
                <div class="tsb">

                    @foreach($jobs as $item)

                        <div class="col-12" style="text-align: left;padding-top: 10px;">
                            <a style="display:block;margin-left:10px;font-size: 19px;color: black;font-weight: bold; text-decoration: none">{{$item->fio}}</a>
                            <div class="row">
                                <div class="col-5">
                                    @if(Illuminate\Support\Facades\Storage::disk('public')->exists($item->filename))
                                        <img src="{{asset('/storage/'.$item->filename)}}" alt="{{$item->dolzhnost}}"
                                             style="margin: 14px;margin-left:14px;float:left;width: 170px;margin-top: 7px;"
                                             alt="{{$adverts->dolzhnost}}">
                                    @else
                                        <img src="/image/not_found.jpg"
                                             style="margin: 14px;margin-left:14px;float:left;width: 170px;margin-top: 7px;"
                                             alt="{{$adverts->dolzhnost}}">
                                    @endif
                                </div>
                                <div class="col-7">
                                    <p style="color: #00008b; margin: 12px;font-size: 17px;">{{$item->age}},{{$item->city_get->name}}</p>
                                    <p style="color: #00008b; margin: 12px;font-size: 17px;">{{$item->education}}</p>
                                    <p style="color: #00008b; margin: 12px;font-size: 17px;"><b>Тел: {{$item->number}}</b></p>
                                </div>
                                <div class="col-12">
                                    <h1 class="mb-0" style="color: #383838; margin: 12px;font-size: 17px;font-weight: bold;height: 24px;">{{$item->dolzhnost}}</h1>
                                    <p class="mt-0" style="margin: 12px;">ищу работу в городе {{$item->city_get->name}}, {{$item->pereezd}}, {{$item->price}}</p>
                                    <p class="mb-0" style="color: #383838; margin: 12px;font-size: 17px;font-weight: bold">Опыт работы</p>
                                    <p class="mt-0" style="margin: 12px;">{{$item->opit}}</p>
                                    <p class="mb-0" style="color: #383838; margin: 12px;font-size: 17px;font-weight: bold">Знание языков</p>
                                    <p class="mt-0" style="margin: 12px;">{{$item->language}}</p>

                                    <p class="mb-0" style="color: #383838; margin: 12px;font-size: 17px;font-weight: bold">Дополнительная информация</p>
                                    <p class="mt-0" style="margin: 12px;">{{nl2br($adverts->description)}}</p>
                                </div>


                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="header-b2"
                 style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;"><a>Другие резюме </a><a class="float-right">{{$jobs_new->total()}}</a>
            </div>
            @foreach($jobs_new as $advertnew)
                <div class="col-12 content-home p-0 pl-4 pr-4">
                    <div class="row">
                        <div class="col-3 span-left p-3">
                            @if($advertnew->filename == 'upload/2/picture/picture/')

                                <img class="img-responsive" src="/image/not_found.jpg" alt="ОПТхимик">
                            @else
                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($advertnew->filename))
                                    <img class="img-responsive" src="{{asset('/storage/'.$advertnew->filename)}}" alt="{{$advertnew->dolzhnost}}">
                                @else
                                    <img class="img-responsive" src="/image/not_found.jpg" alt="ОПТхимик">
                                @endif

                            @endif
                        </div>
                        <div class="col-9 span-right pl-0 p-3" style="padding-left: 0px !important;">

                            <a style="font-weight: bold"
                               href="/resume/{{$advertnew->slug}}"><?=mb_substr($advertnew->dolzhnost, 0, 40)?>
                                ...</a><br>
                            <p style="margin-bottom: 0px">Описание: {{mb_substr($advertnew->description,0,120)}}
                                ...</p>
                            <p style="margin-bottom: 0px">Добалено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($advertnew->created_at)->formatLocalized('%d %f %Y')}}

                            </p>
                            <b>Зарплата: {{$advertnew->price}}</b>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--{{$jobs}}--}}
            <button type="submit" class="btn btn-login col-12 mt-3" data-toggle="modal" data-target="#modalAdvert" style="background-color: #ffa400;
    border-color: #ffffff;
    color: white;
    font-weight: bold;
    height: 45px;
    font-size: 14pt;">
                Сделать запрос
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalAdvert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><p style="display: inline-block;font-size: 24px">Сделать запрос</p></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 col-xs-12">

                                <form style="padding: 5px" class="form-horizontal" method="POST" enctype="multipart/form-data"
                                      action="/mailer/vacant">
                                    <input style="margin-bottom: 10px;font-size: 13pt;" type="text" name="name"
                                           placeholder="Имя или компания" class="form-control">
                                    <input style="margin-bottom: 10px;font-size: 13pt;" type="text" name="phone"
                                           placeholder="Телефон" class="form-control">
                                    <input style="margin-bottom: 10px;font-size: 13pt;" type="email" name="email"
                                           placeholder="Ваш email" class="form-control">

                                    @if($jobs[0]->user_id != '2')

                                        <input type="hidden" name="user_email" value="{{Auth::user()->email}}">
                                    @else
                                        <input type="hidden" name="user_email" value="{{$jobs[0]->email}}">
                                    @endif

                                    <input class="url" type="hidden" name="url">
                                    <textarea style="margin-bottom: 10px;font-size: 13pt;" type="text" name="content"
                                              placeholder="Задайте ваш вопрос компании" class="form-control"></textarea>
                                    {{csrf_field()}}
                                    <button type="submit" value="Отправить запрос" class="form-control"
                                            style="background-color: #ffa400;
    border-color: #ffffff;
    color: white;
    font-weight: bold;
    height: 45px;
    font-size: 14pt;">Отправить запрос
                                    </button>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_form"><!-- Сaмo oкнo -->
        <div id="modal_close">X</div> <!-- Кнoпкa зaкрыть -->
        <!-- Тут любoе сoдержимoе -->
    </div>
    <div id="overlay"></div><!-- Пoдлoжкa -->


@endsection
@section('scripts')
    <script>
        window.onload = function () {

            $('.url').attr('value', window.location.href);
        }
    </script>
@endsection
