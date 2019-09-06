@extends('himik')

@section('title')
    <title>ОПТхимик - Блог компаний</title>
    @stop
@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8 col-12">
            <div class="header-b" style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;">Блог компаний</div>
            @if(count($blog)>0)
                <div class="blog" style="box-shadow:  0 0 10px rgba(0,0,0,2);">

                    <div style="padding: 10px">
                    @foreach($blog as $items)

                            <p><b style="color:#696969;font-size: 24px"> {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($items[0]->created_at)->formatLocalized('%d %f %Y')}} г.</b></p>
                        @foreach($items as $item)


                                <p><a style="color:#00008b;font-size:19px;font-weight: bold;" href="blog/post/{{$item->id}}">{{$item->name}}</a></p>
                                <p style="color:black;font-size: 16px;">{{strip_tags(mb_substr($item->content,0,180))}}...</p>

                        @endforeach
                            <p style="height: 2px;width: 100%;background-color: darkgray;box-shadow: 0 0 1px rgba(0,0,0,0.5);"></p>
                    @endforeach
                        <a href="/myblog" style="color: #000000;
    font-family: Arial;
    display: block;

    padding-top: 7px;
    height: 40px;
    font-size: 16px;
    width: 170px;"><img src="image/img0006.png" style="margin-right: 10px;display: inline-block;">Добавить новости</a>

                </div>
                </div>

                @else
                    <h3>Никто еще не писал в блог</h3>
                @endif
        </div>
        <div class="col-12 col-md-4">
            <b class="header-b2" style="display:block;">Компании</b>
            <div class="" style="width: 355px;padding:4px;">

                @foreach($company as $item)

                        <span class="blog-span-left" style="display:inline-block;vertical-align: top;    margin-top: 5px;">
                            @if(Illuminate\Support\Facades\Storage::disk('public')->exists($item->filename))
                                <img src="{{asset('/storage/'.$item->filename)}}" style="width:70px;height: 70px;background-color: slategray; margin-left: 5px;">
                            @else
                                <img src="/image/not_found.jpg" style="width:70px;height: 70px;background-color: slategray;margin-left: 5px;">
                            @endif
                        </span>
                        <span class="blog-span-right" style="display:inline-block;">
                            <strong style="display: block;margin-top: 5px;color:#00008B;font-family:Arial;font-size:16px;"><a style="color:#00008b" href="blog/company/{{$item->user_id}}">{{$item->company}}</a></strong>
                            <p style="padding: 0px;font-size: 12px;">Город: {{$item->city_title}}</p>
                            <p style="padding: 0px;margin-bottom: 0px;">Количество публикаций: {{$item->count_sub}}</p>

                        </span>
                        <img src="image/img0005.png" style="border-width: 0;height: 8px;width: 100%;">
                    @endforeach
            </div>
        </div>
    </div>


</div>


    @stop
