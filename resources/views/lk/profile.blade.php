@extends('himik')

@section('title')

    <title>ОПТхимик - Личный кабинет </title>

@stop

@section('content')

    <div class="container">
        @foreach($profile as $item)
        <div>

            <span class="profile-left" style="box-shadow: 0 0 10px rgba(0, 0, 0, 1);">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/profile') }}">
                {{ csrf_field() }}
                    <div class="col-md-6" style="margin-top: 30px;">

                    <div class="form-group">

                        <label for="name" class="col-md-4 control-label">Контактное лицо:</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control" name="name" value="{{$item->name}}" required="" autofocus="">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                            <label for="organiz" class="col-md-4 control-label">Организация/Компания:</label>
                        <div class="col-md-8">
                            <input id="organiz" class="form-control" name="company" type="text" value="{{$item->company}}" required="" autofocus="">
                        </div>
                    </div>
                        @endforeach

                        <div class="form-group">
                        <label for="country" class="col-md-4 control-label">Страна:</label>
                    <div class="col-md-8">
                        <select id="country" class="form-control" name="country" type="text">
                            <option style="font-size: 15pt;color:#00008b;" disabled> Страны </option>
                            @foreach($country as $item)

                                <option  @if(Auth::user()->attributes[0]->country == $item->id) selected @else @endif id="{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach


                        </select>
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="regoin" class="col-md-4 control-label">Регион:</label>
                    <div class="col-md-8">
                        <select id="region" class="form-control" name="region" type="text">

                            <option style="font-size: 15pt;color:#00008b;" disabled> Регионы </option>
                            @foreach($regions as $item)
                                <option  @if(Auth::user()->attributes[0]->region == $item->id) selected @else @endif id="{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach


                        </select>
                        </div>
                    </div>
                        @foreach($profile as $item)

                            <div class="form-group">
                    <label for="sity" class="col-md-4 control-label">Город:</label>
                        <div class="col-md-8">
                    <select id="city" class="form-control" name="city" type="text">
                            <option style="font-size: 15pt;color:#00008b;" disabled> Города </option>
                            @foreach($city as $items)
                                <option  @if(Auth::user()->attributes[0]->city == $items->id) selected @else @endif value="{{$items->id}}">{{$items->name}}</option>
                            @endforeach

                        </select>
                            </div>
                        </div>
                            <div class="form-group">
                    <label for="adress" class="col-md-4 control-label">Адрес:</label>
                        <div class="col-md-8">
                    <input id="adress"  class="form-control" name="address" type="text" value="{{$item->address}}">
                            </div>
                        </div>

                            <div class="form-group">
                    <label for="number" class="col-md-4 control-label">Телефон:</label>
                        <div class="col-md-8">
                    <input id="number"  class="form-control" name="number" type="text" value="{{$item->number}}">
                            </div>
                        </div>

                            <div class="form-group">
                    <label for="site" class="col-md-4 control-label">Сайт:</label>
                        <div class="col-md-8">
                    <input id="site"  class="form-control" name="site" type="text" value="{{$item->site}}">
                            </div>
                        </div>

                            <div class="form-group">
                    <label for="description" class="col-md-4 control-label">Деятельность компании:</label>
                        <div class="col-md-8">
                    <textarea style="min-height: 68px;" id="richtextbody"  class="form-control richTextBox" name="description" type="text" >{!! $item->description !!}</textarea>
                            <input id="description"  class="form-control" name="user_id" type="hidden" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                             <button @if(!Auth::user()->attributes[0]->city) disabled @endif id="btn-send" class="btn" style="margin:0 auto;border-width: 0;width: 100%;height: 50px;font-weight: bold;font-size: 14pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;margin-top: 30px;margin-bottom: 30px;border-radius: 5px;">Сохранить изменения</button>
                            </div>
                        </div>


                </div>

                <div class="col-md-6" style="text-align: center;margin-top: 30px;">

                    <img  onclick="loadImage()" class="img-responsive mx-auto" id="image" src="{{asset("storage/$item->filename")}}">
                     <p>(размер файла не более 1Мб)</p>
<input id="clear" type="button" onclick="clearImg()" value="Очистить">
<label id="loadfile" for="uploadbtn" style="position: relative;    left:8px;
    top: -180px;display: none">Загрузить изображение</label>
                                  <input type="file" accept="image/*" name="file" value="" id="uploadbtn" style="display: none">
                </div>


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
            </span>

        </div>
        @endforeach
    </div>


@endsection
@section('scripts')
<!-- <script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script> -->
    <script>

    // ClassicEditor
    //     .create( document.querySelector( '#description' ) )
    //     .then( editor => {
    //         console.log( editor );
    //     } )
    //     .catch( error => {
    //         console.error( error );
    //     } );


        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').css('height','auto');
                    $('#loadfile').css('display','none');

                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        $("#uploadbtn").change(function(){
            readURL(this);
            $('#loadfile').css('display','none');

        });


        function clearImg() {
            $('#image').attr('src','');
            $('#image').css('height','234px');
            $('#loadfile').css('display','block');
        }

        function loadImage() {
            $("#uploadbtn").click();
        }

        $("#country").change(function () {

            $('#region').fadeIn();
            $('#region').empty();

            var id = $('#country :selected').attr('id');

            console.log(id);

            $('.countryajax').attr('value', id);


            var _data = $('.country_live').serialize();


            $.ajax({
                type: "POST",
                url: "/test/country/" + id,
                response: 'text',
                data: _data,
                success: function (data) {
                    console.log(data);
                    $("#region").append("<option>Выберите Регион</option>").fadeIn();

                    $.each(data, function (i, star) {

                        console.log(star);
                        

                        $("#region").addClass('error');

                        $("#region").append('<option id="' + star.id + '">' + star.name + '</option>').fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });

        $("#region").change(function () {

            $("#region").removeClass('error');
            $('#city').fadeIn();
            $('#city').empty();

            var id = $('#region :selected').attr('id');

            console.log(id);

            $('.regionajax').attr('value', id);


            var _data = $('.subcategory_live').serialize();

            console.log(_data);
            $.ajax({
                type: "POST",
                url: "/test/region/" + id,
                response: 'text',
                data: _data,
                success: function (data) {
                    console.log(data);
                    $("#city").append("<option>Выберите Город</option>").fadeIn();

                    $.each(data, function (i, star) {

                        console.log(star);

                        $("#city").addClass('error');
                        $("#city").append('<option id="' + star.id + '">' + star.name + '</option>').fadeIn();


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


    $("#city").change(function () {
        $("#city").removeClass('error');
        $("#btn-send").prop('disabled',false);
    });
    </script>
@endsection
