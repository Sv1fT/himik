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

class Blog extends Section
{
    /**
     * @var bool
     */
    protected $checkAccess = false;

    /**
     * @var string
     */
    protected $title = 'Блог';

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
            AdminColumn::text('id', '#')->setWidth('30px'),
            AdminColumn::link('name', 'Название')->setWidth('100px'),
            AdminColumn::text('content', 'Контент'),
            AdminColumn::text('url', 'Источник'),
            AdminColumn::image('filename','Изображение'),
            AdminColumnEditable::checkbox('active')->setLabel('Опубликованно')
        )->paginate(20);
    }

    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel();

        $form->setItems(
            AdminFormElement::columns()
                ->addColumn(function () {
                    return [
                        AdminFormElement::text('name', 'Название')->required(),

                        AdminFormElement::textarea('content', 'Контент')->required(),
                        AdminFormElement::text('url', 'Источник'),
                        AdminFormElement::image('filename', 'Изображние')->required(),
                    ];
                })
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
