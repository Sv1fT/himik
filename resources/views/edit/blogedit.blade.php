@extends('himik')

@section('content')
<div class="container">

    <div class="content-full">
        <div class="content-left">
            <div class="tsb">


                <div class="blog" style="width: 563px;">
                    <div class="header-b">Редактирование статьи</div>
                    <form style="padding: 10px" method="post" enctype="multipart/form-data">



                        <input type="text" name="name" placeholder="Заголовок" value="{{$blog->name}}" style="width: 100%;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                        <textarea type="text" name="content" placeholder="Описание" style="max-width: 100%;width: 100%;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">{{$blog->content}}</textarea>
                        <span style="display: inline-block;width: 309px;vertical-align: top">

                                  <input type="hidden" name="status"  placeholder="Тип упаковки" value="0" style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
                                  <input type="text" name="url" placeholder="Источник" value="{{$blog->url}}" style="width: 309px;height: 34px;border: 1px solid darkgray;border-radius: 5px;margin-bottom: 16px;">
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
                            <img id="image" onclick="loadImage()" src="/{{$blog->filename}}" style="width: 220px;background-color: #f0f0f0;">

                            <p>(размер файла не более 1Мб)</p>

<label id="loadfile" for="uploadbtn" style="position: relative;    left: 34px;
    top: -150px;display: none">Загрузить изображение</label>
                                  <input type="file" name="file" value="{{$blog->filename}}" id="uploadbtn" style="display: none">
                            <input id="clear" type="button" onclick="clearImg()" value="Очистить">
                              </span>

                        <input type="submit" style="border-width: 0;width: 418px;height: 50px;font-weight: bold;font-size: 18pt;position: relative;display: block;box-sizing: border-box;color: white;background-color: orange;margin-top: 30px;margin-bottom: 30px;border-radius: 7px;left: 11%;" value="Сохранить статью"/>
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
    </div>
</div>

    <script>

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').css('height','auto');
                    $('#loadfile').css('display','none');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function clearImg() {
                $('#image').attr('src','');
                $('#image').css('height','234px');
            $('#loadfile').css('display','block');
        }

        function loadImage() {
            $("#uploadbtn").click();
        }

        $("#uploadbtn").change(function(){
            readURL(this);
            $('#loadfile').css('display','none');

        });

    </script>
@stop