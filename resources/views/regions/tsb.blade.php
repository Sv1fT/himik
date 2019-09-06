@extends('himik')

@section('title')

    <title>ОПТхимик - товарно сырьевая база</title>

@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">



              <div class="header-b" style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;"><div class="row">
                <div class="col-9">
                  <h1 class="m-auto bold" style="vertical-align: top;margin-top: 41px !important;color:#00008b;font-size: 18pt;font-weight: bold;">{{$regions_title->name}}</h1>
                </div>
                <div class="float-right row align-items-end col-3 pl-0 pr-0 m-0" style="width: 170px;background: none;border:none;box-shadow: none;float: right;text-align: right;margin-left: -3px;">
                      <img class="ml-auto mr-2"  style="height: 30px;border: 1px solid;text-align: center;margin-left: auto;" src="/storage/{{$regions_title->filename}}" alt="{{$regions_title->name}}">
                  </div></div></div>
                @foreach($advert as $adverts)

                    <div class="blog" style="    padding-bottom: 0;">
                                <span style="display: block;padding: 1px 0px 0px 0px;margin-left: -5px;">
                                    <ins style="display: block;padding: 5px;">
                                        @if(isset($adverts->citys))
                                            @if($adverts->user_id == '209')
                                                <p><a itemprop="url" style="font-weight: bold;color:#00008b;font-size: 19px;"
                                                      href="{{$adverts->slug}}"><?=mb_substr($adverts->title, 0, 60)?>
                                                        ... </a></p>
                                            @else
                                                <p><a itemprop="url" style="font-weight: bold;color:#00008b;font-size: 19px;"
                                                      href="http://{{$adverts->citys->slug.'.opt-himik.ru/'.$adverts->slug}}"><?=mb_substr($adverts->title, 0, 60)?>
                                                        ...</a></p>
                                            @endif
                                        @else
                                            @if($adverts->user_id == '209')
                                                <p><a itemprop="url" style="font-weight: bold;color:#00008b;font-size: 19px;"
                                                      href="http://opt-himik.ru/{{$adverts->slug}}"><?=mb_substr($adverts->title, 0, 60)?>
                                                        ... </a></p>
                                            @else
                                                <p><a itemprop="url" style="font-weight: bold;color:#00008b;font-size: 19px;"
                                                      href="{{$adverts->slug}}"><?=mb_substr($adverts->title, 0, 60)?>
                                                        ...</a></p>
                                            @endif
                                        @endif
                                    </ins>
                                    <span style="padding-left: 10px;display: inline-block;color: black;"><?=mb_substr($adverts->content, 0, 220) ?>
                                        ...</span>
                                </span>

                        <span style="display: inline-block;/*! float: left; */vertical-align: top;">
                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($adverts->filename))
                                <img src="/storage/{{$adverts->filename}}"
                                     style="border-radius: 7px;width:120px;height: 120px;display: block;margin: 0 auto;margin-top: 5px;margin-bottom: 5px;display: inline-block"
                                     alt="{{$adverts->title}}">
                            @else
                                <img src="/image/not_found.jpg"
                                     style="border-radius: 7px;width:120px;height: 120px;display: block;margin: 0 auto;margin-top: 5px;margin-bottom: 5px;display: inline-block"
                                     alt="{{$adverts->title}}">
                            @endif

                                </span>
                        <div style="display: inline-block;width: 530px;">
                            <table style="text-align: center;width: 110%;">
                                <tr style="border-bottom: 1px solid #696969;">
                                    <td>Упаковка</td>
                                    <td>Вес</td>
                                    <th>Цена</th>
                                </tr>

                                @foreach($adverts->types as $item)
                                    @if(isset($item))
                                        <tr style="border-bottom: 1px solid #b3b3b3;">


                                            <td>{{$item->type}}</td>
                                            <td>{{$item->mass}}</td>
                                            <th>
                                                @if($item->price == "")

                                                @else
                                                    {{$item->price}}
                                                @endif
                                            </th>


                                        </tr>
                                    @else
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>


                                        </tr>
                                    @endif
                                @endforeach
                            </table>

                        </div>

                    </div>
                @endforeach

                {{$advert->render()}}
            </div>
            <!-- <div class="col-4 text-center">

                 <div class="header-b" style="color:#00008b">{{$regions_title->name}}</div>
                <div class="col-12" style="background: none;border:none;box-shadow: none">

                    <img class="img-fluid" style="box-shadow: 0 0 24px rgba(0,0,0,0.5);border: 1px solid;border-radius: 8px;float: left;" src="/storage/{{$regions_title->filename}}" alt="{{$regions_title->name}}">
                </div>
                <div class="row">
                  <div class="col-9" style="color:#00008b;font-size: 18pt;">
                    <p class="m-auto" style="vertical-align: top;margin-top: 41px !important;">{{$regions_title->name}}</p>
                  </div>
                  <div class="float-right row align-items-end col-3" style="width: 170px;background: none;border:none;box-shadow: none;float: right;text-align: right;">
                        <img style="height: 30px;border: 1px solid;text-align: center;" src="/storage/{{$regions_title->filename}}" alt="{{$regions_title->name}}">
                    </div></div>
            </div> -->
        </div>
    </div>


@endsection
@section('scripts')

    <script>


        function SendPost() {
            //отправляю POST запрос и получаю ответ
            $$a({
                type: 'post',//тип запроса: get,post либо head
                url: '/tsb',//url адрес файла обработчика
                data: {'category': $category_val},//параметры запроса
                response: 'text',//тип возвращаемого ответа text либо xml
                success: function (data) {//возвращаемый результат от сервера
                    $$('result', $('result').innerHTML + '<br />' + data);
                }
            });
        }

        $(".category_select").change(function () {

            $('#subcat').fadeIn();
            $('#subcat').empty();

            var id = $('.category_select :selected').attr('id');

            $('.regionajax').attr('value', id);


            var _data = $('.blog').serialize();


            $.ajax({
                type: "POST",
                url: "/test/" + id,
                response: 'text',
                data: _data,
                success: function (data) {

                    $.each(data, function (i, star) {

                        console.log(star);


                        $("#subcat").append("<option value='" + star.id + "'>" + star.title + "</option>").fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });

        $('#sendPost').submit(function () {

            event.preventDefault();
            var _data = $('.blog').serialize();


            $.ajax({
                type: "POST",
                url: "/test/" + id,
                response: 'text',
                data: _data,
                success: function (data) {

                    $(".blog").empty();

                    $(".blog").append("<p>Вы подпимались на рассылку</p>").fadeIn();


                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });

    </script>

@endsection
