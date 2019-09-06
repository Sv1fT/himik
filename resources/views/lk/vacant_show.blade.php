@extends('himik')

@section('title')
    @foreach($vacant as $adverts)

        <title>ОПТхимик - {{$adverts->name}}</title>
    @endforeach
@endsection
@section('content')


    <div class="container">
        <div class="col-md-7">
            <div class="col-md-12 content-adverts-show">
                <div class="tsb">
                    @foreach($vacant as $item)

                        <div style="text-align: left;padding-top: 10px;">

                            <h1 style="color: black; display: block;
                margin-left: 10px;
                font-size: 19px;font-weight: bold">{{$item->name}} в городе {{$item->city_get->name}}</h1>
                            <p style="margin-left: 10px;font-size: 16px;color: grey;">Зарплата {{$item->price}} - {{$item->price1}} {{$item->valute}}</p>

                            @if(!empty($item->value['filename']))

                                <img src="{{asset("storage/".$item->value['filename'])}}"
                                     style="margin: 14px;margin-left:14px;float:left;width: 150px;margin-top: 7px;"
                                     alt="{{$item->name}}">
                            @else
                                <img src="/image/not_found.jpg"
                                     style="margin: 14px;margin-left:14px;float:left;width: 150px;margin-top: 7px;"
                                     alt="ОПТхимик">

                            @endif
                            <p style="margin: 12px;margin-bottom: 4px;font-size: 17px;color: #00008b;">{{$item->value->company}}, {{$item->value->citys->name}}</p>
                            <p style="    display:block;margin: 12px;margin-bottom: 4px;margin-top:4px;font-size: 16px;color: grey;text-decoration: none">{{$item->value->name}}</p>
                            <p style="color: grey; margin: 12px;margin-bottom: 4px;margin-top:4px;font-size: 16px;">в ОПТхимик с {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($item->value->created_at)->formatLocalized('%d %f %Y')}}</p>
                            <p style="margin: 12px;font-size: 17px;margin-bottom: 4px;margin-top:4px;">Тел: {{$item->value->number}}</p>
                            <br>

                            <p style="margin:12px;font-size: 17px;font-weight: bold;color: black;">Описание вакансии</p>
                            <p style="margin: 12px;font-size: 14px;color: black;">{!! nl2br($adverts->description) !!}</p>


                        </div>

                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-5" >
            <div class="header-b2"
                 style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;"><a>Другие вакансии</a> <a class="float-right">{{$jobs_new->total()}}</a>
            </div>
            @foreach($jobs_new as $advertnew)
                <div class="col-md-12 content-home">

                        <span class="col-md-12 span-right pl-0 pr-0" style="width: 100%;">
                            <p><a style="font-weight: bold;color:#00008b" href="/vacant/{{$advertnew->slug}}"><?=mb_substr($advertnew->name, 0, 40)?>...</a></p>
                            <p class="margin-top-5">Описание: {{mb_substr($advertnew->description,0,60)}}...</p>
                            <p class="margin-top-5">Добавлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($advertnew->created_at)->formatLocalized('%d %f %Y')}}</p>
                            <p class="mb-0" style="font-weight: bold; color: black;">Зарплата: {{$advertnew->price}} - {{$advertnew->price1}} {{$advertnew->valute}}</p>
                            </span>
                </div>
            @endforeach
            {{--{{$jobs}}--}}
            <button type="submit" class="btn btn-login col-12 ml-2 mt-3" data-toggle="modal" data-target="#modalAdvert" style="background-color: #ffa400;
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


                                    @if(Auth::check())
                                        @if(Auth::id() !== '2')

                                            <input type="hidden" name="user_email" value="{{Auth::user()->email}}">
                                        @else
                                            <input type="hidden" name="user_email" value="{{$advert[0]->email}}">
                                        @endif
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
    </div>
    </div>

    <div id="modal_form"><!-- Сaмo oкнo -->
        <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
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
