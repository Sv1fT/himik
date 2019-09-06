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

        Route::get('/', 'Regions\HomeController@index');
        Route::get('logout', 'Regions\HomeController@Logout');
        Route::get('email/verify/{token}','Regions\HomeController@verify');
        Route::get('/search', 'Regions\HomeController@postSearch');
        Route::post('/search', 'Regions\HomeController@postSearchCompany');
        Route::get('change/email','Regions\HomeController@EmailChange');
        Route::post('change/email','Regions\HomeController@EmailChanger');
        Route::get('change/password','Regions\HomeController@PasswordChange');
        Route::post('change/password','Regions\HomeController@PasswordChanger');
        #Tsb Controller
        Route::get('tsb', 'Regions\TsbController@ShowPage');
        Route::get('region/{id}', 'Regions\TsbController@ShowPageRegions');
        Route::get('tsb/{id}/', 'Regions\TsbController@showSubcategory');
        Route::get('/advert/{name}', 'Regions\TsbController@showAdvert');
        Route::get('/advert/show/{id}', 'Regions\TsbController@redirect_advert');

        Route::get('spros', 'Regions\TsbController@showSpros');
        Route::post('spros','Regions\TsbController@postSpros');
        Route::get('favourites', 'Regions\TsbController@favouritesGet');
        Route::post('/favorites/{id}/{name}', 'Regions\TsbController@favoritePost');
        Route::post('/favorites/delete/{id}/{name}', 'Regions\TsbController@favoriteDeletePost');
        Route::post('/regions/select/{name}', 'Regions\TsbController@regionSelectPost');
        #My Advert Controller
        Route::get('/advert/edit/{id}/{name}', 'Regions\MyAdvertController@editGet');
        Route::post('/advert/edit/{id}/{name}', 'Regions\MyAdvertController@editPost');
        Route::post('/advert/delete/{id}', 'Regions\MyAdvertController@deletePost');
        Route::get('/blog/edit/{id}/{name}', 'Regions\BlogController@editGet');
        Route::post('/blog/edit/{id}/{name}', 'Regions\BlogController@editPost');
        Route::post('/blog/delete/{id}', 'Regions\BlogController@deletePost');
        Route::get('myadvert', 'Regions\MyAdvertController@index');
        Route::post('myadvert', 'Regions\MyAdvertController@add');
        #company
        Route::get('/company', 'Regions\CompanyController@showCompany');
        #regions
        Route::get('/region', 'Regions\RegionsController@showRegions');

        Route::get('/regions/{id}/{name}', 'Regions\RegionsController@showRegionsadv');

        Route::get('jobs', 'Regions\JobsController@showPage');
        Route::get('profile', 'Regions\ProfileController@index');
        Route::post('profile', 'Regions\ProfileController@editProfile');
        Route::get('addblog', 'Regions\BlogController@showpage');
        Route::get('blog','Regions\BlogController@index');
        Route::post('addblog', 'Regions\BlogController@add');
        Route::post('tsb', 'Regions\TsbController@addfollowers');


        Route::get('/myblog', 'Regions\BlogController@showBlog');
        Route::post('/test/{id}', 'Regions\TestController@postAdd');
        Route::post('/test/country/{id}', 'Regions\TestController@countrySelect');
        Route::post('/test/region/{id}', 'Regions\TestController@regionSelect');
        Route::get('myadvertising', 'Regions\TestController@reklams');
        Route::post('myadvertising', 'Regions\TestController@mailsend');
        Route::any('mailer','Regions\TestController@emailsend');
        Route::get('blog/post/{id}','Regions\BlogController@postShow');
        Route::get('blog/company/{id}','Regions\BlogController@companyShow');
        Auth::routes();
        Route::get('test', 'Regions\TestController@index');
        Route::get('jobs/{name}', 'Regions\JobsController@showResume');
        Route::post('advert/refresh/{id}', 'Regions\MyAdvertController@refresh');
        Route::get('/vacant', 'Regions\JobsController@showVacant');
        Route::get('/vacant/edit/{id}/{slug}', 'Regions\JobsController@editVacant');
        Route::post('/vacant/mailer', 'Regions\JobsController@MailerVacant');
        Route::get('vacant/{name}', 'Regions\JobsController@showVacants');
        Route::get('about',function (){
            return view('about');
        });
        Route::get('contacts',function (){
            return view('contacts');
        });
Route::get('/{id}', 'Regions\TsbController@showAdvertsnow');
