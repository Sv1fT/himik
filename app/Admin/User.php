<?php
namespace Admin\Http\Sections;
use AdminColumn;
use AdminDisplay;
use AdminDisplayFilter;
use AdminForm;
use AdminFormElement;
use App\Model\Country;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

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
    protected $alias = 'users';

    public function getTitle()
    {
        return 'Пользователи    ';
    }

    /**
     * @return DisplayInterface
     */
    public function onDisplay($scopes = [])
    {
        $display = AdminDisplay::datatablesAsync()->setDisplaySearch(true)->paginate(10);
        $display->setHtmlAttribute('class', 'table-primary');
        $display->with('values');
        $display->setFilters(
            AdminDisplayFilter::related('user_id')->setModel(\App\User::class)
        );

        $display->setColumns([
            AdminColumn::text('id', '#')->setWidth('30px'),
            AdminColumn::text('values.name', 'Имя')->setWidth('100px')->append(
                AdminColumn::filter('user_id')
            ),
            AdminColumn::text('company', 'Компания')->setWidth('50px'),
            AdminColumn::link('email', 'email')->setWidth('100px'),
        ]);

        $display->paginate(20);
        #dd($display);
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
            AdminFormElement::text('name', 'Имя')->required()->setModelForOptions(new \App\UserAttributes()),
            AdminFormElement::text('company', 'Компания')->required(),
            AdminFormElement::select('region', 'Регион')->setModelForOptions(\App\Region::class),
            AdminFormElement::text('number', 'Телефон')->required(),
            AdminFormElement::text('sity', 'Город')->required(),
            AdminFormElement::text('adress', 'Адрес')->required(),
            AdminFormElement::text('description', 'Описание компании')->required(),
            AdminFormElement::text('site', 'Сайт')->required()
        );

        return $form;
    }


    public function onCreate()
    {
        return $this->onEdit(null);
    }
}
