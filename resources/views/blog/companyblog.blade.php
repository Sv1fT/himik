@extends('himik')

@section('title')
    @foreach($user as $item)
        @foreach($item->attributes as $item)
            <title>ОПТхимик - блог компании {{$item->company}}</title>
        @endforeach
    @endforeach
@stop
@section('content')


    <div class="container" style="padding-left: 30px;">
        <div class="row">
            <div class="col-12">
            <div class="content-left col-7">
                @foreach($user as $item)
                    @foreach($item->attributes as $item)
                        <div class="blog" style="width: 563px;
    background: none;
    box-shadow: none;
    border: none;">
                            <span style="display: inline-block">
                                <img style="    width: 170px;
    height: 160px;
    box-shadow: 0 0 24px rgba(0,0,0,0.5);
    border: 1px solid;
    border-radius: 8px;
    float: left;
    margin: 15px;margin-bottom: 0;margin-top:10px;" src="{{asset('/storage/'.$item->filename)}}" alt="">
                                <h1 style="color: black;font-size: 22px;text-align: center;color:#00008b;font-weight: bold;display: inline-block;">{{$item->company}}</h1>
                                <p>{!! nl2br($item->description) !!}</p>
                            </span>

                        </div>
                    @endforeach
                @endforeach


                <div class="blog" style="width: 563px;box-shadow:  0 0 10px rgba(0,0,0,2);">
                    @if(count($postblog) >= 1)
                        <div style="padding: 10px">
                            @foreach($postblog as $items)

                                <p><b style="color:#696969;font-size: 24px"> {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($items[0]->created_at)->formatLocalized('%d %f %Y')}} г.</b></p>
                                @foreach($items as $item)

                                    <p><a style="color:#00008b;font-size:19px;font-weight: bold;" href="/blog/post/{{$item->id}}">{{$item->name}}</a></p>
                                    <p style="color:black;font-size: 16px;">{{strip_tags(mb_substr($item->content,0,180))}}...</p>

                                @endforeach
                                <p style="height: 2px;width: 100%;background-color: darkgray;box-shadow: 0 0 1px rgba(0,0,0,0.5);"></p>
                            @endforeach
                        </div>
                    @else
                        <h3>Компания не ведёт свой блог</h3>
                    @endif
                </div>
            </div>


            <div class="content-right col-5">


                <div class="header-b2" style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;">Предложения компании <a class="float-right">{{$new->total()}}</a></div>

                @foreach($new as $advertnew)
                    <div class="col-md-12 content-home ml-0">
                            <span class="col-md-4 span-left pr-3 pl-0">
                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($advertnew->filename))
                                    <img style="height: 140px" class="img-responsive m-auto" title="{{$advertnew->title}}" src="/storage/{{$advertnew->filename}}"
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
                            <p class="margin-top-5">Описание: {{strip_tags(mb_substr($advertnew->content,0,90))}}...</p>

                                <p class="margin-top-5">Обновлено: {{\Laravelrus\LocalizedCarbon\LocalizedCarbon::parse($advertnew->updated_at)->formatLocalized('%d %f %Y')}}</p>
                            @if(count($advertnew->types) >= 1)
                                <p class="m-0"><b>Цена: {{$advertnew->types[0]->price}}</b></p>
                            @else

                            @endif
                        </span>
                    </div>
                @endforeach
                {{$new->render()}}
            </div>
        </div>
    </div>
</div>

@stop
