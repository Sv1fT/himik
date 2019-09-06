@extends('himik')

@section('title')

    <title>Вакансии и Резюме - ОПТхимик</title>

@endsection

@section('content')

    <div class="container">
        <div class="content-full">


            <div class="tsb">
                <div style="
    width: 600px;
    display: inline-block;
">

                    <div class="tabs">
                        <input id="tab1" type="radio" name="tabs" checked>
                        <label for="tab1" title="Вкладка 1">Резюме</label>

                        <input id="tab2" type="radio" name="tabs">
                        <label for="tab2" title="Вкладка 2">Вакансии</label>


                        <section id="content-tab1">
                            @if($rezume->count() > 0)
                                @foreach($rezume as $item)
                                    <div class="" style="text-align: left;border-bottom: 1px solid;padding-top: 10px;">

                                        <a style="font-size: 12pt;font-weight: bold"
                                           href="/resume/{{$item->slug}}">{{$item->dolzhnost}}
                                            <a class="float-right" style="font-size: 12pt; color: #333333; text-decoration: none"> {{$item->price}}</a></a>
                                        <div class="row mt-3">
                                            <span class="col-2">
                                                <img class="img-fluid" style="max-height: 120px;" src="/storage/{{$item->filename}}"
                                                     alt="{{$item->dolzhnost}}">
                                            </span>
                                            <span class="col-10 pl-0">
                                            <p class="mb-0" style="font-size: 14px; color: #333333;">{{$item->fio}}, {{$item->age}}
                                                , {{$item->city_get->name}}</p>
                                                <p class="mb-0" style="font-size: 14px;color: #333333;">{{$item->education}}</p>
                                            <p style="font-size: 12px; color: darkgray;" class="text-lowercase">{{$item->pereezd}}</p>
                                            <p style="font-size: 12px; color: #333333;">Опыт работы: {{mb_substr($item->opit,0,75)}}...</p>

                                                {{--<p style="font-size: 12pt; color: gray;">Возраст: </p>--}}
                                                {{--<p style="font-size: 12pt; color: gray;">Желаемый город: </p>--}}
                                                {{--<p style="font-size: 12pt; color: gray;">Образование: </p>--}}

                                                </span>
                                            <span class="col-12">
                                            <p style="font-size: 12px; color: #333333;word-wrap: break-word;">{{mb_substr($item->description,0,260)}}...</p>
                                                </span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <strong>Резюме нет.</strong>
                            @endif
                        </section>
                        <section id="content-tab2">
                            @if($vacant->count() > 0)
                                @foreach($vacant as $item)

                                    <div style="text-align: left;border-bottom: 1px solid;padding-top: 10px;">
                                        <a href="{{url('/vacant/'.$item->slug) }}" style="font-size: 12pt; color: #00008b; font-weight: bold;">{{$item->name}}</a>,<a
                                                style="font-size:10pt; color:gray;text-decoration: none">
                                            {{$item->price}} - {{$item->price1}} {{$item->valute}}</a>
                                        <div class="mt-2 row">
                                        <span class="col-3 pb-3" style="display: inline-block;vertical-align: top;margin-top: 5px;">
                                            <img class="img-fluid" style="display: inline-block;height:100px;"
                                                 src="{{asset("/storage/".$item->value->filename)}}" alt="">
                                        </span>
                                            <span class="col-9 pl-0" style="display: inline-block;width: 79%;">
                                            <p class="mb-0" style="font-size: 14px;color: gray;">{{$item->value->company}}, {{$item->value->citys->name}}</p>
                                        <p style="font-size: 14px;color: gray;">в городе {{$item->city_get->name}}, {{$item->education}}, {{$item->opit}}</p>
                                        <p style="font-size: 12px;color: black;">{{mb_substr($item->description,0,400)}}</p>
                                        </span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <strong>Вакансий нет.</strong>
                            @endif
                        </section>

                    </div>


                </div>
                <div style="box-shadow: 0 0 10px rgba(0, 0, 0, 1);display: inline-block;vertical-align: top;word-wrap: break-word;width: 420px;background-color: #696969;margin-top: 50px;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="mb-0 pb-0" style="padding: 20px;font-size: 12pt;width: 340px;color:white">
                        Eсли вы находитесь в активном поиске работы, добавьте ваше резюме. Возможно, среди пользователей
                        нашего портала найдется необходимый вам работодатель.</p>

                    <button type="submit" class="btn" data-toggle="modal" data-target="#modalAdvert" style="margin:20px auto;border-width: 0;width: 90%;height: 45px;font-weight: bold;font-size: 15pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;border-radius: 5px;">
                        Добавить резюме
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalAdvert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 1200px !important;margin: 0 auto;width: 740px;" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="padding-left: 25px;color: white;background-color: #696969;border: none;">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><p style="display: inline-block;font-size: 24px">Добавить резюме</p></h5>
                                    
                                </div>
                                <div style="background-color: #696969; height: 2px;">
                                              <p style="display: block;border: 5px solid orange;margin-left: 20px;margin-right: 140px;"></p>
                                            </div>
                                <div class="modal-body p-0" style="background-color: #696969;">
                                    <div class="col-md-12 col-xs-12 p-0">

                                      <div style="margin: 10px;padding: 10px;background-color: #696969;">
                                          <form enctype="multipart/form-data" class="row" method="post" action="{{url('rezume')}}">
                                            <div class="col-7">
                                              <input type="text" name="city" placeholder="Желаемый город"
                                                     style="padding-left:3px;width: 50%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;vertical-align: top;">
                                              <input class="m-0 ml-5" id="pereezd" type="checkbox" name="pereezd"
                                                     style="height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;"><label
                                                      for="pereezd"
                                                      style="color: white;margin-top: -25px;vertical-align: middle;margin-left: 15px;">Готов
                                                  к переезду</label>
                                              <select id="country" type="text" name="country" placeholder="Регион" style="width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                                  <option>Выберите страну</option>
                                                  @foreach($country_job as $item)
                                                      <option id="{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                                                  @endforeach


                                              </select>
                                              <select id="region" type="text" name="region" placeholder="Регион" style="display:none;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">

                                              </select>
                                              <select id="city" type="text" name="city" placeholder="Город" style="display:none;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">


                                              </select>

                                              <select type="text" name="razdel" placeholder="Раздел"
                                                      style="width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">

                                                  @foreach($razdel as $item)
                                                      <option id="{{$item->id}}" value="{{$item->id}}">{{$item->title}}</option>
                                                  @endforeach
                                              </select>
                                              <input type="text" name="fio" placeholder="ФИО"
                                                     style="padding-left:3px;width: 78%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                              <input type="text" name="age" placeholder="Возраст"
                                                     style="padding-left:3px;width: 20%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                              <input type="email" name="email" placeholder="Email"
                                                     style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                              <input type="text" name="number" placeholder="Телефон"
                                                     style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">

                                              <textarea type="text" name="opit" placeholder="Опыт работы"
                                                        style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;"></textarea>
                                              <input type="text" name="dolzhnost" placeholder="Должность"
                                                     style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                              <input type="text" name="price" placeholder="Зарплата от"
                                                     style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">

                                              <input type="text" name="education" placeholder="Образование"
                                                     style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                              <input type="text" name="language" placeholder="Владения языками"
                                                     style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                              <textarea type="text" name="description" placeholder="Дополнительная информация"
                                                        style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;"></textarea>


                                              <input style="width: 20px;box-shadow: none" type="checkbox" class="form-control" required="">
                                              <a style="vertical-align: 70%;margin-left: 10px;cursor:pointer;color: white;" id="confid">согласие на обработку персональных данных</a>
                                              {{csrf_field()}}
                                              
                                            </div>
                                              <div class="col-5 text-center">
                                                <a id="load"  class="w-100" onclick="loadImage()" style="cursor:pointer;color: white;font-family: Arial;display: inline-block;width: 220px;padding-top: 7px;height: 50px;font-size: 16px;"><img src="image/img0006.png" style="margin-right: 10px;display: inline-block;">Загрузить изображение</a>

                                                <a id="clear" onclick="clearImg()" style="display: block;cursor: pointer;color: white;font-family: Arial;padding-top: 7px;text-align:  right;height: 50px;font-size: 16px;display: none;">Очистить</a>
                                                <img style="display:none;width:100%;height: 100px;margin-bottom: 15px;z-index: 0;" id="image" src="/image/image_load.jpg">


                                                <input type="file" accept="image/*" name="file" value="" id="uploadbtn" style="display: none">
                                              </div>
                                              <button type="submit" class="btn"
                                                      style="margin:0 auto;border-width: 0;width: 50%;height: 45px;font-weight: bold;font-size: 15pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;border-radius: 5px;"
                                                      value="Добавить">Добавить резюме
                                              </button>
                                          </form>
                                          <form class="country_live" type="post" enctype="application/x-www-form-urlencoded">
                                              <input type="hidden" name="id_country" class="countryajax" value="" style="
                      padding-top: 2px;
                      padding-bottom: 1px;
                      height: 27px;
                      font-size: 13px;
                      width: 100%;
                  ">
                                              {{csrf_field()}}
                                          </form>
                                          <form class="subcategory_live" type="post" enctype="application/x-www-form-urlencoded">
                                              <input type="hidden" name="id_category" class="regionajax" value="" style="
                      padding-top: 2px;
                      padding-bottom: 1px;
                      height: 27px;
                      font-size: 13px;
                      width: 100%;
                  ">
                                              {{csrf_field()}}
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
        <div class="col-12 mx-auto" id="modal_form" style="    width: 1050px;
    border-radius: 5px;
    border: 3px solid rgb(0, 0, 0);
    background: rgb(243, 243, 243);
    position: fixed;
    top: 30%;
    left: initial;
    display: none;
    overflow: scroll;
    opacity: 1;
    height: 590px;
z-index: 11000;"><!-- Сaмo oкнo -->
            <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->


            <div class="" style="margin-top: 30px;padding: 30px;text-align: left;color: black">
                {!! setting('site.license_resume') !!}
            </div>

            </span>
        </div>
        <div id="overlay"></div><!-- Пoдлoжкa -->
    </div>
    </div>

@endsection
@section('scripts')
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').css('height', 'auto');
                    $('#image').css('display', 'block');
                    $('#load').css('display', 'none');
                    $('#clear').css('display', 'block');

                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        $("#uploadbtn").change(function () {
            readURL(this);
            $('#load').css('display', 'none');

        });


        function clearImg() {
            $('#image').attr('src', '/image/image_load.jpg');
            $('#image').css('height', '100px');
            $('#image').css('display', 'none');
            $('#clear').css('display', 'none');
            $('#load').css('display', 'block');
        }

        function loadImage() {
            $("#uploadbtn").click();
        }
    </script>
    <script>
        $("#country").change(function () {

            $('#region').fadeIn();
            $('#region').empty();

            var id = $('#country :selected').attr('id');


            $('.countryajax').attr('value', id);


            var _data = $('.country_live').serialize();


            $.ajax({
                type: "POST",
                url: "/test/country/" + id,
                response: 'text',
                data: _data,
                success: function (data) {
                    $("#region").append("<option>Выберите регион</option>").fadeIn();

                    $.each(data, function (i, star) {


                        $("#region").append('<option id="' + star.id + '"value="' + star.id + '">' + star.name + '</option>').fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });

        $("#region").change(function () {

            $('#city').fadeIn();
            $('#city').empty();

            var id = $('#region :selected').attr('id');


            $('.regionajax').attr('value', id);


            var _data = $('.subcategory_live').serialize();

            $.ajax({
                type: "POST",
                url: "/test/region/" + id,
                response: 'text',
                data: _data,
                success: function (data) {
                    $("#city").append("<option>Выберите город</option>").fadeIn();

                    $.each(data, function (i, star) {


                        $("#city").append('<option id="' + star.id + '"value="' + star.id + '">' + star.name + '</option>').fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });
    </script>
    <script>
        $(document).ready(function () { // вся мaгия пoсле зaгрузки стрaницы
            $('#confid').click(function (event) { // лoвим клик пo ссылки с id="go"
                event.preventDefault(); // выключaем стaндaртную рoль элементa
                $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
                    function () { // пoсле выпoлнения предъидущей aнимaции
                        $('#modal_form')
                            .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                            .animate({opacity: 1, top: '30%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
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
