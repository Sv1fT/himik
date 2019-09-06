@extends('himik')
@section('title')
    <title>ОПТхимик - Регионы и Страны</title>
@stop
@section('content')

    <div class="container"style="padding-left: 100px;">
        <div class="content-full">
            <div class="content-left">

                        <div class="header-b" style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;"><div class="row">
                          <div class="col-9" style="color:#00008b;font-size: 18pt;">
                            <p class="m-auto" style="vertical-align: top;margin-top: 41px !important;">Вся Россия</p>
                          </div>
                          <div class="float-right row align-items-end col-3" style="width: 170px;background: none;border:none;box-shadow: none;float: right;text-align: right;">
                                <img  style="height: 30px;border: 1px solid;text-align: center;margin-left: 70px;" src="/image/Flag_of_Russia.png" alt="">
                            </div></div></div>
                            <div class="blog" style="width: 563px;box-shadow:  0 0 10px rgba(0,0,0,2);">
                                @foreach($regions as $region)
                                    <a class="region_link" href="/region/{{$region->id}}">{{$region->name}} [{{$region->count_reg}}]</a>
                                @endforeach
                            </div>


                        <div class="header-b" style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;">Поставщики по странам</div>
                        <div class="blog" style="width: 563px;box-shadow:  0 0 10px rgba(0,0,0,2);">
                            @foreach($countrys as $country)
                                <a class="region_link" href="/country/{{$country->id}}">{{$country->name}} [{{$country->count_reg}}]</a>
                            @endforeach
                        </div>


            </div>


                <div class="content-right" style="text-align: center">

                        <!-- <div class="header-b" style="color:#00008b">Вся Россия</div>
                    <div class="advert-content-home" style="width: 355px;background: none;border:none;box-shadow: none">
                        <img class="img-fluid m-auto" style="    width: 300px;

    box-shadow: 0 0 24px rgba(0,0,0,0.5);
    border: 1px solid;
    border-radius: 8px;
    display: block;
    text-align: center;" src="/image/Flag_of_Russia.png" alt="">
                    </div> -->

                    <div class="text-center mt-3 mt-4">
                      {!! setting('region.advert') !!}
                    </div>
                </div>

        </div>
    </div>

@endsection
