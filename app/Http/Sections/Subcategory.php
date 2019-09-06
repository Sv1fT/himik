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

/**
 * Class Subcategory
 *
 * @property \App\Subcategory $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Subcategory extends Section
{
    /**
     * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
     *
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Подкатегории';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay()
    {
        $display = AdminDisplay::datatables();
        $display->with('category');
        $display->setColumns([
            AdminColumn::link('id')->setLabel('#')->setWidth('20px'),
            AdminColumn::link('title')->setLabel('Title')->setWidth('400px')
        ]);

        $display->paginate(15);
        return $display;
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Название')->required()->unique(),
            AdminFormElement::text('slug', 'Алиас ссылки')->required()->unique(),
            AdminFormElement::select('category', 'Категория')->setModelForOptions(\App\Category::class),
            AdminFormElement::ckeditor('description', 'Описание')
        );
        return $form;
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
