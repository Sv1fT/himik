@extends('himik')

@section('title')

    <title>ОПТхимик - Добавление вакансии </title>

@stop

@section('content')

    <style></style>

    <meta id="csrf" name="csrf-token" content="{{csrf_token()}}">

    <div class="container">

        <div class="content-full">
            <div class="content-left">
                <div class="tsb">

                    @foreach($vacant as $vacants)
                    <div class="blog" style="width: 563px;    box-shadow: 0 0 10px rgba(0, 0, 0, 1);">
                        <div class="header-b">Редактирование вакансии</div>
                        <form id="sendForm" method="post" enctype="multipart/form-data" action="{{url('/vacant/edit/'.$vacants->id)}}">
                            <input type="text" class="get_city" required placeholder="Укажите город в России" value="{{$vacants->city_get->name}}" style="width: 553px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <ul class="search_result p-0">

                            </ul>

                            <select class="category_select" name="razdel" required style="width: 553px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                <option>Выберите раздел</option>
                                @foreach($razdel as $item)

                                    <option id="{{$item->id}}"@if($vacants->category == $item->id) selected
                                            @endif value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                            <input type="text" required name="name" placeholder="Название вакансии" value="{{$vacants->name}}" style="width: 553px;max-width:553px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">

                            <input type="text" name="price1" required  placeholder="Зарплата от" value="{{$vacants->price}}" style="width: 184px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <input type="text" name="price2" required  placeholder="Зарплата до" value="{{$vacants->price1}}" style="width: 184px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <select class="category_select" name="valute" required style="width: 175px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                <option id="1">Руб.</option>
                                <option id="2">USD</option>
                                <option id="3">EUR</option>

                            </select>
                            <input type="text" name="opit" required placeholder="Опыт работы" value="{{$vacants->opit}}" style="width: 553px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <input type="text" name="education" required placeholder="Образование" value="{{$vacants->education}}" style="width: 553px;color: black;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <textarea name="description" required placeholder="Описание вакансии" style="width: 553px;color: black;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">{{$vacants->description}}</textarea>

                            {{csrf_field()}}

                            <input value="{{$vacants->city_get->id}}" class="name_city" name="city" type="hidden">


                            <input id="goSend" type="submit" style="border-width: 0;width: 418px;height: 50px;font-weight: bold;font-size: 18pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;margin-top: 30px;margin-bottom: 30px;border-radius: 7px;" value="Изменить вакансию"/>
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
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $('.get_city').bind("keyup", function () {


            var _token = $('.search_live').serialize();
            var data_id = this.value;
            if (this.value.length >= 3) {
                $.ajax({
                    type: "POST",
                    url: "/test/city/" + data_id,
                    response: 'text',
                    data: _token,
                    success: function (data) {
                        console.log(data);

                        $('.search_result').empty();
                        var parser = document.createElement('a');
                        parser.href = window.location.href;


                        $.each(data, function (i, star) {


                            $(".search_result").append("<a class='search_load w-100 m-0'  id='"+star.id+"' style='display: inline-block;  '>" + star.name + "</a>").fadeIn();


                        });

                        //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                    },
                    error: function (xhr, str) {
                        console.log(_token);
                        alert('Возникла ошибка: ' + xhr.responseCode);
                    }


                });
            }
        });
        $( "body" ).click(function( event ) {
            $('.search_load').on('click', function (e) {
                e.preventDefault();
                $('.get_city').val($(this).text());
                $('.search_result').empty();
                $('.search_result').css('display','none');
                $('.name_city').remove();
                $('#sendForm').append('<input type="hidden" value="'+$(this).attr('id')+'" name="city">');
            })
        });

    </script>
@endsection