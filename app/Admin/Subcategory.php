<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Category;

AdminSection::registerModel(\App\Subcategory::class, function (ModelConfiguration $model) {
    $model->setTitle('Подкатегории');
    // Display
    $model->onDisplay(function () {

        $display = AdminDisplay::datatables();
        $display->with('category');
        $display->setColumns([
            AdminColumn::link('id')->setLabel('#')->setWidth('20px'),
            AdminColumn::link('title')->setLabel('Title')->setWidth('400px')
        ])->setOrderable(function($query) {
            $query->orderBy('id', 'asc');
        });

        $display->paginate(15);

        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Название')->required()->unique(),
            AdminFormElement::select('category', 'Категория')->setModelForOptions(\App\Category::class),
            AdminFormElement::ckeditor('description', 'Описание')
        );
        return $form;
    });
})
    ->addMenuPage(\App\Subcategory::class, 4)
    ->setIcon('fa fa-bank');
