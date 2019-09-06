<?php

namespace App\Http\Sections;

use AdminColumn;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;

use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class User
 *
 * @property \App\User $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class User extends Section
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
    protected $title = 'Пользователи';

    /**
     * @var string
     */
    protected $alias;

    /**
     * @return DisplayInterface
     */
    public function onDisplay($scopes = [])
    {
        $display = AdminDisplay::datatables();
        $display->setHtmlAttribute('class', 'table-info table-hover');
        $display->with('values');

        $display->setColumns([
            $photo = AdminColumn::image('filename', 'Аватар<br/><small>(image)</small>')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs foobar')
                ,
            AdminColumn::link('name', 'Имя<br/><small>(string with accessor)</small>')
                ,


            AdminColumn::relatedLink('values.email', 'Email'),
            $companiesCount = AdminColumn::count('companies', 'Companies<br/><small>(count)</small>')
                ->setHtmlAttribute('class', 'text-center hidden-sm hidden-xs')
                ,
            $companies = AdminColumn::text('title', 'Companies<br/><small>(lists)</small>')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs hidden-md'),
            AdminColumn::custom('Has Photo?<br/><small>(custom)</small>', function ($instance) {
                return $instance->photo ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>';
            })->setHtmlAttribute('class', 'text-center')->setWidth('50px'),
        ]);

    $display->paginate(10);

        return $display;
    }
    /**
     * @param int $id
     *
     * @return FormInterface
     */
    public function onEdit($id)
    {
        $form = AdminForm::panel();
        $form->setHtmlAttribute('enctype','multipart/form-data');
        $form->setItems(
            AdminFormElement::columns()
                ->addColumn(function() {
                    return [
                        AdminFormElement::text('name', 'Имя')->required('Please, type first name'),
                        AdminFormElement::text('company', 'Компания')->required(),
                        AdminFormElement::text('values.email', 'E-mail')->required(),
                        AdminFormElement::text('number', 'Телефон'),
                        AdminFormElement::text('address', 'Адрес'),
                        AdminFormElement::text('city', 'Город'),
                        AdminFormElement::text('site', 'Сайт'),
                        AdminFormElement::textarea('description', 'Описание'),
                        AdminFormElement::select('region', 'Описание')->setModelForOptions(\App\Region::class),
                    ];
                })->addColumn(function() {
                    return [
                        AdminFormElement::image('filename', 'Аватар'),

                        AdminFormElement::hidden('user_id')->setDefaultValue(auth()->user()->id),
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
