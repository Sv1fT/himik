
                    <h2 class="header-b" id="search_text" style="color:black;font-weight: normal">{{$q}}</h2>

@if(!empty($posts))
                    @foreach($posts as $adverts)

                            <div class="blog" style="    padding-bottom: 0;width: 600px;">
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

                                <span class="pl-2" style="display: inline-block;/*! float: left; */vertical-align: top;">

                                    @if(Illuminate\Support\Facades\Storage::disk('public')->exists($adverts->filename))
                                        <img src="/storage/{{$adverts->filename}}"
                                             style="border-radius: 7px;width:120px;height: 120px;display: block;margin: 0 auto;margin-top: 5px;margin-bottom: 5px;display: inline-block"
                                             alt="{{$adverts->title}}">
                                    @else
                                        <img src="/image/not_found.jpg"
                                             style="border-radius: 7px;width:120px;height: 120px;display: block;margin: 0 auto;margin-top: 5px;margin-bottom: 5px;display: inline-block"
                                             alt="{{$adverts->title}}">
                                    @endif

                                </span>
                                <div style="display: inline-block;width: 420px;">
                                    <table style="text-align: center;width: 110%;">
                                        <tr style="border-bottom: 1px solid #696969;">
                                            <td>Упаковка</td>
                                            <td>Вес</td>
                                            <th>Цена</th>
                                        </tr>

                                        @foreach($adverts->types as $item)
                                            @if(isset($item))
                                                <tr style="border-bottom: 1px solid #b3b3b3;">


                                                    <td>{{$item->type}}</td>
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
                    @endforeach
@else
                    <h3>Ничего не найдено</h3>
@endif