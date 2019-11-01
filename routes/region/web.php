<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::domain('{account}.opt-himik.ru')->group(function () {
    Route::get('/', 'Regions\HomeController@index');
    //Поиск
    Route::get('/search', 'Regions\SearchController@index');
    Route::post('/search', 'Regions\SearchController@SearchCompany');
    //Товарно сырьевая база
    Route::get('/tsb', 'Regions\TsbController@ShowPage');
    Route::post('tsb', 'Regions\TsbController@addfollowers');
    //Регионы
    Route::get('region/{id}', 'Regions\RegionsController@ShowPageRegions');
    Route::get('country/{id}', 'Regions\TsbController@ShowPageCountry');
    Route::post('/regions/select/{name}', 'Regions\RegionsController@regionSelectPost');
    Route::get('region', 'Regions\RegionsController@showRegions');
    Route::get('/regions/{id}/{name}', 'Regions\RegionsController@showRegionsadv');
    //Блог
    Route::get('/blog/edit/{id}/{name}', 'Regions\BlogController@editGet');
    Route::post('/blog/edit/{id}', 'Regions\BlogController@editPost');
    Route::post('/blog/delete/{id}', 'Regions\BlogController@deletePost');
    Route::get('addblog', 'Regions\BlogController@showpage');
    Route::get('blog', 'Regions\BlogController@index');
    Route::post('blog/addblog', 'Regions\BlogController@add');
    //Спрос
    Route::get('spros', 'Regions\SprosController@showSpros');
    Route::post('spros', 'Regions\SprosController@postSpros');
    //Личный кабинет
    Route::get('profile', 'Regions\ProfileController@index');
    Route::post('profile', 'Regions\ProfileController@editProfile');
    //Мои объявления
    Route::get('myadvert', 'Regions\MyAdvertController@index');
    Route::post('myadvert', 'Regions\MyAdvertController@add');
    Route::get('/advert/edit/{id}', 'Regions\MyAdvertController@editGet');
    Route::post('/advert/edit/{id}', 'Regions\MyAdvertController@editPost');
    Route::post('/advert/delete/{id}', 'Regions\MyAdvertController@deletePost');
    Route::post('advert/refresh/{id}', 'Regions\MyAdvertController@refresh');
    //Мой блог
    Route::get('/myblog', 'Regions\BlogController@showBlog');
    Route::get('blog/post/{id}', 'Regions\BlogController@postShow');
    Route::get('blog/company/{id}', 'Regions\BlogController@companyShow');
    //Мои Вакансии
    Route::post('addvacantion', 'Regions\VacantController@addVacantion');
    Route::get('/vacant/edit/{id}/{slug}', 'Regions\VacantController@editVacant');
    Route::post('/vacant/edit/{id}', 'Regions\VacantController@editVacantPost');
    Route::post('/vacant/delete/{id}', 'Regions\VacantController@deleteVacant');
    Route::post('/vacant/mailer', 'Regions\VacantController@MailerVacant');
    Route::post('/mailer', 'Regions\TestController@emailsend');
    Route::post('/mailer/vacant', 'Regions\TestController@emailsendVacant');
    //Вакансии
    Route::get('vacant/{name}', 'Regions\VacantController@showVacants');
    Route::get('/vacant', 'Regions\VacantController@showVacant');
    //Резюме
    Route::get('resume/{name}', 'Regions\ResumeController@showResume');
    Route::post('rezume', 'Regions\ResumeController@addRezume');
    //Работа
    Route::get('jobs', 'Regions\JobsController@showPage');
    //Компании
    Route::get('company', 'Regions\CompanyController@showCompany');
    //Статичные страницы
    Route::get('contacts', function () {
        return view('contacts');
    });
    Route::get('about', function () {
        return view('about');
    });
    //Админка
    Route::group(['prefix' => 'admin'], function () {
        Voyager::routes();
    });
    //Логин Регистрация
    Route::get('/auth/logout', ['uses' => 'Auth\LoginController@logout']);
    Route::get('email/verify/{token}', 'Regions\HomeController@verify');
    Route::get('change/email', 'Regions\HomeController@EmailChange');
    Route::post('change/email', 'Regions\HomeController@EmailChanger');
    Route::get('change/password', 'Regions\HomeController@PasswordChange');
    Route::post('change/password', 'Regions\HomeController@PasswordChanger');
    Auth::routes();
    //Категории
    Route::post('/test/{id}', 'Regions\TsbController@postAdd');
    //Подкатегории
    Route::get('tsb/{id}/', 'Regions\SubcategoryController@showSubcategory');
    //Моя реклама
    Route::get('myadvertising', 'Regions\ReklamsController@reklams');
    Route::post('myadvertising', 'Regions\ReklamsController@mailsend');
    //Ajax
    Route::post('test/{id}', 'Regions\TestController@SubcategorySelect');
    Route::post('/test/country/{id}', 'Regions\TestController@countrySelect');
    Route::post('/test/city/{id}', 'Regions\TestController@citySelect');
    Route::post('/test/region/{id}', 'Regions\TestController@regionSelect');
    Route::post('/test/update/advert', 'Regions\TestController@update_advert_admin');
    //Объявления
    Route::get('/advert/{name}', 'Regions\AdvertController@showAdvert');
    Route::get('/advert/show/{id}', 'Regions\AdvertController@redirect_advert');
    Route::get('/{id}', 'Regions\AdvertController@showAdvertsnow');
});
