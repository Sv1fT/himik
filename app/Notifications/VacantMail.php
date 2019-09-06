<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VacantMail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$phone,$email,$description,$prev_url,$vacants)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->description = $description;
        $this->prev_url = $prev_url;
        $this->vacants = $vacants;


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
	        ->greeting('Новый ответ на вакансию!')
	        ->subject('Новый ответ на вакансию!')
	        ->line('Вам пришло резюме по вашей вакансии: '.$this->vacants)
	        ->action('Вакансия',$this->prev_url)
	        ->line('Имя: '.$this->name)
	        ->line('Телефон: '.$this->phone)
	        ->line('E-mail: '.$this->email)
	        ->line('О себе: '.$this->description)
	        ->line('Пожалуйста, не забывайте поделиться с друзьями.')
	        ->view('vendor.notifications.email');
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
