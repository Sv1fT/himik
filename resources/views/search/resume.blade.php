@extends('himik')

@section('title')

    <title>ОПТхимик поиск - {{$q}} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content')
    <div id="search_field">
        <div class="container">
            <div class="content-full">


                <div class="content-left">
                    <div class="tsb" style="width: 1020px;">

                        <div id="search_ajax" style="width: 600px;display: inline-block;">

                            <h2 class="header-b" id="search_text" style="color:black;font-weight: normal">{{$q}}</h2>


                            <section id="content-tab1">
                                @foreach($search as $item)
                            <div class="bg-white p-3 mb-4" style="text-align: left;border-bottom: 1px solid;padding-top: 10px;box-shadow: 0 0 10px rgba(0,0,0,0.5);">

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
                                                {{--<p style="font-size: 12pt; color: gray;">Возраст: </p>--}}
                                                {{--<p style="font-size: 12pt; color: gray;">Желаемый город: </p>--}}
                                                {{--<p style="font-size: 12pt; color: gray;">Образование: </p>--}}

                                                </span>
                                            <span class="col-12">
                                                    <p style="font-size: 12px; color: #333333;">Опыт работы: {{mb_substr($item->opit,0,75)}}...</p>
                                            <p style="font-size: 12px; color: #333333;word-wrap: break-word;">{{mb_substr($item->description,0,260)}}...</p>
                                                </span>
                                        </div>
                            </div>
                                @endforeach
                            </section>


                            {{$search->appends(['user' => 'advert','quote' => $q]) -> links()}}
                        </div>

                    </div>

                </div>
                <div class="content-right">

                    @include('search.search_filters2')

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
@endsection
@section('scripts')
    <script src="{{ asset('js/search.js')}}"></script>
@endsection