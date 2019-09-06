<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
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
    
    protected $uploadurl;


    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        return AdminDisplay::table()
            ->setHtmlAttribute('class', 'table-primary')
            ->setColumns(
                AdminColumn::text('id', '#')->setWidth('30px'),
                AdminColumn::link('title', 'Название')->setWidth('100px'),
                AdminColumn::text('content', 'Контент'),
                AdminColumn::text('price', 'Цена'),
                AdminColumn::image('filename','Изображение'),
                AdminColumnEditable::checkbox('status','Опубликовано')
            )->setApply(function ($query) {
                $query->orderBy('id', 'desc');
            })->paginate(20);
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

            AdminFormElement::image('filename','Изображние')->required(),
            AdminFormElement::checkbox('status', 'Published'),
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
