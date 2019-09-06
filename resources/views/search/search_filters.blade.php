<div id="search-right" style="box-shadow: 0 0 10px rgba(0, 0, 0, 1);display: inline-block;vertical-align: top;word-wrap: break-word;margin-left: 50px;width: 360px;background-color: #696969;margin-top: 60px;">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <p style="text-align:center;margin: 0 auto;padding: 20px;font-size: 22px;width: 340px;color:white">Параметры поиска</p>
    <div style="margin: 10px;padding: 10px;background-color: #696969;">
        <form enctype="application/x-www-form-urlencoded" method="post">
            <div class="form-group country">

                <select id="country" style="padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;" class="form-control" name="country" size="1">

                    @foreach($country as $item)
                        {{--@if(session()->get('search_country') == $item->id) selected @endif--}}
                        <option @if($item->id == 0) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach


                </select>

            </div>
            <div class="form-group region">

                <select id="select" class="form-control" name="region" style="display: none;padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;" size="1">



                </select>

            </div>
            <div class="form-group city">

                <select id="city" class="form-control" name="city" style="display: none;padding-left:3px;width: 100%;margin-bottom: 15px;border: 1px solid;border-width: 1px;border-radius: 3px;height: 34px;font-size: 13pt;" size="1">



                </select>

            </div>

            {{--<div class="form-group">--}}
            {{--<p>Цена от <input id="price_min" style="width: 150px;" type="number" name="price1"> до <input id="price_max" style="width: 150px;" type="number" name="price2"></p>--}}
            {{--</div>--}}

            <div class="form-group mb-0">
                <button id="submit" style="margin:0 auto;border-width: 0;width: 100%;height: 45px;font-weight: bold;font-size: 15pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;border-radius: 5px;">Применить</button>
            </div>
            {{csrf_field()}}
        </form>
    </div>
</div>
