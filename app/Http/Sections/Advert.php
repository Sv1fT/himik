<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminColumnEditable;
use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Section;


class Advert extends Section
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Объявления';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::datatables()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#'),
                AdminColumn::link('title', 'Название'),
                AdminColumn::text('content', 'Контент'),
                AdminColumn::text('price', 'Цена'),
                AdminColumn::image('filename','Изображение'),
                AdminColumnEditable::checkbox('status')->setLabel('Опубликованно')
            )-orderBy('stasus','asc')->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        return AdminForm::panel()->addBody([
            AdminFormElement::text('title', 'Название')->required(),
            AdminFormElement::select('region', 'Регион')->setModelForOptions(\App\Region::class),
            AdminFormElement::select('category', 'Категория')->setModelForOptions(\App\Category::class),
            AdminFormElement::select('subcategory', 'Подкатегория')->setModelForOptions(\App\Subcategory::class),
            AdminFormElement::textarea('content', 'Контент')->required(),
            AdminFormElement::text('price','Цена'),
            AdminFormElement::image('filename','Изображние')->required(),
        ])->setHtmlAttribute('enctype','multipart/form-data');
    }

    /**
     * @return FormInterface
     */
    public function onCreate()
    {
        return $this->onEdit(null);
    }

    /**
     * @return void
     */
    public function onDelete($id)
    {
        // todo: remove if unused
    }

    /**
     * @return void
     */
    public function onRestore($id)
    {
        // todo: remove if unused
    }
}
