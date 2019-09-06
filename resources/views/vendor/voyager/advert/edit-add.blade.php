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
        <form class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.advert.update', $dataTypeContent->id) }}@else{{ route('voyager.advert.store') }}@endif" method="POST" enctype="multipart/form-data">
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
                                <i class="voyager-character"></i> {{ __('voyager.post.title') }}
                                <span class="panel-desc"> {{ __('voyager.post.title_sub') }}</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'title',

                            ])
                            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('voyager.generic.title') }}" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif">
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-book"></i> {{ __('voyager.post.content') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'content',

                        ])
                        <textarea class="form-control richTextBox" id="richtextbody" name="body" style="border:0px;">@if(isset($dataTypeContent->content)){{ $dataTypeContent->content }}@endif</textarea>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <div class="panel">
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
                    </div>


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

                                @php
                                    $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                @endphp

                                @foreach($dataTypeRows as $row)

                                        @php
                                            $display_options = isset($row->details->display) ? $row->details->display : NULL;
                                        @endphp

                                        @if($row->type == 'relationship')
                                        <div class="form-group">
                                            <label for="name">{{$row->display_name}}</label>
                                            @include('voyager::formfields.relationship', ['options' => $row->details])

                                        </div>
                                        @endif

                                @endforeach
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
                                <label for="name">{{ __('voyager.post.slug') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'slug',

                                ])
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="slug"
                                       {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}}
                                       value="@if(isset($dataTypeContent->slug)){{ $dataTypeContent->slug }}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.category') }}</label>
                                <select class="form-control category_select" name="category">
                                    @foreach(App\Category::all() as $category)
                                        <option value="{{ $category->id }}"@if(isset($dataTypeContent->category) && $dataTypeContent->category == $category->id) selected="selected"@endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="subcat">
                                <label for="name">Подкатегория</label>
                                <select class="form-control" name="subcategory">
                                    @foreach(App\Subcategory::where('category_id',$dataTypeContent->category)->get() as $subcategory)
                                        <option value="{{ $subcategory->id }}"@if(isset($dataTypeContent->subcategory) && $dataTypeContent->subcategory == $subcategory->id) selected="selected"@endif>{{ $subcategory->title }}</option>
                                    @endforeach
                                </select>
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
