@extends('himik')

@section('title')

    <title>{{$q}} цена, где купить {{$q}} в России</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('meta')

<meta name="description" content="{{$q}} в России, цена оптом и в розницу, где купить спирт по регионам - предложения продам куплю от компаний портала ОПТхимик Россия" />
<meta name="keywords" content="{{$q}}, цена, купить, продам, куплю, россия, страна, портал" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="language" content="ru" />
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="https://opt-himik.ru/image/пlogo.png">
<meta property="og:image" content="https://opt-himik.ru/image/пlogo.png"/>
<meta name="theme-color" content="#ffffff">
<meta property="og:title" content="{{$q}} цена, где купить {{$q}} в России"/>
<meta property="og:description" content="{{$q}} в России, цена оптом и в розницу, где купить {{$q}} по регионам - предложения продам куплю от компаний портала ОПТхимик Россия"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="{{URL::current()}}"/>
<meta property="og:site_name" content="opt-himik.ru"/>
<meta property="og:locale" content="ru"/>
@stop
@section('content')
    <div id="search_field">
        <div class="container">
            <div class="content-full">


                <div class="content-left">
                    <div class="tsb" style="width: 1020px;">

                        <div id="search_ajax" style="width: 600px;display: inline-block;">

                            <h2 class="header-b" id="search_text" style="color:black;font-weight: normal">{{$q}}</h2>
                            
                            @if(isset($search))
                                @foreach($search as $adverts)


                                    <div class="blog" style="    padding-bottom: 0;width: 600px;">
                                    <span style="display: block;padding: 1px 0px 0px 0px;margin-left: -5px;">
                                        <ins style="display: block;padding: 5px;">
                                            @if($adverts->user_id == '209')
                                                <a class="region_link" style="color:#00008b;font-weight: bold;"
                                                   href="{{$adverts->slug}}">{{$adverts->title}}</a>
                                            @else
                                                @if(isset($adverts->citys))
                                                    <a class="region_link" style="color:#00008b;font-weight: bold;"
                                                       href="http://{{$adverts->citys->slug.'.opt-himik.ru/'.$adverts->slug}}">{{$adverts->title}}</a>
                                                @else
                                                    <a class="region_link" style="color:#00008b;font-weight: bold;"
                                                       href="{{$adverts->slug}}">{{$adverts->title}}</a>
                                                @endif       
                                            @endif
                                        </ins>
                                        <span style="padding-left: 10px;display: inline-block;color: black;"><?=mb_substr($adverts->content, 0, 220) ?>
                                            ...</span>
                                    </span>

                                        <span class="pl-2" style="display: inline-block;/*! float: left; */vertical-align: top;">

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
                                        <div style="display: inline-block;width: 420px;">
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


                                {{$search->appends(['user' => 'advert','quote' => $q]) -> links()}}
                            @endif
                        </div>

                    </div>

                </div>
                <div class="content-right">

                    @include('search.search_filters')

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
