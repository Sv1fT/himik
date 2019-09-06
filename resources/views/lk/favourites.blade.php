@extends('himik')

@section('content')

    <div class="content">
        <div class="content-full">

            <div class="content-adverts">
                <div class="tsb" style="width: 1020px;">
                    <div style="width: 600px;display: inline-block;">

                        @foreach($advert as $adverts)
                            <div class="blog" style="    padding-bottom: 0;width: 600px;">
                                <span style="border-bottom: 1px solid #b3b3b3;display: block;padding: 1px 0px 0px 0px;margin-left: -5px;">
                                    <ins style="display: block;padding: 5px;">
                                   <a href="/{{$adverts->id}}/<?= str_slug($adverts->title, "-")?>">{{$adverts->title}}</a>
                                        @if (Auth::guest())
                                        @else

                                            <label for="{{$adverts->id}}" style="background-repeat: no-repeat;margin-top: -30px;width: 20px;display: inline-block;float: right;height: 20px;">
                                    <img src="/image/img0011.png" class="favorites{{$adverts->id}}"  data="add"   style="background-repeat: no-repeat;width: 30px;display: inline-block;float: right;height: 30px;" href="/favorites/{{Auth::user()->id}}/{{$adverts->id}}">
                                        </label>
                                        @endif
                                    </ins>
                                    @if (Auth::guest())
                                        <a href="/login/" style="display:none;"id="go">Логин</a>
                                    @else
                                        <form style="display:none;" class="favoriteses" method="POST" action="/favorites/{{Auth::user()->id}}/{{$adverts->id}}">
                                            {{csrf_field()}}

                                            <input type="text" class="userid" name="user_id" value="{{Auth::user()->id}}">
                                            <input class="post_id" type="text" name="post_id" value="{{$adverts->id}}">
                                                <input type="submit" id="{{$adverts->id}}" >
                                            </form>
                                    @endif
                                    <p><?=mb_substr($adverts->content,0,220) ?>...</p>
                                </span>

                                <span style="display: inline-block;/*! float: left; */vertical-align: top;">
                                    <img src="/image/archive/{{$adverts->user_id}}/picture/picture/{{$adverts->filename}}" style="width:120px;height: 120px;display: block;margin: 0 auto;margin-top: 5px;margin-bottom: 5px;display: inline-block">
                                    <span class="separator"></span>
                                </span>
                                <span style="display: inline-block;width: 420px;">
                                    <table style="text-align: center;width: 110%;">
                                        <tr style="border-bottom: 1px solid #b3b3b3;display: block;margin-left: -4px;padding: 7px 0 0 0;">

                                            <td style="padding-left: 40px;color: black;padding-right: 42px;">
                                                Упаковка
                                            </td>
                                            <td style="padding-left: 50px;color: black;padding-right: 53px;">
                                                Вес
                                            </td>
                                            <td style="padding-left: 50px;color: black;padding-right: 29px;">
                                                Цена
                                            </td>

                                        </tr>
                                        <tr style="border-bottom: 1px solid #b3b3b3;display: block;margin-left: -4px;padding: 7px 0 0 0;">

                                            <td style="padding-left: 50px;color: black;padding-right: 82px;width: 8.7%;">
                                                Ведро
                                            </td>
                                            <td style="padding-left: 10px;color: black;padding-right: 0px;width: 11.9%;">
                                                18 кг
                                            </td>
                                            <td style="padding-left: 100px;color: black;padding-right: 20px;width: 13px;text-align: left;">
                                             @if($adverts->price == "")

                                                @else
                                                    {{$adverts->price}}
                                                @endif
                                            </td>


                                        </tr>
                                    </table>

                                </span>
                                <a href="/{{$adverts->id}}/<?= str_slug($adverts->title, "-")?>" style="float: right;margin-top: -40px;
">подробнее..</a>
                            </div>
                        @endforeach
                    </div>
                    <div style="background-color: lightgrey;width: 335px;height: 413px;margin-left: 40px;vertical-align: top;display: inline-block;margin-top: 63px;">
                    </div>
                </div>

            </div>



        </div>
    </div>








    @endsection