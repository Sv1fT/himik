@extends('himik')

@section('title')

    <title>ОПТхимик - Добавление объявления </title>

@stop

@section('content')

    <style></style>

    <meta id="csrf" name="csrf-token" content="{{csrf_token()}}">

    <div class="container">

        <div class="content-full">
            <div class="content-left">
                <div class="tsb">


                    <div class="blog" style="width: 563px;    box-shadow: 0 0 10px rgba(0, 0, 0, 1);">
                        <div class="header-b">Добавление нового объявления</div>
                        <form id="sendForm" method="post" enctype="multipart/form-data">
                            <div id="modal_form"><!-- Сaмo oкнo -->
                                <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
                                <h3>Добавление упаковки</h3>

                                <input type="submit"
                                       style="border-width: 0;width: 418px;height: 50px;font-weight: bold;font-size: 18pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;/* margin-top: 30px; */margin-bottom: 30px;border-radius: 7px;left: 7%;"
                                       value="Добавить упаковку">
                            </div>
                            <div id="overlay"></div><!-- Пoдлoжкa -->
                            <input type="text" required name="name" placeholder="Название" class="input_big form-control">
                            @if(Auth::user()->id != '209' )

                            @else
                                <input type="text" required name="slug" placeholder="Ссылка" class="input_big form-control">
                            @endif
                            <textarea type="text" class="input_big form-control" required name="content" placeholder="Описание"></textarea>
                            <span style="display: inline-block;width: 309px;vertical-align: top">

                                  <select class="category_select input form-control" required>
                                      <option>Выберите рубрику</option>
                                      @foreach($category as $item)

                                          <option id="{{$item->id}}">{{$item->title}}</option>
                                      @endforeach
                                  </select>
                                  <input class="category_selected input form-control" type="hidden" name="category">
                                  <select id="subcat" class="category_selected input form-control" required>

                                     <option>Выберите подрубрику</option>
                                      @foreach($subcategory as $item)

                                          <option id="{{$item->id}}">{{$item->title}}</option>
                                      @endforeach
                                  </select>
                                  <input type="text" class="input form-control" name="type[]" required placeholder="Тип упаковки">
                                      <input type="text" class="input form-control" name="mass[]" required placeholder="Вес">
                                <div class="col-12">
                                    <div class="row">
                                    <input style="width: calc(100% / 1 - 123px);margin-right: 20px;" type="number" min="0" class="input form-control" name="price[]" required placeholder="Цена">
                                    <select style="width: calc(100% / 3);" class="input form-control" name="valute" required>

                                        <option value="RUB">Руб</option>
                                        <option value="USD">$(Доллар)</option>
                                        <option value="EUR">€(Евро)</option>
                                        <option value="UAH">₴(Гривна)</option>
                                  </select>
                                        </div>
                                </div>


                                  <input class="subcategory_selected"  type="hidden" name="subcategory">


                                {{csrf_field()}}
                              </span>
                            <span style="display: inline-block;border-width:0;width:234px;height:234px;">
                                  <img id="image" src="" onclick="loadImage()"
                                       style="width: 234px;height: 234px;background-color: #f0f0f0;">

<input id="clear" type="button" onclick="clearImg()" value="Очистить">
<label id="loadfile" for="uploadbtn" style="position: relative;text-align: center;
    top: -165px;display: block">Загрузить изображение<p>(размер файла не более 1Мб)</p></label>
                                  <input type="file" accept="image/*" name="file" value="" id="uploadbtn"
                                         style="display: none">

                              </span>


                            <input id="goSend" type="submit" class="w-75 btn" value="Добавить объявление"/>
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
            <div class="content-right" style="width:400px">

                <div class="header-b2"
                     style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;">Мои
                    объявления <a class="float-right">{{$adverts->total()}}</a>
                </div>

                <input type="hidden" id="user" value="{{Auth::user()->id}}">
                <?php $var = 0 ?>
                @foreach($adverts as $advertnew)
                    <div class="advert-content-home row">
                            <span class="col-4 pl-0 pr-0 span-left">
                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($advertnew->filename))
                                    <img class="img-fluid" src="/storage/{{$advertnew->filename}}" alt="{{$advertnew->title}}">
                                @else
                                    <img class="img-fluid" src="/image/not_found.jpg" alt="ОПТхимик">
                                @endif
                            </span>
                        <span class="col-8 span-right pr-0">
                                @if(Auth::user()->id == '209')
                                <a style="color:#00008b;font-weight: bold"
                                   href="{{$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 20)?>...</a>
                            @else
                                <a style="color:#00008b;font-weight: bold"
                                   href="/{{$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 20)?>...</a>
                            @endif
                            <form class="delete-form" style="display: inline;">
                                    {{ csrf_field() }}
                                <a class="delete" onclick="advertDelete({{$advertnew->id}}); return false;">
                                    <input class="delete-advert" name="id" type="hidden" value="{{$advertnew->id}}">
                                    <i class="fa fa-times fa-lg" aria-hidden="true"
                                       style="padding-left:10px;float: right;color:red;"></i></a></form>
                                <a href="/advert/edit/{{$advertnew->id}}">
                                    <i class="fa fa-pencil fa-lg" aria-hidden="true"
                                       style="padding-left: 10px;float: right;color:blue;"></i></a>
                            @if($var == 0)
                                @if($adverts->total() > 0)
                                    <a><i class="fa fa-refresh fa-lg" style="float: right;color:blue;" onclick="refresh();"
                                          aria-hidden="true"></i></a>
                                @else
                                @endif
                            @else
                            @endif


                            <p style="margin:0;word-wrap: break-word">Описание: {{mb_substr($advertnew->content,0,60)}}
                                ...</p>
                                <p style="margin:0">Добалено: {{ date('d-m-Y H:i:s', strtotime($advertnew->updated_at)) }}</p>

                            @if(count($advertnew->types) >= 1)
                                <b>Цена: {{$advertnew->types[0]->price}} {{$advertnew->types[0]->valute}}</b>
                            @else

                            @endif

                            @if(($advertnew->status) == 0)
                                <p>Статус:

                                        <b style="color: green;">На модерации</b>
                                    @endif
                                    </p>
                            </span>
                    </div>
                    <?php $var++ ?>

                @endforeach
                {{$adverts->render()}}
            </div>
        </div>
    </div>


@endsection
@section('scripts')

    <script>

        function clearImg() {
            $('#image').attr('src', '');
            $('#image').css('height', '234px');
            $('#loadfile').css('display', 'block');
        }


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

        function refresh() {
            var user_id = $('#user').attr('value');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/advert/refresh/" + user_id,
                response: 'text',
                data: {user_id: user_id},
                success: function (data) {
                    //console.log(data);
                    location.reload();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        }

        function advertDelete(e) {

            if (confirm("Вы уверены, что хотите удалить?\nЭта операция не восстановима."))
            {
              var id = e;
              var _data = $('.delete-form').serialize();

              $.ajax({
              type: "POST",
              url: "/advert/delete/" + id,
              response: 'text',
              data: _data,
              success: function (data) {
                  console.log(data);
                  location.reload();
              },
              error: function (xhr, str) {
                  alert('Возникла ошибка: ' + xhr.responseCode);
              }
              })
            } else {

            }



        }
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').css('height', 'auto');
                    $('#loadfile').css('display', 'none');

                };

                reader.readAsDataURL(input.files[0]);
            }
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
            console.log(id);
            $('.category_selected').attr('value', $('.category_select :selected').attr('id'));

            $('.regionajax').attr('value', id);


            var _data = $('.subcategory_live').serialize();


            $.ajax({
                type: "POST",
                url: "/test/" + id,
                response: 'text',
                data: _data,
                success: function (data) {

                    $("#subcat").append("<option>Выберите подрубрику</option>").fadeIn();

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
