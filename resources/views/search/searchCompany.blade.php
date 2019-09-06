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
                            <h2 class="ml-4" id="search_text" style="color:black">{{$q}}</h2>

                            <div class="">
                                <!-- <h2 class="pl-2" style="color: black;">Каталог компаний</h2> -->
                                <img src="image/img0005.png" style="border-width: 0;height: 8px;width: 100%;">
                                @foreach($search as $company)
                                    @foreach($company->attributes as $item)
                                        <div style="text-align: left;padding-top: 10px;">
                                            <span class="blog-company-image mb-3">
                                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($item->filename))
                                                    <img src="/storage/{{$item->filename}}" alt="{{$item->company}}" title="{{$item->company}}" style="width:160px;height: 160px;display: block;margin: 0 auto;">
                                                @else

                                                    <img src="/image/not_found.jpg" alt="{{$item->company}}" title="{{$item->company}}" style="width:160px;height: 160px;display: block;margin: 0 auto;">
                                                @endif
                                            </span>
                                            <span class="blog-company-content">


                                            <a class="region_link" style="color:#00008b;font-weight: bold" href="/blog/company/{{$item->user_id}}">{{$item->company}}</a>

                                        <p style="margin: 0 0 5px;">Город: {{$company->city}}</p>
                                        <p style="margin: 0 0 5px;">Адрес: {{$item->address}}</p>
                                        <p>Телефон: {{$item->number}}</p>
                                        <p>Описание компании: {{$item->description}}</p>





                                    </span>

                                        </div>
                                    @endforeach
                                @endforeach

                                {{$search->render()}}
                            </div>


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
                    {{--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
                    {{--<!-- поиск по компаниям -->--}}
                    {{--<ins class="adsbygoogle"--}}
                    {{--style="display:inline-block;width:390px;height:380px;margin-left: 5px;margin-top: 20px;"--}}
                    {{--data-ad-client="ca-pub-7737478077892007"--}}
                    {{--data-ad-slot="6498614976"></ins>--}}
                    {{--<script>--}}
                    {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                    {{--</script>--}}

                </div>
            </div>

        </div>

    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/search.js')}}"></script>
@endsection
