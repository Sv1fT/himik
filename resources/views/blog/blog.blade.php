@extends('himik')

@section('title')

        <title>ОПТхимик - Блог компаний</title>

@endsection



@section('content')
    <div class="container">

        <div class="content-full">
            <div class="content-left">
                <div class="tsb">


                    <div class="blog" style="width: 563px;    box-shadow: 0 0 10px rgba(0, 0, 0, 1);">
                        <div class="header-b">Добавление новой статьи</div>
                        <form style="padding: 10px" method="post" enctype="multipart/form-data" action="blog/addblog">
                            <input type="text" class="form-control" name="name" placeholder="Заголовок" style="width: 100%;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                            <textarea type="text" class="form-control" name="content" placeholder="Описание" style="max-width: 100%;height:34px;width: 100%;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;"></textarea>
                              <span style="display: inline-block;width: 309px;vertical-align: top">

                                  <input type="hidden" name="status"  placeholder="Тип упаковки" value="0" style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                  <input type="text" class="form-control" name="url" placeholder="Источник" style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                  <b style="font-size: 13px;color:black;">Интернет-портал «ОПТхимик» предлагает к
размещению информационных материалов:</b><br><br>
                                  <p style="font-size: 13px;margin-bottom: 0;">- авторских статей,</p>
                                  <p style="font-size: 13px;margin-bottom: 0;">- пресс-релизов,</p>
                                  <p style="font-size: 13px;margin-bottom: 0;">- технологических обзоров,</p>
                                  <p style="font-size: 13px;margin-bottom: 0;">- «историй успеха»,</p>
                                  <p style="font-size: 13px;margin-bottom: 0;">- описаний внедренческого опыта,</p>
                                  <p style="font-size: 13px;margin-bottom: 0;">- публикаций рекламно-информационного
характера</p>

                                  {{csrf_field()}}
                              </span>
                              <span style="display: inline-block;border-width:0;width:220px;">
                                  {{--<a href="#">X</a>--}}
                                  <img id="image" onclick="loadImage()" src="" style="width: 220px;height: 220px;background-color: #f0f0f0;">

                                  <input id="clear" type="button" onclick="clearImg()" value="Очистить">
                                  <label id="loadfile" for="uploadbtn" style="position: relative;text-align: center;
                                      top: -155px;display: block">Загрузить изображение<p>(размер файла не более 1Мб)</p></label>

                                  <input type="file" accept="image/*" name="file" id="uploadbtn" style="display: none">

                              </span>

                            <input type="submit" class="w-75" value="Добавить статью"/>
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
            <div class="content-right" style="width: 400px;">

                    <div class="header-b2" style="background-color: #f5f5f5;border-top-left-radius: 3px;border-top-right-radius: 3px;">Мои публикации <a class="float-right">{{$blogitem->total()}}</a></div>

                @foreach($blogitem as $item)
                    <div class="advert-content-home" >
                            <span class="span-left">
                                @if(Illuminate\Support\Facades\Storage::disk('public')->exists($item->filename))
                                    <img style="width:115px;height: auto;" src="/storage/{{$item->filename}}" alt="{{$item->name}}">
                                @else
                                    <img style="width:115px;height: auto;" src="/image/not_found.jpg" alt="ОПТхимик">
                                @endif
                            </span>
                            <div class="span-right" style="width:260px;">
                                <a style="color:#00008b;font-weight: bold" href="blog/post/{{$item->id}}"><?=mb_substr($item->name,0,25)?>...</a>
                                <form class="delete-form"  style="display: inline;">
                                    {{ csrf_field() }}
                                    <a class="delete" id="{{$item->id}}" data-get-advert-id="{{$item->id}}" onclick="advertDelete({{$item->id}}); return false;">
                                    <input class="delete-advert" name="id" type="hidden" value="{{$item->id}}">
                                    <i class="fa fa-times fa-lg" aria-hidden="true" style="padding-left:10px;float: right;color:red;"></i></a></form>
                                <a href="/blog/edit/{{$item->id}}/{{$item->slug}}">
                                    <i class="fa fa-pencil fa-lg" aria-hidden="true" style="float: right;color:blue;"></i></a>
                                <p style="display: inline-block;">Описание: {{strip_tags(mb_substr($item->content,0,60))}}...</p>
                                <span style="display: inline-block;width: 290px;">Добалено: {{ date('d-m-Y H:i:s', strtotime($item->updated_at)) }}</span>
                                @if(($item->active) == 0)
                                    <p>Статус:

                                        <b style="color: green;">На модерации</b>
                                        </p>
                                        @endif

                            </div>
                    </div>
                @endforeach
                {{$blogitem->render()}}
            </div>

        </div>

    </div>

@endsection
@section('scripts')
    <script>
        function clearImg() {
            $('#image').attr('src','');
            $('#image').css('height','220px');
            $('#loadfile').css('display','block');
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').css('height','auto');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



        function advertDelete(e) {

            if (confirm("Вы уверены, что хотите удалить?\nЭта операция не восстановима."))

                var id = e;
            var _data = $('.delete-form').serialize();

            $.ajax({
                type: "POST",
                url: "/blog/delete/"+id,
                response: 'text',
                data: _data,
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (xhr, str) {
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }
            })


        }
        $("#uploadbtn").change(function(){
            readURL(this);
            $('#loadfile').css('display','none');

        });
        function loadImage() {
            $("#uploadbtn").click();
        }
        function SendPost() {
            //отправляю POST запрос и получаю ответ
            $$a({
                type:'post',//тип запроса: get,post либо head
                url:'/tsb',//url адрес файла обработчика
                data:{'category':$category_val},//параметры запроса
                response:'text',//тип возвращаемого ответа text либо xml
                success:function (data) {//возвращаемый результат от сервера
                    $$('result',$$('result').innerHTML+'<br />'+data);
                }
            });
        }

    </script>
@endsection
