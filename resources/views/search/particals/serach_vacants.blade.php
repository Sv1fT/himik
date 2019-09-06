        <div class="container">
            <div class="content-full">


                <div class="content-left">
                    <div class="tsb" style="width: 1020px;">

                        <div id="search_ajax" style="width: 600px;display: inline-block;">

                            <h2 class="header-b" id="search_text" style="color:black;font-weight: normal">{{$q}}</h2>


                            <section id="content-tab1">
                                @foreach($search as $item)
                                    @if($item->count() > 0)



                                        <div class="p-3 bg-white mb-4" style="text-align: left;border-bottom: 1px solid;padding-top: 10px;box-shadow: 0 0 10px rgba(0,0,0,0.5);">
                                        <a href="{{url('/vacant/'.$item->slug) }}" style="font-size: 12pt; color: #00008b; font-weight: bold;">{{$item->name}}</a>,<a
                                                style="font-size:10pt; color:gray;text-decoration: none">
                                            {{$item->price}} - {{$item->price1}} {{$item->valute}}</a>
                                        <div class="mt-2 row">
                                        <span class="col-3 pb-3" style="display: inline-block;vertical-align: top;margin-top: 5px;">
                                            <img style="display: inline-block;width: 110px;"
                                                 src="{{asset("/storage/".$item->value->filename)}}" alt="">
                                        </span>
                                            <span class="col-9 pl-0" style="display: inline-block;width: 79%;">
                                            <p class="mb-0" style="font-size: 14px;color: gray;">{{$item->value->company}}, {{$item->value->citys->name}}</p>
                                        <p style="font-size: 14px;color: gray;">в городе {{$item->city_get->name}}, {{$item->education}}, {{$item->opit}}</p>
                                        <p style="font-size: 12px;color: black;">{{mb_substr($item->description,0,400)}}</p>
                                        </span>
                                        </div>
                                    </div>

                                    @else
                                        <strong>Резюме нет.</strong>
                                    @endif
                                @endforeach
                            </section>


                            {{$search->appends(['user' => 'advert','quote' => $q]) -> links()}}
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

@section('scripts')
    <script src="{{ asset('js/search.js')}}"></script>
@endsection    