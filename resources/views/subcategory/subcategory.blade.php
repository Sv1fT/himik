@extends('himik')

@section('title')
@if($subcategory[0]->category->seo_title != '')
  <title>ОПТхимик - {{$subcategory[0]->category->seo_title}}</title>
@else
        <title>ОПТхимик - {{$subcategory[0]->category->title}}</title>
@endif
@endsection
@section('meta')

    @if($subcategory[0]->category->meta_keywords != '')
      <meta name="keywords" content="{{$subcategory[0]->category->meta_keywords}}" />
    @else
      <meta name="keywords" content="куплю {{$subcategory[0]->category->title}}, продам {{$subcategory[0]->category->title}}, купить {{$subcategory[0]->category->title}}" />
    @endif
    @if($subcategory[0]->category->meta_description != '')


      <meta name="description" content="{{$subcategory[0]->category->meta_description}}">
    @endif

@endsection
@section('content')

    <div class="container" >
        <div class="content-full">
            <div class="content-left">
                <div class="tsb">

                    <h1 class="header-b"><?php echo $subcategory[0]->category->title ?></h1>
                    <div class="d-md-none mb-5" style="background-color: lightgrey;">
                        @foreach($opisan as $item)
                            <div style="text-align: left;padding: 8px;padding-left: 10px;margin-bottom: -12px;">{!! $item->description !!}</div>
                        @endforeach
                    </div>
                    <div class="blog">
                        @foreach($subcategory as $subcategorys)
                            <a class="region_link" style="color:#00008b"
                               href="/advert/{{$subcategorys->slug}}">{{$subcategorys->title}}
                                [{{$subcategorys->count_adv}}]</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-md-inline-block d-none" style="background-color: lightgrey;width: 335px;height: auto;margin-left: 40px;vertical-align: top;display: inline-block;margin-top: 70px;">
                @foreach($opisan as $item)
                    <div style="text-align: left;padding: 8px;padding-left: 10px;margin-bottom: -12px;">{!! $item->description !!}</div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
