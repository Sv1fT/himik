<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddAdvert extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($blog,$titlesubcategory,$category,$subcategory)
    {
        $this->request = $blog;

        $this->title = $titlesubcategory;

        $this->category = $category;
        $this->subcategory = $subcategory;

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
        $title = str_slug($this->request['title']);
        return (new MailMessage)
            ->greeting('Новое объявление!')
            ->subject('Новое объявление!')
            ->line('Вы оформили подписку на объявления "'.$this->subcategory[0]['title'].'" категории '.$this->category[0]['title'].'')
            ->action('Читать', url("http://opt-himik.ru/advert/show/".$title.'-'.$this->request['id']))
            ->line('Пожалуйста, не забывайте поделиться с друзьями.');
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
