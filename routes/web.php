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
    */      #Главная страница

use Illuminate\Support\Facades\Artisan;


    Route::get('clear', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
//        Artisan::call('backup:clean');
        return "Кэш очищен.";
    });
    //Главная
    Route::get('/', 'HomeController@index');
    //Поиск
    Route::get('/search', 'SearchController@index');
    Route::post('/search', 'SearchController@SearchCompany');
    //Товарно сырьевая база
    Route::get('tsb', 'TsbController@ShowPage');
    Route::post('tsb', 'TsbController@addfollowers');
    //Регионы
    Route::get('region/{id}', 'RegionsController@ShowPageRegions');
    Route::get('country/{id}', 'TsbController@ShowPageCountry');
    Route::post('/regions/select/{name}', 'RegionsController@regionSelectPost');
    Route::get('region', 'RegionsController@showRegions');
    Route::get('/regions/{id}/{name}', 'RegionsController@showRegionsadv');
    //Блог
    Route::get('/blog/edit/{id}/{name}', 'BlogController@editGet');
    Route::post('/blog/edit/{id}', 'BlogController@editPost');
    Route::post('/blog/delete/{id}', 'BlogController@deletePost');
    Route::get('addblog', 'BlogController@showpage');
    Route::get('blog', 'BlogController@index');
    Route::post('blog/addblog', 'BlogController@add');
    //Спрос
    Route::get('spros', 'SprosController@showSpros');
    Route::post('spros', 'SprosController@postSpros');
    //Личный кабинет
    Route::get('profile', 'ProfileController@index');
    Route::post('profile', 'ProfileController@editProfile');
    //Мои объявления
    Route::get('myadvert', 'MyAdvertController@index');
    Route::post('myadvert', 'MyAdvertController@add');
    Route::get('/advert/edit/{id}', 'MyAdvertController@editGet');
    Route::post('/advert/edit/{id}', 'MyAdvertController@editPost');
    Route::post('/advert/delete/{id}', 'MyAdvertController@deletePost');
    Route::post('advert/refresh/{id}', 'MyAdvertController@refresh');
    //Мой блог
    Route::get('/myblog', 'BlogController@showBlog');
    Route::get('blog/post/{id}', 'BlogController@postShow');
    Route::get('blog/company/{id}', 'BlogController@companyShow');
    //Мои Вакансии
    Route::post('addvacantion', 'VacantController@addVacantion');
    Route::get('/vacant/edit/{id}/{slug}', 'VacantController@editVacant');
    Route::post('/vacant/edit/{id}', 'VacantController@editVacantPost');
    Route::post('/vacant/delete/{id}', 'VacantController@deleteVacant');
    Route::post('/vacant/mailer', 'VacantController@MailerVacant');
    Route::post('/mailer', 'TestController@emailsend');
    Route::post('/mailer/vacant', 'TestController@emailsendVacant');
    //Вакансии
    Route::get('vacant/{name}', 'VacantController@showVacants');
    Route::get('/vacant', 'VacantController@showVacant');
    //Резюме
    Route::get('resume/{name}', 'ResumeController@showResume');
    Route::post('rezume', 'ResumeController@addRezume');
    //Работа
    Route::get('jobs', 'JobsController@showPage');
    //Компании
    Route::get('company', 'CompanyController@showCompany');
    //Статичные страницы
    Route::get('contacts', function () {
        return view('contacts');
    });
    Route::get('about', function () {
        return view('about');
    });
    //Админка
    Route::group(['prefix' => 'admin'], function () {
        Voyager::routes('https');
    });
    //Логин Регистрация
    Route::get('/auth/logout', ['uses' => 'Auth\LoginController@logout']);
    Route::get('email/verify/{token}', 'HomeController@verify');
    Route::get('change/email', 'HomeController@EmailChange');
    Route::post('change/email', 'HomeController@EmailChanger');
    Route::get('change/password', 'HomeController@PasswordChange');
    Route::post('change/password', 'HomeController@PasswordChanger');
    Auth::routes();
    //Категории
    Route::post('/test/{id}', 'TsbController@postAdd');
    //Подкатегории
    Route::get('tsb/{id}/', 'SubcategoryController@showSubcategory');
    //Моя реклама
    Route::get('myadvertising', 'ReklamsController@reklams');
    Route::post('myadvertising', 'ReklamsController@mailsend');
    //Ajax
    Route::post('test/{id}', 'TestController@SubcategorySelect');
    Route::post('/test/country/{id}', 'TestController@countrySelect');
    Route::post('/test/city/{id}', 'TestController@citySelect');
    Route::post('/test/region/{id}', 'TestController@regionSelect');
    Route::post('/test/update/advert', 'TestController@update_advert_admin');
    //Объявления
    Route::get('/advert/{name}', 'AdvertController@showAdvert');
    Route::get('/advert/show/{id}', 'AdvertController@redirect_advert');
    Route::get('sitemap','TestController@sitemap');
    Route::get('keywords','TestController@keywords');
    Route::get('advert_4oclock','TestController@advert_4oclock');

 Route::get('optimize',function () {
   // dd(env('APP_URL').'/storage/app/public/users-attributes');
   $file = \App\UserAttributes::all();

      foreach ($file as $item1)
      {
        $filename = $item1->filename;
        //dd($filename);
        if(Storage::disk('public')->exists($item1->filename)){
            $img = Image::make('storage/'.$item1->filename);

            //$img->resize(170, 113);

            // and insert a watermark for example
            //$img->insert('image/пlogo.png','bottom-right', 10, 10);

            // finally we save the image as a new file
            $img->save('storage/'.$item1->filename, 20);


          echo $item1->filename;
          echo "<br>";
          //app(Spatie\ImageOptimizer\OptimizerChain::class)->optimize('storage/'.$item1->filename);

        }
        else {

        }

      }




 });
Route::get('short_content', 'AdvertController@shortContent');

    Route::get('/{id}', 'AdvertController@showAdvertsnow');
