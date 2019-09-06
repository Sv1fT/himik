@extends('himik')
@section('title')
    @foreach($items as $name)
        <title>ОПТхимик - Редактирование объявления {{$name->title}}</title>
    @endforeach
@stop
@section('content')



    <meta id="csrf" name="csrf" content="{{csrf_token()}}">

    <div class="container">

        <div class="content-full">
            <div class="content-left">
                <div class="tsb">


                    <div class="blog" style="width: 563px;">
                        <div class="header-b">Редактирование объявления</div>
                        @foreach($items as $item)
                            <form id="sendForm" method="post" action="/advert/edit/{{$item->id}}" enctype="multipart/form-data">
                                <input type="text" required name="title" placeholder="Название" value="{{$item->title}}"
                                       style="width: 551px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">{{$item->name}}
                                @if(Auth::user()->id != '209')

                                @else
                                    <input type="text" required name="slug" placeholder="Ссылка"
                                           value="{{$item->slug}}"
                                           style="width: 551px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">{{$item->name}}
                                @endif
                                <textarea type="text" required name="content" placeholder="Описание"
                                          style="max-width: 551px;width:551px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">{{$item->content}}</textarea>
                                <span style="display: inline-block;width: 309px;vertical-align: top">
                                  <select class="category_select" required
                                          style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">

                                      @foreach($category as $items)

                                          <option id="{{$items->id}}" @if($item->category == $items->id) selected
                                                  @endif value="{{$items->id}}">{{$items->title}}</option>
                                      @endforeach
                                  </select>
                                  <input class="category_selected" type="hidden" value="{{$item->category}}"
                                         name="category">

                                  <select id="subcat" required
                                          style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">

                                     @foreach($subcategory as $items)


                                          <option @if($item->subcategory == $items->id) selected
                                                  @endif value="{{$items->id}}">{{$items->title}}</option>

                                      @endforeach

                                  </select>
                                  <input class="subcategory_selected" type="hidden" value="{{$item->subcategory}}"
                                         name="subcategory">
                                  <input type="hidden" name="region" placeholder="Тип упаковки"
                                         value="{{Auth::user()->attributes[0]->region}}"
                                         style="display:none;width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">

                                    @if(count($item->types) > 0)
                                        <input type="text" name="type[]" value="{{$item->types[0]->type}}"
                                               placeholder="Тип упаковки"
                                               style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                        <input type="text" name="mass[]" value="{{$item->types[0]->mass}}"
                                               placeholder="Вес"
                                               style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                        <input style="width: calc(100% / 2 - 10px);margin-right: 15px;" type="number" min="0" class="input form-control" name="price[]" value="{{$item->types[0]->price}}" placeholder="Цена">
                                        <select style="width: calc(100% / 2 - 10px);" class="input form-control" name="valute">

                                        <option value="RUB">Руб</option>
                                        <option value="USD">$(Доллар)</option>
                                        <option value="EUR">€(Евро)</option>
                                        <option value="UAH">₴(Гривна)</option>
                                  </select>
                                    @else
                                        <input type="text" name="type[]" value="" placeholder="Тип упаковки"
                                               style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                        <input type="text" name="mass[]" value="" placeholder="Вес"
                                               style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                        <input style="width: calc(100% / 2 - 10px);margin-right: 15px;" type="number" min="0" class="input form-control" name="price[]" placeholder="Цена">
                                        <select style="width: calc(100% / 2 - 10px);" class="input form-control" name="valute[]">

                                        <option value="RUB">Руб</option>
                                        <option value="USD">$(Доллар)</option>
                                        <option value="EUR">€(Евро)</option>
                                        <option value="UAH">₴(Гривна)</option>
                                  </select>
                                    @endif

                                    {{csrf_field()}}
                                    <a id="popup" onclick="popupopen();"
                                       style="cursor: context-menu;color:#000000;font-family:Arial;font-size:16px;">
                                <img src="/image/img0006.png"
                                     style="margin-right: 10px;margin-left: 10px;display: inline-block;">Вторая упаковка</a>
                                    @if(isset($item->types[1]))
                                        <span id="popup-close" style="margin-top: 25px;display:block;width: 309px;">
                                        <input type="text" name="type[]" value="{{$item->types[1]->type}}"
                                               placeholder="Тип упаковки"
                                               style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                        <input type="text" name="mass[]" value="{{$item->types[1]->mass}}"
                                               placeholder="Вес"
                                               style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                        <input style="width: calc(100% / 2 - 10px);margin-right: 15px" type="number" min="0" name="price[]" value="{{$item->types[1]->price}}" placeholder="Цена">
                                        <select style="width: calc(100% / 2 - 10px);" class="input form-control" name="valute[]">

                                        <option value="RUB">Руб</option>
                                        <option value="USD">$(Доллар)</option>
                                        <option value="EUR">€(Евро)</option>
                                        <option value="UAH">₴(Гривна)</option>
                                  </select>
                            </span>
                                    @else
                                        <span id="popup-close"
                                              style="margin-top: 25px;display:none;width: 309px;vertical-align: top">
                                    <input type="text" name="type[]" value="" placeholder="Тип упаковки"
                                           style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                    <input type="text" name="mass[]" value="" placeholder="Вес"
                                           style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                    <input style="width: calc(100% / 2 - 10px);margin-right: 15px;" type="number" min="0" class="input form-control" name="price[]" placeholder="Цена">
                                    <select style="width: calc(100% / 2 - 10px);" class="input form-control" name="valute[]">

                                        <option value="RUB">Руб</option>
                                        <option value="USD">$(Доллар)</option>
                                        <option value="EUR">€(Евро)</option>
                                        <option value="UAH">₴(Гривна)</option>
                                  </select>
                                </span>
                                    @endif
                              </span>
                                <span style="display: inline-block;border-width:0;width:220px;padding-left: 10px;">
                                  {{--<a href="#">X</a>--}}


                                    @if(!empty($item->filename))
                                        <img id="image" onclick="loadImage()" src="/storage/{{$item->filename}}"
                                             style="width: 220px;background-color: #f0f0f0;">

                                    @else
                                        <img id="image" onclick="loadImage()" src="/image/not_found.jpg"
                                             style="width: 220px;background-color: #f0f0f0;">
                                    @endif

                                    <p>(размер файла не более 1Мб)</p>

<label id="loadfile" for="uploadbtn" style="position: relative;    left: 34px;
    top: -150px;display: none">Загрузить изображение</label>
                                  <input type="file" accept="image/*" name="file" value="{{$item->filename}}"
                                         id="uploadbtn" style="display: none">
                                <input type="hidden" id="imageChange" name="imageChange" value="{{$item->filename}}">
                            <input id="clear" type="button" onclick="clearImg()" value="Очистить">
                              </span>


                                <input id="goSend" type="submit"
                                       style="border-width: 0;width: 418px;height: 50px;font-weight: bold;font-size: 18pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;margin-top: 30px;margin-bottom: 30px;border-radius: 7px;"
                                       value="Сохранить изменения"/>
                            </form>
                        @endforeach

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

@stop
@section('scripts')
    <script>


        function clickButton() {
            $('#uploadbtn').click();
        }
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function clearImg() {
            $('#image').attr('src', '');
            $('#image').css('height', '234px');
            $('#loadfile').css('display', 'block');
            $('#uploadbtn').attr('value', '');
            $('#imageChange').attr('value', '');

        }

        function popupclose() {
            $('#popup-open').css('display', 'none');
            $('#popup-open').attr('id', 'popup-close');

            $('#popup').attr('onclick', 'popupopen()');
        }
        function popupopen() {
            $('#popup-close').css('display', 'block');

            $('#popup').attr('onclick', 'popupclose()');
            $('#popup-close').attr('id', 'popup-open');

        }

        function loadImage() {
            $("#uploadbtn").click();
        }

        $("#uploadbtn").change(function () {
            readURL(this);
            $('#loadfile').css('display', 'none');

        });

        $(".category_select").change(function () {

            $('#subcat').fadeIn();
            $('#subcat').empty();

            var id = $('.category_select :selected').attr('id');

            $('.category_selected').attr('value', $('.category_select :selected').attr('id'));

            $('.regionajax').attr('value', id);


            var _data = $('.subcategory_live').serialize();

            console.log(id);

            $.ajax({
                type: "POST",
                url: "/test/" + id,
                response: 'text',
                data: _data,
                success: function (data) {

                    $("#subcat").append("<option>Выберите подрубрику</option>").fadeIn();

                    console.log(data);
                    $.each(data, function (i, star) {

                        console.log(star);


                        $("#subcat").append('<option id="' + star.id + '">' + star.title + '</option>').fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });



        $('#subcat').change(function () {

            $('.subcategory_selected').attr('value', $('#subcat :selected').attr('id'));

        });


    </script>
@endsection