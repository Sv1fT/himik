<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Yandex.Metrika counter -->
    <script> (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter38513335 = new Ya.Metrika({
                        id: 38513335,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true,
                        webvisor: true
                    });
                } catch (e) {
                }
            });
            var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () {
                n.parentNode.insertBefore(s, n);
            };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks"); </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/38513335" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript> <!-- /Yandex.Metrika counter -->
    <meta name="yandex-verification" content="20e7bf7464734d36"/>
    <meta name='wmail-verification' content='7cd9df90f702efda3e52d63539bdb183'/>
    <meta name="yandex-verification" content="20e7bf7464734d36"/>
    <meta name="google-site-verification" content="R1td9GMMaMpQ5eC3XmgtZbnxEH61kxR2finLuc20KP4"/>
    <meta name="google-site-verification" content="8EgXHYZEqbqCAt7j1dp-hOzyTAk1pf7j9KRu70KNq_k"/>
    <meta name="verify-admitad" content="a3e8af415a"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffa400">

@yield('title')
@yield('meta')
<!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/index_test.css?v1.1') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owlcarousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css?v1.3') }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
<header>
    <div class="container">
        <div class="col-xs-4 col-md-2 header-div-left">
            <a href="/">
                <img class="img-responsive" src="/image/logo.png" title="ОПТхимик" alt="ОПТхимик"></a>
        </div>
        <div class="col-md-7 col-lg-8 search-head-div">
            <form action="/search/" class="col-md-12 header-div-middle1" method="GET" enctype="multipart/form-data">
                <div class="col-md-12 header-div-middle">
                    <div class="h-100 search-button">
                        <button type="submit" class="border btn btn-primary h-100 m-0 pl-3"><i class="fa fa-search"
                                                                                               aria-hidden="true"></i>
                        </button>

                    </div>
                    <div class="h-100 search-button">
                        <select style="font-size: 14px !important;" name="user"
                                class="border btn btn-primary h-100 m-0">
                            <option value="user">по компаниям</option>
                            <option value="advert">по объявлениям</option>
                            <option value="vacant">по вакансиям</option>
                            <option value="resume">по резюме</option>
                        </select>

                    </div>
                    <div class="search-field">
                        <input type="text" name="quote" class="input-search" placeholder="Введите поисковый запрос">
                    </div>
                </div>

            </form>

            <!-- Modal -->
            <div class="modal fade" style="z-index: 3" id="myModal" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="position: absolute;

left: 30%;

top: 10%;">
                    <div class="modal-content" style="
            width: 400px;
            max-height: 420px;
            overflow-y: scroll;

            ">
                        <div class="modal-header" style="height: 70px;">
                            @if(!empty(session()->get('regiones')))

                                <h4 class="modal-title">{{session()->get('regiones')}}</h4>
                                <p style="position: absolute;top: 34%;"><a href="http://opt-himik.ru"
                                                                           class="modal-title" id="myModalLabel">Вся
                                        Россия</a></p>



                            @else
                                <h4 class="modal-title" id="myModalLabel">Вся Россия</h4>
                            @endif
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" style="

            ">
                            <form class="search_live" method="post" enctype="multipart/form-data">
                                <input type="text" autocomplete="off" name="sity"
                                       placeholder="Введите название страны, региона или города"
                                       class="regionajax form-control" style="
              padding-top: 2px;
              padding-bottom: 1px;
              height: 27px;
              font-size: 13px;
              width: 100%;
              ">
                                {{ csrf_field() }}
                            </form>

                            <ul class="search_result p-0">

                            </ul>

                        </div>

                    </div>
                </div>
            </div>

            @if(!empty(session()->get('regiones')))

                <a class="select-region-head" href="#" data-toggle="modal" data-target="#myModal"
                   style="    margin-left: 5px;">{{session()->get('regiones')}}<b class="caret"></b></a>

            @else
                <a class="select-region-head" href="#" data-toggle="modal" data-target="#myModal"
                   style="    margin-left: 5px;">Вся Россия<b class="caret"></b></a>
            @endif

        </div>


        <div class="col-md-3 col-lg-2 header-div-right text-right pr-0">
            @if (Auth::guest())
                <a href="/register" style="padding-right: 6px;text-decoration: underline;">Регистрация</a>
                <a class="button-login" href="/login">Войти</a>

            @else
                <li class="dropdown text-right" style="list-style: none">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">{{ session()->get('user_name') }} </a>
                    <ul class="dropdown-menu" role="menu">
                        <a href="#" class="cancelComment"></a>
                        @if (Auth::user()->status == 4)
                            <li><a class="logina" style="color: #080808;font-size: 11pt;" href="/admin">Управление
                                    сайтом</a></li>
                            <li><a href="/jobs/">Работа</a></li>
                            <li><a href="/vacant/">Вакансии</a></li>
                        @endif
                        <li><a class="logina" style="color: #080808;font-size: 11pt;" href="/profile/">Профиль</a></li>
                        <li><a class="logina" style="color: #080808;font-size: 11pt;" href="/myadvert">Мои
                                объявления</a></li>

                        <!--<li><a class="logina" style="color: #080808;font-size: 11pt;" href="/favourites">Избранное</a></li>-->
                        <li><a class="logina" style="color: #080808;font-size: 11pt;" href="/myblog/">Мой блог</a></li>
                        <li><a class="logina" style="color: #080808;font-size: 11pt;" href="/myadvertising">Моя
                                реклама</a></li>
                        <li><a class="logina" style="color: #080808;font-size: 11pt;" href="/change/email">Изменить
                                Email</a></li>
                        <li><a class="logina" style="color: #080808;font-size: 11pt;" href="/change/password">Изменить
                                пароль</a></li>
                        <li><a href="/auth/logout">Выход</a></li>
                    </ul>
                </li>
            @endif
        </div>
    </div>

</header>
<nav class="navbar navbar-default sticky">
    <div class="container-fluid p-0" style="background-color: rgb(64, 64, 64);">
        <div class="">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" aria-label="navbar" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <button class="navbar-toggle" aria-label="myModal" data-toggle="modal" data-target="#myModal">
                    <span class="fa fa-map-marker fa-2x"></span>
                </button>
                <span class="navbar-toggle" style="font-size: 17pt;margin-top: 5px;">ОПТхимик</span>
                <button class="navbar-toggle" aria-label="myModal" data-toggle="modal" data-target="#myModal">
                    <span class="fa fa-search fa-2x"></span>
                </button>
                <a href="{{url('login')}}" aria-label="Авторизация" class="navbar-toggle">
                    <span class="fa fa-user fa-2x"> </span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/">Главная</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="/tsb/">Товарно-сырьевая база</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="/company">Компании</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="/blog">Блог компаний</a></li>
                </ul>

                <ul class="nav navbar-nav">
                    <li><a href="/jobs/">Работа</a></li>
                </ul>

                <ul class="nav navbar-nav">
                    <li><a href="/region">Регионы</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="/spros">Спрос</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@if(Auth::check())
    <nav class="navbar navbar-default sticky1" style="background-color: #fff;margin: 10px auto">
        <div class="container-fluid p-0">
            <div class="container">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" style="    background: none;">
                        <li>
                            <a class="logina"
                               style="color: #080808;font-size: 13pt;padding-right: 57px;padding-left: 0;">Личный
                                кабинет</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li><a class="logina" style="color: #080808;font-size: 11pt;font-weight: normal"
                               href="/profile/">Профиль</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li><a class="logina" style="color: #080808;font-size: 11pt;font-weight: normal"
                               href="/myadvert">Мои объявления</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li><a class="logina" style="color: #080808;font-size: 11pt;font-weight: normal" href="/vacant">Мои
                                вакансии</a></li>
                    </ul>
                    <!--<ul class="nav navbar-nav">
                    <li><a class="logina" style="color: #080808;font-size: 11pt;" href="/favourites">Избранное</a></li>
                  </ul>-->
                    <ul class="nav navbar-nav">
                        <li><a class="logina" style="color: #080808;font-size: 11pt;font-weight: normal"
                               href="/myblog/">Мой блог</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li><a class="logina" style="color: #080808;font-size: 11pt;font-weight: normal"
                               href="/myadvertising">Моя реклама</a></li>
                    </ul>

                    <ul class="nav navbar-nav">
                        <li><a style="color: #080808;font-size: 11pt;font-weight: normal" href="/auth/logout">Выход</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>
@endif
@yield('content')
<footer style="text-align: center">

    <p style="color: white;display: block;padding: 12px;font-weight: bold;font-size: 15pt;">Спасибо, что выбрали портал
        «ОПТхимик»!</p>
</footer>
<div class="footer-info">
    <!-- Yandex.Metrika informer --> <a href="https://metrika.yandex.ru/stat/?id=38513335&amp;from=informer"
                                        target="_blank" rel="nofollow"><img
            src="https://informer.yandex.ru/informer/38513335/3_0_FFFF53FF_FFFF33FF_0_pageviews"
            style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
            title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
            class="ym-advanced-informer" data-cid="38513335" data-lang="ru"/></a> <!-- /Yandex.Metrika informer -->


    <span style="float: right;">
      {{--{{url('/about')}}--}}
        <a href="{{url('/about')}}" style="margin-right: 10px;color:#696969">О проекте</a>
      <a href="{{url('/contacts')}}" style="color:#696969">Контакты</a>
    </span>
</div>
<p style="color:black;text-align: center;">Все права на материалы, находящиеся на сайте, охраняются в соответствии с
    законодательством РФ.<br>
    При любом использовании материалов сайта письменное согласие обязательно.
</p>
<p style="color:black;text-align: center;"><b>ОПТхимик</b> {{LocalizedCarbon::now()->year}} г.</p>
{{--<script src="{{asset('js/manifest.js')}}" async></script>--}}
{{--<script src="{{ asset('js/4848c90a5f.js') }}" async></script>--}}
{{--<script src="{{ asset('js/ckeditor.js') }}" async></script>--}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.lazy.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.lazy.plugins.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/uikit.min.js') }}" async></script>
<script src="{{ asset('js/bootstrap.min.js') }}"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("img.lazy").Lazy({
            // your configuration goes here
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
            onError: function(element) {
                console.log('error loading ' + element.data('src'));
            }
        });
    });
    document.addEventListener('touchstart', onTouchStart, {passive: true});
</script>
@yield('scripts')


<script>

    $(".dropdown-toggle").click(function () {
        $(this).next(".dropdown-menu").toggle("fast")
    });
    $(".cancelComment").click(function () {
        $(this).parents(".dropdown-menu:first").hide("fast")
    });


    $('.regionajax').bind("keyup", function () {


        var _token = $('.search_live').serialize();
        var data_id = this.value;
        if (this.value.length >= 3) {
            $.ajax({
                type: "POST",
                url: "/regions/select/" + data_id,
                response: 'text',
                data: _token,
                success: function (data) {
                    console.log(data);

                    $('.search_result').empty();
                    var parser = document.createElement('a');
                    parser.href = window.location.href;


                    $.each(data, function (i, star) {


                        $(".search_result").append("<a class='search_load' href='http://" + star.slug + ".opt-himik.ru' style='width: 100%;display: inline-block;margin: 0 auto;'>" + star.name + "</a>").fadeIn();


                    });

                    //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
                },
                error: function (xhr, str) {
                    console.log(_token);
                    alert('Возникла ошибка: ' + xhr.responseCode);
                }


            });
        }
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112410116-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-112410116-1');
</script>

<script src="{{ asset('js/popper.min.js') }}"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup').click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });

    });
</script>

<a href="#" class="scrollup">Наверх</a>
</body>


{{--<script src="https://use.fontawesome.com/b42656625d.js"></script>--}}

{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

<!-- Scripts -->


</html>
