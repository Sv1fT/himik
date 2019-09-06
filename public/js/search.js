$(document).ready(function () {

    $('#select').fadeIn(1000);
    $('#select').empty();

    $id = $('#country').children(":selected").val();

    console.log($id);
    $('.countryajax').attr('value', $id);


    var _data = $('.country_live').serialize();


    $.ajax({
        type: "POST",
        url: "/test/country/" + $id,
        response: 'text',
        data: _data,
        success: function (data) {
            $("#select").append("<option id='null' value='null'>Выберите Регион</option>").fadeIn();

            $.each(data, function (i, star) {

                $("#select").append('<option id="' + star.id + '"value="' + star.id + '">' + star.name + '</option>').fadeIn();

            });

            //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });


$('#submit').click(function (e) {
e.preventDefault();

    $region = $('#select :selected').val();
    $city = $('#city :selected').val();
    $country = $('#country :selected').val();
    console.log($country);
    var price_min = $('#price_min').val();
    var price_max = $('#price_max').val();
    var text = $('#search_sold').val();
    $serach_text = $('#search_text').text();
    $category = $('#category').val();
    console.log($category);
    console.log($region);
    console.log(price_max);
    $params = window
        .location
        .search
        .replace('?', '')
        .split('&')
        .reduce(
            function (p, e) {
                var a = e.split('=');
                p[decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                return p;
            },
            {}
        );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({

        type: "POST",
        url: "/search",
        response: 'text',
        data: {data: text, region: $region, city: $city, category: $category, country: $country, name: $serach_text,price_min:price_min,price_max:price_max, params: $params},

        beforeSend: function (data) {
            console.log(data);
            $('#search_ajax').html('<h1>Подождите идет загрузка.....</h1>');
        },
        success: function (data) {
            $('#search_ajax').html(data);
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });
    console.log(text);
});

$("#country").change(function () {

    $('#select').fadeIn(1000);
    $('#select').empty();
    $('#city').empty();
    $('#city').fadeOut(1000);

    $id = $('#country').children(":selected").val();

console.log($id);
    $('.countryajax').attr('value', $id);


    var _data = $('.country_live').serialize();


    $.ajax({
        type: "POST",
        url: "/test/country/" + $id,
        response: 'text',
        data: _data,
        success: function (data) {
            $("#select").append("<option id='null' value='null'>Выберите Регион</option>").fadeIn();

            $.each(data, function (i, star) {

                $("#select").append('<option id="' + star.id + '"value="' + star.id + '">' + star.name + '</option>').fadeIn();

            });

            //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    })
});

$("#select").change(function () {

    $('.city').fadeIn();
    $('#city').empty();

    var id = $('#select :selected').attr('id');

    $('.regionajax').attr('value', id);


    var _data = $('.subcategory_live').serialize();

    $.ajax({
        type: "POST",
        url: "/test/region/" + id,
        response: 'text',
        data: _data,
        success: function (data) {
            $("#city").append("<option id='null' value='null'>Выберите Город</option>").fadeIn();

            $.each(data, function (i, star) {

                $("#city").append('<option id="' + star.id + '"value="' + star.id + '">' + star.name + '</option>').fadeIn();

            });

            //$(".search_result").html("<li style='width: 250px'>"+value.title+"</li>").fadeIn();
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    })
});
    function scrl() {
        var top = $(window).scrollTop();
        if (top > 180) {
            $('#search-right').css('position', 'fixed');
            $('#search-right').css('top', '10%');
            $('#search-right').css('margin-top', '0');
        }
        else {
            $('#search-right').css('position', 'relative');
            $('#search-right').css('top', '0');
            $('#search-right').css('margin-top', '60px');
        }
    }

     $(window).scroll(scrl);
})
;
