@extends('voyager::master')

@section('page_title', __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">

        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form" action="@if(isset($dataTypeContent->user_id)){{ route('voyager.users-attributes.update', $dataTypeContent->user_id) }}@else{{ route('voyager.users-attributes.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> Название компании
                                <span class="panel-desc"></span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'title',

                            ])

                            <input type="text" class="form-control" id="title" name="company" placeholder="{{ __('voyager.generic.title') }}" value="@if(isset($dataTypeContent->company)){{ $dataTypeContent->company }}@endif">
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-book"></i> Описание компании</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'content',

                        ])
                        <textarea class="form-control richTextBox" id="richtextbody" name="description" style="border:0px;">@if(isset($dataTypeContent->description)){{ $dataTypeContent->description }}@endif</textarea>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <!-- <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{!! __('voyager.post.excerpt') !!}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'excerpt',

                            ])
                            <textarea class="form-control" name="excerpt">@if (isset($dataTypeContent->excerpt)){{ $dataTypeContent->excerpt }}@endif</textarea>
                        </div>
                    </div> -->


                </div>
                <div class="col-md-4">
                  <!-- ### SEO CONTENT ### -->
                  <div class="panel panel-bordered panel-info">
                      <div class="panel-heading">
                          <h3 class="panel-title"><i class="icon wb-search"></i> {{ __('voyager.post.seo_content') }}</h3>
                          <div class="panel-actions">
                              <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                          </div>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <label for="name">{{ __('voyager.post.meta_description') }}</label>
                              <textarea class="form-control" name="meta_description">@if(isset($dataTypeContent->meta_description)){{ $dataTypeContent->meta_description }}@endif</textarea>
                          </div>
                          <div class="form-group">
                              <label for="name">{{ __('voyager.post.meta_keywords') }}</label>
                              <textarea class="form-control" name="meta_keywords">@if(isset($dataTypeContent->meta_keywords)){{ $dataTypeContent->meta_keywords }}@endif</textarea>
                          </div>
                          <div class="form-group">
                              <label for="name">{{ __('voyager.post.seo_title') }}</label>
                              <input type="text" class="form-control" name="seo_title" placeholder="SEO Title" value="@if(isset($dataTypeContent->seo_title)){{ $dataTypeContent->seo_title }}@endif">
                          </div>
                      </div>
                  </div>
                    <!-- ### COMPANY ### -->
                    <div class="panel panel panel-bordered panel-dark">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> Компания</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                              <div class="form-group">
                                  <label for="name">Имя</label>
                                  <input type="text" class="form-control" name="name" placeholder="Имя" value="@if(isset($dataTypeContent->name)){{ $dataTypeContent->name }}@endif">


                              </div>
                              <div class="form-group">
                                  <label for="name">Страна</label>
                                  <select id="country" class="form-control country" name="country">
                                      @foreach(App\Country::all() as $country)
                                          <option value="{{ $country->id }}"@if(isset($dataTypeContent->country) && $dataTypeContent->country == $country->id) selected="selected"@endif>{{ $country->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group d-none">
                                  <label for="name">Регион</label>
                                  <select id="regiones" class="form-control country" name="region">
                                      @foreach(App\Region::all() as $region)
                                          <option value="{{ $region->id }}"@if(isset($dataTypeContent->region) && $dataTypeContent->region == $region->id) selected="selected"@endif>{{ $region->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="form-group d-none">
                                  <label for="name">Город</label>
                                  <select id="city" class="form-control city" name="city">
                                      @foreach(App\City::all() as $city)
                                          <option value="{{ $city->id }}"@if(isset($dataTypeContent->city) && $dataTypeContent->city == $city->id) selected="selected"@endif>{{ $city->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                        </div>
                    </div>

                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> {{ __('voyager.post.details') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Сайт</label>

                                <input type="text" class="form-control" id="slug" name="site"
                                       placeholder="Сайт"
                                       {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "site") !!}}
                                       value="@if(isset($dataTypeContent->site)){{ $dataTypeContent->site }}@endif">
                            </div>
                            <div class="form-group">
                              <label for="name">Адрес</label>

                              <input type="text" class="form-control" id="address" name="address"
                                     placeholder="Сайт"
                                     {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "address") !!}}
                                     value="@if(isset($dataTypeContent->address)){{ $dataTypeContent->address }}@endif">
                            </div>
                            <div class="form-group" id="subcat">
                              <label for="name">Номер телефона</label>

                              <input type="text" class="form-control" id="number" name="number"
                                     placeholder="Сайт"
                                     {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "number") !!}}
                                     value="@if(isset($dataTypeContent->number)){{ $dataTypeContent->number }}@endif">
                            </div>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> {{ __('voyager.post.image') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(isset($dataTypeContent->filename))
                                <img src="{{asset('storage/'.$dataTypeContent->filename) }}" style="width:100%" />
                            @endif
                            <input name="filename" accept="image/*" type="file">
                        </div>
                    </div>


                </div>
                <button type="submit" class="btn btn-primary pull-right">
                <i class="icon wb-plus-circle"></i> Обновить
            </button>
            </div>


        </form>


    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('#slug').slugify();

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif
        });
    </script>

    <script>
        $(".category_select").change(function () {

            $('#subcat').fadeIn();
            $('#subcat').empty();

            var id = $('.category_select :selected').attr('value');
            console.log(id);
            var _data = $('.subcategory_live').serialize();


            $.ajax({
                type: "POST",
                url: "/test/" + id,
                response: 'text',
                data: _data,
                success: function (data) {

                    $("#subcat").append('<label for="name">Подкатегория</label><select id="subcategory" class="form-control" name="subcategory"><option selected="selected">Выберите подрубрику</option></select>').fadeIn();

                    $.each(data, function (i, star) {

                        console.log(star);


                        $("#subcategory").append('<option value="' + star.id + '">' + star.title + '</option>').fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })
        });

        $("#country").change(function () {

    $('#regiones').fadeIn(1000);
    $('#regiones').empty();

    $id = $('#country').children(":selected").val();

console.log($id);
    $('.countryajax').attr('value', $id);


    var _data = $('.country_live').serialize();


    $.ajax({
        type: "POST",
        url: "/test/country/" + $id,
        response: 'text',
        data: _data,
        success: function (data) {
            $("#regiones").append("<option>Выберите Регион</option>").fadeIn();

            $.each(data, function (i, star) {

                $("#regiones").append('<option id="' + star.id + '"value="' + star.id + '">' + star.name + '</option>').fadeIn();

            });

            //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    })
});

$("#regiones").change(function () {

    $('.city').fadeIn();
    $('#city').empty();

    var id = $('#regiones :selected').attr('value');
console.log(id);
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
@stop
