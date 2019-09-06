<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class getback extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Сегодня интеренет-портал "ОПТхимик" это!')
                    ->subject('Сегодня интеренет-портал "ОПТхимик" это!')
                    ->line('•	B2B площадка по продаже всех видов химической продукции отечественного и зарубежного производства. Крупнейший российский интернет портал химической отрасли;')
                    ->line('•	ежедневная нарастающая посещаемость;')
                    ->line('•	удобная загрузка товаров и услуг;')
                    ->line('•	широкий охват аудитории в разных городах и регионах;')
                    ->line('•	высокие позиции в поисковых системах Яндекс и Google;')
                    ->line('•	Регулярно добавляемая оперативная информация авторских статей, пресс-релизов, технологических обзоров, «историй успеха», описаний внедренческого опыта, публикаций рекламно-информационного характера;')
                    ->line('•	Базы данных химических компаний из разных регионов России и зарубежных стран.')
                    ->action('Личный кабинет', 'http://opt-himik.ru/login')
                    ->line('Вы получили данное сообщение, так как информация о Вашей компании размещена в Интернет-портале «ОПТхимик». ');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
