@extends('himik')
@section('title')
    <title>ОПТхимик - {{$postblog->name}}</title>
@stop
@section('meta')
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="canonical" href="{{URL::current()}}"/>
    <meta property="og:site_name" content="ОПТхимик" />
    <meta property="og:title" content="{{$postblog->name}}"/>
    <meta property="og:description" content="{{$postblog->content}}"/>
    <meta property="og:url" content="{{URL::current()}}" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:locale:alternate" content="en-us" />
    <meta property="og:image" content="http://opt-himik.ru/image/logo_ogg.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection
@section('content')


    <div class="container"style="padding-left: 50px;">

        <div class="row">
            <div class="content-left">
                <div class="tsb">


                    <div class="blog" style="width: 563px;">
                        <h1 style="text-align: center;font-size: 16pt" class="header-b">{{$postblog->name}}</h1>

                        <p style="display:table;min-height: 150px; padding:12px">
                           
                            @if(Illuminate\Support\Facades\Storage::disk('public')->exists($postblog->filename))
                            <img style="margin-right: 15px;margin-top: 5px;float:left;width: 210px;" src="/storage/{{$postblog->filename}}" alt="{{$postblog->name}}">
                                @else
                                    <img style="margin-right: 15px;margin-top: 5px;float:left;width: 210px;" src="/image/not_found.jpg" alt="{{$postblog->name}}">
                                @endif

                            {!! strip_tags($postblog->content)!!}</p>
                           <p style="padding-left: 15px;display: block;">Автор: {{$postblog->values->company}}</p>
                            <p style="padding-left: 15px;display: block;">Источник: <a target="_blank" href="http://{{$postblog->url}}">{{$postblog->url}}</a></p>

                        <div class="col-12 p-3 text-right">
                        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,gplus,twitter"></div>
                    </div>
                    </div>
                </div>
            </div>
    <div class="content-right col-5">
        <div class="header-b2" style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;">Предложения компании <a class="float-right">{{$new->total()}}</a></div>

        @foreach($new as $advertnew)
            <div class="col-md-12 content-home ml-0">
                            <span class="col-md-4 span-left pr-3 pl-0">
                                <?php
                                $ch = curl_init(env('LINK_ADVERTS') . '/storage/' . $advertnew->filename);
                                curl_setopt($ch, CURLOPT_NOBODY, true);
                                curl_exec($ch);
                                $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                ?>
                                @if($code == 200)
                                    <img class="img-responsive" title="{{$advertnew->title}}" src="/storage/{{$advertnew->filename}}"
                                         alt="{{$advertnew->title}}">
                                @else
                                    <img class="img-responsive" title="{{$advertnew->title}}" src="/image/not_found.jpg" alt="{{$advertnew->title}}">
                                @endif
                            </span>
                <span class="col-md-8 span-right pl-0 pt-0 pb-0 pr-0">
                                @if($advertnew->user_id == '209')
                        <p><a style="font-weight: bold;color:#00008b"
                              href="http://{{$advertnew->citys->slug.'.opt-himik.ru/'.$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 35)?>
                                ...</a></p>
                    @else
                        <p><a style="font-weight: bold;color:#00008b"
                              href="http://{{$advertnew->citys->slug.'.opt-himik.ru/'.$advertnew->slug}}"><?=mb_substr($advertnew->title, 0, 35)?>
                                ...</a></p>
                    @endif
                    <p class="margin-top-5">Описание: {{mb_substr($advertnew->content,0,90)}}...</p>

                                <p class="margin-top-5">Обновлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($advertnew->updated_at)->formatLocalized('%d %f %Y')}}</p>
                    @if($advertnew->types[0]->price)
                        <p><b>Цена: {{$advertnew->types[0]->price}}</b></p>
                    @else

                    @endif
                            </span>
            </div>
        @endforeach
        {{$new->render()}}
    </div>
    </div>
    </div>



    @stop