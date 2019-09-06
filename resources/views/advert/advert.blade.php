@extends('himik')

@section('title')
@if($opisan[0]->seo_title != '')
  <title>ОПТхимик - {{$opisan[0]->seo_title}}</title>
@else
        <title>ОПТхимик - {{$opisan[0]->title}}</title>
@endif
@endsection
@section('meta')

    @if($opisan[0]->meta_keywords != '')
      <meta name="keywords" content="{{$opisan[0]->meta_keywords}}" />
    @else
      <meta name="keywords" content="куплю {{$opisan[0]->title}}, продам {{$opisan[0]->title}}, купить {{$opisan[0]->title}}" />
    @endif
    @if($opisan[0]->meta_description != '')


      <meta name="description" content="{{$opisan[0]->meta_description}}">
    @endif

@endsection
@section('content')

    <div class="container">
        <div class="col-12 p-0">

                <div class="row">
                    <div class="col-12 d-inline-block col-md-7 " >
                        @foreach($opisan as $item)

                            <h1 class="header-b" style="color:black; margin-left: 5px;">{{$item->title}}</h1>
                        @endforeach

                        @foreach($advert as $adverts)

                            <div class="blog subcategory_adverts col-12 order-2">
                                <span style="display: block;padding: 1px 0px 0px 0px;margin-left: -5px;">
                                    <ins style="display: block;padding: 5px;">
                                        @if($adverts->user_id == '209')
                                            <a class="region_link" style="color:#00008b;font-weight: bold;"
                                               href="{{$adverts->slug}}">{{$adverts->title}}</a>
                                        @else
                                            <a class="region_link" style="color:#00008b;font-weight: bold;"
                                               href="http://{{$adverts->citys->slug.'.'.env('LINK_ADVERTS').'/'.$adverts->slug}}">{{$adverts->title}}</a>
                                        @endif
                                    </ins>
                                    <span style="padding-left: 10px;display: inline-block;color: black;"><?=mb_substr($adverts->content, 0, 220) ?>
                                        ...</span>
                                </span>
                                <div class="row p-3">
                                  <span class="col-12 col-md-3 text-center" style="display: inline-block;/*! float: left; */vertical-align: top;">
                                  @if(Illuminate\Support\Facades\Storage::disk('public')->exists($adverts->filename))
                                      <img class="advert_subcategory_img" src="/storage/{{$adverts->filename}}"
                                           style="border-radius: 7px;width:120px;height: 120px;display: block;margin: 0 auto;margin-top: 5px;margin-bottom: 5px;display: inline-block"
                                           alt="{{$adverts->title}}">
                                  @else
                                      <img class="advert_subcategory_img" src="/image/not_found.jpg"
                                           style="border-radius: 7px;width:120px;height: 120px;display: block;margin: 0 auto;margin-top: 5px;margin-bottom: 5px;display: inline-block"
                                           alt="{{$adverts->title}}">
                                  @endif

                                  </span>
                                  <div class="col-md-9 pb-2" style="display: inline-block;width: 420px;">
                                      <table style="text-align: center;width: 100%;">
                                          <tr style="border-bottom: 1px solid #696969;">
                                              <td class="p-2">Упаковка</td>
                                              <td>Вес</td>
                                              <th>Цена</th>
                                          </tr>

                                          @foreach($adverts->types as $item)
                                              @if(isset($item))
                                                  <tr style="border-bottom: 1px solid #b3b3b3;">


                                                      <td class="p-2">{{$item->type}}</td>
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



                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-5 col-12 " style="background-color: lightgrey;height: 100%;vertical-align: top;display: inline-block;margin-top: 70px;">
                        @foreach($opisan as $item)
                            <div style="text-align: left;padding: 8px;padding-left: 10px;margin-bottom: -12px;">{!! $item->description !!}</div>
                        @endforeach
                    </div>
                </div>

            {{ $advert -> links()}}

        </div>
    </div>

@endsection

@section('scripts')
    <script>


        $('.favoriteses').submit(function (ev) {


            var user_id = $('.userid').val();
            var id_clear = $(this).children('.button_send').attr('id');
            var id = ev.target.id;
            var url = $(this).attr('action');
            var data = $(this).serialize();

            if ($('.favorites' + id).attr('src') == '/image/img0011.png') {
                $('.favorites' + id).attr('src', '/image/img00062.png');
                $('#' + id).attr('action', '/favorites/delete/' + user_id + '/' + id_clear);

                console.log(url);

            }
            else {
                $('.favorites' + id).attr('src', '/image/img0011.png');
                $('#' + id).attr('action', '/favorites/' + user_id + '/' + id_clear);
            }


            event.preventDefault();


            $.ajax({

                type: "POST",
                url: url,
                data: data,
                success: function (data) {
                    console.log(id);


                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            });


        });


    </script>
@endsection
