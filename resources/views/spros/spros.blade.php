@extends('himik')
@section('title')

    <title>ОПТхимик - Спрос</title>

@endsection
@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <div class="col-md-12">
                    <div class="col-md-12"
                         style="box-shadow: 0 0 10px rgba(0, 0, 0, 1);display: inline-block;vertical-align: top;word-wrap: break-word;background-color: #696969;">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="col-md-7 mb-0 pb-0 p-0"
                           style="font-size: 8pt;width: 340px;color:white;margin:10px auto;">
                            Если вы никак не можете найти необходимую вам продукцию, добавьте объявление о поиске, с
                            подробным описанием того, что хотите приобрести.</p>
                        <button type="submit" class="col-md-5 form-control btn"
                                style="margin:10px auto;border-width: 0;width: 90%;height: 45px;font-weight: bold;font-size: 15pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;border-radius: 5px;"
                                value="Добавить объявление" data-toggle="modal" data-target="#modalAdvert">
                            Добавить объявление
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalAdvert" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header"
                                         style="padding-left: 25px;color: white;background-color: #696969;border: none;">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><p
                                                    style="display: inline-block;font-size: 24px">Добавить
                                                объявление</p></h5>

                                    </div>
                                    <div style="background-color: #696969; height: 2px;">
                                        <p style="display: block;border: 5px solid orange;margin-left: 20px;margin-right: 140px;"></p>
                                    </div>
                                    <div class="modal-body p-0" style="background-color: #696969;">
                                        <div class="col-md-12 col-xs-12 p-0 ">

                                            <div style="margin: 10px;padding: 10px;background-color: #696969;">
                                                <form enctype="application/x-www-form-urlencoded" method="post"
                                                      action="{{url('spros')}}">
                                                    <input type="text" name="title" class="form-control"
                                                           placeholder="Название продукции"
                                                           style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                                    <select id="country" class="form-control" type="text" name="country"
                                                            placeholder="Регион"
                                                            style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                                        <option>Выберете страну</option>
                                                        @foreach($country as $item)
                                                            <option id="{{$item->id}}"
                                                                    value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach


                                                    </select>
                                                    <select id="region" class="form-control" type="text" name="region"
                                                            placeholder="Регион"
                                                            style="display:none;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">


                                                    </select>
                                                    <select id="city" class="form-control" type="text" name="city"
                                                            placeholder="Город"
                                                            style="display:none;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">


                                                    </select>
                                                    {{--<input type="text" name="sity" placeholder="Город" style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">--}}
                                                    <input type="text" class="form-control" name="number"
                                                           placeholder="Телефон"
                                                           style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                                    <input type="email" class="form-control" name="email"
                                                           placeholder="Email"
                                                           style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;">
                                                    <textarea type="text" class="form-control" rows="3" name="content"
                                                              placeholder="Описание"
                                                              style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;font-size: 13pt;"></textarea>
                                                    <input type="hidden" name="category" value="36">
                                                    <input type="hidden" name="subcategory" value="339">
                                                    <input type="hidden" name="user_id" value="2">
                                                    <input type="hidden" name="show" value="0">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="form-control btn"
                                                            style="margin:0 auto;border-width: 0;width: 100%;height: 45px;font-weight: bold;font-size: 15pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;border-radius: 5px;"
                                                            value="Добавить объявление">Добавить объявление
                                                    </button>
                                                </form>
                                                <form class="country_live" type="post"
                                                      enctype="application/x-www-form-urlencoded">
                                                    <input type="hidden" name="id_country" class="countryajax" value=""
                                                           style="
                          padding-top: 2px;
                          padding-bottom: 1px;
                          height: 27px;
                          font-size: 13px;
                          width: 100%;
                      ">
                                                    {{csrf_field()}}
                                                </form>
                                                <form class="subcategory_live" type="post"
                                                      enctype="application/x-www-form-urlencoded">
                                                    <input type="hidden" name="id_category" class="regionajax" value=""
                                                           style="
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
                    @foreach($spros as $item)
                        <div class="blog col-md-12" style="text-align: left;border-bottom: 1px solid;">

                                <span class="" style="display: inline-block;width: 100%;padding-left: 5px">
                                    @if(isset($item->citys->slug))
                                        <a class="mb-2 d-block" style="font-size: 12pt;font-weight: bold"
                                           href="http://{{$item->citys->slug.".opt-himik.ru/".$item->slug}}">{{$item->title}}</a>
                                    @else
                                        <a class="mb-2 d-block" style="font-size: 12pt;font-weight: bold"
                                           href="{{$item->slug}}">{{$item->title}}</a>
                                    @endif
                                    <p style="color:black;"><?=mb_substr($item->content, 0, 100) ?></p>
                                    <p class="mb-0">Добавлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($item->created_at)->formatLocalized('%d %f %Y')}}</p>
                                    <p class="mb-0">Регион: {{$item->region_title}}</p>
                                    <p class="m-0">Телефон: {{$item->number}}</p>
                                </span>
                        </div>
                    @endforeach
                    {{ $spros -> links()}}
                </div>

            </div>
            <div class="col-md-5">
                <div class="text-center">
                    {!! setting('spros.advert') !!}
                </div>
            </div>


        </div>
    </div>



@endsection

@section('scripts')
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
                    $("#region").append("<option>Выберите Регион</option>").fadeIn();

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
                    $("#city").append("<option>Выберите Город</option>").fadeIn();

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
@endsection
