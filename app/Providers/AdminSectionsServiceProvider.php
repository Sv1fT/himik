<?php

namespace App\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        //\App\User::class => 'App\Http\Sections\Users',
        \App\Advert::class => 'App\Http\Sections\Advert',
        \App\Region::class => 'App\Http\Sections\Region',
        \App\Category::class => 'App\Http\Sections\Category',
        \App\Subcategory::class => 'App\Http\Sections\Subcategory',
        \App\UserAttributes::class => 'App\Http\Sections\User',
        \App\Blog::class => 'App\Http\Sections\Blog',
        \App\Delivery::class => 'App\Http\Sections\Delivery',
        \App\Razdel::class => 'App\Http\Sections\Razdel',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
