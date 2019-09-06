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
 * Class Delivery
 *
 * @property \App\Delivery $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Delivery extends Section
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
    protected $title = "Подписчики";

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
                AdminColumn::text('id', '#')->setWidth('100px'),
                AdminColumn::link('email', 'Email'),
                AdminColumn::text('category', 'Рубрика'),
                AdminColumn::text('subcategory', 'Подрубрика')

            )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('email', 'Email')->required()->unique(),
            AdminFormElement::select('category', 'Категория')->setModelForOptions(\App\Category::class),
            AdminFormElement::select('subcategory', 'Подкатегория')->setModelForOptions(\App\Subcategory::class)
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
