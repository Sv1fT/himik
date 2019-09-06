@extends('himik')

@section('title')

    <title>ОПТхимик - товарно сырьевая база</title>

@endsection


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="tsb">

                    <h1 class="header-b">Товарно-сырьевая база</h1>
                    <a href="{{url('/myadvert')}}" data-uk-scrollspy="{cls:'uk-animation-scale-down', delay:500}"
                       style="color: #000000;font-family: Arial;display: block;height: 60px;font-size: 16px;margin-left:  7px;padding-top: 21px;"
                       class="d-md-none align-middle"><img src="image/img0006.png" style="margin-right: 10px;display: inline-block;">Добавить
                        объявление</a>
                    <div class="blog">
                        @foreach($category as $category_titles)

                            <a class="region_link" style="color:#00008b"
                               href="/tsb/{{ $category_titles->slug}}">{{$category_titles->title}}
                                [{{$category_titles->count_sub}}]</a>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">

                <a href="{{url('/myadvert')}}" data-uk-scrollspy="{cls:'uk-animation-scale-down', delay:500}"
                   style="color: #000000;font-family: Arial;display: block;height: 60px;font-size: 16px;margin-left:  7px;padding-top: 21px;"
                   class="d-md-block d-none align-middle"><img src="image/img0006.png" style="margin-right: 10px;display: inline-block;">Добавить
                    объявление</a>


                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="header-b2" style="border-top-left-radius: 3px;border-top-right-radius: 3px;">Оформить подписку</div>
                <form class="blog col-12" method="POST" enctype="multipart/form-data"
                      action="{{ url('/tsb') }}">

                    {{csrf_field()}}
                    <select class="category_select form-control"
                            style="display: block;padding-left: 3px;width: 100%;margin-bottom: 15px;font-size: 13pt;margin-top: 20px"
                            name="category">
                        <option>
                            Выберите рубрику
                        </option>
                        @foreach($category as $item)
                            <option id="{{$item->id}}" value="{{$item->id}}">
                                {{$item->title}}
                            </option>
                        @endforeach
                    </select>
                    <select id="subcat" class="form-control"
                            style="display: none;padding-left: 3px;width: 100%;margin-bottom: 15px;font-size: 13pt;"
                            name="subcategory">
                        <option selected>
                            Выберите подрубрику
                        </option>


                    </select>
                    <input id="email_tsb" style="display: block;padding-left: 3px;width: 100%;margin-bottom: 15px;font-size: 13pt;"
                           class="form-control" name="email" type="email" placeholder="Укажите ваш email" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                    <input id="sendPost" class="form-control" onclick="SendPost();"
                           style="border:none;display: block;width: 100%;margin-top: 20px;background-color: rgb(255,164,0);height: 35px;color: black;font-size: 13pt !important;font-weight: normal !important;margin-bottom: 10px !important;"
                           type="submit" value="Подписаться на рассылку">
                    @foreach($counts as $count)
                        <p class="text-center" style="padding-top: 10px;font-size: 13px;font-weight: bold">Количество подписчиков: {{$count->count}}</p>
                    @endforeach

                </form>
                <div class="text-center mt-3 mt-4">
                  {!! setting('tsb.advert') !!}
                </div>


            </div>
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
