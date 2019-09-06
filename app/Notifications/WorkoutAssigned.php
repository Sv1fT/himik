<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WorkoutAssigned extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($delivery,$category,$subcategory)
    {

        $this->request = $delivery;
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
        $subcategory_title = str_slug($this->subcategory[0]['title']);
        #$title_cat = DB::table('category')->where('id','=',$this->request->);
        return (new MailMessage)
            ->subject('Подписка на рассылку!')
            ->line('Вы оформили подписку на объявления "'.$this->subcategory[0]['title'].'" категории '.$this->category[0]['title'].'')
            ->action('Читать', url("http://opt-himik.ru/tsb/".$subcategory_title))
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
