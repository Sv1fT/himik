@extends('himik')
<?php

$text = mb_substr($advert[0]->content, 0, 100);
$arr = explode(' ', $text);
$arr = array_slice($arr, 0, 50);
$text = implode(' ', $arr); // Этот текст нужно обработать как...
unset($arr);


?>
@section('title')
    @foreach($advert as $adverts)
        @if($advert[0]->seo_title != '')
            <title>{{$advert[0]->seo_title}}</title>
        @else

            @if($advert[0]->user_id != '2')
                @if(isset($advert[0]->citys->name))
                    <title>Продам {{ $advert[0]->title }}, где купить в {{$advert[0]->citys->name}}"</title>
                @else
                    <title>Продам {{ $advert[0]->title }}, где купить в др. городах"</title>

                @endif
            @else
                @if(isset($advert[0]->citys->name))
                    <title> Куплю {{ $advert[0]->title }}, где купить в {{$advert[0]->citys->name}}"</title>
                @else
                    <title> Куплю {{ $advert[0]->title }}, где купить в др. городах"</title>

                @endif

            @endif

        @endif
    @endforeach
@endsection

@section('meta')
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="canonical" href="{{URL::current()}}"/>
    <meta property="og:site_name" content="ОПТхимик"/>
    @if($advert[0]->seo_title != '')
        <meta property="og:title" content="{{$advert[0]->seo_title}}"/>
    @else
        <meta property="og:title" content="{{$advert[0]->title}}"/>
    @endif
    <meta property="og:description" content="{{$advert[0]->content}}"/>
    <meta property="og:url" content="{{URL::current()}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:locale:alternate" content="en-us"/>
    <meta property="og:image" content="https://opt-himik.ru/storage/{{$adverts->filename}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if($advert[0]->meta_keywords != '')
        <meta name="keywords"
              content="{{$advert[0]->meta_keywords}}"/>
    @else
        <meta name="keywords"
              content="куплю {{$advert[0]->title}}, продам {{$advert[0]->title}}, купить {{$advert[0]->title}}"/>
    @endif
    @if($advert[0]->meta_description != '')


        <meta name="description" content="{{$advert[0]->meta_description}}">
    @else
        @if($advert[0]->user_id != '2')
            @if(isset($advert[0]->citys->name))
                <meta name="description"
                      content="Продам {{ $advert[0]->title }} - {{substr($text, 0, strrpos($text, '.'))}}, где купить в {{$advert[0]->citys->name}}"/>
            @else
                <meta name="description"
                      content="Продам {{ $advert[0]->title }} - {{substr($text, 0, strrpos($text, '.'))}}, где купить в др. городах"/>

            @endif
        @else
            @if(isset($advert[0]->citys->name))
                <meta name="description"
                      content="Куплю {{ $advert[0]->title }} - {{substr($text, 0, strrpos($text, '.'))}}, где купить в {{$advert[0]->citys->name}}"/>
            @else
                <meta name="description"
                      content="Куплю {{ $advert[0]->title }} - {{substr($text, 0, strrpos($text, '.'))}}, где купить в др. городах"/>

            @endif

        @endif
    @endif

@endsection
@section('content')


    <div class="container">

        <div class="row">
            <div class="col-md-7">
                <div class="col-md-12 col-xs-12 content-adverts-show">
                    @foreach($advert as $adverts)
                        <div style="text-align: left;padding-top: 10px;" itemscope="" itemtype="http://schema.org/Product">
                                <span itemprop="name">

                                <h1 class="text-capitalize"><a itemprop="url" style="display:block;margin-left:10px;font-size: 18pt;"
                                                               href="/{{$adverts->slug}}">{{$adverts->title}}</a></h1></span>
                            <div style="margin-left:10px;">
                                Добалено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($adverts->created_at)->formatLocalized('%d %f %Y')}}
                                <p style="margin-left:10px;display: inline;float: right;margin-right: 10px"><i
                                            class="post_views_icon _icon"></i><img src="image/eye.svg"
                                                                                   alt=""> {{$adverts->views}}
                                    (+{{$adverts->views_day}})</p>
                                @if($adverts->user_id != '2')
                                    <p class="ml-0" style="color: black; margin: 12px">
                                        @if(Illuminate\Support\Facades\Storage::disk('public')->exists($adverts->filename))
                                            <img itemprop="image" src="/storage/{{$adverts->filename}}"
                                                 style="margin: 14px;margin-left:0;float:left;width: 210px;    margin-top: 5px;"
                                                 alt="{{$adverts->title}}" title="{{$adverts->title}}">
                                    <div itemprop="description" class="ml-0"
                                         style="color: black; margin: 12px">{!!preg_replace("/\b((http(s?):\/\/)|(www\.))([\w\.]+)([\/\w+\.]+)([\?\w+\.\=]+)([\&\w+\.\=]+)\b/i", "<a href=\"http$3://$4$5$6$7$8\" target=\"_blank\">$2$4$5$6$7$8</a>", nl2br($adverts->content))!!}</div>
                                @else
                                    <img itemprop="image" src="/image/not_found.jpg"
                                         style="margin: 14px;margin-left:0;float:left;width: 210px;    margin-top: 5px;"
                                         alt="{{$adverts->title}}" title="{{$adverts->title}}">
                                    <div itemprop="description" class="ml-0"
                                         style="color: black; margin: 12px">{!!preg_replace("/\b((http(s?):\/\/)|(www\.))([\w\.]+)([\/\w+\.]+)([\?\w+\.\=]+)([\&\w+\.\=]+)\b/i", "<a href=\"http$3://$4$5$6$7$8\" target=\"_blank\">$2$4$5$6$7$8</a>", nl2br($adverts->content))!!}</div>
                                @endif
                            </div>
                            @else
                                <div itemprop="description" class="ml-0"
                                     style="color: black; margin: 12px">{!!preg_replace("/\b((http(s?):\/\/)|(www\.))([\w\.]+)([\/\w+\.]+)([\?\w+\.\=]+)([\&\w+\.\=]+)\b/i", "<a href=\"http$3://$4$5$6$7$8\" target=\"_blank\">$2$4$5$6$7$8</a>", nl2br($adverts->content))!!}</div>
                            @endif
                            @if($adverts->user_id != '2')
                                <div style="display: inline-block;width: 100%;">
                                    <table style="text-align: center;width: 100%;">
                                        <tr>
                                            <td class="p-3" style="border-right: 3px solid #b3b3b3;;width: 100px;">Упаковка</td>
                                            @foreach($adverts->types as $item)
                                                @if(isset($item))
                                                    <td>{{$item->type}}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                        <tr style="border-bottom: 3px solid #b3b3b3;">
                                            <td class="p-3" style="border-right: 3px solid #b3b3b3;;width: 100px;">Вес</td>
                                            @foreach($adverts->types as $item)
                                                <td>{{$item->mass}}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td class="p-3" style="border-right: 3px solid #b3b3b3;;width: 100px;font-weight: bold">
                                                Цена:
                                            </td>
                                            <th itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">

                                                @if(isset($adverts->types[0]->price))

                                                @foreach($adverts->types as $item)
                                                    @if($item->price != "")
                                                        <span>
                                                            <span itemprop="priceSpecification" itemscope="" itemtype="http://schema.org/PriceSpecification">
                                                                <span itemprop="price" content="{{preg_replace("/[^,.0-9]/", '', $item->price)}}">{{$item->price}}</span>
                                                                    @if(isset($item->value))
                                                                        <span itemprop="priceCurrency" content="{{$item->valute}}">{{$item->valute}}</span>
                                                                    @else
                                                                        <span itemprop="priceCurrency" content="RUB">{{$item->valute}}</span>
                                                                    @endif
                                                            </span>
                                                        </span>
                                                    @endif
                                                @endforeach
                                                @else
                                                    <span>
                                                        <span itemprop="priceSpecification" itemscope="" itemtype="http://schema.org/PriceSpecification">
                                                            <span itemprop="price" content="Не указана">
                                                                Не указана
                                                            </span>
                                                            <span itemprop="priceCurrency" content="RUB">

                                                            </span>
                                                        </span>
                                                    </span>
                                                @endif
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            @else
                          </div>
                          @endif
                        </div>

                    @endforeach
                    <div class="col-12 p-3 text-right">
                        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                        <script src="//yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" data-services="vkontakte,facebook,gplus,twitter"></div>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12 content-adverts-show">
                    <div>
                        <div class="col-12">
                            <h3 style="color:black;">Контакты компании</h3>
                        </div>

                        <hr style="height: 3px;background-color: #b3b3b3;">
                        @foreach($user as $users)



                            @if($users->id != '2')
                                @foreach($users->attributes as $item)
                                    <div class="col-md-3 col-xs-12 text-center pl-1 pr-2 pb-0">
                                        @if(Illuminate\Support\Facades\Storage::disk('public')->exists($item->filename))
                                            <img style="height: 120px;" class="img-fluid" src="/storage/{{$item->filename}}"
                                                 alt="{{$item->company}}">
                                        @else
                                            <img style="height: 120px;" class="img-fluid" src="/image/not_found.jpg"
                                                 alt="{{$item->company}}">
                                        @endif
                                    </div>
                                    <div class="col-md-9 col-xs-12">

                                        <div class="text-center"
                                             style="color:#00008b;font-weight: bold;font-size: 16px"><?=mb_substr($item->company, 0) ?></div>
                                        <div style="float: right;color: black;"><?=mb_substr($region[0]->name, 0) ?></div>
                                        <div style="color: black;">Регион:</div>
                                        <div style="float: right;color: black;">{{mb_substr($city[0]->name, 0)}}</div>
                                        <div style="color: black;">Город:</div>
                                        <div style="float: right;color: black;"> {{$item->address}}</div>
                                        <div style="color: black;">Адрес:</div>
                                        <div style="float: right;color: black;"><a
                                                    href="tel:{{str_replace(" ","",$item->number)}}">{{$item->number}}</a>
                                        </div>
                                        <div style="color: black;">Телефон:</div>

                                        <div class="col-md-12 col-xs-12">
                                            <a href="http://{{$item->site}}" style="display: block;text-align: center;">Перейти
                                                на сайт поставщика</a>
                                        </div>
                                    </div>


                                @endforeach
                            @else
                                <div style="display: inline-block;padding: 10px;width:100%;">

                                    @foreach($advert as $items)


                                        @if(!empty($items->sity))
                                            <p style="height: 19px">
                                            <div style="float: left">Город:</div>
                                            <div style="float: right">{{$items->sity}}</div>
                                            </p>
                                        @endif
                                        <div style="float: left">Регион:</div>
                                        <div style="float: right">{{$items->region_title}}</div>
                                        <p style="height: 19px">
                                        <div style="float: left">Телефон:</div>
                                        <div style="float: right"><a
                                                    href="tel:{{$items->number}}">{{$items->number}}</a></div>
                                        </p>
                                </div>

                                @endforeach
                            @endif

                        @endforeach

                    </div>
                </div>
                @if($user[0]->id != '2')
                    <div class="col-md-12 col-xs-12 content-adverts-show">
                        <div class="col-12">
                            <h3 style="color:black;">Вакансии компании <a
                                        class="float-right">{{$vacants->count()}}</a></h3>
                        </div>

                        @if($vacants->count() == '0')
                            <div class="col-md-12">
                                <h4>Вакансии отсутствуют</h4>
                            </div>
                        @else
                            @foreach($vacants as $vacant)
                                <div class="col-12">
                                    <a href="/vacant/{{$vacant->slug}}"><strong>{{$vacant->name}}</strong></a>
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="text-left"><strong>{{$vacant->price}}
                                                    - {{$vacant->price1}} {{$vacant->valute}}</strong></p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <p>
                                                Добавлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($vacant->created_at)->formatLocalized('%d %f %Y')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr class="black">
                                </div>
                            @endforeach
                        @endif

                    </div>
                @endif
            
          </div>

            <div class="col-md-5 col-xs-12">
                <div class="p-0"
                     style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;"><h3 class="font-weight-bold">Другие
                        предложения <a class="float-right">{{$new->total()}}</a></h3>
                </div>
                <div class="row p-md-4">
                    @foreach($new as $advertnew)
                        <div class="col-md-12 content-home ml-0 col-5 ml-auto mr-auto">
                            <div class="col-md-3 span-left pr-3 pl-0">
                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($advertnew->filename))
                                    <img class="img-responsive" title="{{$advertnew->title}}"
                                         src="/storage/{{$advertnew->filename}}"
                                         alt="{{$advertnew->title}}">
                                @else
                                    <img class="img-responsive" title="{{$advertnew->title}}" src="/image/not_found.jpg"
                                         alt="{{$advertnew->title}}">
                                @endif
                            </div>
                            <div class="col-md-8 span-right pl-0 pt-0 pb-0 pr-0 col-12">
                                @if(isset($advertnew->citys))
                                    @if($advertnew->user_id == '209')
                                        <p class="mb-0"><a style="font-weight: bold;color:#00008b" class="page_href"
                                                           href="http://{{$advertnew->citys->slug.'.opt-himik.ru/'.$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 35)?>
                                                ...</a></p>
                                    @else
                                        <p class="mb-0"><a style="font-weight: bold;color:#00008b" class="page_href"
                                                           href="http://{{$advertnew->citys->slug.'.opt-himik.ru/'.$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 35)?>
                                                ...</a></p>
                                    @endif
                                @else
                                    <p class="mb-0"><a style="font-weight: bold;color:#00008b" class="page_href"
                                                       href="{{$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 35)?>
                                            ...</a></p>
                                @endif
                                <div>
                                    <p class="mb-0">Описание: <span
                                        >{{strip_tags(mb_substr($advertnew->content,0,90))}}</span>
                                        ...</p>

                                    <p class="mb-0">
                                        Добавлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($advertnew->created_at)->formatLocalized('%d %f %Y')}}</p>
                                    @if(isset($advertnew->types))
                                        <p class="mb-0">
                                          <span>
                                              <span>
                                                  <b>Цена:
                                                      @foreach($advertnew->types as $item)
                                                          <span>{{$item->price}}</span>
                                                          <span>{{$item->valute}}</span>
                                                      @endforeach
                                                  </b>
                                              </span>
                                          </span>
                                        </p>
                                    @else

                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>

                {{$new->render("pagination::default")}}
                <button type="submit" class="btn btn-login col-12 mt-3" data-toggle="modal"
                        data-target="#modalAdvert"
                        style="background-color: #ffa400;
                    border-color: #ffffff;
                    color: white;
                    font-weight: bold;
                    height: 45px;
                    font-size: 14pt;">
                    Сделать запрос
                </button>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAdvert" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-left: 25px;color: white;background-color: #696969;border: none;">
                    <h5 class="modal-title" style="display: inline-block;font-size: 24px;margin-left: 20px;" id="exampleModalLongTitle">
                        Сделать запрос</h5>

                </div>
                <div style="background-color: #696969; height: 2px;">
                    <p style="display: block;border: 5px solid orange;margin-left: 20px;margin-right: 140px;"></p>
                </div>
                <div class="modal-body p-0" style="background-color: #696969;">
                    <div class="col-md-12 col-xs-12">
                        <div style="margin: 10px;padding: 10px;background-color: #696969;">
                            <form style="padding: 5px" class="form-horizontal" method="POST" enctype="multipart/form-data"
                                  action="/mailer">
                                <input style="margin-bottom: 10px;font-size: 13pt;" type="text" name="name"
                                       placeholder="Имя или компания" class="form-control">
                                <input style="margin-bottom: 10px;font-size: 13pt;" type="text" name="phone"
                                       placeholder="Телефон" class="form-control">
                                <input style="margin-bottom: 10px;font-size: 13pt;" type="email" name="email"
                                       placeholder="Ваш email" class="form-control">

                                @if($user[0]->id !== '2')

                                    <input type="hidden" name="user_email" value="{{$user[0]->email}}">
                                @else
                                    <input type="hidden" name="user_email" value="{{$advert[0]->email}}">
                                @endif

                                <input class="url" type="hidden" name="url">
                                <textarea style="margin-bottom: 10px;font-size: 13pt;" name="content"
                                          placeholder="Задайте ваш вопрос компании" class="form-control"></textarea>
                                {{csrf_field()}}
                                <button type="submit" value="Отправить запрос" class="btn form-control"
                                        style="background-color: #ffa400;
        border-color: #ffffff;
        color: white;
        font-weight: bold;
        height: 45px;
        font-size: 14pt;">Отправить запрос
                                </button>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_form"><!-- Сaмo oкнo -->
        <div id="modal_close">X</div> <!-- Кнoпкa зaкрыть -->
        <!-- Тут любoе сoдержимoе -->
    </div>
    <div id="overlay"></div><!-- Пoдлoжкa -->


@endsection
@section('scripts')
    <script>
        window.onload = function () {

            $('.url').attr('value', window.location.href);


        };


        $('.page_href').click(function location_href(e) {
            e.preventDefault();
            parse_url(window.location.href);
            var href = $(this).attr('href');
            $(this).attr('href', href + "?" + out.search);
            document.location.href = href + "?" + out.search;
        });


        function parse_url(url) {

            var parts = url.split("#"),
                out = {};

            out.url = url;
            out.hash = (parts.length > 1 ? ((url = parts.shift()) || 1) && parts.join("#") : "");
            url = (parts = url.split("?")).shift();
            out.search = parts.join("?");
            out.scheme = (parts = url.split("://")) && parts.length > 1 ? parts.shift() : "";
            out.host = ((parts = parts.join("://").split("/")) && parts.length > 1 &&
                parts[0].indexOf(".") > 0 || out.scheme) && parts.shift() || "";
            out.script = parts.pop();
            out.path = (parts.length > 0 ? "/" : "") + parts.join("/");

            return out;


        }

        var out = parse_url(window.location.href);

        // alert([
        //     "url: " + out.url,
        //     "scheme: " + out.scheme,
        //     "host: " + out.host,
        //     "path: " + out.path,
        //     "script: " + out.script,
        //     "search: " + out.search,
        //     "hash: " + out.hash
        // ].join("\n"));
    </script>
@endsection

