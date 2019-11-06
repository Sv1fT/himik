@extends('himik')

@section('title')

    <title>ОПТхимик - Портал химической промышленности России №1</title>

@endsection

@section('meta')
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="canonical" href="{{\Illuminate\Support\Facades\Request::url()}}"/>
    <meta property="og:site_name" content="ОПТхимик"/>
    <meta property="og:title" content="ОПТхимик"/>
    <meta name="description" content="Бизнес объявления России, региона, города. Объявления компаний куплю, продам с ценой и фото на opt-himik.ru" />
    <meta name="keywords" content="бизнес, объявления россии, химия, оптом, opt-himik" />
    <meta property="og:url" content="https://opt-himik.ru/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:locale:alternate" content="en-us"/>
    <meta property="og:image" content="https://opt-himik.ru/image/logo_ogg.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"
          content="Портал химической промышленности России №1 «ОПТхимик»! Это одна из крупнейших в России специализированных торговых площадок по продаже продуктов химической промышленности."/>

@endsection

@section('content')

    <div class="content lazy">
        <div id="slider-wrap" style="padding-left: 27px;">
            <div id="slider">

                <h3 style="margin-left: 0px;">Топ компаний</h3>

                <div class="slider">

                    <div class="owl-carousel" style="text-align: center;display: block;margin-top: 60px;">
                        @foreach($sledier as $item)
                            @foreach($item->attributes as $items )

                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($items->filename))
                                    @if($items->site != "")
                                        <a href="http://{{$items->site}}" target="_blank" rel="noreferrer">
                                            <img class="lazy" data-src="/storage/{{$items->filename}}" title="{{$items->title}}"
                                                 alt="{{$items->company}}"></a>@else
                                        <a href="/">
                                            <img src="/storage/{{$items->filename}}" rel="noreferrer" title="{{$items->title}}"
                                                 alt="{{$items->company}}"></a>
                                    @endif
                                @else

                                    <img src="/image/not_found.jpg" title="{{$items->title}}" alt="{{$items->company}}">
                                @endif

                            @endforeach
                        @endforeach
                    </div>
                </div>


            </div>


        </div>
        <div class="container">

            <div class="col-md-7 pl-0 pr-0 pr-md-4">
                <div class="col-md-12 p-0">
                    <h1 class="text-left header-b">Товар дня</h1>

                    @foreach($productDay as $advertnew)



                        <div class="content-home col-12 col-md-12" data-uk-scrollspy="{cls:'uk-animation-scale-down', delay:500}" itemscope="" itemtype="http://schema.org/Product">
                            <div class="col-md-12 pl-0 pr-0 mb-3" itemprop="name">
                                @if(isset($advertnew->citys) > 0)
                                    @if($advertnew->user_id == '209')
                                        <p class="m-0"><a itemprop="url" style="font-weight: bold;color:#00008b;font-size: 19px;"
                                              href="http://{{$advertnew->citys->slug.'.opt-himik.ru/'.$advertnew->slug}}">{!! mb_substr($advertnew->title,0,50) !!}</a></p>
                                    @else
                                        <p class="m-0"><a itemprop="url" style="font-weight: bold;color:#00008b;font-size: 19px;"
                                              href="{{$advertnew->slug}}">{!! mb_substr($advertnew->title,0,50) !!}</a></p>
                                    @endif
                                @else
                                    @if($advertnew->user_id == '209')
                                        <p class="m-0"><a itemprop="url" style="font-weight: bold;color:#00008b;font-size: 19px;"
                                              href="http://{{env('LINK_ADVERTS').'/'.$advertnew->slug}}">{!! mb_substr($advertnew->title,0,50) !!}</a></p>
                                    @else
                                        <p class="m-0"><a itemprop="url" style="font-weight: bold;color:#00008b;font-size: 19px;"
                                              href="{{$advertnew->slug}}">{!! mb_substr($advertnew->title,0,50) !!}</a></p>
                                    @endif
                                @endif
                            </div>
                            <div class="col-12 pl-0 pr-0 text text-center col-lg-3 mb-4 mb-md-0" style="background-color: #e8e8e8;">

                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($advertnew->filename))
                                    <img itemprop="image" class="img-responsive m-auto lazy" title="{{$advertnew->title}}" style="max-width: 100%;"
                                         data-src="/storage/{{$advertnew->filename}}" alt="{{$advertnew->title}}">
                                @else
                                    <img itemprop="image" class="img-responsive m-auto" src="/image/not_found.jpg" alt="{{$advertnew->title}}">
                                @endif
                            </div>
                            <div class="col-12 pr-0 col-12 col-lg-9 pl-3">

                                <p style="font-size: 16px;" class="margin-top-5">Описание: <span itemprop="description">{!! mb_substr($advertnew->content,0,200) !!}
                                        ...</span></p>
                                <div class="badge eye pull-right"><img src="image/eye.svg"
                                                                       alt="">{{$advertnew->views_day}}</div>
                                <p class="margin-top-5">

                                    Добавлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($advertnew->created_at)->formatLocalized('%d %f %Y')}}

                                @if(count($advertnew->types) >= 1)
                                    <p>
                                        <span itemprop="offers" itemscope=""
                                              itemtype="http://schema.org/Offer">
                                            <span itemprop="priceSpecification" itemscope=""
                                                  itemtype="http://schema.org/PriceSpecification">
                                                <b style="font-size: 16px;">Цена: <span itemprop="price"
                                                               content="{{$advertnew->types[0]->price}}">{{$advertnew->types[0]->price}}</span> <span
                                                            itemprop="priceCurrency"
                                                            content="{{$advertnew->types[0]->valute}}">{{$advertnew->types[0]->valute}}</span></b>
                                            </span>
                                        </span>
                                    </p>
                                @else
                                
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 p-0">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <h2 class="header-b text-left">Блог компаний</h2>
                        </div>
                        <div class="col-md-7 col-12 float-right pt-md-4 d-md-block d-none">
                            {!! setting('glavnaya.advert') !!}
                        </div>
                    </div>






                    @if(isset($blog))

                        <div class="col-md-12 blog">

                            <div style="padding: 10px">
                                @foreach($blog as $items)
                                    <p>
                                        <b style="color:#696969;font-size: 24px"> {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($items[0]->created_at)->formatLocalized('%d %f %Y')}}
                                            г.</b></p>
                                    @foreach($items as $item)

                                        <p><a style="color:#00008b;font-size:19px;font-weight: bold;"
                                              href="blog/post/{{$item->id}}">{{$item->name}}</a></p>
                                        <p style="color:black;font-size: 16px;">{!! mb_substr($item->content,0,180) !!}
                                            ...</p>


                                    @endforeach
                                    <p style="height: 2px;width: 100%;background-color: darkgray;box-shadow: 0 0 1px rgba(0,0,0,0.5);"></p>
                                @endforeach
                                <a href="/blog" style="color: #000000;
        font-family: Arial;
        display: block;

        padding-top: 7px;
        height: 40px;
        font-size: 16px;
        width: 170px;"><img src="image/img0006.png" alt="" style="margin-right: 10px;display: inline-block;">Еще новости</a>
                            </div>
                        </div>
                    @else
                        <h3>Никто еще не писал в блог</h3>
                    @endif
                </div>
            </div>

            <div class="col-md-5 pl-0 pr-0">
                <div class="header-b2 text-left">Новые объявления</div>
<div class="row m-auto pt-3 pt-md-0">
                    @foreach($newadvert as $advertnew)


                        <div class="col-5 col-md-12 mb-lg-3 content-home ml-auto mr-auto mt-0 mb-5" itemscope="" itemtype="http://schema.org/Product">
                            <div class="col-md-4 span-left pr-0 pl-0 mr-2">
                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($advertnew->filename))
                                    <img itemprop="image" style="height: 121px" class="img-responsive m-auto lazy" title="{{$advertnew->title}}"
                                         data-src="/storage/{{$advertnew->filename}}"
                                         alt="{{$advertnew->title}}">
                                @else
                                    <img itemprop="image" class="img-responsive" title="{{$advertnew->title}}" src="/image/not_found.jpg"
                                         alt="{{$advertnew->title}}">
                                @endif
                            </div>
                            <div class="col-md-8 span-right pl-0 pt-0 pb-0 pr-0 col-12">
                                @if($advertnew->user_id == '209')
                                    <p><span  itemprop="name" content="{{$advertnew->title}}"><a itemprop="url" style="font-weight: bold;color:#00008b"
                                          href="{{$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 30)?>
                                            ...</a></span></p>
                                @else
                                    <p><span  itemprop="name" content="{{$advertnew->title}}">
                                            <a itemprop="url" style="font-weight: bold;color:#00008b"
                                          href="http://{{$advertnew->citys->slug.'.opt-himik.ru/'.$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 30)?>
                                            ...</a></span></p>
                                @endif
                                <div>
                                    <p class="margin-top-5">Описание: <span
                                                itemprop="description" content="{{strip_tags($advertnew->short_content)}}">{{strip_tags($advertnew->short_content)}}</span>
                                        </p>

                                    <p class="margin-top-5">
                                        Добавлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($advertnew->created_at)->formatLocalized('%d %f %Y')}}</p>
                                    @if(count($advertnew->types) >= 1)
                                        <p class="mb-0">
                                            <span itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                <span itemprop="priceSpecification" itemscope=""
                                                      itemtype="http://schema.org/PriceSpecification">
                                                    <b>Цена: <span itemprop="price"
                                                                   content="{{$advertnew->types[0]->price}}">{{$advertnew->types[0]->price}}</span> <span
                                                                itemprop="priceCurrency"
                                                                content="{{$advertnew->types[0]->valute}}">{{$advertnew->types[0]->valute}}</span></b>
                                                </span>
                                            </span>
                                        </p>
                                    @else

                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach


                @foreach($newadvertUpdate as $item)


                    <div class="col-5 col-md-12 mb-lg-3 content-home ml-auto mr-auto mt-0 mb-5" itemscope="" itemtype="http://schema.org/Product">
                        <div class="col-md-4 span-left pr-0 pl-0 mr-2">
                            @if(Illuminate\Support\Facades\Storage::disk('public')->exists($item->filename))
                                <img itemprop="image" style="height: 121px" class="img-responsive m-auto lazy" title="{{$item->title}}" data-src="/storage/{{$item->filename}}"
                                     alt="{{$item->title}}">
                            @else
                                <img itemprop="image" class="img-responsive " title="{{$item->title}}" src="/image/not_found.jpg"
                                     alt="{{$item->title}}">
                            @endif
                        </div>
                        <div class="col-md-8 span-right pl-0 pt-0 pb-0 pr-0 col-12">
                            @if($item->user_id == '209')
                                <p><span itemprop="name" content="{{$item->title}}"><a itemprop="url" style="font-weight: bold;color:#00008b"
                                      href="{{$item->slug}}"><?=mb_substr($item->title, 0, 30)?>
                                        ...</a></span></p>
                            @else
                                <p><span itemprop="name" content="{{$item->title}}"><a itemprop="url" style="font-weight: bold;color:#00008b"
                                      href="http://{{$item->citys->slug.'.opt-himik.ru/'.$item->slug}}"><?=mb_substr($item->title, 0, 30)?>
                                        ...</a></span></p>
                            @endif
                            <p class="margin-top-5">Описание: <span
                                        itemprop="description" content="{{strip_tags($item->short_content)}}">{{strip_tags($item->short_content)}}</span></p>

                            <p class="margin-top-5">
                                Обновлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($item->updated_at)->formatLocalized('%d %f %Y'    )}}</p>
                            @if(count($item->types) >= 1)
                                    <span itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                            <span itemprop="priceSpecification" itemscope=""
                                                  itemtype="http://schema.org/PriceSpecification">
                                                <b>Цена: <span itemprop="price"
                                                               content="{{$item->types[0]->price}}">{{$item->types[0]->price}}</span> <span
                                                            itemprop="priceCurrency"
                                                            content="{{$item->types[0]->valute}}">{{$item->types[0]->valute}}</span></b>
                                            </span>
                                        </span>
                            @else

                            @endif
                        </div>
                    </div>
                @endforeach
</div>
            </div>
            <div class="col-md-5 pr-0 pl-0">
                <div class="header-b2 text-left pt-0 mt-0 pt-md-2 mt-md-2">Новые вакансии</div>

                @foreach($vacants as $vacant)


                    <div class="col-md-12 content-home">

                        <div class="col-md-12 span-right pl-0 pr-0" style="width: 100%;">
                            <p><a style="font-weight: bold;color:#00008b"
                                  href="/vacant/{{$vacant->slug}}"><?=mb_substr($vacant->name, 0, 40)?>...</a></p>
                            <p class="margin-top-5">Описание: {{mb_substr($vacant->description,0,60)}}...</p>
                            <p class="margin-top-5">
                                Добавлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($vacant->created_at)->formatLocalized('%d %f %Y')}}</p>
                            <p class="mb-0" style="font-weight: bold;">Зарплата: {{$vacant->price}}
                                - {{$vacant->price1}} {{$vacant->valute}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container">
            <div class="col-md-12 p-0">
                <div class="col-md-12">
                    <h2 class="header-b2 text-left">Новые резюме</h2>
                    @if(isset($resume))
                        <div class="row">
                        @foreach($resume as $resumes)
                            <div class="col-5 col-md-2 ml-auto mr-auto mr-md-5 resume text-center ml-md-0">
                                <p><a style="font-weight: bold;color:#00008b"
                                      href="/resume/{{$resumes->slug}}">{{$resumes->dolzhnost}}</a></p>

                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($resumes->filename))
                                    <img class="img-responsive lazy" data-src="{{secure_asset('/storage/'.$resumes->filename)}}"
                                         alt="{{$resumes->dolzhnost}}">
                                @else
                                    <img class="img-responsive" src="/image/not_found.jpg" alt="ОПТхимик">
                                @endif
                                <p class="mb-0 pt-2"
                                   style="font-weight: bold;">{{$resumes->price}} {{$resumes->valute}}</p>
                            </div>
                        @endforeach
                        </div>
                    @else
                        <h2>Резюме пока нет</h2>
                    @endif
                </div>
            </div>
        </div>

        <div class="content-full1">
            <p style="font-size: 30pt;padding-top: 20px;">Почему мы? Всё просто</p>
            <div class="infohome" data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:600}">
                <div class="infosite">
                    <p>№1</p>
                </div>
                <p class="info-p">Портал химической промышленности России</p>
            </div>
            <div class="infohome" data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:800}">
                <div class="infosite">
                    <p>{{ $category }}</p>
                </div>
                <p class="info-p">Рубрик</p>
            </div>
            <div class="infohome" data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:1000}">
                <div class="infosite">
                    <p>{{ $subcategory }}</p>
                </div>
                <p class="info-p">Подрубрик</p>
            </div>
            <div class="infohome" data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:1200}">
                <div class="infosite">
                    <p>{{ $users }}</p>
                </div>
                <p class="info-p">Представлено компаний</p>
            </div>
            <div class="infohome" data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:1400}">
                <div class="infosite">
                    <p>{{ $advertcount }}</p>
                </div>
                <p class="info-p">Представлено объявлений</p>
            </div>


        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            items: 5,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: false,
            autoplaySpeed: 1000,
            margin: 10,
            nav: true,
            navText: ["<i class='fa fa-chevron-left slide-nav slide-previous' aria-hidden='true'></i>", "<i class='fa fa-chevron-right slide-nav slide-next' aria-hidden='true'></i>"],
            dots: false,
        })
    </script>

    <script>
        $(document).ready(function () {
            $("img.lazy").Lazy({
                // your configuration goes here
                scrollDirection: 'vertical',
                effect: 'fadeIn',
                visibleOnly: true,
                onError: function(element) {
                    console.log('error loading ' + element.data('src'));
                }
            });
        });
    </script>
@endsection
